<?php

/**
 * This is the model class for table "competition_schedule".
 *
 * The followings are the available columns in table 'competition_schedule':
 * @property integer $id
 * @property string $date_r_n
 * @property string $date_r_k
 * @property string $date_pk_n
 * @property string $date_pk_k
 * @property integer $go
 * @property integer $open
 * @property string $title
 */
class CompetitionSchedule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'competition_schedule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_r_n, date_r_k, date_pk_n, date_pk_k, go, open, title', 'required'),
			array('go, open', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, date_r_n, date_r_k, date_pk_n, date_pk_k, go, open, title', 'safe', 'on'=>'search'),
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
                    'users'=>array(self::HAS_MANY,'UserList','comp_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date_r_n' => Yii::t('frontend.strings','Registation start'),
			'date_r_k' => Yii::t('frontend.strings','Registation end'),
			'date_pk_n' => Yii::t('frontend.strings','Contest period start'),
			'date_pk_k' => Yii::t('frontend.strings','Contest period end'),
			'go' => 'Go',
			'open' => 'Open',
			'title' => 'Title',
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
		$criteria->compare('date_r_n',$this->date_r_n,true);
		$criteria->compare('date_r_k',$this->date_r_k,true);
		$criteria->compare('date_pk_n',$this->date_pk_n,true);
		$criteria->compare('date_pk_k',$this->date_pk_k,true);
		$criteria->compare('go',$this->go);
		$criteria->compare('open',$this->open);
		$criteria->compare('title',$this->title,true);

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
        
        public function getUsers()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
                
                $user = new UserList();
                $user->unsetAttributes();
                if (isset($_GET['UserList']))
                    $user->attributes = $_GET['UserList'];
                
		$criteria=new CDbCriteria;
                
		$criteria->compare('id',$this->id);
		$criteria->compare('date_r_n',$this->date_r_n,true);
		$criteria->compare('date_r_k',$this->date_r_k,true);
		$criteria->compare('date_pk_n',$this->date_pk_n,true);
		$criteria->compare('date_pk_k',$this->date_pk_k,true);
		$criteria->compare('go',$this->go);
		$criteria->compare('open',$this->open);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort'=>array(
                            'defaultOrder'=>'id desc',
                        )
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CompetitionSchedule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getOpenList($id = 0){
            $tmp = array(
                ''=>'Choose...',
                '1'=>Yii::t('frontend.strings','Registration open'),
                '2'=>Yii::t('frontend.strings','Competition period'),
                '3'=>Yii::t('frontend.strings','Competition closed'),
            );
            if ($id)
                return $tmp[$id];
            return $tmp;
        }
}
