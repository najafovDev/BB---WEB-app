<?php

/**
 * This is the model class for table "category_fieldset".
 *
 * The followings are the available columns in table 'category_fieldset':
 * @property integer $id
 * @property string $name
 * @property string $type
 *
 * The followings are the available model relations:
 * @property CategoryFieldsetRelation[] $categoryFieldsetRelations
 */
class CategoryFieldset extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category_fieldset';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type', 'length', 'max'=>255),
                        array('name,type,group','required'),
                        array('group,parent_id','numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, type', 'safe', 'on'=>'search'),
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
			'categoryFieldsetRelations' => array(self::HAS_MANY, 'CategoryFieldsetRelation', 'fieldset_id'),
                        'parent'=>array(self::BELONGS_TO,'CategoryFieldset','parent_id'),
                        'children'=>array(self::HAS_MANY,'CategoryFieldset','parent_id'),
			'usageCount' => array(self::STAT, 'CategoryFieldsetRelation', 'fieldset_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'type' => 'Type',
		);
	}
        public function getListData(){
            return array(
                'text'=>'text',
                'integer'=>'integer',
                'array'=>'array',
                'bool'=>'bool'
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('group',$this->group,true);
		//$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('type',$this->type,true);
                $criteria->addCondition('t.parent_id is NULL');
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
	public function searchChildren()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
                $tmp = new CategoryFieldset('search');
                $tmp->unsetAttributes();
                if(isset($_GET['CategoryFieldset']))
			$model->attributes=$_GET['CategoryFieldset'];
                $tmp->parent_id = $this->parent_id;
		$criteria->compare('parent_id',$tmp->parent_id,true);
                $criteria->limit = 1;
		return new CActiveDataProvider($tmp, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CategoryFieldset the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
