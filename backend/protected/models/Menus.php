<?php

/**
 * This is the model class for table "menus".
 *
 * The followings are the available columns in table 'menus':
 * @property integer $id
 * @property integer $parent_id
 * @property integer $sort
 */
class Menus extends Translatable
{
    public $translationClass='MenusTranslate';
    public $contentTranslationClass='ArticlesTranslate';
	/**
	 * Returns the static model of the specified AR class.
	 * @return Menus the static model class
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
		return 'menus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sort', 'required'),
			array('parent_id, sort,banner', 'numerical', 'integerOnly'=>true),
                        array('keyword', 'length', 'max'=>255),
                        array('pic_name', 'file', 'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, keyword,parent_id, pic_name,sort', 'safe', 'on'=>'search'),
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
			'translations'   => array(self::HAS_MANY,   'MenusTranslate',    'menus_id','index'=>'language'),
			'cleanurls'   => array(self::HAS_MANY,   'Cleanurls',    'parent_id','index'=>'language','condition'=>'cleanurls.type="Menus"'),
                        'photos'=>array(self::HAS_MANY,'Gallery','parent_id','condition'=>'photos.type="Menus"','order'=>'photos.sort asc'),
			'getparent'   => array(self::BELONGS_TO,   'Menus',    'parent_id'),
			'childs'   => array(self::HAS_MANY,   'Menus',    'parent_id'),
                        'articles'=>array(self::HAS_MANY,'Articles','parent_id','condition'=>'articles.type="Menus"'),
			'content'   => array(self::HAS_ONE,   'Articles',    'parent_id','condition'=>'content.type="static"'),

		);
	}
        public function getActions(){
                $tmp = array('content'=>array(
                            'create'=>array('title'=>'Create Item',
                                            'params'=>array('aclass'=>'magnum-jstree-create magnum-ajax','class'=>'glyphicon glyphicon-plus', 'url'=> 'menus/create','data'=>array())),
                            'edit'=>array('title'=>'Edit Item',
                                            'params'=>array('class'=>'glyphicon glyphicon-edit', 'url'=> 'menus/edit','data'=>array('id'=>$this->id))),
                            /*'edit2'=>array('title'=>'Edit Content',
                                            'params'=>array('class'=>'fa fa-list-alt', 'url'=> 'menus/translate','data'=>array('id'=>$this->id))),
                            */'articles'=>array('title'=>'Add Article',
                                            'params'=>array('class'=>'fa fa-file-text-o', 'url'=> 'articles/create','data'=>array('type'=>'Menus', 'parent_id'=>$this->id))),
                            'all-articles'=>array('title'=>'Articles',
                                            'params'=>array('class'=>'fa fa-list', 'url'=> 'articles/admin','data'=>array('type'=>'Menus', 'parent_id'=>$this->id))),
                            'delete'=>array('title'=>($this->deleted?'Undelete':'Delete').' item',
                                            'params'=>array('aclass'=>'magnum-'.($this->deleted?'delete':'delete').' magnum-ajax', 'class'=>'glyphicon glyphicon-trash', 'url'=> 'menus/delete','data'=>array('id'=>$this->id))),
                            'visible'=>array('title'=>'Show / Hide',
                                            'params'=>array('aclass'=>'magnum-togglevisibility magnum-ajax', 'class'=>'fa fa-eye', 'url'=> 'menus/togglevisibility','data'=>array('id'=>$this->id))),
                            //'publish'=>array('title'=>'Publish Item',
                            //                'params'=>array('class'=>'glyphicon glyphicon-pushpin', 'url'=> 'content/publish','data'=>array('id'=>$id))),
                        ));
                if ($this->articles && count($this->articles)){
                    $tmp['content']['all-articles'] = array('title'=>'Articles',
                                            'params'=>array('class'=>'fa fa-list', 'url'=> 'articles/admin','data'=>array('type'=>'Menus', 'parent_id'=>$this->id)));
                }
                if ($this->deleted){
                    $tmp['content']['forever-delete'] = array('title'=>'Delete Forever',
                                            'params'=>array('aclass'=>'magnum-delete magnum-ajax', 'class'=>'glyphicon glyphicon-trash', 'url'=> 'menus/shiftdelete','data'=>array('id'=>$this->id,'ajax'=>1)));
                }
                return $tmp;
        }
        public function rootMenus($id){
            return 'Root '.(-1*$id);
        }
        public function afterFind() {
            parent::afterFind();
            if ($this->parent_id < 0){
                $this->getparent = new Menus();
                $this->getparent->id = $this->parent_id;
            }
        }
        public function getContent(){
            if (isset($this->content))
                return $this->content;
            else {
                $model = new Articles;
                $model->parent_id = $this->id;
                $model->menucontent = 1;
                $model->save();
                return $model;
            }
        }
        public function getContentTranslation($lang) {
        $content = $this->getContent();
        if (isset($content->translations) && isset($content->translations[$lang]))
            return $content->translations[$lang];
        else {
            $model = new ArticlesTranslate();
            $model->articles_id = $content->id;
            $model->language = $lang;
            return $model;
        }
    }

    /**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Parent',
			'sort' => 'Sort',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('sort',$this->sort);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        public function getPhoto($id){
            if (isset($this->photos) && is_array($this->photos) && isset($this->photos[$id]))
                return '/uploads/menus/'.$this->photos[$id]->pic_name;
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
            $tmp->type = 'Menus';
            $tmp->parent_id = $this->id;
            $tmp->url = Utilities::str2url($this->getTranslation($lang)->name);
            return $tmp;
        }
}
