<?php

class CImageComponent extends CApplicationComponent {

	public $driver = 'GD';

	public function load($file) {

		Yii::import('application.extensions.image.Image');
		return new Image($file, $this->driver);
	}
}

