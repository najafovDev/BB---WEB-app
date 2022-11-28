<?php

/**
 * This is the model class for table "items_stock".
 *
 * The followings are the available columns in table 'items_stock':
 * @property string $id
 * @property integer $item_id
 * @property integer $artikul
 * @property integer $artikul2
 * @property string $barcode
 * @property integer $color_id
 * @property string $size
 * @property integer $price
 * @property integer $discount
 * @property integer $stock
 *
 * The followings are the available model relations:
 * @property Items $item
 */
class ItemsStock extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'items_stock';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_id,barcode, price, discount, stock', 'required'),
			array('item_id,stock ', 'numerical', 'integerOnly'=>true),
			array('barcode, size', 'length', 'max'=>255),
                        array('price,discount','type','type'=>'float'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, item_id, artikul, artikul2, barcode, color_id, size, price, discount, stock', 'safe', 'on'=>'search'),
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
                        'color' => array(self::BELONGS_TO, 'Colors', 'color_id'),
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
			'artikul' => 'Artikul',
			'artikul2' => 'Artikul2',
			'barcode' => 'Barcode',
			'color_id' => 'Color',
			'size' => 'Size',
			'price' => 'Price',
			'discount' => 'Discount',
			'stock' => 'Stock',
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
		$criteria->addSearchCondition('item_id',$this->item_id);
		$criteria->compare('artikul',$this->artikul);
		$criteria->compare('artikul2',$this->artikul2);
		$criteria->compare('barcode',$this->barcode,true);
		$criteria->compare('color_id',$this->color_id);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('stock',$this->stock);
                $criteria->with=array('item');
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ItemsStock the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
