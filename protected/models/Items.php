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
    public $minPrice,$maxPrice,$input1,$input2,$input3,$input4,$input5,$input6,$cat;
    public $checkbox1,$checkbox2,$checkbox3,$checkbox4,$checkbox5,$checkbox6;
    public $translationClass='ItemsTranslate';
    public $ip;
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
            array('category_id,body, address,documents,city,latitude,longitude ', 'required','on'=>'Create','message'=>  Utilities::t('{attribute} cannot be blank!')),
            array('category_id', 'required','on'=>'Import'),
            array('category_id,customer_id,floors,monthly,daily,price,city,floor,rooms,balconies,district', 'numerical', 'integerOnly'=>true),
            array('price,latitude,longitude','type','type'=>'float'),
            array('name, size, pic_name,district,city,possesion,date, construction_status,area,rooms,project,remont,documents,heating,hot_water', 'length', 'max'=>255),
            array('pic_name','file','types'=>'jpg,png,gif','allowEmpty'=>true),
//            array('params','file','types'=>'doc,docx,zip,pdf','allowEmpty'=>true),
            array('sort','default','value'=>0),
//            array('sort,badge,floor,floors,bedrooms,bedrooms,jiloy_area,general_area,balconies,price,monthly,daily','default','value'=>0),
            array('body,address','type','type'=>'string'),
