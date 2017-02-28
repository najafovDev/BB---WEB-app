<?php

/**
 * This is the model class for table "articles_translate".
 *
 * The followings are the available columns in table 'articles_translate':
 * @property integer $id
 * @property integer $articles_id
 * @property string $language
 * @property string $name
 * @property string $summary
 * @property string $body
 */
class ArticlesTranslate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ArticlesTranslate the static model class
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
		return 'articles_translate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('articles_id, language,summary, name,body', 'required'),
			array('id, articles_id', 'numerical', 'integerOnly'=>true),
			array('language', 'length', 'max'=>2),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, articles_id, language, name, summary, body', 'safe', 'on'=>'search'),
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
                        'article'    => array(self::BELONGS_TO, 'Articles',    'articles_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'articles_id' => 'Articles',
			'language' => 'Language',
			'name' => 'Name',
			'summary' => 'Summary',
			'body' => 'Body',
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
		$criteria->compare('articles_id',$this->articles_id);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('body',$this->body,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
