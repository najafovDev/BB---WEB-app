<?php

/**
 * This is the model class for table "items_paramset".
 *
 * The followings are the available columns in table 'items_paramset':
 * @property string $id
 * @property integer $fieldset_id
 * @property integer $items_id
 * @property string $language
 * @property string $value
 *
 * The followings are the available model relations:
 * @property CategoryFieldset $fieldset
 * @property Items $items
 */
class ItemsParamset extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'items_paramset';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fieldset_id, items_id', 'required'),
			array('fieldset_id, items_id', 'numerical', 'integerOnly'=>true),
			array('language', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fieldset_id, items_id, language, value', 'safe', 'on'=>'search'),
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
			'fieldset' => array(self::BELONGS_TO, 'CategoryFieldset', 'fieldset_id','together'=>true),
			'items' => array(self::BELONGS_TO, 'Items', 'items_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fieldset_id' => 'Fieldset',
			'items_id' => 'Items',
			'language' => 'Language',
			'value' => 'Value',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('fieldset_id',$this->fieldset_id);
		$criteria->compare('items_id',$this->items_id);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ItemsParamset the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
