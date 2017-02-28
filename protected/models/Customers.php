<?php

/**
 * This is the model class for table "customers".
 *
 * The followings are the available columns in table 'customers':
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $phone
 * @property string $email
 * @property string $login
 * @property string $password
 * @property integer $subscribe
 */
class Customers extends MfeActiveRecord
{
    public $verifyCode,$password2,$new_password,$oldpass,$_identity;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Customers the static model class
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
		return 'customers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('login','match', 'pattern'=> '/[[:alnum:]]/','message'=>"{attribute} should contain only alphanumeric and underscore."),
                        array('pic_name','file','types'=>'png,jpg,gif','allowEmpty'=>true),
			array('subscribe,type,active,experience,phone,prefix,email_confirmed', 'numerical', 'integerOnly'=>true),
			array('name, surname, email,tags, latitude,longitude,login,address, password,password2,officephone,website', 'length', 'max'=>255),
			array('phone', 'length', 'is'=>7, 'message'=>'{attribute} 7 rəqəmdən ibarət olmalıdır'),
                        array('phone','checkPhone'),
			array('email','email','message'=>'Email Düzgün daxil edilməyib.'),
                        array('prefix','in','range'=>$this->getPrefixes()),
                        array('verifyCode', 'captcha','allowEmpty'=>1 || !Yii::app()->user->isGuest || !CCaptcha::checkRequirements(),'on'=>'Register'),
			array('login,email','unique','message'=>'Bu {attribute} artıq qeydiyyatdan keçib. ','on'=>'Register'),
			array('name,phone', 'required','message'=>'{attribute} daxil edilməyib.', 'on'=>'Register'),
//			array('password2', 'compare', 'compareAttribute'=>'password','on'=>'Register','message'=>'{attribute}.'),
//                        array('body','required'),
                        array('name,body', 'required', 'on'=>'Update'),
                        array('oldpass', 'findPasswords', 'on' => 'Update'),
                        array('new_password', 'compare', 'compareAttribute'=>'password2', 'on'=>'Update'),
			array('login, email,password,active,deleted,email_confirmed,date', 'unsafe', 'on'=>'Update'),
                        array('login,phone','unsafe','on'=>'Update'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, officephone,website,surname, phone, prefix,email, login, password, subscribe', 'safe', 'on'=>'search'),
		);
	}
        public function findPasswords($attribute, $params)
        {
            if ($this->oldpass && $this->password != ($this->oldpass))
                $this->addError($attribute, 'Mövcud şifrə düzgün daxil edilməyib.');
        }
        public function checkPhone($attr,$params){
            $prefixes = $this->getPrefixes();
            $this->phone = preg_replace("/[^0-9]/", "", $this->phone);
            $crit = new CDbCriteria();
            $crit->compare('prefix',$this->prefix);
            $crit->compare('phone',$this->phone);
            if (!$this->isNewRecord)
                $crit->addCondition('t.id!='.$this->id);
            if (Customers::model()->count($crit))
                    $this->addError($attr,'Bu telefon artıq qeydiyyatdan keçib. ');
        }
        public function getPrefixes(){
            $prefixes = Phones::getPrefixes();
            
            return $prefixes;
        }
        
        public function beforeSave() {
            parent::afterSave();
            
            if ($this->scenario == 'Register' && $this->scenario =='Forgot'){
                $this->password = Utilities::genRandomString(10);

                if ($this->email!=''){
                    $mailer = Yii::app()->mandrill;
                    $mailData['to_email'] = $this->email;
                    $mailData['subject'] = '[Arabam.az] '.Utilities::t('Registration notification');
                    if ($this->scenario=='Forgot')
                        $mailData['html'] = Yii::app()->controller->renderPartial('//private/forgotpassword-mail', array('login' => $this->login,'pass'=>$this->password,'url'=>$_SERVER['HTTP_HOST']), true);
                    else 
                        $mailData['html'] = Yii::app()->controller->renderPartial('//private/pass-mail', array('login' => $this->login,'pass'=>$this->password,'url'=>$_SERVER['HTTP_HOST']), true);

                    $mailData['text'] = "Login: ".$this->login.'\n Password: '.$this->password;
                    $result = $mailer->sendMessage($mailData);
                    if ($result[0]->status=='sent' || $result[0]->status=='queued'){
                        Yii::app()->user->setFlash('userSettings','Şifrəniz tezliklə email vasitəsi ilə göndəriləcəkdir');
                    } 
                    else {
                        Yii::app()->user->setFlash('userSettings','E-mail göndərişi mümkün olmadı');
                    }
                }
//                $sms = round(rand(0,1)) || !Yii::app()->controller->getSetting('dualSmsGateway',0)? Yii::app()->atlSms: Yii::app()->smsSend;
//                if($sms->queryCoverage($this->prefix.$this->phone)){
//                    if ($this->scenario=='Forgot')
//                        $sms->postSms($this->prefix.$this->phone, "Arabam.az sehifesinde yeni shifre isteyi teleb etmisiniz.  Istifadeci adi: {$this->login}  Shifre: ".$this->password);
//                    else 
//                        $sms->postSms($this->prefix.$this->phone, "Arabam.az sehifesinde ugurla qeydiyyatdan kecdiniz.  Istifadeci adi: {$this->login}  Shifre: ".$this->password);
//                        
//                    Yii::app()->user->setFlash('userSettings','Qısa müddət ərzində telefonunuza və email adresinizə  istifadəçi adı və yeni şifrə göndəriləcək. ');
//
//                }
            }
            return true;
        }
	public function login()
	{
            if($this->_identity===null)
            {
                $this->_identity=new UserIdentity($this->login,$this->password);
                $this->_identity->authenticate();
            }
            if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
            {
                $duration=3600*24*30;//$this->rememberMe ? 3600*24*30 : 0; // 30 days
                Yii::app()->user->login($this->_identity,$duration);
                Yii::app()->user->setState('fullname',$this->name.' '.$this->surname);
                Yii::app()->user->setState('phone',$this->phone);
                Yii::app()->user->setState('id',$this->id);
                return true;
            }
            else
                return false;
	}
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'addresses'=>array(self::HAS_MANY,'Adress','customers_id'),
                    'rentListingsStat'=>array(self::STAT,'Items','customer_id','condition'=>'t.category_id=62 and t.active=1 and t.deleted=0'),
                    'rentListings'=>array(self::HAS_MANY,'Items','customer_id','condition'=>'rentListings.category_id=62 and rentListings.active=1 and rentListings.deleted=0'),
                    'sellListingsStat'=>array(self::STAT,'Items','customer_id','condition'=>'t.category_id=69 and t.active=1 and t.deleted=0'),
                    'sellListings'=>array(self::HAS_MANY,'Items','customer_id','condition'=>'sellListings.category_id=69 and sellListings.active=1 and sellListings.deleted=0'),
                    'photos'=>array(self::HAS_MANY,'Gallery','parent_id','condition'=>'photos.type="Customers"'),
                    'items'=>array(self::HAS_MANY,'Items','customer_id','condition'=>'items.active=1 and items.deleted=0'),
                    'phones'=>array(self::HAS_MANY,'Phones','customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
        public function getUserTypes($var=null){
            $tmp = array(
                ''=>Utilities::t('Chose...'),
                0=>Utilities::t('Owner'),
                1=>Utilities::t('Agent'),
//                2=>Utilities::t('Project developer'),
            );
            if ($var!=null){
                return $tmp[$var];
            } 
            return $tmp;
        }

        public function getImage($thumbnail =''){
            $tmp = ($this->pic_name!=''?$this->pic_name:'search.png');
            return ($thumbnail!=''?"/site/uploads/customers/$thumbnail/".$tmp:'/uploads/customers/'.$tmp);
        }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                    'id'=>'ID',
                    'login'=>Yii::t('frontend.strings','Login'),
                    'name'=>Yii::t('frontend.strings','Name'),
                    'surname'=>Yii::t('frontend.strings','Surname'),
                    'type'=>Yii::t('frontend.strings','User type'),
                    'prefix'=>'',//Yii::t('frontend.strings','Prefix'),
                    'phone'=>Yii::t('frontend.strings','Phone'),
                    'password'=>Yii::t('frontend.strings','Password'),
                    'password2'=>Yii::t('frontend.strings','Password2'),
                    'email'=>Yii::t('frontend.strings','E-mail'),
                    'subscribe'=>Yii::t('frontend.strings','Subscribe'),
                    'verifyCode'=>Yii::t('frontend.strings','verifyCode'),
		);
	}
        public function getPhones(){
            if (isset($_POST['Phones'])){
                $phones = array();
                foreach($_POST['Phones'] as $p){
                    $tmp = new Phones();
                    $tmp->attributes = $p;
                    $tmp->sort = 0;
                    $phones[]=$tmp;

                }
            } else {
                $phones = array(new Phones());
            }
            return $phones;
        }
        
        public function setPhones($var){
            if (isset($this->phones)){
                
            }
            $phones = array();
            foreach($var as $p){
                $tmp = new Phones();
                $tmp->attributes = $p;
                $tmp->sort = 0;
                $tmp->customer_id = $this->id;
                $tmp->save();
                $phones[]=$tmp;
                
            }
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('subscribe',$this->subscribe);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
    public function behaviors()
    {
        return array(
        );
    }
}