<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property CategoryFieldsetRelation[] $categoryFieldsetRelations
 * @property Items[] $items
 */
class Category extends Translatable
{   
        public $translationClass='CategoryTranslate';
        public $fieldsetIds;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required','on'=>'Update'),
                        array('price_field','default','value'=>'price'),
			array('parent_id,front,main', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
                        array('sort','default','value'=>0),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_id,fieldsetIds,deleted,sort,active, name', 'safe', 'on'=>'search'),
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
                        //'models' => array(self::MANY_MANY, 'Busmodel', 'bus_busmodel_assignment(buses_id, busmodel_id)'),
			'fields' => array(self::MANY_MANY, 'CategoryFieldset', 'category_fieldset_relation(category_id,fieldset_id)'),
			'items' => array(self::HAS_MANY, 'Items', 'category_id'),
                        'parent'=>array(self::BELONGS_TO,'Category','parent_id'),
			'children'   => array(self::HAS_MANY,   'Category',    'parent_id'),
			'translations'   => array(self::HAS_MANY,   'CategoryTranslate',    'parent_id','index'=>'language'),
                        'photos'=>array(self::HAS_MANY,'Gallery','parent_id','condition'=>'photos.type="Category"','order'=>'photos.sort asc'),
                        'cleanurls'   => array(self::HAS_MANY,   'Cleanurls',    'parent_id','index'=>'language','condition'=>'cleanurls.type="Category"'),
		);
	}

        public function getActions(){
            $tmp = array('content'=>array(
                'create'=>array('title'=>'Create Category',
                                'params'=>array('aclass'=>'magnum-jstree-create magnum-ajax','class'=>'glyphicon glyphicon-plus', 'url'=> 'category/create','data'=>array())),
                'edit'=>array('title'=>'Edit Category',
                                'params'=>array('class'=>'glyphicon glyphicon-edit', 'url'=> 'category/Update','data'=>array('id'=>$this->id))),
                'delete'=>array('title'=>($this->deleted?'Undelete':'Delete').' Category',
                                'params'=>array('aclass'=>'magnum-'.($this->deleted?'undelete':'delete').' magnum-ajax', 'class'=>'glyphicon glyphicon-trash', 'url'=> 'category/delete','data'=>array('id'=>$this->id))),
                'visible'=>array('title'=>'Show / Hide',
                                'params'=>array('aclass'=>'magnum-togglevisibility magnum-ajax', 'class'=>'fa fa-eye', 'url'=> 'category/togglevisibility','data'=>array('id'=>$this->id))),
                //'publish'=>array('title'=>'Publish Item',
                //                'params'=>array('class'=>'glyphicon glyphicon-pushpin', 'url'=> 'content/publish','data'=>array('id'=>$id))),
            ));
            if ($this->deleted){
                $tmp['content']['forever-delete'] = array('title'=>'Delete Forever',
                                        'params'=>array('aclass'=>'magnum-delete magnum-ajax', 'class'=>'glyphicon glyphicon-trash', 'url'=> 'category/shiftdelete','data'=>array('id'=>$this->id,'ajax'=>1)));
            }
            return $tmp;

        }
        public function afterFind() {

            if (!empty($this->fields)){
                foreach($this->fields as $model){
                    $this->fieldsetIds[]=$model->id;
                }
            }
            return $retVal = parent::afterFind();
            
        }
        public function beforeSave() {
            CategoryFieldsetRelation::model()->deleteAllByAttributes(array('category_id'=>$this->id));
            $this->fields = array();
            if (isset($this->fieldsetIds) && is_array($this->fieldsetIds)){
                foreach($this->fieldsetIds as $id){
                        $model = new CategoryFieldsetRelation;
                        $model->category_id=$this->id;
                        $model->fieldset_id = $id;
                        if ($model->save()){}// $this->fields[] = $model;
                        $tmp = CategoryFieldset::model()->findByPk($id);
                        if ($tmp->group)
                            foreach($tmp->children as $child){
                                $model = new CategoryFieldsetRelation;
                                $model->category_id = $this->id;
                                $model->fieldset_id = $child->id;
                                $model->save();
                            }
                }
            }
            return parent::beforeSave();
        }
        public function getfieldsetIds(){
            if (!empty($this->fields)){
                foreach($this->fields as $model){
                    $this->fieldsetIds[]=$model->id;
                }
            }
            return $this->fieldsetIds;
        }
        public function setFieldsetIds($arr){
            CategoryFieldsetRelation::model()->deleteAllByAttributes(array('category_id'=>$this->id));
            $this->fieldsetIds = $arr;
            $this->fields = array();
            if (isset($arr) && is_array($arr)){
                foreach($arr as $id){
                        $model = new CategoryFieldsetRelation;
                        $model->category_id=$this->id;
                        $model->fieldset_id = $id;
                        if ($model->save()) {}//{$this->fields[]=$model;}
                        $tmp = CategoryFieldset::model()->findByPk($id);
                        if ($tmp->group)
                            foreach($tmp->children as $child){
                                $model = new CategoryFieldsetRelation;
                                $model->category_id = $this->id;
                                $model->fieldset_id = $child->id;
                                $model->save();
                            }
                }
            }
        }
        public function getPriceFields(){
            return array(
                'price'=>'price',
                'daily'=>'daily',
                'monthly'=>'monthly'
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
			'name' => 'Name',
                        'fieldsetIds'=>'Additional Fields',
                        'fields'=>'Additional Fields',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Category the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getPhoto($id){
            if (isset($this->photos) && is_array($this->photos) && isset($this->photos[$id]))
                return '/uploads/category/'.$this->photos[$id]->pic_name;
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
        public static function getList($id=-1,$indent=0){
            $list = array();
            $indentStr = str_repeat("--", $indent).' ';
            $models = Category::model()->with('translations')->findAllByAttributes(array('parent_id'=>$id,'deleted'=>0));
            foreach ($models as $model) {
                
                $childList = Category::getList($model->id,$indent+1);
                $list = ($list+ array($model->id => $indentStr.(($str =$model->getTranslation(Yii::app()->controller->Lang)->name)!=''?$str:$model->name))+ $childList);
            }
            return $list;
        }
        public static function getChildrenTree($id=-1,$deleted=0){
            if (!$deleted)
                $models = Category::model()->with()->findAllByAttributes(array('deleted'=>0,'parent_id'=>$id),array('order'=>'sort asc'));
            else $models = Category::model()->with()->findAllByAttributes(array('deleted'=>1),array('order'=>'sort asc'));
            $classType = 'category';
            $tmp = array();
            $i=0;
            foreach($models as $model){
                 $i++;
                 $tmp[] = array('id'=>$classType.$model->id,
                                    'children'=>(isset($model->children)&&is_array($model->children) && count($model->children)?
                                                 true:
                                                 (isset($model->items)&&is_array($model->items) && count($model->items)?true:false)),
                                    //'parent'=>'menu'.$model->parent_id,
                                    'text'=>($model->name)?
                                            $model->name:
                                            'NOT TRANSLATED',
                                    'li_attr'=>array(
                                        'class'=>$model->active?'menus-visible':'menus-hidden',
                                        'data-menus-id'=>$model->id,
                                    ),
                                    'type'=>($model->deleted?'deleted':('file'))
                            );
             }
             if ($id!=-1)
                foreach(Category::model()->findByPk($id)->items as $model){
                     $i++;
                     $tmp[] = array('id'=>'item'.$model->id,
                                        'children'=>(isset($model->children)&&is_array($model->children) && count($model->children)?
                                                     true:
                                                     (isset($model->items)&&is_array($model->items) && count($model->items)?true:false)),
                                        //'parent'=>'menu'.$model->parent_id,
                                        'text'=>($model->name)?
                                                $model->name:
                                                'NOT TRANSLATED',
                                        'li_attr'=>array(
                                            'class'=>($model->active?'menus-visible':'menus-hidden').' -1 '.($model->deleted?' menus-deleted':''),
                                            'data-menus-id'=>$model->id,
                                        ),
                                        'type'=>($model->deleted?'deleted':('item'))
                                );
                 }
            return $tmp ;
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
