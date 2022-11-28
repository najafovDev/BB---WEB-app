<?php

/**
 * This is the model class for table "portals".
 *
 * The followings are the available columns in table 'portals':
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property double $latitude
 * @property double $longitude
 */
class Portals extends Translatable
{
        public $translationClass = 'PortalsTranslate';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'portals';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, name, latitude, longitude', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude', 'numerical'),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_id, name, latitude, longitude', 'safe', 'on'=>'search'),
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
                    'translations'=>array(self::HAS_MANY,'PortalsTranslate','parent_id','index'=>'language'),
                    'district'=>array(self::BELONGS_TO,'Districts','parent_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' =>  Utilities::t('District'),
			'name' =>  Utilities::t('Name'),
			'latitude' =>  Utilities::t('Latitude'),
			'longitude' =>  Utilities::t('Longitude'),
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);

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
	 * @return Portals the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getDistricts(){
            $criteria = new CDbCriteria();
            $criteria->with['translations'] = array('together'=>true);
            $criteria->order = 'translations.name asc';
            $tmps = Districts::model()->findAll($criteria);
            $return  = array();
            foreach ($tmps as $tmp){
                $return[$tmp->id] = $tmp->getTranslation(Yii::app()->controller->Lang)->name;
            }
            return $return;
        }
}
