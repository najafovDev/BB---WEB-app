<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class CallbackForm extends MfeFormModel
{
	public $name;
        public $prefix;
	public $telefon;
	public $body;
//	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, telefon,  body', 'required'),
                        array('telefon','length','max'=>10,'min'=>10),
			// email has to be a valid email address
//                        array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
                    // verifyCode needs to be entered correctly
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'verifyCode'=>Yii::t('frontend.strings','Verification Code'),
			'name'=>Yii::t('frontend.strings','Name'),
			'telefon'=>Yii::t('frontend.strings','Phone'),
			'subject'=>Yii::t('frontend.strings','Subject'),
			'body'=>Yii::t('frontend.strings','Body'),			
		);
	}
}
