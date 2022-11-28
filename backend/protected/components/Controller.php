<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	//public $layout='';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

        public $footer, $admin,$left,$right;
        public $header;
        public $Lang,$settings,$active;
        public $imgUpl = array();
        public $layout='//layouts/column1';
        public $languages;
	public function init(){
                parent::init();
		$this->languages = Yii::app()->params['languages'];
		$baseUrl = Yii::app()->baseUrl;
		$clientScript = Yii::app()->getClientScript();
                $clientScript->scriptMap=array(
                    "jquery.js"=>"/mfe/template/js/jquery-1.10.2.min.js",
                    "jquery-ui.min.js"=>"/mfe/template/js/jquery-ui-1.10.4.custom.js",
                    //"jquery.js"=>"/js/jquery-1.10.2.min.js",
                    'bootstrap.js'=>'/mfe/template/js/bootstrap.min.js'
                );
		$clientScript->registerCoreScript('jquery');
                //$clientScript->registerScriptFile('/mfe/js/jquery.browser.min.js');
                $clientScript->registerCoreScript('jquery.ui');
		$clientScript->registerScriptFile('/mfe/template/js/cropper.js', CClientScript::POS_HEAD);
                $clientScript->registerCoreScript('bootstrap.js');
                $clientScript->registerScriptFile('http://code.jquery.com/jquery-migrate-1.2.1.js',  CClientScript::POS_HEAD);
                $clientScript->registerScriptFile('/mfe/template/js/bootstrap.min.js',  CClientScript::POS_HEAD);
		$clientScript->registerScriptFile('/mfe/template/js/jquery-migrate-1.2.1.min.js', CClientScript::POS_END);
		$clientScript->registerScriptFile('/mfe/template/js/modernizr.min.js', CClientScript::POS_END);
		$clientScript->registerScriptFile('/mfe/template/js/jquery.sparkline.min.js', CClientScript::POS_END);
		$clientScript->registerScriptFile('/mfe/template/js/toggles.min.js', CClientScript::POS_END);
//		$clientScript->registerScriptFile('/mfe/template/js/retina.min.js', CClientScript::POS_END);
		$clientScript->registerScriptFile('/mfe/template/js/jquery.cookies.js', CClientScript::POS_END);

                $clientScript->registerScriptFile('/mfe/template/js/flot/flot.min.js', CClientScript::POS_END);
                $clientScript->registerScriptFile('/mfe/template/js/flot/flot.resize.min.js', CClientScript::POS_END);
                $clientScript->registerScriptFile('/mfe/template/js/morris.min.js', CClientScript::POS_END);
                $clientScript->registerScriptFile('/mfe/template/js/raphael-2.1.0.min.js', CClientScript::POS_END);

                $clientScript->registerScriptFile('/mfe/template/js/jquery.datatables.min.js', CClientScript::POS_END);
                $clientScript->registerScriptFile('/mfe/template/js/chosen.jquery.min.js', CClientScript::POS_END);
                $clientScript->registerScriptFile('/mfe/template/js/jquery.total-storage.min.js', CClientScript::POS_END);
                $clientScript->registerScriptFile('/mfe/template/js/jquery.elevatezoom.js', CClientScript::POS_HEAD);
                $clientScript->registerScriptFile('/mfe/template/js/bootstrap-fileupload.min.js', CClientScript::POS_HEAD);
                //print_r($clientScript);die();
                //$clientScript->registerScriptFile('/mfe/template/js/classie.js');
                //$clientScript->registerScriptFile('/mfe/template/js/sidebarEffects.js');
                //$clientScript->registerScriptFile('/mfe/template/js/modernizr.custom.js');

                $clientScript->registerScriptFile('/mfe/template/js/custom.js', CClientScript::POS_END);
                //$clientScript->registerScriptFile('/mfe/template/js/dashboard.js');
                $clientScript->registerScriptFile('/mfe/template/js/jstree.js', CClientScript::POS_END);
$str=<<<JAVASCRIPT
        var inputChangeStatus =0;
        $('.tab-pane input,.tab-pane select,.tab-pane textarea').on('change',function(e){
            inputChangeStatus =1;
        });
        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
            isTranslatable = 0;
            if  ($($(e.relatedTarget).attr('href')).find('form.translatable').length)
                if ($($(e.target).attr('href')).find('form.translatable').length)
                    isTranslatable = 1;
            var confirmVar = 1;
            if (!isTranslatable && inputChangeStatus && (confirmVar = confirm('Are you sure to discard changes made on this tab?')))
                {
            }
            else if (!confirmVar) e.preventDefault();
            inputChangeStatus = 0;
            //alert(isTranslatable);
          });
        $('.tab-content form.translatable').on('submit',function(e){
                e.preventDefault();
                $('.tab-content form.translatable').each(function(){
                        $('.el-rte').find('textarea').each(function(){
                            $('#'+$(this).attr('id')).val($('#'+$(this).attr('id')).elrte('val'));
                        });
                    $.ajax({
                        'url':$(this).attr('action'),
                        'data':$(this).serialize()+'&ajax=1',
                        'type':'post',
                        'dataType':'json',
                    }).done(function(data){
                        if (data.message){
                            inputChangeStatus = 0;
                            $.notify("Saved successfully "+data.language, "success");
                        }
                        else {
                            $.notify("Not saved "+data.language, "warn");
                        }
                    });
                });
                //$('.alert').alert();

        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            //alert('asd');
            tabinfo = {
                'activeTab':e.target.hash,
            };
                $.totalStorage(window.location.href,tabinfo);
        });
        if (activeTab = $.totalStorage(window.location.href))
                $('.nav-tabs li a[data-toggle="tab"][href="'+ activeTab['activeTab']+'"]').click();
