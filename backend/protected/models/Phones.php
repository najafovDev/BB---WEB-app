<?php

class Phones extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Colors the static model class
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
		return 'phones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('sort','default','value'=>0),
			array('customer_id,sort,phone,prefix', 'required'),
			array('phone', 'length', 'is'=>7, 'message'=>'{attribute} 7 rəqəmdən ibarət olmalıdır'),
                        array('phone','checkPhone'),
                        array('prefix','in','range'=>$this->getPrefixes()),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, customer_id,prefix,phone', 'safe', 'on'=>'search'),
		);
	}
        public function checkPhone($attr,$params){
//            $prefixes = Phones::getPrefixes();
            $this->phone = preg_replace("/[^0-9]/", "", $this->phone);
        }
        static function getPrefixes(){
            $prefixes = array(
                ''=>Utilities::t('Chose...'),
                '012'=>'012',
                '050'=>'050',
                '051'=>'051',
                '055'=>'055', 
                '070'=>'070',
                '077'=>'077'
            );
            
            return $prefixes;
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
			'phone'=>  Utilities::t('Phone'),
			'prefix'=>  Utilities::t('Prefix'),                    
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
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}