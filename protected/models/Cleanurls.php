<?php
Yii::import('application.components.Utilities');

/**
 * This is the model class for table "album".
 *
 * The followings are the available columns in table 'album':
 * @property integer $id
 * @property string $pic_name
 * @property string $name
 * @property string $date
 * @property string $type
 * @property string $video
 */
class Cleanurls extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Album the static model class
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
		return 'cleanurls';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id,type,url,language', 'required'),
			array('id,parent_id', 'numerical', 'integerOnly'=>true),
			array('type,url', 'length', 'max'=>255),
                        //array('url','existsFunc'),
			array('language', 'length', 'max'=>2),
			array('id, parent_id,type,url', 'safe', 'on'=>'search'),
                        array('parent_id', 'unique', 'criteria'=>array(
                            'condition'=>'`language`=:language and `type`=:type',
                            'params'=>array(
                                ':language'=>$this->language,
                                ':type'=>$this->type
                            )
                        )),
		);
	}

        public function existsFunc($attribute,$params){
            $count = Cleanurls::model()->countByAttributes(array('type'=>$this->type,'url'=>  $this->url,'language'=>$this->language));
            if ($count)
                $this->addError ($attribute, 'url exists already');
                
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
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        static function getUrlOrSave($item,$name,$language){
            if (($tmp = Cleanurls::model()->cache(3600)->findByAttributes(array('parent_id'=>$item->id,'type'=>  get_class($item),'language'=>$language)))==null){
                    $tmp = new Cleanurls();
                    $tmp->parent_id = $item->id;
                    $tmp->type = get_class($item);
                    $tmp->url = Utilities::str2url($name);
                    $tmp->language = $language;
                    if (!$tmp->save()){
                    }
            }
            return $tmp->url;
        }
}