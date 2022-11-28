<?php

/**
 * This is the model class for table "user_list".
 *
 * The followings are the available columns in table 'user_list':
 * @property string $name
 * @property string $sername
 * @property string $nicname
 * @property string $country
 * @property string $city
 * @property string $mail
 * @property string $phone
 * @property integer $id
 * @property string $pass
 * @property integer $comp_id
 */
class UserList extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, sername, nicname, country, city, mail, phone, pass', 'required'),
			array('comp_id', 'numerical', 'integerOnly'=>true),
			array('name, sername, nicname, country, city, mail, phone, pass', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('name, sername, nicname, country, city, mail, phone, id, pass, comp_id', 'safe', 'on'=>'search'),
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
                    'competition'=>array(self::BELONGS_TO,'CompetitionSchedule','comp_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => 'Name',
			'sername' => 'Sername',
			'nicname' => 'Nicname',
			'country' => 'Country',
			'city' => 'City',
			'mail' => 'Mail',
			'phone' => 'Phone',
			'id' => 'ID',
			'pass' => 'Pass',
			'comp_id' => 'Comp',
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

		$criteria->compare('name',$this->name,true);
		$criteria->compare('sername',$this->sername,true);
		$criteria->compare('nicname',$this->nicname,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('id',$this->id);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('comp_id',$this->comp_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>(Yii::app()->getRequest()->getParam('pageSize',Yii::app()->params['gridViewPageSize']))
                        )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
