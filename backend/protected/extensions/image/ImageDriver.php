<?php
/**
 * Abstract Image driver class.
 *
 * @package    Image
 * @copyright  (c) 2008-2009 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
abstract class ImageDriver {

	// Status of the driver check
	public static $_checked = FALSE;

	/**
	 * Resize an image.
	 *
	 * @param   integer  width
	 * @param   integer  height
	 * @param   integer  one of: Image::NONE, Image::AUTO, Image::WIDTH, Image::HEIGHT
	 * @return  object
	 */
	abstract public function resize($width, $height);

	/**
	 * Crop an image.
	 *
	 * @param   integer  $width     new width
	 * @param   integer  $height    new height
	 * @param   mixed    $offset_x  offset from the left
	 * @param   mixed    $offset_y  offset from the top
	 * @return  $this
	 */
	abstract public function crop($width, $height, $offset_x, $offset_y);

    /**
	 * Rotate an image. Valid amounts are -180 to 180.
	 *
	 * @param   integer  degrees
	 * @return  object
	 */
	abstract public function rotate($degrees);

    /**
	 * Flip an image.
	 *
	 * @param   integer  $direction  direction: Image::HORIZONTAL, Image::VERTICAL
	 * @return  object
	 */
	abstract public function flip($direction);

	/**
	 * Sharpen and image.
	 *
	 * @param   integer  amount to sharpen
	 * @return  object
	 */
	abstract public function sharpen($amount);

	/**
	 * Sharpen and image. Valid amounts are 1 to 100.
	 *
	 * @param   integer   $height   reflection height
	 * @param   integer   $opacity  reflection opacity: 0-100
	 * @param   boolean   $fade_in  TRUE to fade in, FALSE to fade out
	 * @return  $this
	 */
	abstract public function reflection($height, $opacity, $fade_in);

	/**
	 * Place watermark on image.
	 *
	 * @param   Image   watermark
	 * @param   boolean offset x
	 * @param   boolean offset y
	 * @param   imteger opacity
	 * @return  boolean
	 */
	abstract public function watermark(Image $watermark, $offset_x, $offset_y, $opacity);

	/**
	 * Place background on image.
	 *
	 * @param   string   $color    hexadecimal color value
	 * @param   integer  $opacity  background opacity: 0-100
	 * @return  $this
	 */
	abstract public function background($r, $g, $b, $opacity);

	/**
	 * Save the image.
	 *
	 * @param   string   $file     new image path
	 * @param   integer  $quality  quality of image: 1-100
	 * @return  boolean
	 */
	abstract public function save($file, $quality);

	/**
	 * Render the image and return the binary string.
	 *
	 * @param   string   $type     image type to return: png, jpg, gif, etc
	 * @param   integer  $quality  quality of image: 1-100
	 * @return  string
	 */
	abstract public function render($type, $quality);

	/**
	 * Returns current image width.
	 *
	 * @return  integer
	 */
	abstract public function getWidth();

	/**
	 * Returns current image height.
	 *
	 * @return  integer
	 */
	abstract public function getHeight();

}