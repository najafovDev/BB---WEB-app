<?php Yii::import('application.extensions.image.ImageDriver');
/**
 * ImageMagick Image Driver.
 *
 * @package    Image
 * @copyright  (c) 2008-2009 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class ImagickDriver extends ImageDriver {

	// Temporary image resource
	private $_image;

	private $_format;

	/**
	 * Checks if ImageMagick is enabled.
	 *
	 * @throws  CException
	 * @return  boolean
	 */
	public static function check() {

		if (!extension_loaded('imagick'))
			throw new CException(Yii::t('Imagick is not installed, or the extension is not loaded.'));

		return ImagickDriver::$_checked = TRUE;
	}

	/**
	 * Runs self::check and loads the image.
	 *
	 * @throws  CException
	 * @param   string   filename
	 * @return  void
	 */
	public function __construct($file) {

		if (!ImagickDriver::$_checked)
			ImagickDriver::check();

		$this->_image = new Imagick;
		$this->_image->readImage($file);
		$this->_format = $this->_image->getImageFormat();

		if (!$this->_image->getImageAlphaChannel())
			$this->_image->setImageAlphaChannel(Imagick::ALPHACHANNEL_SET);
	}

	/**
	 * Destroys the loaded image to free up resources.
	 *
	 * @return  void
	 */
	public function __destruct() {
		$this->_image->clear();
		$this->_image->destroy();
	}


	public function resize($width, $height) {

		if ($this->_image->scaleImage($width, $height))
			return TRUE;

		return FALSE;
	}


	public function crop($width, $height, $offset_x, $offset_y) {

		if ($this->_image->cropImage($width, $height, $offset_x, $offset_y)) {

			// Trim off hidden areas
			$this->_image->setImagePage($this->getWidth(), $this->getHeight(), 0, 0);

			return TRUE;
		}

		return FALSE;
	}


	public function rotate($degrees) {

		if ($this->_image->rotateImage(new ImagickPixel('transparent'), $degrees)) {

			// Trim off hidden areas
			$this->_image->setImagePage($this->getWidth(), $this->getHeight(), 0, 0);

			return TRUE;
		}

		return FALSE;
	}


	public function flip($direction) {

		if ($direction === Image::HORIZONTAL)
			return $this->_image->flopImage();
		else
			return $this->_image->flipImage();
	}


	public function sharpen($amount) {

		// IM not support $amount under 5 (0.15)
		$amount = ($amount < 5) ? 5 : $amount;

		// Amount should be in the range of 0.0 to 3.0
		$amount = ($amount * 3.0) / 100;

		return $this->_image->sharpenImage(0, $amount);
	}


	public function reflection($height, $opacity, $fade_in) {

		// Clone the current image and flip it for reflection
		$reflection = $this->_image->clone();
		$reflection->flipImage();

		// Crop the reflection to the selected height
		$reflection->cropImage($this->_image->getImageWidth(), $height, 0, 0);
		$reflection->setImagePage($this->_image->getImageWidth(), $height, 0, 0);

		// Sets direction
		$direction = 'gradient:transparent-black';
		if ($fade_in)
			$direction = 'gradient:black-transparent';

		// Create a gradient for fading
		$gradient = new Imagick();
		$gradient->newPseudoImage($reflection->getImageWidth(), $height, $direction);

		// Apply the fade alpha channel to the reflection
		$reflection->compositeImage($gradient, imagick::COMPOSITE_OVER, 0, 0);

		// NOTE: Using setImageOpacity will destroy alpha channels!
		$reflection->evaluateImage(Imagick::EVALUATE_MULTIPLY, $opacity / 100, Imagick::CHANNEL_ALPHA);

		// Create a new container to hold the image and reflection
		$canvas = new Imagick();
		$canvas->newImage($this->_image->getImageWidth(), $this->_image->getImageHeight() + $height, new ImagickPixel('transparent'));
		$canvas->setImageFormat($this->_format);

		// Match the colorspace between the two images before compositing
		$canvas->setColorspace($this->_image->getColorspace());

		// Place the image and reflection into the container
		if (   $canvas->compositeImage($this->_image, Imagick::COMPOSITE_OVER, 0, 0)
			&& $canvas->compositeImage($reflection,   Imagick::COMPOSITE_OVER, 0, $this->getHeight())
		) {
			// Replace the current image with the reflected image
			$this->_image = $canvas;

			return TRUE;
		}

		return FALSE;
	}

	public function watermark(Image $image, $offset_x, $offset_y, $opacity) {

		// Convert the Image intance into an Imagick instance
		$watermark = new Imagick;
		$watermark->readImageBlob($image->render(), $image->file);

		if ($watermark->getImageAlphaChannel() !== Imagick::ALPHACHANNEL_ACTIVATE)
			// Force the image to have an alpha channel
			$watermark->setImageAlphaChannel(Imagick::ALPHACHANNEL_OPAQUE);

		if ($opacity < 100)
			// NOTE: Using setImageOpacity will destroy current alpha channels!
			$watermark->evaluateImage(Imagick::EVALUATE_MULTIPLY, $opacity / 100, Imagick::CHANNEL_ALPHA);

		// Match the colorspace between the two images before compositing
		// $watermark->setColorspace($this->_image->getColorspace());

		// Apply the watermark to the image
		return $this->_image->compositeImage($watermark, Imagick::COMPOSITE_DISSOLVE, $offset_x, $offset_y);
	}

	public function background($r, $g, $b, $opacity) {

		// Create a RGB color for the background
		$color = sprintf('rgba(%d, %d, %d, %d)', $r, $g, $b, $opacity);

		// Create a new image for the background
		$background = new Imagick();
		$background->newImage($this->getWidth(), $this->getHeight(), new ImagickPixel($color), $this->_format);

		if ( ! $background->getImageAlphaChannel())
			// Force the image to have an alpha channel
			$background->setImageAlphaChannel(Imagick::ALPHACHANNEL_SET);

		// Clear the background image
		$background->setImageBackgroundColor(new ImagickPixel('transparent'));

		// NOTE: Using setImageOpacity will destroy current alpha channels!
		$background->evaluateImage(Imagick::EVALUATE_MULTIPLY, $opacity / 100, Imagick::CHANNEL_ALPHA);

		// Match the colorspace between the two images before compositing
		$background->setColorspace($this->_image->getColorspace());

		if ($background->compositeImage($this->_image, Imagick::COMPOSITE_DISSOLVE, 0, 0)) {

			// Replace the current image with the new image
			$this->_image = $background;

			return TRUE;
		}

		return FALSE;
	}


	public function save($file, $quality) {

		$this->_image->setImageFormat($this->_format);
		$this->_image->setImageCompressionQuality($quality);

		if ($this->_image->writeImage($file))
			return TRUE;

		return FALSE;
	}


	public function render($type, $quality) {

		$this->_image->setImageFormat($this->_format);
		$this->_image->setImageCompressionQuality($quality);

		return (string) $this->_image;
	}


	public function getWidth() {
		return $this->_image->getImageWidth();
	}


	public function getHeight() {
		return $this->_image->getImageHeight();
	}

}