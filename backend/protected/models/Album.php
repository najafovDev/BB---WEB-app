<?php

/**
 * This is the model class for table "album".
 *
 * The followings are the available columns in table 'album':
 * @property integer $id
 * @property string $pic_name
 * @property string $name
 * @property string $date
 * @property string $type
 * @property string $video
 */
class Album extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Album the static model class
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
		return 'album';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, date, type', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('pic_name, name, video', 'length', 'max'=>255),
			array('type', 'length', 'max'=>5),
			array('pic_name', 'file', 'types'=>'jpg, gif, png','allowEmpty'=>true),
		// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pic_name, name, date, type, video', 'safe', 'on'=>'search'),
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
			'pic_name' => 'Pic Name',
			'name' => 'Name',
			'date' => 'Date',
			'type' => 'Type',
			'video' => 'Video',
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
		$criteria->compare('pic_name',$this->pic_name,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('video',$this->video,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}