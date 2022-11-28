<?php

class CustomersController extends Controller
{
        public $basePath = '/../../uploads/customers/';
        public $baseUrl = '/uploads/customers/';
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
		$model=new Customers;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Customers']))
		{
			$model->attributes=$_POST['Customers'];
                        $model->login = $model->prefix.$model->phone;
                        if (isset($_FILES['Customers'])){
                            $model->pic_name=CUploadedFile::getInstance($model,'pic_name');

                            if ($model->pic_name!=NULL){

                                $timeNow = time();
                                $path = Yii::app()->basePath . $this->basePath . $timeNow. $model->pic_name->name;

                                $model->pic_name->saveAs($path);
                                $model->pic_name = $timeNow.$model->pic_name->name;
                            }
                        }
			if($model->save()){
                            if (isset($_POST['Phones'])){
                                $model->setPhones($_POST['Phones']);
                            }
                            
                            $this->redirect(array('view','id'=>$model->id));
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
//            print_r($_POST);
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Customers']))
		{
                        $tmpPicname = $model->pic_name;
			$model->attributes=$_POST['Customers'];
                        if (isset($_FILES['Customers'])){
                            $model->pic_name=CUploadedFile::getInstance($model,'pic_name');

                            if ($model->pic_name!=NULL){

                                $timeNow = time();
                                $path = Yii::app()->basePath . $this->basePath . $timeNow. $model->pic_name->name;

                                $model->pic_name->saveAs($path);
                                $model->pic_name = $timeNow.$model->pic_name->name;
                            } else $model->pic_name = $tmpPicname;
                        } else $model->pic_name = $tmpPicname;
			if($model->save()){
                            if (isset($_POST['Phones'])){
                                $model->setPhones($_POST['Phones']);
                            }
                            
                            $this->redirect(array('update','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('Customers');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Customers('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Customers']))
			$model->attributes=$_GET['Customers'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Customers the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Customers::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Customers $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='customers-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
