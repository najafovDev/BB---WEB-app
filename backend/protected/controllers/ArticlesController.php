<?php

class ArticlesController extends Controller
{
        public $basePath = '../uploads/articles/';
        public $baseUrl = '/uploads/articles/';
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
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
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
		$model=new Articles('create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $parent_id = Yii::app()->getRequest()->getParam('parent_id',-1);
                $type = Yii::app()->getRequest()->getParam('type','Menus');
                $model->parent_id = $parent_id;
                $model->type = $type;
                $model->sort = 0;
                $model->menucontent = 0;
                $model->date = date('Y-m-d h:i:s');
		if(isset($_POST['Articles']))
		{
			$model->attributes=$_POST['Articles'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
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
        public function actionDuplicate($id){
		$model = $menu=$this->loadModel($id);
                $new = new Articles();
                $new->attributes = $model->attributes;
                $new->id = null;
                $new->save();
                
                foreach($model->translations as $translation){
                    $newTr = new ArticlesTranslate();
                    $newTr->attributes = $translation->attributes;
                    $newTr->id = null;
                    $newTr->articles_id = $new->id;
                    $newTr->save();
//                    print_r($newTr->errors);
                    
                }
                foreach($model->photos as $photo){
                    $newImg = new Gallery();
                    $newImg->attributes = $photo->attributes;
                    $newImg->id = null;
                    $newImg->parent_id = $new->id;
                    $newImg->save();
//                    print_r($newImg->errors);
                }
                foreach($model->cleanurls as $url){
                    $newUrl = new Cleanurls();
                    $newUrl->attributes = $url->attributes;
                    $newUrl->id = null;
                    $newUrl->parent_id= $new->id;
                    $newUrl->url .= time();
                    $newUrl->save();
//                    print_r($newUrl->errors);
                }
                echo 1;
        }
	public function actionUpdate($id)
	{
                
		$model = $menu=$this->loadModel($id);
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

                if(isset($_POST['Articles']))
                {
                        $model->attributes=$_POST['Articles'];
                        if($model->save()){}
                }
                if(isset($_POST['ArticlesTranslate']))
                {       
                        $articleTranslate = $menu->getContentTranslation($_POST['ArticlesTranslate']['language']);
                        $articleTranslate->attributes=$_POST['ArticlesTranslate'];
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
		$model = $menu=$this->loadModel($id);
		$this->render('update',array(
			'model'=>$model,
		));
                
	}

        public function actionTogglevisibility($id){
            if ($model=  Articles::model()->with()->findByPk($id)){
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
	public function actionShiftdelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
        
        public function actiongetLastPhotos($id){
            $model = Articles::model()->with()->findByPk($id);
            $this->renderPartial('//photo-container',array('model'=>$model));
        }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Articles');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Articles('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Articles']))
			$model->attributes=$_GET['Articles'];
		if(isset($_GET['type']))
			$model->type=$_GET['type'];
		if(isset($_GET['parent_id']))
			$model->parent_id=$_GET['parent_id'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Articles the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Articles::model()->findByPk($id);
                
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
                $model->scenario = 'update';
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Articles $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='articles-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionDeleteAll(){
            $ids = Yii::app()->getRequest()->getParam('ids');
            $condition = new CDbCriteria();
            $condition->addInCondition('id', $ids);
            Articles::model()->updateAll(array('deleted'=>1), $condition);
        }
        public function actionUnpublishAll(){
            $ids = Yii::app()->getRequest()->getParam('ids');
            $condition = new CDbCriteria();
            $condition->addInCondition('id', $ids);
            Articles::model()->updateAll(array('active'=>0), $condition);
        }
        public function actionPublishAll(){
            $ids = Yii::app()->getRequest()->getParam('ids');
            $condition = new CDbCriteria();
            $condition->addInCondition('id', $ids);
            Articles::model()->updateAll(array('active'=>1), $condition);
            print_r($condition);
            print_r(Articles::model()->findAll($condition));
        }
}
