<?php

class CityController extends Controller
{

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
//            $cities = City::model()->findAll();
//            foreach($cities as $city){
//                foreach($this->languages as $lang=>$name){
//                    $tmpTr = new CityTranslate();
//                    $tmpTr->language = $lang;
//                    $tmpTr->name = $city->name;
//                    $tmpTr->parent_id=$city->id;
//                    $tmpTr->save();
//                    print_r($tmpTr->errors);
//                }
//            }
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
		$model=new City;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['City']))
		{
			$model->attributes=$_POST['City'];
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

		if(isset($_POST['City']))
		{
			$model->attributes=$_POST['City'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
		}
                if(isset($_POST['CityTranslate']))
                {       
                        $articleTranslate = $model->getTranslation($_POST['CityTranslate']['language']);
                        $articleTranslate->attributes=$_POST['CityTranslate'];
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
        public function actionParse(){
            if (!defined('YII_DEBUG'))
                return;
            $str = 'Bakı, Sumqayıt, Xırdalan, Lənkəran, Qusar, Quba, Şamaxı, Qax, Oğuz, Xaçmaz, Xızı, Ağsu, Şəki, İsmayıllı, Goranboy, Daşkəsən, Göyçay, Siyəzən, Qəbələ, Naxçıvan, Salyan, Şabran, Sabirabad, Şirvan, Xanlar, Zərdab, Gəncə, Gədəbəy, Masallı, Mingəçevir, Naftalan, İmişli, Samux, Şamaxı, Astara, Tovuz, Dəvəçi, Füzuli, Qazax, Göygöl, Xudat, Bərdə, Cəlilabad, Kürdəmir, Neftçala, Zaqatala, Biləsuvar, Belarusiya, Ağdaş, Ağcabədi, Ağstafa, Balakən, Hacıqabul, Lerik, Saatlı, Şəmkir, Ucar, Yardımlı, Yevlax, Ukrayna/Kiev';
            $matches = explode(',',$str);
            foreach($matches as $m){
                $model = new City();
                $model->name = $m;
                $model->latitude = '40.3418415';
                $model->longitude = '49.8889152';
                if (!$model->save())
                    print_r($model->errors);
                
                $tr = new CityTranslate();
                $tr->parent_id = $model->id;
                $tr->name = $m;
                $tr->language = 'az';
                if (!$tr->save())
                    print_r($tr->errors);
            }
            $models = City::model()->findAll();
            print_r($models);
        }
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('City');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new City('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['City']))
			$model->attributes=$_GET['City'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return City the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=City::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param City $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='city-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
