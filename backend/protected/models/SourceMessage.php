<?php

/**
 * This is the model class for table "SourceMessage".
 *
 * The followings are the available columns in table 'SourceMessage':
 * @property integer $id
 * @property string $category
 * @property string $message
 *
 * The followings are the available model relations:
 * @property Message[] $messages
 */
class SourceMessage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $controls;
	public function tableName()
	{
		return 'SourceMessage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category,message', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('category', 'length', 'max'=>32),
			array('message', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, category, message', 'safe', 'on'=>'search'),
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
			'translations' => array(self::HAS_MANY, 'Message', 'id','index'=>'language'),
			'translation' => array(self::HAS_ONE, 'Message', 'id','condition'=>'language="'.Yii::app()->controller->Lang.'"'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category' => 'Category',
			'message' => 'Message',
		);
	}

        public function gridTranslations($data,$row){
            return '<a href="asdasd"><img src="asdasd"></a>';
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
		$criteria->compare('category',$this->category,true);
		$criteria->compare('message',$this->message,true);
                $criteria->addInCondition('category', $this->getModules());
                $criteria->order = 't.id desc';
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

        public function getModules(){
            //if (!defined('YII_DEBUG'))
                return array(
                    'frontend.strings'=>'frontend.strings'
                );
            $sm = Modules::model()->findAll(array('order'=>'name asc'));
            return $ld = CHtml::listData($sm, 'name', 'name');

        }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SourceMessage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
