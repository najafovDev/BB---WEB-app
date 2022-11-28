<?php

/**
 * This is the model class for table "banners".
 *
 * The followings are the available columns in table 'banners':
 * @property integer $id
 * @property integer $item_id
 * @property integer $brands_id
 * @property integer $sort
 * @property integer $name
 * @property string $text
 * @property string $link
 * @property string $pic_name
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Items $item
 */
class Banners extends Translatable
{
        public $translationClass='BannersTranslate';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'banners';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sort,type', 'required'),
			array('item_id, brands_id, sort, name', 'numerical', 'integerOnly'=>true),
			array('text, link, pic_name', 'length', 'max'=>255),
                        array('type','in','range'=>array_keys($this->types()),'allowEmpty'=>false),
                        array('sort','default','value'=>0,'setOnEmpty'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, item_id, brands_id, sort, name, text, link, pic_name, date', 'safe', 'on'=>'search'),
		);
	}
        public function types($key=NULL){
            $tmp= array(
                'slider-banners'=>Yii::t('frontend.strings','Slider Banners'),
                'front-horizontal-banners'=>Yii::t('frontend.strings','Front horizontal banner'),
                'insider-horizontal-banners'=>Yii::t('frontend.strings','Insider horizontal banners'),
                'partners'=>Yii::t('frontend.strings','Partners'),
            );
            if ($key)
                return $tmp[$this->type];
            else return $tmp;
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
			'brand' => array(self::BELONGS_TO, 'Brands', 'brands_id'),
                        'translations'=>array(self::HAS_MANY,'BannersTranslate','parent_id','index'=>'language'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'item_id' => 'Item',
			'brands_id' => 'Brands',
			'sort' => 'Sort',
			'name' => 'Name',
			'text' => 'Text',
			'link' => 'Link',
			'pic_name' => 'Pic Name',
			'date' => 'Date',
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
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('brands_id',$this->brands_id);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('name',$this->name);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('pic_name',$this->pic_name,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                    'sort'=>array(
                        'defaultOrder'=>'id desc',
                    ),
                    'pagination'=>array(
                        'pageSize'=>Yii::app()->getRequest()->getParam('pageSize',Yii::app()->params['gridViewPageSize'])
                    )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Banners the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
