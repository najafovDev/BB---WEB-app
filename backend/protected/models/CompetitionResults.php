<?php

/**
 * This is the model class for table "comptetion_results".
 *
 * The followings are the available columns in table 'comptetion_results':
 * @property string $id
 * @property integer $compt_id
 * @property string $login
 * @property string $name
 * @property double $balance
 * @property double $equity
 * @property string $statement
 * @property string $date
 * @property integer $place
 */
class CompetitionResults extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comptetion_results';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, name, equity, date', 'required'),
			array('compt_id, place', 'numerical', 'integerOnly'=>true),
			array('balance, equity', 'numerical'),
                        array('statement','file','types'=>'html','allowEmpty'=>true),                        
			array('login, statement', 'length', 'max'=>255),
                        array('compt_id','exist','attributeName'=>'id','className'=>'CompetitionSchedule'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, compt_id, login, name, balance, equity, statement, date, place', 'safe', 'on'=>'search'),
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
			'compt_id' => 'Competition',
			'login' => 'Login',
			'name' => 'Name',
			'balance' => 'Balance',
			'equity' => 'Equity',
			'statement' => 'Statement',
			'date' => 'Date',
			'place' => 'Place',
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
		$criteria->compare('compt_id',$this->compt_id);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('balance',$this->balance);
		$criteria->compare('equity',$this->equity);
		$criteria->compare('statement',$this->statement,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('place',$this->place);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>150,
                        )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CompetitionResults the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
