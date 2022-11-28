<?php

/**
 * This is the model class for table "Offers".
 *
 * The followings are the available columns in table 'Offers':
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $body
 * @property integer $pic_name
 * @property string $phone
 * @property string $website
 */
class Offers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Offers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Offers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, name, body, pic_name, website', 'required'),
			array('phone', 'required','on'=>'Offers'),
			array('type, name,pic_name, body, phone, website', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type, name, body, pic_name, phone, website', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'name' => 'Name',
			'body' => 'Body',
			'pic_name' => 'Pic Name',
			'phone' => 'Phone',
			'website' => 'Website',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('pic_name',$this->pic_name);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('website',$this->website,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}