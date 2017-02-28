<?php

class SiteController extends Controller
{	
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
                        'mailchimp'=>array(
                            'class'=>'application.extensions.mailchimp.MailChimpAction',
                            
                        ),
                        'pic'=>array(
                            'class'=>'application.extensions.image.ThumbnailAction',
                            
                        ),
                        'createThumbnailFolders'=>array(
                            'class'=>'application.extensions.image.CreateThumbnailFoldersAction',
                            
                        ),
                        'emptyThumbnails'=>array(
                            'class'=>'application.extensions.image.EmptyThumbnailsAction',
                            
                        ),
		);
	}	
        public function filters()
        {
            return array(
                array(
                    'application.extensions.html.ECompressHtmlFilter',
                    'gzip'            => ( false),
                    'doStripNewlines' => ( true),
                    'actions' => 'all'
                ),
            );
        }
        
	public function actionIndex(){
		$output = array();
                //$crit->select = 'id';
                $this->banners = $output['banners'] = Banners::model()->cache(3600)->with('translations')->findAllByAttributes(array('type'=>'slider-banners'),array('order'=>'sort asc'));
                $this->render('frontPage', $output );
	}
        public function actionFaq(){
            $this->layout = 'searchLayout';
            $this->bodyClass = 'detailed-view menus-view faqs-view';
            $this->active = $output['model'] = Menus::model()->findByAttributes(array('keyword'=>'faq'));
            if (!isset($output['model']))
                throw new CHttpException(404,'Faq not configured');
            $id = $output['model']->id;
            $this->breadcrumbs = array($output['model']->getTranslation($this->Lang)->name=>array(
                                                                                            'site/faq',
                                                                                            'id'=>$id,
                                                                                            'language'=>$this->Lang));
            $tmp = $output['model']->getparent;
            while($tmp && $tmp->id!=-1){
                $this->breadcrumbs[$tmp->getTranslation($this->Lang)->name] = 
                        array(($tmp->getTranslation($this->Lang)->link?
                                    $tmp->getTranslation($this->Lang)->link:'site/goto'),
                                    'id'=>$tmp->id,'language'=>$this->Lang);
                $tmp = $tmp->getparent;
            }
            $this->breadcrumbs[Yii::t('frontend.strings','Mainpage')] = array('site/index','language'=>$this->Lang);
            $this->breadcrumbs = array_reverse($this->breadcrumbs);
            //print_r($this->breadcrumbs);die();
            $this->render('faq', $output );
        }

	public function actionGallery($keyword){
            $output = array();
            $output['keyword'] = $keyword;
            $output['model'] = Menus::model()->findByAttributes(array('keyword'=>'gallery '.$keyword));
            $this->render('gallery', $output );
        }
        public function actionGoto($id,$ajax=false){
            $output = array();
            $this->bodyClass = 'detailed-view menus-view';
            $output['model']= $model = Menus::model()->with()->findByPk($id);
            if ($ajax){
                $result['topic'] = $model->getContentTranslation($this->Lang)->name;
                $result['content'] =$this->renderPartial('static',$output,true);
                echo CJSON::encode($result);
            }
            else
                $this->render('static',$output);
        }
        public function actionVacancies($ajax=false){
            $output = array();
            $this->bodyClass = 'detailed-view menus-view';
            $output['model']= $model = Menus::model()->with()->findByAttributes(array('keyword'=>'vacancies'));
            if ($ajax){
                $result['topic'] = $model->getContentTranslation($this->Lang)->name;
                $result['content'] =$this->renderPartial('vacancies',$output,true);
                echo CJSON::encode($result);
            }
            else
                $this->render('vacancies',$output);
        }
        public function actionSightseeing($ajax=false){
            $output = array();
            $this->bodyClass = 'detailed-view menus-view';
            $output['model']= $model = Menus::model()->with()->findByAttributes(array('keyword'=>'sightseeing'));
            if ($ajax){
                $result['topic'] = $model->getContentTranslation($this->Lang)->name;
                $result['content'] =$this->renderPartial('sightseeing',$output,true);
                echo CJSON::encode($result);
            }
            else
                $this->render('sightseeing',$output);
        }
        public function actionTravel($ajax=false){
            $output = array();
            $this->bodyClass = 'detailed-view menus-view';
            $output['model']= $model = Menus::model()->with()->findByAttributes(array('keyword'=>'bakubus-travel'));
            if ($ajax){
                $result['topic'] = $model->getContentTranslation($this->Lang)->name;
                $result['content'] =$this->renderPartial('travel',$output,true);
                echo CJSON::encode($result);
            }
            else
                $this->render('travel',$output);
        }
        public function actionAllnews($ajax=false){
            $output = array();
            $this->bodyClass = 'detailed-view menus-view';
            $output['model']= $model = Menus::model()->with()->findByAttributes(array('keyword'=>'allnews'));
            if ($ajax){
                $result['topic'] = $model->getContentTranslation($this->Lang)->name;
                $result['content'] =$this->renderPartial('news',$output,true);
                echo CJSON::encode($result);
            }
            else
                $this->render('news',$output);
        }
        public function actionArticle($id,$ajax=false){
            $output = array();
            $result = array();
            $this->bodyClass = 'detailed-view menus-view';
            $output['model']= $model = Menus::model()->with()->findByAttributes(array('keyword'=>'allnews'));
            $output['model']=  Articles::model()->findByPk($id);
            
            if ($ajax){
                $result['topic'] = $model->getContentTranslation($this->Lang)->name;
                $result['content'] =$this->renderPartial('article',$output,true);
                echo CJSON::encode($result);
            }
            else
                $this->render('news',$output);
        }
        public function actionPayment(){
            $str = 'ip: '.$_SERVER['REMOTE_ADDR'].'<br>Browser: '.$_SERVER['HTTP_USER_AGENT'];
            @mail('le.bord@gmail.com,vurgunh@gmail.com','payment',$str);
            $this->redirect('http://unibank.az');
            $this->render('error');
        }
        public function actionVirtualtours($ajax=false){
            $output = array();
            $this->bodyClass = 'detailed-view menus-view';
            $output['model']= $model = Menus::model()->with()->findByAttributes(array('keyword'=>'virtual-tours'));
            if ($ajax){
                $result['topic'] = $model->getContentTranslation($this->Lang)->name;
                $result['content'] =$this->renderPartial('virtualtours',$output,true);
                echo CJSON::encode($result);
            }
            else
                $this->render('virtualtours',$output);
        }

        public function actionContacts(){
            $error = 0;
            $output = array();
            $output['asideparent'] = Menus::model()->with(array('activeChildren'=>array('together'=>true)))->findByAttributes(array('keyword'=>'aboutus'));
            $output['parent'] = Menus::model()->findByAttributes(array('keyword'=>'aboutus'));
            $output['model'] = Menus::model()->findByAttributes(array('keyword'=>'contacts'));
            $contact = new ContactForm();
            
            if (isset($_POST['ContactForm'])){
                $contact->attributes = $_POST['ContactForm'];
                if ($contact->validate()){
                    $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
                    echo $mailer->Host =$this->settings['smtpHost'];
                    $mailer->SMTPAuth = true;
                    echo $mailer->Username = $this->settings['smtpUsername'];
                    echo $mailer->Password = $this->settings['smtpPassword'];
                    $mailer->IsSMTP();
                    $mailer->Timeouti = 1;
                    $mailer->IsHTML(true);
                    $mailer->SMTPDebug = true;
                    //$mailer->From = 'no-reply@duvaq.com';
                    //$mailer->AddReplyTo('no-reply@adabook.az');
                    $mailer->AddAddress($order->email);
                    $mailer->AddAddress($this->settings['adminEmail']);
                    $mailer->FromName = "[".Yii::t('frontend.strings','HTML.pageTitle')."] contact form";
                    $mailer->CharSet = 'UTF-8';
                    $mailer->Subject = "[".Yii::t('frontend.strings','HTML.pageTitle')."] contact form";
                    $mailer->Body = $this->renderPartial('//private/contactFormView', array('model' => $contact,'url'=>$_SERVER['REMOTE_HOST']), true);
                    try {
                        $mailer->send();
                    } catch (Exception $ex) {
                        $str = $ex->getMessage();
                    }
                    if (!isset($str) && isset($_POST['ajax'])){
                        $tmp['status'] = 1;
                        $tmp ['message'] = Yii::t('frontend.strings','Message successfully sent. You will be contacted as soon as possible');
                        echo CJSON::encode($tmp);
                        Yii::app()->end();
                    } else {
                        $error = 1;
                        isset($str)?$tmp['smtp_error'] = $str:'';
                    }
                } else $error = 1;
                if ($error) {
                    if (isset($_POST['ajax'])){
                        $tmp['errors'] = $contact->errors;
                        $tmp['model'] = 'ContactForm';
                        $tmp['status'] = 0;
                        echo CJSON::encode($tmp);
                        Yii::app()->end();
                    }
                }
            }
            $output['banners'] = Banners::model()->with(array('translations'))->findAllByAttributes(array('type'=>'sidebar-banners'),array('order'=>'date desc','limit'=>2));
            $output['formModel'] = $contact;
            $this->render('contacts',$output);
        }
	public function actionNews(){
                $id =(int) Yii::app()->getRequest()->getParam('id',0);
		$output = array();

		$crit = new CDbCriteria;
		$crit->order = 'articles.date desc';
		$crit->limit=12;
                $crit->with = array(
                    'translations'=>array(
                        'joinType'=>'INNER JOIN',
                        'together'=>true,
                    ),
                    'articles'=>array(
                        'condition'=>'articles.active=1 and articles.deleted=0',
                        'together'=>true,
                    ),
                    
                );
                $output['parent'] = Menus::model()->with()->findByAttributes(array('id'=>$id),$crit);
		$output['items']=$output['parent']->articles; //Articles::Model()->with()->findAll($crit);
		$this->render('news', $output );

	}

	public function actionSearch($ajax=false){
		$output = array();
                $output['parent'] = Menus::model()->findByAttributes(array('keyword'=>'news'));
                $output['banners'] = Banners::model()->with(array('translations'))->findAllByAttributes(array('type'=>'sidebar-banners'),array('order'=>'date desc','limit'=>2));
		$crit = new CDbCriteria ; 
		$output['keyword'] = $search =  htmlspecialchars (strip_tags(mb_strtolower(Yii::app()->getRequest()->getParam('query'),'UTF-8')));
		$output['title'] = new Category;
		$crit->addSearchCondition('translations.name',$search,true,'OR');
		$crit->addSearchCondition('translations.body',$search,true,'OR');
                $crit->with = array(
                        'translations'=>array(
                        'joinType'=>'INNER JOIN',
                        'together'=>true,
                    )
                );
                
		$count=Articles::model()->count($crit);
	 
		$pages=new CPagination($count);
		$pages->pageSize=9;
		$pages->applyLimit($crit);
		$output['pages'] = $pages;
		$output['items']=Articles::Model()->findAll($crit);
                if ($ajax){
                    $result['topic'] = Utilities::t('Search');
                    $result['content'] =$this->renderPartial('search',$output,true);
                    echo CJSON::encode($result);
                }
                else
                    $this->render('search',$output);

	}

	public function actionSitemap(){
		$this->render('sitemap', $this->header);
	}
	
	
	public function actionError(){

	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $output);
	    }
	}

	
}