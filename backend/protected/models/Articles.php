<?php

/**
 * This is the model class for table "articles".
 *
 * The followings are the available columns in table 'articles':
 * @property integer $id
 * @property integer $parent_id
 * @property string $type
 * @property string $date
 */
class Articles extends Translatable
{
        public $translationClass='ArticlesTranslate';
        public $n2nrel_names = array('Brands','Category');
        public $n2nrel = array();
        public $n2nrel_ids = array();
        public function behaviors() {
            return array(
                'n2n-relation'=>array(
                    'class'=>'application.components.behaviors.N2NRelBehavior',
                )
            );
        }
        
	/**
	 * Returns the static model of the specified AR class.
	 * @return Articles the static model class
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
		return 'articles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_id', 'required'),
			array('carousel', 'default','value'=>'0'),
			array('parent_id,front', 'numerical', 'integerOnly'=>true),
			array('type, date', 'length', 'max'=>255),
			array('pic_name', 'file', 'types'=>'jpg, gif, png','allowEmpty'=>true),
			array('file_name', 'file', 'types'=>'pdf,doc,docx','allowEmpty'=>true),
                        array('n2nrel_ids','type','type'=>'array','allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id,translations.name, type,pic_name, date,modify_date,create_date', 'safe', 'on'=>'search'),
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
                        'translations'   => array(self::HAS_MANY,   'ArticlesTranslate',    'articles_id','index'=>'language'),
			'cleanurls'   => array(self::HAS_MANY,   'Cleanurls',    'parent_id','index'=>'language','condition'=>'cleanurls.type="Articles"'),
                        'photos'=>array(self::HAS_MANY,'Gallery','parent_id','condition'=>'photos.type="Articles"','order'=>'photos.sort asc'),
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
			'type' => 'Type',
			'date' => 'Date',
		);
	}
        public function beforeSave() {
            parent::beforeSave();
            $this->modify_date = date('Y-m-d h:i:s');
            if ($this->scenario=='create'){
                $this->create_date = date('Y-m-d h:i:s');
            }
            return true;
        }
        public function getContentTranslation($lang){
            if (isset($this->translations) && isset($this->translations[$lang]))
                return $this->translations[$lang];
            else {
                $model = new ArticlesTranslate();
                $model->articles_id = $this->id;
                $model->language = $lang;
                return $model;
            }
        }
        public function getActions(){
                $tmp = array('content'=>array(
                            'edit2'=>array('title'=>'Edit Article',
                                            'params'=>array('class'=>'fa fa-list-alt', 'url'=> 'articles/update','data'=>array('id'=>$this->id))),
                            'delete'=>array('title'=>($this->deleted?'Undelete':'Delete').' item',
                                            'params'=>array('aclass'=>'magnum-'.($this->deleted?'delete':'delete').' magnum-ajax', 'class'=>'glyphicon glyphicon-trash', 'url'=> 'articles/delete','data'=>array('id'=>$this->id))),
                            'duplicate'=>array('title'=>'Duplicate item',
                                            'params'=>array('aclass'=>'magnum-delete magnum-ajax', 'class'=>'glyphicon glyphicon-trash', 'url'=> 'articles/duplicate','data'=>array('id'=>$this->id))),
                            'visible'=>array('title'=>'Show / Hide',
                                            'params'=>array('aclass'=>'magnum-togglevisibility magnum-ajax', 'class'=>'fa fa-eye', 'url'=> 'articles/togglevisibility','data'=>array('id'=>$this->id))),
                            //'publish'=>array('title'=>'Publish Item',
                            //                'params'=>array('class'=>'glyphicon glyphicon-pushpin', 'url'=> 'content/publish','data'=>array('id'=>$id))),
                        ));
                if ($this->deleted)
                    $tmp['content']['Delete forever'] = array('title'=>'Delete forever item',
                                            'params'=>array('aclass'=>'magnum-'.($this->deleted?'delete':'delete').' magnum-ajax', 'class'=>'glyphicon glyphicon-trash', 'url'=> 'articles/shiftdelete','data'=>array('id'=>$this->id,'ajax'=>1)));
                return $tmp;
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('date',$this->date,true);
                $criteria->compare('deleted',0);
                //$criteria->addSearchCondition('translations.name',$this->translations[Yii::app()->Lang]->name);
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        public function getPhoto($id){
            if (isset($this->photos) && is_array($this->photos) && isset($this->photos[$id]))
                return '/uploads/articles/'.$this->photos[$id]->pic_name;
            else return '/img/wirebike.jpg';
        }
        public function getPhotoItem($id){
            if (isset($this->photos) && is_array($this->photos) && isset($this->photos[$id]))
                return $this->photos[$id];
            else {
                $tmp = new Gallery();
                $tmp->pic_name='wirebike.jpg';
                return $tmp;
            }
        }
        public function getCleanurl($lang){
            if (isset($this->cleanurls[$lang]))
                return $this->cleanurls[$lang];
            
            $tmp = new Cleanurls();
            $tmp->language = $lang;
            $tmp->type = 'Articles';
            $tmp->parent_id = $this->id;
            $tmp->url = Utilities::str2url($this->getContentTranslation($lang)->name);
            return $tmp;
        }
        
}