JAVASCRIPT;


                Yii::app()->getClientScript()->registerScript('translatableSubmitEvent',$str,  CClientScript::POS_READY);

                $clientScript->registerCSSFile('/mfe/template/css/style.default.css');
                $clientScript->registerCSSFile('/mfe/template/css/magnum.css');
                $clientScript->registerCSSFile('/mfe/template/css/jquery.datatables.css');
                $clientScript->registerCSSFile('/mfe/template/css/tree-theme/default/style.css');
                $clientScript->registerCSSFile('/mfe/template/css/bootstrap-fileupload.min.css');
                $clientScript->registerCSSFile('/mfe/template/css/cropper.min.css');

                //$clientScript->registerCSSFile('/mfe/template/css/component.css');
                //$clientScript->registerCSSFile('/mfe/template/css/icons.css');
                //$clientScript->registerCSSFile('/mfe/template/css/normalize.css');

			$this->imgUpl['banners']= '/images/banners/';
			$this->imgUpl['articles']= '/images/articles/';
			$this->imgUpl['gallery']= '/images/gallery/';
			$this->imgUpl['menus']= '/images/menu/';
			$this->imgUpl['items']= '/images/items/';
			$this->imgUpl['offers']= '/images/offers/';
			$this->imgUpl['album']= '/images/album/';
			$this->imgUpl['publishers']= '/images/publishers/';
			$this->imgUpl['upl']= '/../../'.$this->imgUpl['gallery'];
			$this->imgUpl['webUpl'] = $this->imgUpl['gallery'];
			$app = Yii::app();

			$models = Settings::Model()->findAll();

			foreach($models as $model){
					$this->settings[$model->attribute] = $model->value;
			}
			unset($models);

			if ($app->getRequest()->getParam('language'))
				{
					$this->Lang = $app->getRequest()->getParam('language');
					$_SESSION['language'] = $this->Lang;
				}
			else if (isset($_SESSION['language']))
				 $this->Lang =$_SESSION['language'];
			else $this->Lang = 'az';



			$app->sourceLanguage = 'ge';
			$app->setLanguage($this->Lang);
			$this->footer = $this->footer();
			$this->header = $this->header();
			$this->right = $this->right();
			$this->left = $this->left();
			$this->admin = $this->admin();
			$this->pageTitle = "CMS" ;
                        $controllers = array('private'=>'User tools',
                                             'site'=>'Site',
                                            'settings'=>'Settings',
                                            'content'=>'Content Manager',
                                            'articles'=>'Article Manager',
                                            'category'=>'Category Manager',
                                            'menus'=>'Menu Manager');
                        if (isset($controllers[Yii::app()->controller->Id]))
                            $this->breadcrumbs[$controllers[Yii::app()->controller->Id]] = array(Yii::app()->controller->Id.'/index');

		}
	public function filters(){
                return array(
                        'accessControl' // perform access control for CRUD operations
                );
        }


	public function accessRules(){
                return array(
			array('allow', 'actions'=>array('login','allnews','logout')),
                        array('allow',  // allow all users to perform 'index' and 'view' actions
                                'users'=>array('@')
                        ),
                        array('allow',
                            'actions'=>array('str2url'),
                                'users'=>array('@')
                        ),
                        array('deny',  // deny all users
                                'users'=>array('*'),
                        )
                );
        }
	public function actionStr2url($str,$language,$id){
            $url = Utilities::str2url($str);
            $tmp = Cleanurls::model()->findByAttributes(array('type'=>ucfirst(Yii::app()->controller->id), 'language'=>$language,'url'=>$url));
            if ($tmp && ($tmp->id!=$id || $id==''))
               echo $url.'_'.time();
           else echo $url;
        }
	public function actionUrl2db($str,$language,$parent_id){
            $str = Utilities::str2url($str);

            $tmp = new Cleanurls();
            $tmp->parent_id = $parent_id;
            $tmp->url = $str;
            $tmp->language = $language;
            $tmp->type = ucfirst(Yii::app()->controller->id);

            $tmp->validate();
            echo CJSON::encode($tmp->errors);
        }
	public function mgnm_render($view,$data=null,$return=false){
		if(($layoutFileft2=$this->getLayoutFile($this->layout))!==false)
                    {
                            $output = $this->renderFile($layoutFileft2, $data,true);
                                    $this->afterRender($view,$output);

                                    return $output=$this->processOutput($output);
                    }
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
        public function getSetting($key,$default=''){
            if (isset($this->settings) && isset($this->settings[$key]))
                return $this->settings[$key];
            else return $default;
        }
        public function actionGetTreeScript(){
            //header("content-type: application/javascript");
            $this->renderPartial('//treeScript');
        }
        protected function renderJSON($data)
        {
            header('Content-type: application/json');
            echo CJSON::encode($data);

            foreach (Yii::app()->log->routes as $route) {
                if($route instanceof CWebLogRoute) {
                    $route->enabled = false; // disable any weblogroutes
                }
            }
            Yii::app()->end();
        }
	public function right(){
		$output = array();

		return $output;

	}

	public function footer(){
		$output = array();
		return $output;
	}

	public function header(){
		$output = array();


		return $output;
	}

	public function left(){
		$output = array();

		//print_r($output['response']);exit();
		return $output;
	}

	public function admin(){
		$output = array();
		$notLang = $this->Lang;
		$output['imgUpl'] = $this->imgUpl;
		$output['lang'] = $notLang;
		return $output;
	}

}
