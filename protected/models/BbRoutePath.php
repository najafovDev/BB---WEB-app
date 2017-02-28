<?php

/**
 * This is the model class for table "bb_route_path".
 *
 * The followings are the available columns in table 'bb_route_path':
 * @property integer $route_id
 * @property integer $path_id
 * @property string $direction
 */
class BbRoutePath extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bb_route_path';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('route_id, path_id, direction', 'required'),
			array('route_id, path_id', 'numerical', 'integerOnly'=>true),
			array('direction', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('route_id, path_id, direction', 'safe', 'on'=>'search'),
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
			'path' => array(self::BELONGS_TO, 'BbPath', 'path_id'),
			'route' => array(self::BELONGS_TO, 'BbRoute', 'route_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'route_id' => 'Route',
			'path_id' => 'Path',
			'direction' => 'Direction',
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

		$criteria->compare('route_id',$this->route_id);
		$criteria->compare('path_id',$this->path_id);
		$criteria->compare('direction',$this->direction,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BbRoutePath the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
