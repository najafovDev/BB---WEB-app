<?php

/**
 * This is the model class for table "item_photos".
 *
 * The followings are the available columns in table 'item_photos':
 * @property string $id
 * @property string $pic_name
 * @property integer $color_id
 * @property integer $item_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Items $item
 */
class ItemPhotos extends Translatable
{
        public $translationClass='ItemPhotosTranslate';
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item_photos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('color_id, item_id', 'numerical', 'integerOnly'=>true),
			array('pic_name, name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pic_name, color_id, item_id, name', 'safe', 'on'=>'search'),
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
			'item' => array(self::BELONGS_TO, 'Items', 'item_id'),
                        'translations'=>array(self::HAS_MANY,'ItemPhotosTranslate','parent_id','index'=>'language'),
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
			'color_id' => 'Color',
			'item_id' => 'Item',
			'name' => 'Name',
		);
	}
        public function getPath($thumb=null){
            if (!$thumb)
                return '/uploads/items/'.$this->pic_name;
            else return '/site/uploads/items/'.$thumb.'/'.$this->pic_name;
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
		$criteria->compare('pic_name',$this->pic_name,true);
		$criteria->compare('color_id',$this->color_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ItemPhotos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
