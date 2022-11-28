<?php

class ItemsStockController extends Controller
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
		$model=new ItemsStock;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ItemsStock']))
		{
			$model->attributes=$_POST['ItemsStock'];
			if($model->save())
				$this->redirect(array('items/update','id'=>$model->item_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionAddStockTo($id)
	{
		$model=new ItemsStock;
                $model->item_id = $id;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ItemsStock']))
		{
			$model->attributes=$_POST['ItemsStock'];
			if($model->save())
				$this->redirect(array('items/update','id'=>$model->item_id));
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

		if(isset($_POST['ItemsStock']))
		{
			$model->attributes=$_POST['ItemsStock'];
			if($model->save())
				$this->redirect(array('items/update','id'=>$model->item_id));
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
		$dataProvider=new CActiveDataProvider('ItemsStock');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ItemsStock('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ItemsStock']))
			$model->attributes=$_GET['ItemsStock'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionAdmin2()
	{
		$model=new ItemsStock('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ItemsStock']))
			$model->attributes=$_GET['ItemsStock'];
		if(isset($_GET['id']))
			$model->item_id=$_GET['id'];

		$this->renderPartial('_admin',array(
			'model'=>$model,
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ItemsStock the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ItemsStock::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ItemsStock $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='items-stock-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
