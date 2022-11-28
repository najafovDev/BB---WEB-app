<?php

/**
 * This is the model class for table "tbl_brands_tags".
 *
 * The followings are the available columns in table 'tbl_brands_tags':
 * @property integer $id
 * @property integer $brands_id
 * @property integer $tags_id
 */
class TblBrandsTags extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TblBrandsTags the static model class
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
		return 'tbl_brands_tags';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('brands_id, tags_id', 'required'),
			array('brands_id, tags_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, brands_id, tags_id', 'safe', 'on'=>'search'),
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
			'brands_id' => 'Brands',
			'tags_id' => 'Tags',
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
		$criteria->compare('brands_id',$this->brands_id);
		$criteria->compare('tags_id',$this->tags_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}