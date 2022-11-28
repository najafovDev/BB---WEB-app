<?php

class MenusController extends Controller
{
        public $basePath = '../uploads/menus/';
        public $baseUrl = '/uploads/menus/';
        public function actions() {
            $tmp = parent::actions();
            $tmp2 = array(
                        'upload'=>array(
                            'class'=>'application.extensions.plupload2.actions.UploadAction',
                            'basePath'=>$this->basePath,
                            'baseUrl'=>$this->baseUrl,
                        ),
                        'deleteImg'=>array(
                            'class'=>'application.extensions.plupload2.actions.DeleteImgAction',
                            'basePath'=>$this->basePath,
                            'picModel'=>'Gallery',
                        ),
                        /*'destroy'=>array(
                            'class'=>'application.extensions.plupload2.DestroyAction',
                            'basePath'=>$this->basePath,
                        ),*/
		);

            $tmp = array_merge($tmp2,$tmp);
            return $tmp;
        }

        public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        public function actionChangeImgSort($id,$sort){
            $tmp = Gallery::model()->findByPk($id);
            $tmp->sort = (int)$sort;
            if ($tmp->save())
                echo 1;
            else echo 0;
        }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Menus;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Menus']))
		{
			$model->attributes=$_POST['Menus'];
                        $model->active = 0;
			if($model->save())
                            if(isset($_POST['ajax'])){
                                $content = $model->getContent();
                                $tmp = array('message'=>'success');
                                $this->renderJSON($tmp);
                                Yii::app()->end();
                            }
                            else $this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                $content = $model->getContent();
                if (isset($_POST['MenusTranslate']))
                    $modelTranslate = (isset($model->translations[$_POST['MenusTranslate']['language']])?$model->translations[$_POST['MenusTranslate']['language']]:new MenusTranslate);

		if(isset($_POST['Menus']))
		{
			$model->attributes=$_POST['Menus'];
			if($model->save())
				$this->redirect(array('edit','id'=>$model->id));
		}
		if(isset($_POST['MenusTranslate']))
		{       
                        $modelTranslate->attributes=$_POST['MenusTranslate'];
                        $modelTranslate->menus_id = $model->id;
                        if (isset($_POST['Cleanurls'])){
                            $cu = $model->getCleanurl($modelTranslate->language);
                            $cu->attributes = $_POST['Cleanurls'];
                            
                            $cu->save();
                        }
			if($modelTranslate->save()){
                            
                            $tmp['language'] = $modelTranslate->language;
                            $tmp['message'] = 1;
                        }
                        else {
                            $tmp['message'] = 0;
                            $tmp['language'] = $modelTranslate->language;
                            $tmp['error'] = $modelTranslate->errors;
                        }
                        if(isset($_POST['ArticlesTranslate']))
                        {       
                                $articleTranslate = $model->getContentTranslation($_POST['ArticlesTranslate']['language']);
                                $articleTranslate->attributes=$_POST['ArticlesTranslate'];
                                if($articleTranslate->save()){
                                    $tmp['language'] = $articleTranslate->language;
                                    $tmp['message'] = 1;
                                }
                                else {
                                    $tmp['message'] = 0;
                                    $tmp['language'] = $articleTranslate->language;
                                    $tmp['error'] = $articleTranslate->errors;
                                }
                                if (isset($_POST['ajax'])){
                                    $this->renderJSON($tmp);
                                    Yii::app()->end();
                                }
                        }
                        if (isset($_POST['ajax'])){
                            $this->renderJSON($tmp);
                            Yii::app()->end();
                        }
                        $this->redirect(array('edit','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionEdit($id)
	{
               $this->actionUpdate($id);
        }
	public function actionTranslate($id)
	{
		$menu=$this->loadModel($id);
                $model = $menu->getContent();
                
                $article = $model;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

                if(isset($_POST['Articles']))
                {
                        $article->attributes=$_POST['Articles'];
                        if($article->save()){}
                }
                if(isset($_POST['ArticlesTranslate']))
                {       
                        $articleTranslate = $menu->getContentTranslation($_POST['ArticlesTranslate']['language']);
                        $articleTranslate->attributes=$_POST['ArticlesTranslate'];
                        if($articleTranslate->save()){
                            $tmp['language'] = $articleTranslate->language;
                            $tmp['message'] = 1;
                        }
                        else {
                            $tmp['message'] = 0;
                            $tmp['language'] = $articleTranslate->language;
                            $tmp['error'] = $articleTranslate->errors;
                        }
                        if (isset($_POST['ajax'])){
                            $this->renderJSON($tmp);
                            Yii::app()->end();
                        }
                }
		$menu=$this->loadModel($id);
                $model = $menu->getContent();
		$this->render('translate',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
                $model->deleted = !$model->deleted;
                $model->save();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
	}
	public function actionShiftDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}


        public function actiongetLastPhotos($id){
            $model = Menus::model()->with()->findByPk($id);
            $this->renderPartial('//photo-container',array('model'=>$model));
        }
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Menus');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Menus('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Menus']))
			$model->attributes=$_GET['Menus'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

        public function actionGetTree(){
             $tmp[] = array('id'=>'root1','parent'=>'#','text'=>'Main Menu','children'=>true,'type'=>'root');
             $tmp[] = array('id'=>'root2','parent'=>'#','text'=>'Secondary Menu','children'=>true,'type'=>'root');
             $tmp[] = array('id'=>'root3','parent'=>'#','text'=>'3rd Root Menu','children'=>true,'type'=>'root');
             $tmp[] = array('id'=>'root4','parent'=>'#','text'=>'4rd Root Menu','children'=>true,'type'=>'root');
             $tmp[] = array('id'=>'deleted1','parent'=>'#','text'=>'Recycle bin','children'=>true,'type'=>'recycle','icon'=>'fa fa-trash-o');
             if (isset($_GET['id']) && ($id =$_GET['id']) && preg_match('/(?P<name>[a-zA-Z]+)(?P<digit>\d+)/', $id,$matches)){
                $tmp = array();
                if (isset($matches['name']) && $matches['name']=='root')
                       $id = -1 * $matches['digit'];
                else if ($matches['name']=='menu')
                    $id = $matches['digit'];
                 
                if ($matches['name']!='deleted' )
                    $models = Menus::model()->with()->findAll(array('condition'=>'t.deleted=0 and t.parent_id='.$id,'order'=>'sort asc'));
                else $models = Menus::model()->with()->findAll(array('condition'=>'t.deleted=1','order'=>'sort asc'));
                $i=1;
                foreach($models as $model){
                     $model->sort = $i;
                     $model->save();
                     $i++;
                     $tmp[] = array('id'=>'menu'.$model->id,
                                        'children'=>(is_array($model->childs) && count($model->childs)?true:(is_array($model->articles) && count($model->articles)?true:false)),
                                        //'parent'=>'menu'.$model->parent_id,
                                        'text'=>($model->getTranslation($this->Lang))?
                                                $model->getTranslation($this->Lang)->name:
                                                'NOT TRANSLATED',
                                        'li_attr'=>array(
                                            'class'=>$model->active?'menus-visible':'menus-hidden',
                                            'data-menus-id'=>$model->id,
                                        ),
                                        'type'=>($model->deleted?'deleted':'file')
                                );
                 }
                 $model = Menus::model()->with('articles')->findByPk($id) ;
                 if($model && 
                    isset($model->articles) && is_array($model->articles) && 
                    count($model->articles)){
                     $i=1;
                     foreach($model->articles as $article){
                         $article->sort = $i;
                         $article->save();
                         $i++;
                        $tmp[] = array('id'=>'article'.$article->id,
                                        'children'=>(false),
                                        'text'=>($article->getContentTranslation($this->Lang))?
                                                mb_substr($article->getContentTranslation($this->Lang)->name,0,2500,'UTF-8'):
                                                'NOT TRANSLATED',
                                        'li_attr'=>array(
                                            'class'=>$article->active?(!$article->deleted?'menus-visible':'menus-hidden'):'menus-hidden',
                                            'data-menus-id'=>$article->id,
                                        ),
                                        'type'=>($article->deleted?'article':'article')
                                );
                     }
                 }
             }
             
            $this->renderJSON($tmp);
        }
        public function actionGetActions(){
            if (isset($_GET['id']) && ($id = $_GET['id']) && 
                    preg_match('/(?P<name>[a-zA-Z]+)(?P<digit>\d+)/', $id,$matches) && 
                    $matches['name']=='menu' &&
                    $model = Menus::model()->findByPk($matches['digit'])
                ){
            } else if (isset($matches['name']) && $matches['name']=='article'){
                $model = Articles::model()->findByPk($matches['digit']);
            } else if ($matches['name']=='root'){
                $tmp = array('content'=>array(
                            'create'=>array('title'=>'Create Item',
                                            'params'=>array('aclass'=>'magnum-jstree-create magnum-ajax','class'=>'glyphicon glyphicon-plus', 'url'=> 'menus/create','data'=>array())),
                        ));
            }
            if (isset($model)&&$model)
                $tmp = $model->getActions();
            $tmpStr='';
            foreach($tmp['content'] as $action=>$val){
                 $tmpStr.='<div class="action"><a class="'.(isset($val['params']['aclass'])?$val['params']['aclass']:'').'" href="'.$this->createUrl($val['params']['url'],$val['params']['data']).'"><span class="'.$val['params']['class'].'"></span> '.$val['title'].'</a></div>';
             }
             echo $tmpStr;

        }
        public function actionTogglevisibility($id){
            if ($model=Menus::model()->with()->findByPk($id)){
                $model->active = !$model->active;
                $model->save();
                $tmp['class'] = $model->active?'menus-visible':'menus-hidden';
            $this->renderJSON($tmp);
            }
        }
        public function actionChangeParent($id,$new_parent,$sort){
            if (preg_match('/(?P<name>[a-zA-Z]+)(?P<digit>\d+)/', $id,$matches) && 
                preg_match('/(?P<name>[a-zA-Z]+)(?P<digit>\d+)/', $new_parent,$matches1)){
                
                $id = $matches['digit'];
                if ($matches1['name']=='root'){
                    $new_parent = -1*$matches1['digit'];
                }
                else {
                    $new_parent = $matches1['digit'];
                }
                if (($matches['name']=='menu' && $model = Menus::model()->with()->findByPk($id))
                  ||($matches['name']=='article' && $model = Articles::model()->with()->findByPk($id)) ){
                    $model->parent_id = $new_parent;
                    if ($model->save()){
                        $tmp = array('message'=>'success');
                    }
                }
            }
            $menuArr = Yii::app()->getRequest()->getParam('menuArr');
            $i=0;
            foreach($menuArr as $key=>$menu){
                
                if (preg_match('/(?P<name>[a-zA-Z]+)(?P<digit>\d+)/', $menu,$matches) && (
                    ($matches['name']=='menu' && $model = Menus::model()->with()->findByPk($matches['digit']))
                  ||($matches['name']=='article' && $model = Articles::model()->with()->findByPk($matches['digit'])) )){
                      $model->sort = $i;
                      $model->save();
                }
                $i++;
            }
            if (!isset($tmp))
                $tmp = array('message'=>'error');
            $this->renderJSON($tmp);
        }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Menus the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Menus::model()->with()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Menus $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='menus-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
