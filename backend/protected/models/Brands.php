<?php

/**
 * This is the model class for table "brands".
 *
 * The followings are the available columns in table 'brands':
 * @property string $id
 * @property string $name
 * @property string $logo
 * @property string $logo_dark
 */
class Brands extends Translatable
{
    public $translationClass='BrandsTranslate';
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'brands';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name','required'),
            array('name, sort,logo, logo_dark', 'length', 'max'=>255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, logo, logo_dark', 'safe', 'on'=>'search'),
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
            'items'=>array(self::HAS_MANY,'Items','brands_id'),
            'translations'=>array(self::HAS_MANY,'BrandsTranslate','parent_id','index'=>'language'),
            'cleanurls'   => array(self::HAS_MANY,   'Cleanurls',    'parent_id','index'=>'language','condition'=>'cleanurls.type="Brands"'),
            'photos'=>array(self::HAS_MANY,'Gallery','parent_id','condition'=>'photos.type="Brands"'),
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
            'logo' => 'Logo',
            'logo_dark' => 'Logo Dark',
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

        $criteria->compare('id',$this->id,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('logo',$this->logo,true);
        $criteria->compare('logo_dark',$this->logo_dark,true);

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
     * @return Brands the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function getCleanurl($lang){
        if (isset($this->cleanurls[$lang]))
            return $this->cleanurls[$lang];

        $tmp = new Cleanurls();
        $tmp->language = $lang;
        $tmp->type = 'Brands';
        $tmp->parent_id = $this->id;
        $tmp->url = Utilities::str2url($this->getTranslation($lang)->name);
        return $tmp;
    }
    
}
