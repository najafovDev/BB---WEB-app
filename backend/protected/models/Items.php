<?php

/**
 * This is the model class for table "items".
 *
 * The followings are the available columns in table 'items':
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $body
 * @property integer $color_id
 * @property string $size
 * @property integer $price
 * @property integer $discount
 * @property string $pic_name
 * @property integer $stock
 *
 * The followings are the available model relations:
 * @property ItemPhotos[] $itemPhotoses
 * @property Category $category
 * @property ItemsTranslate[] $itemsTranslates
 */
class Items extends Translatable
{
    public $translationClass='ItemsTranslate';
   /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'items';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_id', 'required','on'=>'Create'),
            array('category_id', 'required','on'=>'Import'),
            array('name,category_id,brands_id','required'),
            array('category_id,active,popular,new,front, model_year,color_id,brands_id, stock,badge', 'numerical', 'integerOnly'=>true),
            array('price, discount,latitude,longitude','type','type'=>'float'),
            array('name, size, pic_name,date,material', 'length', 'max'=>255),
            array('pic_name','file','types'=>'jpg,png,gif','allowEmpty'=>true),
            array('params','file','types'=>'doc,docx,zip,pdf','allowEmpty'=>true),
            array('sort,badge','default','value'=>0),
            array('body','type','type'=>'string'),
            array('price','numerical','min'=>'0.000'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, category_id,name,sort,brands_id, body,artikul,artikul2,barcode,size, color_id, size, price, discount, pic_name, stock', 'safe', 'on'=>'search'),
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
            'photos' => array(self::HAS_MANY, 'ItemPhotos', 'item_id','order'=>'sort asc'),
            'paramset' => array(self::HAS_MANY, 'ItemsParamset', 'items_id'),
            'recommended' => array(self::MANY_MANY, 'Items', 'items_recommended(parent_id,child_id)'),
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
            'color' => array(self::BELONGS_TO, 'Colors', 'color_id'),
            'brand' => array(self::BELONGS_TO, 'Brands', 'brands_id'),
            'customer'=>array(self::BELONGS_TO,'Customers','customer_id'),
            'translations' => array(self::HAS_MANY, 'ItemsTranslate', 'parent_id','index'=>'language'),
            'stocks' => array(self::HAS_MANY, 'ItemsStock', 'item_id'),
            'cleanurls'=>array(self::HAS_MANY,'Cleanurls','parent_id','condition'=>'cleanurls.type="Items"','together'=>true,'index'=>'language'),
//            'configurations'=>array(self::HAS_MANY,'ItemsConfiguration','parent_id'),
//            'minPriceStat'=>array(self::STAT,'ItemsConfiguration','parent_id','select'=>'min(price)')
        );
    }
    public function getConstructionStatuses(){
        return array(
            'in progress'=>'In Progress',
            'completed'=>'Completed',
            'sold'=>'Sold'
        );
    }
    public function getActions(){
        $tmp = array('content'=>array(
            'edit'=>array('title'=>'Edit Item',
                            'params'=>array('class'=>'glyphicon glyphicon-edit', 'url'=> 'items/update','data'=>array('id'=>$this->id))),
            'delete'=>array('title'=>($this->deleted?'Undelete':'Delete').' Item',
                            'params'=>array('aclass'=>'magnum-'.($this->deleted?'delete':'delete').' magnum-ajax', 'class'=>'glyphicon glyphicon-trash', 'url'=> 'items/delete','data'=>array('id'=>$this->id))),
            'visible'=>array('title'=>'Show / Hide',
                            'params'=>array('aclass'=>'magnum-togglevisibility magnum-ajax', 'class'=>'fa fa-eye', 'url'=> 'items/togglevisibility','data'=>array('id'=>$this->id))),
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
            'category_id' => 'Category',
            'name' => 'Name',
            'body' => 'Body',
            'brands_id'=>'Brand',
            'color_id' => 'Color',
            'size' => 'Size',
            'price' => 'Price',
            'general_area'=>  Utilities::t('Land area'),
            'district'=>  Utilities::t('District/Metro'),
            'discount' => 'Discount',
            'pic_name' => 'Pic Name',
            'params'=>'Book pdf',
            'stock' => 'Stock',
        );
    }
    public function getStock($no){
        if (isset($this->stocks[$no]))
            return $this->stocks[$no];
        else return new ItemsStock();
    }
    public function getStockSum(){
        $sum = 0;
        if (isset($this->stocks) && is_array($this->stocks) && count($this->stocks))
            foreach($this->stocks as $stock)
                $sum+=$stock->stock;
        return $sum;
    }
    public function getColors(){
        $colors = '';
        $colorArr = array();
        if (isset($this->stocks) && is_array($this->stocks) && count($this->stocks))
            foreach($this->stocks as $stock)
                if ($stock->color && !in_array($stock->color->name, $colorArr))
                        $colorArr[] = $stock->color->name;
                //$colors.=$stock->color->name.', ';
         $str = implode(', ', $colorArr);
         return $str;
    }
    public function getPhoto($id){
        if (isset($this->photos) && is_array($this->photos) && isset($this->photos[$id]))
            return '/uploads/items/'.$this->photos[$id]->pic_name;
        else return '/img/wirebike.jpg';
    }
    public function getBadges(){
        $tmp = array(
            '0'=>'No badge',
            '1'=>'New',
            '2'=>'Hit',
            '3'=>'Otstoy'
        );
        return $tmp;
    }
    public function getCustomers(){
        $customers =Customers::model()->findAll(array('order'=>'name asc'));
        $tmp = array();
        foreach($customers as $customer ){
            $tmp[$customer->id] = $customer->name.' '.$customer->surname .' | '.$customer->prefix.$customer->phone;
        }


        return $tmp;
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
        $criteria->compare('category_id',$this->category_id);
        $criteria->compare('customer_id',$this->customer_id);
        $criteria->addSearchCondition('t.name',$this->name,true);
        $criteria->compare('body',$this->body,true);
        $criteria->compare('color_id',$this->color_id);
        $criteria->compare('brands_id',$this->brands_id);
        $criteria->compare('size',$this->size,true);
        $criteria->compare('price',$this->price);
        $criteria->compare('deleted',0);
        $criteria->compare('discount',$this->discount);
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

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Items the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public static function getItems4Tree($id=-1,$deleted=0){
        $models = Items::model()->with()->findAllByAttributes(array('category_id'=>$id,'deleted'=>0));
        $classType = 'item';
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
                                'type'=>($model->deleted?'deleted':($classType=='menu'?'file':'item'))
                        );
         }
        return $tmp ;
    }
    public function getCleanurl($lang){
        if (isset($this->cleanurls[$lang]))
            return $this->cleanurls[$lang];

        $tmp = new Cleanurls();
        $tmp->language = $lang;
        $tmp->type = 'Items';
        $tmp->parent_id = $this->id;
        $tmp->url = Utilities::str2url($this->getTranslation($lang)->name);
        $tmp->save();
        return $tmp;
    }

}
