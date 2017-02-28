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
        
        public function behaviors() {
            return array(
                'cleanurlBehavior'=>array(
                'class'=>'application.components.behaviors.CleanurlBehavior'
                    
                )
            );
        }

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
			array('name,price_field', 'required','on'=>'Update'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
                        array('sort','default','value'=>0),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_id,fieldsetIds,deleted,sort,active, name', 'safe', 'on'=>'search'),
		);
	}
        public function scopes(){
            $t=$this->getTableAlias(false, false);
            
            return array(
                'active'=>array(
                    'condition'=>$t.'.deleted=0 and '.$t.".active=1 and $t.id!=37",
                )
                
            );
        }
        public function defaultScope() {
            parent::defaultScope();
            return array(
                'scopes'=>array('active')
            );
        }
        public function getKeyword(){
            $tmp = array('','velo','extras','spares','kits','instruments');
            return $tmp[$this->sort%count($tmp)];
            
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
                        'itemsCount'=>array(self::STAT,'Items','category_id'),
                        'parent'=>array(self::BELONGS_TO,'Category','parent_id'),
                        'cleanurls'=>array(self::HAS_MANY,'Cleanurls','parent_id','condition'=>'cleanurls.type="Category"'),
			'children'   => array(self::HAS_MANY,   'Category',    'parent_id'),
			'translations'   => array(self::HAS_MANY,   'CategoryTranslate',    'parent_id','index'=>'language','together'=>true),
                        'photos'=>array(self::HAS_MANY,'Gallery','parent_id','condition'=>'photos.type="Category"'),
                        'activeChildren'=>array(self::HAS_MANY,'Category','parent_id','scopes'=>'active'),
                        'hasActiveChildren'=>array(self::STAT,'Category','parent_id','condition'=>'t.deleted=0 and t.active=1'),
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
            return $tmp;

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

	public function featuredItems()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
                $model = new Items();
                
		$criteria=new CDbCriteria;

		$criteria->compare('category_id',$this->id);
		$criteria->compare('popular',1);
		$criteria->compare('active',1);
		$criteria->compare('deleted',0);
                $criteria->order = 't.date desc';
		return new CActiveDataProvider($model, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>16,
                            'validateCurrentPage'=>true
                        )
		));
	}

	public function premiumItems()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.
                $model = new Items();
                
		$criteria=new CDbCriteria;

		$criteria->compare('category_id',$this->id);
		$criteria->compare('popular',1);
		$criteria->compare('active',1);
		$criteria->compare('deleted',0);
                
		return new CActiveDataProvider($model, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>16,
                            'validateCurrentPage'=>true
                        )
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
}
