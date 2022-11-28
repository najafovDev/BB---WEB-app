<?php

class BannersController extends Controller
{
        public $basePath = '/../../uploads/banners/';
        public $baseUrl = '/uploads/banners/';

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Banners;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Banners']))
		{
			$model->attributes=$_POST['Banners'];
                        if (isset($_FILES['Banners'])){
                            $model->pic_name=CUploadedFile::getInstance($model,'pic_name');

                            if ($model->pic_name!=NULL){

                                $timeNow = time();
                                $path = Yii::app()->basePath . $this->basePath . $timeNow. $model->pic_name->name;

                                $model->pic_name->saveAs($path);
                                $model->pic_name = $timeNow.$model->pic_name->name;
                            }
                        }
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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

                if(isset($_POST['BannersTranslate']))
                {       
                        $articleTranslate = $model->getTranslation($_POST['BannersTranslate']['language']);
                        $articleTranslate->attributes=$_POST['BannersTranslate'];
                        if($articleTranslate->save()){
                            $model = $this->loadModel($id);
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
		if(isset($_POST['Banners']))
		{
                        $tmpPicname = $model->pic_name;
			$model->attributes=$_POST['Banners'];
                        if (isset($_FILES['Banners'])){
                            $model->pic_name=CUploadedFile::getInstance($model,'pic_name');

                            if ($model->pic_name!=NULL){

                                $timeNow = time();
                                $path = Yii::app()->basePath . $this->basePath . $timeNow. $model->pic_name->name;

                                $model->pic_name->saveAs($path);
                                $model->pic_name = $timeNow.$model->pic_name->name;
                            } else $model->pic_name = $tmpPicname;
                        } else $model->pic_name = $tmpPicname;
			if($model->save())
				$this->redirect(array('admin','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('Banners');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Banners('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Banners']))
			$model->attributes=$_GET['Banners'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Banners the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Banners::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Banners $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='banners-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
