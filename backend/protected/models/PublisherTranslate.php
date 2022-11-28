<?php

/**
 * This is the model class for table "publisher_translate".
 *
 * The followings are the available columns in table 'publisher_translate':
 * @property integer $id
 * @property integer $parent_id
 * @property string $language
 * @property string $name
 * @property string $teaser
 */
class PublisherTranslate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PublisherTranslate the static model class
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
		return 'publisher_translate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, language, name, teaser', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('language', 'length', 'max'=>2),
			array('name, teaser', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, language, name, teaser', 'safe', 'on'=>'search'),
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
                        'parent'    => array(self::BELONGS_TO, 'Publisher',    'parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Parent',
			'language' => 'Language',
			'name' => 'Name',
			'teaser' => 'Teaser',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('teaser',$this->teaser,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}