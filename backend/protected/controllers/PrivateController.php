<?php

class PrivateController extends Controller
{	
	
	public $Lang,$settings,$active;
	public function filters(){
                return array(
                        'accessControl' // perform access control for CRUD operations
                );
        }
	public function actions(){
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	public function accessRules(){
                return array(
			array('allow', 'actions'=>array('login','index','forgotpassword','logout','captcha')),
                        array('allow',  // allow all users to perform 'index' and 'view' actions
                                'actions'=>array('index2','add','elanlar','uploadedFiles','getLast','delImg','settings','add2Cart','cart','cart2','checkout','clearcart','confirm','confirmed','history','registered','register','users'
								),
												 
                                'users'=>array('@')
                        ),
                        array('deny',  // deny all users
                                'users'=>array('*'),
                        )
                );
        }
	public function SiteController($id, $module){
		parent::__construct($id, $module);
                $this->breadcrumbs = array('User module'=>array('private/index'));

	}
	public function actionIndex(){
		Yii::app()->clientScript->reset();
		$this->render('frontPage', array() );

	}
	public function actionIndex2(){
		
		$this->render('frontPage', array() );

	}
	public function actionLogin(){
			// renders the view file 'protected/views/site/index.php'
			// using the default layout 'protected/views/layouts/main.php'

			$model=new LoginForm;

			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			{
					echo CActiveForm::validate($model);
					Yii::app()->end();
			}

			// collect user input data
			if(isset($_POST['LoginForm']))
			{
					$model->attributes=$_POST['LoginForm'];
					// validate user input and redirect to the previous page if valid
					if($model->validate() && $model->login())
							$this->redirect($this->createUrl('site/index'));
			}
			$output = array();
			$output['model'] = $model;
			$this->layout='//layouts/column1';
			$this->render('login', $output );
	}
	public function actionUsers(){
		$output['model'] = Users::Model()->findAll();
		$this->render('users', $output );
	}
	public function actionRegister($id=0){
			
			if ($id && $output['model']= $model = Users::Model()->findByAttributes(array('id'=>$id))){}
			else $output['model']= $model = new Users();
			$output['model'] = $model->setScenario('Register');
			// renders the view file 'protected/views/site/index.php'
			// using the default layout 'protected/views/layouts/main.php'


			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			{
					echo CActiveForm::validate($model);
					Yii::app()->end();
			}

			// collect user input data
			if(isset($_POST['Users']))
			{
					$model->attributes=$_POST['Users'];
					// validate user input and redirect to the previous page if valid
					if($model->validate()){
							$model->save();
							$this->redirect($this->createUrl('private/users'));
					}
			}
			$output['model'] = $model;
			$this->layout='//layouts/column1';
			$this->render('regIndiv', $output );
	}
	public function actionForgotpassword(){
			// renders the view file 'protected/views/site/index.php'
			// using the default layout 'protected/views/layouts/main.php'
                        $this->layout='//layouts/column2';
			$model=new LoginForm;

			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			{
					echo CActiveForm::validate($model);
					Yii::app()->end();
			}

			// collect user input data
		if(isset($_POST['LoginForm']))
		{		
				$tmp2="";
				$validator = new CEmailValidator;
				$criteria = new CDbCriteria;
				$criteria->compare('uname',$_POST['LoginForm']['username']);
				$model = Users::Model()->find($criteria);
				
				if($validator->validateValue(($model?$model->email:"")))
							{		
									
									if (!$model){
											$tmp2['forgot'] = 'not valid';
											$tmp2['ErrorsSummary'] = 'errors';
											echo CSJON::Encode($tmp2);
											Yii::app()->end();
									}
									$email = Yii::app()->email;
									$newPass = Utilities::genRandomString(15);

											$mailer = Yii::createComponent('application.extensions.mailer.EMailer');
											$mailer->Host = $this->settings['smtpHost'];
											$mailer->SMTPAuth = true;
											$mailer->Username = $this->settings['smtpUsername'];
											$mailer->Password = $this->settings['smtpPassword'];
											$mailer->IsSMTP();
											$mailer->IsHTML(true);
											$mailer->From = 'no-reply@duvaq.com';
											//$mailer->AddReplyTo('wei@example.com');
											$mailer->AddAddress($model->email);
											$mailer->FromName = '[Duvaq.com] Admin PAssword generator';
											$mailer->CharSet = 'UTF-8';
											$mailer->Subject = '[Duvaq.com] Admin PAssword generator';//Yii::t('demo', 'Yii rulez!');
											$mailer->Body = $this->renderPartial('pass-mail', array('login' => $model->uname,'pass'=>$newPass,'url'=>'http://duvaq.wilsa.net/'), true);;
											if ($mailer->Send()){
												$model->pass = $newPass; 
												if ($model->validate()){
													$model->save();
													$tmp2['result']='success';
													$tmp2['result2']='save success';
													echo CJSON::Encode($tmp2);
												}
												else {
													$errors = $model->getErrors();
													echo CJSON::Encode($errors);											
												}

											} 
											else {
													$tmp2['forgot']='email not sent';
													$tmp2['ErrorsSummary']='email not sent';
													echo CJSON::Encode($tmp2);
											}
									Yii::app()->end();
									
							}
				else {

						$tmp2['forgot']='email not valid.';
						$tmp2['ErrorsSummary']='email not sent';
						echo CJSON::Encode($tmp2);
						Yii::app()->end();
				}
		}

			$output = array();
			$output['model'] = $model;
			$this->render('forgot', $output );
	}
	public function actionLogout(){
                Yii::app()->user->logout();
                $this->redirect(Yii::app()->homeUrl);
		}

	public function actionTest() {
			if ($model = ShopOrder::Model()->with()->find('order_id=\'20\'')){
					{
							$message .= '<table>';
							$message.='<tr>';
							$message.='<td>Book id</td>';
							$message.='<td>Book Title</td>';
							$message.='<td>Price </td>';
							$message.='<td>Quantity</td>';
							$message.='<td>Amount</td>';
							$message.='</tr>';
							
								foreach($model->products as $tmpBookOrder){
									$message.='<tr>';												
									$message.='<td>'.$tmpBookOrder->product_id.'</td>';
									$message.='<td>'.$tmpBookOrder->title_en.'</td>';
									$message.='<td>'.$tmpBookOrder->amount.'AZN </td>';
									$message.='<td>'.$tmpBookOrder->quantity.'</td>';
									$message.='<td>'.$tmpBookOrder->quantity*$tmpBookOrder->amount.'AZN </td>';

									$message.='</tr>';
								}
							$message.='</table>';	
							print $message;
							$email = Yii::app()->email;
							
							$email->subject = '[Ada Bookstore] Order no.'.$order->order_id;
							
									
							$email->message = $message.'</br> Ip address: '.$_SERVER['REMOTE_ADDR'];
							$email->to = Yii::app()->params['adminEmail']; //'le.bord@gmail.com,rasim.rakhmanov@gmail.com';
							$email->send();
								
								
					}
		  }		
	}
	public function actionSettings(){
		
		$output['user'] = Users::Model()->find("uname='".Yii::app()->user->name."'");


		$id = 0;
		
		if (Yii::app()->user->isGuest){
				$this->redirect(array("site/index"));
		}
		else {
				if (isset($_POST['password'],$_POST['password2'],$_POST['password3']) && 
					$output['user']->pass == $_POST['password'] && 
					$_POST['password2']==$_POST['password3'])
						{
							$output['user']->pass = $_POST['password3'] ;
							if ($output['user']->validate()){
									$output['user']->save();
									$this->redirect($this->createUrl('private/settings'));
							}
						}
				if (isset($_POST['Users'])){
					
					$output['user']->attributes = $_POST['Users'];
					if ($output['user']->validate()){
							$output['user']->save();
							$this->redirect($this->createUrl('private/settings'));
					}
				}
				
				
				$output['user'] = Users::Model()->find("uname='".Yii::app()->user->name."'");
				
		}
		
		$output['lang']=$this->Lang;
		$this->render('settings', $output );

	}		
	public function actionError(){
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	protected function performAjaxValidation($model){
	}
	protected function saveFormData($model){


	}
	
}