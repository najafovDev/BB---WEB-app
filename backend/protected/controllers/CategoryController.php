<?php
class CategoryController extends Controller
{
        public $basePath = '../uploads/category/';
        public $baseUrl = '/uploads/category/';

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
        public function actionChangeImgSort($id,$sort){
            $tmp = Gallery::model()->findByPk($id);
            $tmp->sort = (int)$sort;
            if ($tmp->save())
                echo 1;
            else echo 0;
        }

        public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Category;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{ 
			$model->attributes=$_POST['Category'];
			if($model->save()){
                            $model = Category::model()->with()->findByAttributes(array('id'=>$model->id));
                            if ($model->parent_id!=-1){
                                $model->setFieldsetIds($model->parent->fieldsetIds);
                                //Yii::log(print_r($parent->fieldsetIds, true), CLogger::LEVEL_TRACE);
                            }
                            if(isset($_POST['ajax'])){
                                $tmp = array('message'=>'success');
                                echo CJSON::encode($tmp);
                                Yii::app()->end();
                            }
                            $this->redirect(array('update','id'=>$model->id));
                        }
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
                $model->scenario='Update';
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
                        
                        if($model->save()){
                            $model->setFieldsetIds($_POST['Category']['fieldsetIds']);
                        }
		}
                if(isset($_POST['CategoryTranslate']))
                {       
                        $articleTranslate = $model->getTranslation($_POST['CategoryTranslate']['language']);
                        $articleTranslate->attributes=$_POST['CategoryTranslate'];
                        if (isset($_POST['Cleanurls'])){
                            $cu = $model->getCleanurl($articleTranslate->language);
                            $cu->attributes = $_POST['Cleanurls'];
                            
                            $cu->save();
                        }

                        if($articleTranslate->save()){
                            $tmp['language'] = $articleTranslate->language;
                            $tmp['message'] = 1;
                        }
                        else {
                            $tmp['message'] = 0;
                            $tmp['language'] = $articleTranslate->language;
                            //$tmp['error'] = $modelTranslate->errors;
                        }
                        if (isset($_POST['ajax'])){
                            echo CJSON::encode($tmp);
                            Yii::app()->end();
                        }
                }
		$model=$this->loadModel($id);

		$this->render('update',array(
			'model'=>$model,
		));
	}

        public function actionTogglevisibility($id){
            if ($model=Category::model()->with()->findByPk($id)){
                $model->active = !$model->active;
                $model->save();
                $tmp['class'] = $model->active?'menus-visible':'menus-hidden';
                echo CJSON::encode($tmp);
            }
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
            $model = Category::model()->with()->findByPk($id);
            $this->renderPartial('//photo-container',array('model'=>$model));
        }
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Category');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Category('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Category']))
			$model->attributes=$_GET['Category'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Category the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Category::model()->with()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Category $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionGetTree(){
             $tmp[] = array('id'=>'root1','parent'=>'#','text'=>'Primary root','children'=>true,'type'=>'root');
             $tmp[] = array('id'=>'menu37','parent'=>'#','text'=>'Uncategorised','children'=>true,'type'=>'root');
             $tmp[] = array('id'=>'deleted1','parent'=>'#','text'=>'Recycle bin','children'=>true,'type'=>'recycle','icon'=>'fa fa-trash-o');
             if (isset($_GET['id']) && ($id =$_GET['id']) && preg_match('/(?P<name>[a-zA-Z]+)(?P<digit>\d+)/', $id,$matches)){
                $tmp = array();
                if (isset($matches['name']) && $matches['name']=='root')
                       $id = -1 * $matches['digit'];
                else if ($matches['name']=='category')
                    $id = $matches['digit'];
                 
                if ($matches['name']!='deleted' )
                    $tmp = Category::getChildrenTree ($id);
                else $tmp = Category::getChildrenTree (-1, 1);
                
                $tmp  =$tmp + Items::getItems4Tree($id,0);


             }
             
            echo CJSON::encode($tmp);
        }
        public function actionGetactions(){
            $tmp = array('content'=>array());
            if (isset($_GET['id']) && ($id = $_GET['id']) && 
                    preg_match('/(?P<name>[a-zA-Z]+)(?P<digit>\d+)/', $id,$matches) && 
                    $matches['name']=='category' &&
                    $model = Category::model()->find('id='.(int) $matches['digit'])
                ){
                
                $tmp = $model->getActions();
            }
            if (isset($matches['name']) && $matches['name'] =='root'){
                $tmp = array('content'=>array(
                            'create'=>array('title'=>'Create Item',
                                            'params'=>array('aclass'=>'magnum-jstree-create magnum-ajax','class'=>'glyphicon glyphicon-plus', 'url'=> 'category/create','data'=>array())),
                        ));
                
            }
            if (isset($matches['name']) && $matches['name'] =='item'){
                $model = Items::model()->with()->findByPk($matches['digit']);
                $tmp = $model->getActions();
                
            }
            $tmpStr='';
            foreach($tmp['content'] as $action=>$val){
                 $tmpStr.='<div class="action"><a class="'.(isset($val['params']['aclass'])?$val['params']['aclass']:'').'" href="'.$this->createUrl($val['params']['url'],$val['params']['data']).'"><span class="'.$val['params']['class'].'"></span> '.$val['title'].'</a></div>';
             }
             echo $tmpStr;            
            
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
                if ($matches['name']=='category' && $model = Category::model()->with()->findByPk($id)){
                    $model->parent_id = $new_parent;
                    if ($model->save()){
                        $tmp = array('message'=>'success');
                    }
                }
                else if ($matches['name']=='item' && $model = Items::model()->with()->findByPk($id)){
                    $model->category_id = $new_parent;
                    if ($model->save()){
                        $tmp = array('message'=>'success');
                    }
                } 
            }
            $menuArr = Yii::app()->getRequest()->getParam('menuArr');
            $i=0;
            foreach($menuArr as $key=>$menu){
                
                if (preg_match('/(?P<name>[a-zA-Z]+)(?P<digit>\d+)/', $menu,$matches)){
                      if ($matches['name']=='category')
                          $model = Category::model()->findByPk($matches['digit']);
                      else if ($matches['name']=='item')
                          $model = Items::model()->findByPk($matches['digit']);
                      else continue;
                      $model->sort = $i;
                      $model->save();
                }
                $i++;
            }
            if (!isset($tmp))
                $tmp = array('message'=>'error');
            echo CJSON::encode($tmp);
        }
}
