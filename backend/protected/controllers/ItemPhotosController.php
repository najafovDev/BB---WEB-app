<?php

class ItemPhotosController extends Controller
{

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
		$model=new ItemPhotos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ItemPhotos']))
		{
			$model->attributes=$_POST['ItemPhotos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        public function actionRotate($id){
            $model = $this->loadModel($id);
            $model->rotate();
            $this->redirect(array('update','id'=>$id));
            $this->actionUpdate($id);
        }
        public function actionResize($id,$dataX,$dataY,$dataHeight,$dataWidth){
            $model = $this->loadModel($id);
            echo $model->crop($dataX,$dataY,$dataHeight,$dataWidth);
//            $this->redirect(array('update','id'=>$id));
//            $this->actionUpdate($id);
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

		if(isset($_POST['ItemPhotos']))
		{
			$model->attributes=$_POST['ItemPhotos'];
                        if (isset($_POST['ajax'])){
                            $model->save();
                            echo '1';
                            Yii::app()->end();
                        }
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
                if(isset($_POST['ItemPhotosTranslate']))
                {       
                        $articleTranslate = $model->getTranslation($_POST['ItemPhotosTranslate']['language']);
                        $articleTranslate->attributes=$_POST['ItemPhotosTranslate'];
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
		$dataProvider=new CActiveDataProvider('ItemPhotos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ItemPhotos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ItemPhotos']))
			$model->attributes=$_GET['ItemPhotos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ItemPhotos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ItemPhotos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ItemPhotos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='item-photos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
