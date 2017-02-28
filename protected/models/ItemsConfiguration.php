<?php

/**
 * This is the model class for table "items_configuration".
 *
 * The followings are the available columns in table 'items_configuration':
 * @property integer $id
 * @property string $title
 * @property integer $general_area
 * @property integer $living_area
 * @property integer $balconies
 * @property integer $bathrooms
 * @property string $schema_pic
 * @property string $pic_name
 * @property integer $price
 * @property integer $parent_id
 */
class ItemsConfiguration extends MfeActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'items_configuration';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, general_area, living_area,rooms, balconies, bathrooms, price, parent_id', 'required'),
			array('general_area, living_area,rooms, balconies, bathrooms, price, parent_id', 'numerical', 'integerOnly'=>true),
			array('title, schema_pic, pic_name', 'length', 'max'=>255),
                        array('pic_name,schema_pic','file','types'=>'jpg,png,gif','allowEmpty'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, general_area, living_area, balconies, bathrooms, schema_pic, pic_name, price, parent_id', 'safe', 'on'=>'search'),
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
                    'item'=>array(self::BELONGS_TO,'Items','parent_id')
		);
	}
        public function getPath(){
            return '/uploads/itemsconf/';
        }
        public function getImage($thumb='',$attr='pic_name'){
            if ($thumb!='')
                return '/site/'.$this->getPath ().$thumb.'/'.$this->$attr;
            return $this->getPath().$this->$attr;
        }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'general_area' => 'General Area',
			'living_area' => 'Living Area',
			'balconies' => 'Balconies',
			'bathrooms' => 'Bathrooms',
			'schema_pic' => 'Schema Pic',
			'pic_name' => 'Pic Name',
			'price' => 'Price',
			'parent_id' => 'Parent',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('general_area',$this->general_area);
		$criteria->compare('living_area',$this->living_area);
		$criteria->compare('balconies',$this->balconies);
		$criteria->compare('bathrooms',$this->bathrooms);
		$criteria->compare('schema_pic',$this->schema_pic,true);
		$criteria->compare('pic_name',$this->pic_name,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('parent_id',$this->parent_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ItemsConfiguration the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