//            array('price,daily,monthly','numerical','min'=>'0.000'),
            array('propertyType','numerical','min'=>1),
            array('bedrooms,jiloy_area,general_area,balconies,monthly,daily','numerical','min'=>0),
            array('latitude','default','value'=>'40.3929804'),
            array('longitude','default','value'=>'49.8890868'),
            array('photos','checkPhotos','on'=>'Update'),
            array('area,jiloy_area,general_area','checkAreas'),
            array('price,daily,monthly','checkPrices'),
            array('propertyType','checkParams'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, category_id,room, name,latitude,floors,floor,district,longitude,sort,brands_id, body,artikul,artikul2,barcode,size, color_id, size, price, discount, pic_name, stock', 'safe', 'on'=>'search'),
        );
    }
    public function afterSave() {
        parent::afterSave();
        if ($this->isNewRecord){
            $output['item']=$this;
            $output['photos'] = $this->photos();
            $content = Yii::app()->controller->renderPartial('mail-item', $output,true );

            $mailer = Yii::app()->mandrill;
            $mailData['to_email'] = Yii::app()->controller->getSetting('adminEmail','le.bord@gmail.com');
            $mailData['subject'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].' mailer';
            $mailData['html'] =  $content;
            $result = $mailer->sendMessage($mailData);
            if (is_array($result) && ($result[0]->status=='sent' || $result[0]->status=='queued')){
                Yii::log('Item Sent to founders',CLogger::LEVEL_INFO,'application.items.Mandrill');
            } 
            else {
                Yii::log('Item Send to founders Error: '.  print_r($result,true),CLogger::LEVEL_ERROR,'application.items.Mandrill');
            }
            
        }
        return true;
    }
    public function checkPhotos($attribute,$params){
        if (count($this->photos)<4)
            $this->addError('photos','Yetərli sayda foto-şəkil əlavə edilməyib.');

    }
    public function checkPrices($attribute,$params){
        $tmp = Category::model()->findByPk($this->category_id);
         if ($tmp && $tmp->price_field==$attribute && !$this->{$attribute}){
            $this->addError($attribute, Utilities::t('{attribute} cannot be blank!',array('{attribute}'=>$this->getAttributeLabel($attribute))) );
        }
    }
    
    
    public function checkAreas($attribute,$params){
        if ($this->category_id==76 && $attribute=='general_area' && !$this->$attribute){
            $this->addError($attribute, Utilities::t('{attribute} cannot be blank!',array('{attribute}'=>$this->getAttributeLabel($attribute))) );
        } else if ($this->category_id!=76 &&($attribute=='area' ) && !$this->$attribute){
            $this->addError($attribute, Utilities::t('{attribute} cannot be blank!',array('{attribute}'=>$this->getAttributeLabel($attribute))) );
        }
    }
    public function beforeSave() {
        parent::beforeSave();
        $priceField = $this->category->price_field?$this->category->price_field:'price';
//        $this->$priceField = $this->price;
        $this->date = date('Y-m-d H:i:s');
        return true;
    }
    public function scopes() {
        parent::scopes();
        $t = $this->getTableAlias(false);
        $date = date('Y-m-d H:i:s');
        $intervalSetting = Yii::app()->controller->getSetting('adsActiveInterval',60);
        return array(
            'active'=>array(
                'condition'=>"$t.active=1 and $t.deleted=0 and DATE_SUB('$date', INTERVAL $intervalSetting day)<=$t.date",
                'order'=>"$t.id desc"
            )
        );
    }
    public function defaultScope(){
        return array(
                'scopes'=>array('active'),
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
            'photos' => array(self::HAS_MANY, 'ItemPhotos', 'item_id','order'=>'photos.sort asc','condition'=>'photos.type!=1'),
            'schemas' => array(self::HAS_MANY, 'ItemPhotos', 'item_id','order'=>'schemas.sort asc','condition'=>'schemas.type=1'),
            'recommended' => array(self::MANY_MANY, 'Items', 'items_recommended(parent_id,child_id)','condition'=>'recommended.active=1'),
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
            'color' => array(self::BELONGS_TO, 'Colors', 'color_id'),
            'brand' => array(self::BELONGS_TO, 'Brands', 'brands_id'),
            'customer' => array(self::BELONGS_TO, 'Customers', 'customer_id'),
            'translations' => array(self::HAS_MANY, 'ItemsTranslate', 'parent_id','index'=>'language'),
            'stocks' => array(self::HAS_MANY, 'ItemsStock', 'item_id'),
            'stockSum' => array(self::STAT, 'ItemsStock', 'item_id','select'=>'sum(stock)'),
            'cleanurls'=>array(self::HAS_MANY,'Cleanurls','parent_id','on'=>'cleanurls.type="Items"','index'=>'language'),
            'paramset'=>array(self::HAS_MANY,'ItemsParamset','items_id'),
            'cityModel'=>array(self::BELONGS_TO,'City','city'),
            'districtModel'=>array(self::BELONGS_TO,'Districts','district'),
            'configurations'=>array(self::HAS_MANY,'ItemsConfiguration','parent_id'),
            'minPriceStat'=>array(self::STAT,'ItemsConfiguration','parent_id','select'=>'min(price)')
        );
    }
    public function getActions(){
        $tmp = array('content'=>array(
            'edit'=>array('title'=>'Edit Item',
                            'params'=>array('class'=>'glyphicon glyphicon-edit', 'url'=> 'items/Update','data'=>array('id'=>$this->id))),
            'delete'=>array('title'=>($this->deleted?'Undelete':'Delete').' Item',
                            'params'=>array('aclass'=>'magnum-'.($this->deleted?'undelete':'delete').' magnum-ajax', 'class'=>'glyphicon glyphicon-trash', 'url'=> 'items/delete','data'=>array('id'=>$this->id))),
            'visible'=>array('title'=>'Show / Hide',
                            'params'=>array('aclass'=>'magnum-togglevisibility magnum-ajax', 'class'=>'fa fa-eye', 'url'=> 'items/togglevisibility','data'=>array('id'=>$this->id))),
            //'publish'=>array('title'=>'Publish Item',
            //                'params'=>array('class'=>'glyphicon glyphicon-pushpin', 'url'=> 'content/publish','data'=>array('id'=>$id))),
        ));
        return $tmp;

    }
    public function getElanTypes(){
        $cats = Category::model()->active()->findAllByAttributes(array('parent_id'=>-1,'main'=>1));
        $tmp = array();
        foreach($cats as $cat){
            $tmp[$cat->id]=$cat->getTranslation(Yii::app()->controller->Lang)->name;
        }
        return $tmp;
    }
    public function getCities(){
        $lang = Yii::app()->controller->Lang;
        $cities = City::model()->with(array('translations'=>array('together'=>true)))->findAll(array('order'=>'t.sort desc , translations.name asc'));
        $tmp = array();
        foreach($cities as $city){
            $tmp[$city->id]=$city->getTranslation($lang)->name;
        }
//        return CHtml::listData($cities, 'id', 'name');
        return $tmp;
    }
    public function getDistricts(){
        $cities = Districts::model()->with(array('translations'=>array('together'=>true)))->findAll(array('order'=>'translations.name asc'));
        $tmp = array();
        foreach($cities as $city){
            $tmp[$city->id]=$city->getTranslation(Yii::app()->controller->Lang)->name;
        }
        return $tmp;
    }
    public function getProjects($id = null){
            $tmp = array(
                'alman'=>  Utilities::t('German'),
                'arxitektura'=>  Utilities::t('Architectural'),
                'axundov'=>  Utilities::t('Akhundov'),
                'stone'=>  Utilities::t('Stone building'),
                'tashkent'=>  Utilities::t('Tashkent'),
                'experimental'=>  Utilities::t('Experimental'),
                'finnish'=>  Utilities::t('Finnish'),
                'french'=>  Utilities::t('French'),
                'italian'=>  Utilities::t('Italian'),
                'kiev'=>  Utilities::t('Kiev'),
                'leningrad'=>  Utilities::t('Leningrad'),
                'minsk'=>  Utilities::t('Minsk'),
                'modern'=>  Utilities::t('Modern'),
                'stalin'=>  Utilities::t('Stalin'),
                'khrushov'=>  Utilities::t('Khrushov'),
                'new-building'=>  Utilities::t('New building')
            );
        if (!$id )
            return $tmp;
        else if  ($id && !isset($tmp[$id])){
            return '';
        }
        return $tmp[$id];

    }
    public function getDocuments($id = null){
        // Bələdiyyə Sənədi, Çıxarış, Digər sənəd, Etibarnamə, Ev kitabçası, 
        // Kupça (Çıxarış), Müqavilə, Order, Qeydiyyat, Şəhadətnamə, Sənədli, 
        // Sənədsiz, Sərəncam, Texpasport, 
        $tmp = array(
            'municipiality'=>  Utilities::t('Municipiality'),
//            'state-register-certificate'=>  Utilities::t('State register certificate'),
            'other'=>  Utilities::t('Other document'),
            'letter-of-attorney'=>  Utilities::t('Letter of attorney'),
            'house-book'=>  Utilities::t('House book'),
            'certificate-of-ownership'=>  Utilities::t('Certificate of ownership'),
            'contract'=>  Utilities::t('Contract'),
            'order'=>  Utilities::t('Order'),
            'registration'=>  Utilities::t('Registration'),
            'certificate'=>  Utilities::t('Certificate'),
            'with-document'=>  Utilities::t('With documents'),
            'no-document'=> Utilities::t('No document'),
            'disposal'=>  Utilities::t('Disposal'),
            'texpasport'=>  Utilities::t('Technical passport')
        );
        if (!$id )
            return $tmp;
        else if  ($id && !isset($tmp[$id])){
            return '';
        }
        return $tmp[$id];
    }
    public function getRepairLevels($id = null){
        //Orta, Təmirsiz, Yaxşı, Zəif, Əla,
        $tmp = array(
            'medium'=>  Utilities::t('Medium'),
            'not-repaired'=>  Utilities::t('Not repaired'),
            'good'=>  Utilities::t('Good'),
            'weak'=>  Utilities::t('Weak'),
            'awesome'=>  Utilities::t('Awesome')
        );
        if (!$id )
            return $tmp;
        else if  ($id && !isset($tmp[$id])){
            return '';
        }
        return $tmp[$id];
    }
    
    public function getHeatingSystems($id =null){
        //Digər, Kamin, Kombi, Kondisioner, Qazanxana, Yoxdur,
        
        $tmp = array(
            'other'=>  Utilities::t('Other'),
            'kamin'=>  Utilities::t('Kamin'),
            'kombi'=>  Utilities::t('Kombi'),
            'conditioner'=>  Utilities::t('Conditioner'),
            'boiling-house'=>  Utilities::t('Boiling house'),
            'no-heating'=>  Utilities::t('No heating')
        );
        if (!$id )
            return $tmp;
        else if  ($id && !isset($tmp[$id])){
            return '';
        }
        return $tmp[$id];
    }
    public function getHotWaterTypes($id =null){
        //Daimi, Fasilə ilə, Kombi, Var, Yoxdur, 

        $tmp = array(
            'always'=>  Utilities::t('Always'),
            'pauses'=>  Utilities::t('Pauses'),
            'kombi'=>  Utilities::t('Kombi'),
            'have'=>  Utilities::t('Have'),
            'no'=>  Utilities::t('No')
        );
        if (!$id )
            return $tmp;
        else if  ($id && !isset($tmp[$id])){
            return '';
        }
        return $tmp[$id];
    }
    public function getGeneralArea(){
        return SearchForm::getGeneralArea($this->category_id);
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'category_id'=>  Utilities::t('category'),
            'propertyType'=>  Utilities::t('property type'),
            'project'=>  Utilities::t('Project'),
            'documents'=>  Utilities::t('Documents'),
            'remont'=>  Utilities::t('Repair'),
            'general_area'=>  Utilities::t('Land area'),
            'heating'=>  Utilities::t('Heating'),
            'hot_water' => Utilities::t('Hot water'),
            'balconies'=>  Utilities::t('Balconies'),
            'area'=>  Utilities::t('area'),
            'floors'=>  Utilities::t('Floors'),
            'floor'=>  Utilities::t('Floor'),
            'jiloy_area'=>  Utilities::t('Living area'),
            'rooms'=>  Utilities::t('Rooms'),
            'city'=>  Utilities::t('City'),
            'district'=>  Utilities::t('District/Metro'),
            'price'=>  Utilities::t('Price'),
            'monthly'=>  Utilities::t('Monthly price'),
            'daily'=>  Utilities::t('Daily price'),
            'body'=>  Utilities::t('Property info'),
            'rooms'=>  Utilities::t('rooms'),
            'address'=>  Utilities::t('Address'),
            'date'=>  Utilities::t('Date added'),
        );
    }
    public function getColors(){
        $colors = '';
        $colorArr = array();
        if (isset($this->stocks) && is_array($this->stocks) && count($this->stocks))
            foreach($this->stocks as $stock)
                if (!in_array($stock->color->name, $colorArr))
                        $colorArr[] = $stock->color->name;
                //$colors.=$stock->color->name.', ';
         $str = implode(', ', $colorArr);
         return $str;
    }
    public function getPhoto($id){
        if (isset($this->photos) && is_array($this->photos) && isset($this->photos[$id]))
            return '/uploads/items/'.$this->photos[$id]->pic_name;
        else return '/uploads/items/noImage.jpg';
    }
    public function getPhotoItem($id){
        if (isset($this->photos) && is_array($this->photos) && isset($this->photos[$id]))
            return $this->photos[$id];
        else {
            $tmp = new ItemPhotos();
            $tmp->pic_name='noImage.jpg';
            return $tmp;
        }
    }
    public function getPropertySingular($id=null){
        $tmp = array(
            1=>  Utilities::t('new buildings'),
            2=> Utilities::t('old buildings'),
            23=> Utilities::t('yard house'),
            51=>  Utilities::t('office'),
            52=> Utilities::t('production facility'),
            53=> Utilities::t('catering facility'),
            81=>  Utilities::t('garage'),
            121=>  Utilities::t('Shop'),
        );
        if (!$id )
            return $tmp;
        else if  ($id && !isset($tmp[$id])){
            return '';
        }
        return $tmp[$id];
    }
    
    public function getPropertyType($id=null){
        $ss = new SearchForm;
        $ss->category = $this->category_id;
        $tmp = $ss->getPropertyType();
        if (!$id )
            return $tmp;
        else if  ($id && !isset($tmp[$id])){
            return '';
        }
        return $tmp[$id];
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
        $criteria->addSearchCondition('category.name',$this->category_id);
        $criteria->addSearchCondition('t.name',$this->name,true);
        $criteria->compare('body',$this->body,true);
        $criteria->addSearchCondition('color.name',$this->color_id);
        $criteria->addSearchCondition('brand.name',$this->brands_id);
        $criteria->compare('size',$this->size,true);
        $criteria->compare('price',$this->price);
        $criteria->compare('discount',$this->discount);
        $criteria->with=array('color','category','brand','stocks');
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
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
 
    function getPrice(){
        return Utilities::t('{price} / per '.$this->category->price_field,array('{price}'=>$this->{$this->category->price_field}));
    }
    static function getOptimizedCriteria($preview=0){
        $crit = new CDbCriteria;
        $crit->order = 't.id asc';
        $crit->addCondition('t.active=1');
        $crit->addCondition('t.deleted=0');


        if ($preview){
            //unset($crit->with['category']['with']['fields']['on']);
            //unset($crit->with['category']['with']['fields']['condition']);

        } else {
            unset($crit->with['category']['with']['fields']['with']['children']);

        }
        return $crit;
    }
    public function checkParams($attribute,$params){
        $fields = Items::getFieldDependency();
        $fields = $fields['Items_propertyType'];
        if ((!$this->propertyType || $this->propertyType=='') && $this->category_id!=76){
            $this->addError($attribute,Utilities::t('{attribute} cannot be blank!',array('{attribute}'=>$this->getAttributeLabel($attribute))));
            return;
        }
//        print_r($this);die();
        $fields = isset($fields[$this->propertyType])?$fields[$this->propertyType]:array();
        $unhide = (isset($fields['unhide'])?$fields['unhide']:array());
        $hide = (isset($fields['nothing'])?$fields['nothing']:array());
//        print_r($hide);
//        if ($hide)
//            foreach($hide as $field){
//                if (isset($this->errors[$field]))
//                    unset($this->errors[$field]);
//            }
        if ($unhide)
            foreach($unhide as $field){
                if (!$this->$field && (($hide && !in_array($field, $hide)) || (empty($hide))))
                $this->addError($field, Utilities::t('{attribute} cannot be blank!',array('{attribute}'=>$this->getAttributeLabel($field))) );
            }
//        if ($tmp->price_field!=$attribute)
//            unset ($this->errors[$attribute]);
    }
    static function getFieldDependency(){
        $attrs = array(
            'Items_category_id'=>array(
                //rent
                62=>array(
                    'allow'=>array( 'floor','floors','monthly','rooms','area','jiloy_area','propertyType',
                                    'documents','project','remont','balconies','heating','hot_water','bedrooms')
                ),
                //daily aparment
                63=>array(
                    'allow'=>array( 'floor','floors','daily','rooms','area','jiloy_area','propertyType',
                                    'documents','project','remont','balconies','heating','hot_water','bedrooms')
                ),
                //buy
                69=>array(
                    'allow'=>array( 'floor','floors','price','rooms','area','jiloy_area','propertyType',
                                    'documents','project','remont','balconies','heating','hot_water','bedrooms')
                ),
                //lands
                76=>array(
                    'allow'=>array( 'price','general_area',
                                    'documents')
                ),
                //new projects
                65=>array(
                    'construction_status','possesion',
                )
            ),
            'Items_propertyType'=>array(
//            1=>  Utilities::t('new buildings'),
                1=>array(
                    'hide'=>array(
                        'general_area'
                    ),
                    'unhide'=>array(
                      'floor','floors','jiloy_area','balconies','rooms','remont','area'
                    ),
                ),
//            2=> Utilities::t('old buildings'),
                
                2=>array(
                    'hide'=>array(
                        'general_area'
                    ),
                    'unhide'=>array(
                      'floor','floors','jiloy_area','balconies','rooms','remont'
                    ),
                ),
//            23=> Utilities::t('yard house'),
                
                23=>array(
                    'hide'=>array(
                        'floor'
                    ),
                    'unhide'=>array(
                      'floors','general_area','jiloy_area','balconies','rooms','remont'
                    ),
                ),
//            51=>  Utilities::t('office'),
                51=>array( 
                    'hide'=>array(
                      'floor','balconies'  
                    ),
                    'unhide'=>array(
                      'floors','general_area','area','jiloy_area','rooms','remont'
                    ),
                ),
//            52=> Utilities::t('production facility'),
                52=>array( 
                    'hide'=>array(
                      'floor','balconies','jiloy_area' 
                    ),
                    'nothing'=>array(
                      'rooms','floors','floor','balconies','documents'  ,'general_area','jiloy_area',
                    ),
                    'unhide'=>array(
                      'floors','general_area','area','remont'
                    ),
                ),
//            53=> Utilities::t('catering facility'),
                53=>array(
                    'hide'=>array(
                      'floor','balconies','jiloy_area' 
                    ),
                    'nothing'=>array(
                      'rooms','floors','floor','balconies','documents'  ,'general_area','jiloy_area'
                    ),
                    'unhide'=>array(
                      'floors','general_area','area','remont'
                    ),
                ),
//            81=>  Utilities::t('garage'),
                81=>array(
                    'hide'=>array(
                      'floor','floors','general_area','jiloy_area','balconies'
                    ),
                    
                ),
//            121=>  Utilities::t('Shop'),
                121=>array(
                    'hide'=>array(
                      'floor','balconies','jiloy_area' 
                    ),
                    'nothing'=>array(
                      'rooms','floors','floor','balconies','documents'  ,'general_area','jiloy_area'
                    ),
                    'unhide'=>array(
                      'floors','general_area','area','remont'
                    ),
                ),
            )
        );
        return $attrs;
    }
}

                            