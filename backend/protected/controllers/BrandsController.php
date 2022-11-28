<?php

class BrandsController extends Controller
{
        public $basePath = '../../../uploads/brands/';
        public $baseUrl = '/uploads/brands/';

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
        public function actiongetLastPhotos($id){
            $model = Brands::model()->with()->findByPk($id);
            $this->renderPartial('//photo-container',array('model'=>$model));
        }
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Brands;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Brands']))
		{
			$model->attributes=$_POST['Brands'];
                        if (isset($_FILES['Brands'])){
                            $model->logo=CUploadedFile::getInstance($model,'logo');

                            if ($model->logo!=NULL){

                                $timeNow = time();
                                $path = Yii::app()->basePath . $this->basePath . $timeNow. $model->logo->name;

                                $model->logo->saveAs($path);
                                $model->logo = $timeNow.$model->logo->name;
                            }
                            $model->logo_dark=CUploadedFile::getInstance($model,'logo_dark');

                            if ($model->logo_dark!=NULL){

                                $timeNow = time();
                                $path = Yii::app()->basePath . $this->basePath . $timeNow. $model->logo_dark->name;

                                $model->logo_dark->saveAs($path);
                                $model->logo_dark = $timeNow.$model->logo_dark->name;
                            }
                        }
			if($model->save())
				$this->redirect(array('admin','id'=>$model->id));
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

                if(isset($_POST['BrandsTranslate']))
                {
                        $articleTranslate = $model->getTranslation($_POST['BrandsTranslate']['language']);
                        $articleTranslate->attributes=$_POST['BrandsTranslate'];
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
                            $tmp['error'] = $articleTranslate->errors;
                        }
                        if (isset($_POST['ajax'])){
                            echo CJSON::encode($tmp);
                            Yii::app()->end();
                        }
                }

		if(isset($_POST['Brands']))
		{
                        $tmppic1 = $model->logo;
                        $tmppic2 = $model->logo_dark;
			$model->attributes=$_POST['Brands'];
                        if (isset($_POST['Cleanurls'])){
                            $cu = $model->getCleanurl($model->language);
                            $cu->attributes = $_POST['Cleanurls'];

                            $cu->save();
                        }

                        if (isset($_FILES['Brands'])){
                            $model->logo=CUploadedFile::getInstance($model,'logo');

                            if ($model->logo!=NULL){

                                $timeNow = time();
                                $path = Yii::app()->basePath . $this->basePath . $timeNow. $model->logo->name;

                                $model->logo->saveAs($path);
                                $model->logo = $timeNow.$model->logo->name;
                            } else $model->logo = $tmppic1;
                            $model->logo_dark=CUploadedFile::getInstance($model,'logo_dark');

                            if ($model->logo_dark!=NULL){

                                $timeNow = time();
                                $path = Yii::app()->basePath . $this->basePath . $timeNow. $model->logo_dark->name;

                                $model->logo_dark->saveAs($path);
                                $model->logo_dark = $timeNow.$model->logo_dark->name;
                            } else $model->logo_dark = $tmppic2;
                        } else {
                            $model->logo = $tmppic1;
                            $model->logo_dark = $tmppic2;
                        }
			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
		}

		$this->render('update',array(
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Brands');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Brands('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Brands']))
			$model->attributes=$_GET['Brands'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

        public function actionImport(){
            $model = new ImportForm();
            $time = time();
            $output['importResults'] ='';
            $model->module = 'Brands';
            $model->columns = (array('*name','logo','logo_dark'));
            if (isset($_POST['ImportForm'])){
                $model->attributes = $_POST['ImportForm'];
                if (isset($_FILES['ImportForm'])){
                    $model->file =  CUploadedFile::getInstance($model,'file');
                    if ($model->file){
                        $path = Yii::getPathOfAlias('application').'/../import/';
                        @mkdir($path, 0754);
                        @mkdir($path.strtolower($model->module), 0754);
                        $model->file->saveAs($path.  strtolower($model->module).'/'.$time.'_'.$model->file->name,false);

                    }
                }
                if ($model->validate()){
                    $model->file = $time.'_'.$model->file->name;
                    $output['importResults'] =$model->results = $model->import();
                    $model->save();
                }
            }
            $output['model'] = $model;
            $this->render('//imports/import',$output);

        }
        public function actionImportHistory($id){
            $output['model'] = $model = ImportForm::model()->findByPk($id);

            if (!$model) throw new CHttpException('404','Model not found');


        }
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Brands the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Brands::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Brands $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='brands-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
