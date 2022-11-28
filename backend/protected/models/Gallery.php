<?php

/**
 * This is the model class for table "gallery".
 *
 * The followings are the available columns in table 'gallery':
 * @property integer $id
 * @property string $parent_id
 * @property string $pic_name
 * @property string $created_date
 * @property string $mod_date
 * @property integer $sort
 * @property integer $type
 */
class Gallery extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gallery';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id, pic_name, type', 'required'),
			array('sort', 'numerical', 'integerOnly'=>true),
			array('parent_id', 'length', 'max'=>11),
			array('pic_name', 'length', 'max'=>255),
                        array('pic_name','file','types'=>'jpg,png,gif','allowEmpty'=>true),
			array('mod_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_id, pic_name, created_date, mod_date, sort, type', 'safe', 'on'=>'search'),
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
			'parent_id' => 'Parent',
			'pic_name' => 'Pic Name',
			'created_date' => 'Created Date',
			'mod_date' => 'Mod Date',
			'sort' => 'Sort',
			'type' => 'Type',
		);
	}
        public function beforeSave() {
            parent::beforeSave();
            if ($this->scenario=='create'){
                $this->created_date = date('Y-m-d h:i:s');
            }
            $this->mod_date = date('Y-m-d h:i:s');
            return TRUE;
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
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('pic_name',$this->pic_name,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('mod_date',$this->mod_date,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Gallery the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
