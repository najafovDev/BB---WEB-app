<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItemsConfigurationController
 *
 * @author sahil1
 */
class ItemsConfigurationController extends Controller{
	public function actionCreate($id)
	{
		$model=new ItemsConfiguration;
                $model->parent_id = $id;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ItemsConfiguration']))
		{
			$model->attributes=$_POST['ItemsConfiguration'];
                        $pic = CUploadedFile::getInstance($model, 'pic_name');
                        $schema = CUploadedFile::getInstance($model, 'schema_pic');
                        $rnd = rand(0,9999);
			if($model->validate()){
                                if(!empty($pic)){
                                    $pic->saveAs(Yii::app()->basePath.'/../../uploads/itemsconf/'.$rnd.'-'.$pic);    
                                    $model->pic_name = $rnd.'-'.$pic;
                                }
                                if(!empty($schema)){
                                    $rnd = rand(0,9999);
                                    
                                    $schema->saveAs(Yii::app()->basePath.'/../../uploads/itemsconf/'.$rnd.'-'.$schema);    
                                    $model->schema_pic = $rnd.'-'.$schema;
                                }
                                $model->save();
				$this->redirect(array('update','id'=>$model->id));
                        }
		}

		$this->render('//items/configuration-form',array(
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

		if(isset($_POST['ItemsConfiguration']))
		{
			$model->attributes=$_POST['ItemsConfiguration'];
                        $pic = CUploadedFile::getInstance($model, 'pic_name');
                        $schema = CUploadedFile::getInstance($model, 'schema_pic');
                        $rnd = rand(0,9999);
			if($model->validate()){
                                if(!empty($pic)){
                                    $pic->saveAs(Yii::app()->basePath.'/../../uploads/itemsconf/'.$rnd.'-'.$pic);    
                                    $model->pic_name = $rnd.'-'.$pic;
                                }
                                if(!empty($schema)){
                                    $rnd = rand(0,9999);
                                    $schema->saveAs(Yii::app()->basePath.'/../../uploads/itemsconf/'.$rnd.'-'.$schema);    
                                    $model->schema_pic = $rnd.'-'.$schema;
                                }
                                $model->save();
				$this->redirect(array('update','id'=>$model->id));
                        }
		}

		$this->render('//items/configuration-form',array(
			'model'=>$model,
		));
	}
        public function actionDelete($id){
            $this->loadModel($id)->delete();
        }
        public function loadModel($id){
            $model = ItemsConfiguration::model()->findByPk($id);
            if (!$model)
                throw new CHttpException(404,'Object ItemsConfiguration not found');
            return $model;
        }
}
