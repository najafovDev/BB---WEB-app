<?php
/**
 * Implementation of Kohana 3.3.1 Image module.
 * Manipulate images using standard methods such as resize, crop, rotate, etc.
 * This class must be re-initialized for every image you wish to manipulate.
 *
 * @package    Image
 * @copyright  (c) 2008-2009 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Image {

	// Resizing constraints
	const NONE    = 0x01;
	const WIDTH   = 0x02;
	const HEIGHT  = 0x03;
	const AUTO    = 0x04;
	const INVERSE = 0x05;
	const PRECISE = 0x06;

	// Flipping directions
	const HORIZONTAL = 0x11;
	const VERTICAL   = 0x12;

	public $driverName = 'GD';

	// Driver instance
	private $_driver;

	// Image info
	public $file;
	public $name;	//filename without extension
	public $ext;	//extension
	public $width;
	public $height;
	public $type;	//IMAGETYPE_XXX constant
	public $mime;

	/**
	 * Creates a new image editor instance.
	 *
	 * @throws  CException
	 * @param   string filename of image
	 * @param   string driver name
	 * @return  void
	 */
	public function __construct($file, $driver = NULL) {

		try {
			$file = realpath($file);
			$pathinfo = pathinfo($file);
			$info = getimagesize($file);
		} catch (Exception $e) {}

		if (empty($info) || empty($pathinfo) || empty($file))
			throw new CException(Yii::t('Not an image or invalid image: {file}', array('file' => $file)));

		// Load the driver
		if ($driver === NULL)
			$driver = $this->driverName;
		$driver .= 'Driver';
		Yii::import('application.extensions.image.drivers.'.$driver);
		$this->_driver = new $driver($file);

		// Store the image information
		$this->file   = $file;
		$this->name   = $pathinfo['filename'];
		$this->ext    = $pathinfo['extension'];
		$this->width  = $info[0];
		$this->height = $info[1];
		$this->type   = $info[2];
		$this->mime   = $info['mime'];
	}

	/**
	 * Resize an image to a specific width and height. By default, Kohana will
	 * maintain the aspect ratio using the width as the master dimension. If you
	 * wish to use height as master dim, set $image->master_dim = Image::HEIGHT
	 * This method is chainable.
	 *
	 * @param   integer  width
	 * @param   integer  height
	 * @param   integer  one of: Image::NONE, Image::AUTO, Image::WIDTH, Image::HEIGHT
	 * @return  object
	 */
	public function resize($width, $height, $master = NULL) {

		if ($master === NULL) {

			$master = Image::AUTO;

		} elseif ($master == Image::WIDTH AND !empty($width)) {

			$master = Image::AUTO;
			$height = NULL;

		} elseif ($master == Image::HEIGHT AND ! empty($height)) {

			$master = Image::AUTO;
			$width = NULL;
		}

		if (empty($width)) {
			if ($master === Image::NONE)
				$width = $this->width;
			else
				$master = Image::HEIGHT;
		}

		if (empty($height)) {
			if ($master === Image::NONE)
				$height = $this->height;
			else
				$master = Image::WIDTH;
		}

		switch ($master) {
			case Image::AUTO:
				// Choose direction with the greatest reduction ratio
				$master = ($this->width / $width) > ($this->height / $height) ? Image::WIDTH : Image::HEIGHT;
			break;
			case Image::INVERSE:
				// Choose direction with the minimum reduction ratio
				$master = ($this->width / $width) > ($this->height / $height) ? Image::HEIGHT : Image::WIDTH;
			break;
		}

		switch ($master) {
			case Image::WIDTH:
				// Recalculate the height based on the width proportions
				$height = $this->height * $width / $this->width;
			break;
			case Image::HEIGHT:
				// Recalculate the width based on the height proportions
				$width = $this->width * $height / $this->height;
			break;
			case Image::PRECISE:
				// Resize to precise size
				$ratio = $this->width / $this->height;

				if ($width / $height > $ratio)
					$height = $this->height * $width / $this->width;
				else
					$width = $this->width * $height / $this->height;
			break;
		}

		$width  = max(round($width), 1);
		$height = max(round($height), 1);

		if ($this->_driver->resize($width, $height)) {
			$this->width = $this->_driver->getWidth();
			$this->height = $this->_driver->getHeight();
		}

		return $this;
	}

	/**
	 * Crop an image to a specific width and height. You may also set the top
	 * and left offset.
	 * This method is chainable.
	 *
	 * @param   integer  $width     new width
	 * @param   integer  $height    new height
	 * @param   mixed    $offset_x  offset from the left
	 * @param   mixed    $offset_y  offset from the top
	 * @return  $this
	 */
	public function crop($width, $height, $offset_x = NULL, $offset_y = NULL) {

		if ($width > $this->width)
			// Use the current width
			$width = $this->width;

		if ($height > $this->height)
			// Use the current height
			$height = $this->height;

		if ($offset_x === NULL)
			// Center the X offset
			$offset_x = round(($this->width - $width) / 2);
		elseif ($offset_x === TRUE)
			// Bottom the X offset
			$offset_x = $this->width - $width;
		elseif ($offset_x < 0)
			// Set the X offset from the right
			$offset_x = $this->width - $width + $offset_x;

		if ($offset_y === NULL)
			// Center the Y offset
			$offset_y = round(($this->height - $height) / 2);
		elseif ($offset_y === TRUE)
			// Bottom the Y offset
			$offset_y = $this->height - $height;
		elseif ($offset_y < 0)
			// Set the Y offset from the bottom
			$offset_y = $this->height - $height + $offset_y;

		// Determine the maximum possible width and height
		$max_width  = $this->width  - $offset_x;
		$max_height = $this->height - $offset_y;

		if ($width > $max_width)
			// Use the maximum available width
			$width = $max_width;

		if ($height > $max_height)
			// Use the maximum available height
			$height = $max_height;

		if ($this->_driver->crop($width, $height, $offset_x, $offset_y)) {
			$this->width = $this->_driver->getWidth();
			$this->height = $this->_driver->getHeight();
		}

		return $this;
	}

	/**
	 * Allows rotation of an image by 180 degrees clockwise or counter clockwise.
	 * This method is chainable.
	 *
	 * @param   integer  degrees
	 * @return  object
	 */
	public function rotate($degrees) {

		$degrees = (int) $degrees;

		if ($degrees > 180)
			do {
				$degrees -= 360;
			} while($degrees > 180);

		if ($degrees < -180)
			do {
				$degrees += 360;
			} while($degrees < -180);

		if ($this->_driver->rotate($degrees)) {
			$this->width = $this->_driver->getWidth();
			$this->height = $this->_driver->getHeight();
		}

		return $this;
	}

	/**
	 * Flip an image horizontally or vertically.
	 * This method is chainable.
	 *
	 * @param   integer  $direction  direction: Image::HORIZONTAL, Image::VERTICAL
	 * @return  object
	 */
	public function flip($direction) {

		if ($direction !== Image::HORIZONTAL)
			$direction = Image::VERTICAL;

		$this->_driver->flip($direction);

		return $this;
	}

	/**
	 * Sharpen an image.
	 * This method is chainable.
	 *
	 * @param   integer  amount to sharpen, usually ~20 is ideal
	 * @return  object
	 */
	public function sharpen($amount) {

		$amount = max(1, min($amount, 100));

		$this->_driver->sharpen($amount);

		return $this;
	}

	/**
	 * Add a reflection to an image. The most opaque part of the reflection
	 * will be equal to the opacity setting and fade out to full transparent.
	 * Alpha transparency is preserved.
	 * This method is chainable.
	 *
	 * @param   integer   $height   reflection height
	 * @param   integer   $opacity  reflection opacity: 0-100
	 * @param   boolean   $fade_in  TRUE to fade in, FALSE to fade out
	 * @return  $this
	 */
	public function reflection($height = NULL, $opacity = 100, $fade_in = FALSE) {

		if ($height === NULL || $height > $this->height)
			$height = $this->height;

		$opacity = min(max($opacity, 0), 100);

		if ($this->_driver->reflection($height, $opacity, $fade_in)) {
			$this->width = $this->_driver->getWidth();
			$this->height = $this->_driver->getHeight();
		}

		return $this;
	}

	/**
	 * Place watermark on image.
	 * This method is chainable.
	 *
	 * @param   Image   watermark
	 * @param   boolean offset x
	 * @param   boolean offset y
	 * @param   imteger opacity
	 * @return  boolean
	 */
	public function watermark($watermark, $offset_x = FALSE, $offset_y = FALSE, $opacity = 100) {

		if ($offset_x === NULL)
			// Center the X offset
			$offset_x = round(($this->width - $watermark->width) / 2);
		elseif ($offset_x === TRUE)
			// Bottom the X offset
			$offset_x = $this->width - $watermark->width;
		elseif ($offset_x < 0)
			// Set the X offset from the right
			$offset_x = $this->width - $watermark->width + $offset_x;

		if ($offset_y === NULL)
			// Center the Y offset
			$offset_y = round(($this->height - $watermark->height) / 2);
		elseif ($offset_y === TRUE)
			// Bottom the Y offset
			$offset_y = $this->height - $watermark->height;
		elseif ($offset_y < 0)
			// Set the Y offset from the bottom
			$offset_y = $this->height - $watermark->height + $offset_y;

		// The opacity must be in the range of 1 to 100
		$opacity = min(max($opacity, 1), 100);

		$this->_driver->watermark($watermark, $offset_x, $offset_y, $opacity);

		return $this;
	}

	/**
	 * Set the background color of an image. This is only useful for images
	 * with alpha transparency.
	 * This method is chainable.
	 *
	 * @param   string   $color    hexadecimal color value
	 * @param   integer  $opacity  background opacity: 0-100
	 * @return  $this
	 */
	public function background($color, $opacity = 100) {

		if ($color[0] === '#')
			$color = substr($color, 1);

		if (strlen($color) === 3)
			$color = preg_replace('/./', '$0$0', $color);

		// Convert the hex into RGB values
		list ($r, $g, $b) = array_map('hexdec', str_split($color, 2));

		$opacity = min(max($opacity, 0), 100);

		$this->_driver->background($r, $g, $b, $opacity);

		return $this;
	}

	/**
	 * Save the image. If the filename is omitted, the original image will
	 * be overwritten.
	 *
	 * @param   string   $file     new image path
	 * @param   integer  $quality  quality of image: 1-100
	 * @return  boolean
	 * @throws  CException
	 */
	public function save($file = NULL, $quality = 100) {

		if ($file === NULL)
			$file = $this->file;

		if (is_file($file)) {

			if (!is_writable($file))
				throw new CException(Yii::t('File must be writable: {file}', array('file' => $file)));

		} else {

			$directory = realpath(pathinfo($file, PATHINFO_DIRNAME));

			if (!is_dir($directory) || !is_writable($directory))
				throw new CException(Yii::t('Directory must be writable: {directory}', array('directory' => $directory)));
		}

		$quality = min(max($quality, 1), 100);

		return $this->_driver->save($file, $quality);
	}
	
	/**
	 * Render the image and return the binary string.
	 *
	 * @param   string   $type     image type to return: png, jpg, gif, etc
	 * @param   integer  $quality  quality of image: 1-100
	 * @return  string
	 */
	public function render($type = NULL, $quality = 100) {

		if ($type === NULL)
			$type = $this->ext;

		return $this->_driver->render($type, $quality);
	}

}