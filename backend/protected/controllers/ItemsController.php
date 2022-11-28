<?php

class ItemsController extends Controller
{
        public $basePath = '../uploads/items/';
        public $baseUrl = '/uploads/items/';
        public function actions() {
            $tmp = parent::actions();
            $tmp2 = array(
                        'upload'=>array(
                            'class'=>'application.extensions.plupload2.actions.UploadAction',
                            'basePath'=>$this->basePath,
                            'baseUrl'=>$this->baseUrl,
                            'picModel'=>'ItemPhotos'
                        ),
                        'deleteImg'=>array(
                            'class'=>'application.extensions.plupload2.actions.DeleteImgAction',
                            'basePath'=>$this->basePath,
                            'picModel'=>'ItemPhotos',
                        ),
                        /*'destroy'=>array(
                            'class'=>'application.extensions.plupload2.DestroyAction',
                            'basePath'=>$this->basePath,
                        ),*/
		);

            $tmp = array_merge($tmp2,$tmp);
            return $tmp;
        }
        
        public function actionTogglevisibility($id){
            if ($model=Items::model()->with()->findByPk($id)){
                $model->active = (int)!$model->active;
                $model->save();
                $tmp['debug'] = print_r($model,true);
                $tmp['errors'] = print_r($model->errors,true);
                $tmp['active'] = print_r($model->active,true);
                $tmp['class'] = $model->active?'menus-visible':'menus-hidden';
                echo CJSON::encode($tmp);
            }
        }
        
        public function actionChangeImgColor($id){
            $color =(int) Yii::app()->getRequest()->getParam('color',0);
            $tmp = ItemPhotos::model()->findByPk($id);
            $tmp->color_id = $color;
            if ($tmp->save())
                echo 1;
            else echo 0;
        }
        public function actionChangeImgSort($id,$sort){
            $tmp = ItemPhotos::model()->findByPk($id);
            $tmp->sort = (int)$sort;
            if ($tmp->save())
                echo 1;
            else echo 0;
        }
        public function actiongetLastPhotos($id){
            $model = Items::model()->with()->findByPk($id);
            $this->renderPartial('photo-container',array('model'=>$model));
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
		$model=new Items;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Items']))
		{
			$model->attributes=$_POST['Items'];
                        $pic = CUploadedFile::getInstance($model, 'pic_name');
                        $pdf = CUploadedFile::getInstance($model, 'params');
                        $rnd = rand(0,9999);
			if($model->validate()){
                                if(!empty($pic)){
                                    $pic->saveAs(Yii::app()->basePath.'/../../uploads/items/'.$rnd.'-'.$pic);    
                                    $model->pic_name = $rnd.'-'.$pic;
                                }
                                if(!empty($pdf)){
                                    $pdf->saveAs(Yii::app()->basePath.'/../../uploads/books/'.$rnd.'-'.$pdf);    
                                    $model->params = $rnd.'-'.$pdf;
                                }
                                $model->save();
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

                if(isset($_POST['ItemsTranslate']))
                {       
                        $articleTranslate = $model->getTranslation($_POST['ItemsTranslate']['language']);
                        $articleTranslate->attributes=$_POST['ItemsTranslate'];
                        if (isset($_POST['Cleanurls'])){
                            $cu = $model->getCleanurl($articleTranslate->language);
                            $cu->attributes = $_POST['Cleanurls'];
                            
                            if ($cu->save()){
                                $tmp['message'] = 0;
                                $tmp['language'] = $articleTranslate->language;
                                
                            }
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
		if(isset($_POST['Items']))
		{
			$model->attributes=$_POST['Items'];
                        $pic = CUploadedFile::getInstance($model, 'pic_name');
                        $pdf = CUploadedFile::getInstance($model, 'params');
                        $rnd = rand(0,9999);
			if($model->validate()){
                                if(!empty($pic)){
                                    $pic->saveAs(Yii::app()->basePath.'/../../uploads/items/'.$rnd.'-'.$pic);    
                                    $model->pic_name = $rnd.'-'.$pic;
                                }
                                if(!empty($pdf)){
                                    $pdf->saveAs(Yii::app()->basePath.'/../../uploads/books/'.$rnd.'-'.$pdf);    
                                    $model->params = $rnd.'-'.$pdf;
                                }
                                $model->save();
				//$this->redirect(array('update','id'=>$model->id));
                        }
		}
                if (isset($_POST['ItemsParamset']) && isset($_POST['ItemsParamset']['az'])){
                    $ok = 1;
                    ItemsParamset::model()->deleteAllByAttributes(array(
                                    'items_id'=>$model->id,
                    ));
                    foreach($_POST['ItemsParamset'] as $lang=>$params){
                        //print_r($params);die();
                        foreach($params as $field_id=>$value){
                                if ($field = ItemsParamset::model()->findByAttributes(array(
                                    'items_id'=>$model->id,
                                    'fieldset_id'=>$field_id,
                                    'language'=>$lang
                                ))){}
                                else {
                                    $field = new ItemsParamset();
                                    $field->items_id = $model->id;
                                    $field->fieldset_id =(int) $field_id;
                                    $field->language = $lang;
                                }
                                $field->value = $value;
                                if (!$field->save()){
                                    $ok =0;
                                }
                        }
                    }
                  if ($ok)
                      $this->redirect(array('update','id'=>$model->id));

                }

		$this->render('update',array(
			'model'=>$model,
		));
	}
        public function actionImport(){
            $model = new ImportForm();
            $time = time();
            $output['importResults'] ='';
            $model->module = 'Items';
            $model->columns = (array('*name','*category_id','Brands::name::brands_id','active'));
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
            $this->render('import',$output);
            
        }
        public function actionImportHistory($id){
            $output['model'] = $model = ImportForm::model()->findByPk($id);
            
            if (!$model) throw new CHttpException('404','Model not found');
            
            
        }
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
                $model->deleted = !(int)$model->deleted;
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Items');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Items('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Items']))
			$model->attributes=$_GET['Items'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        public function actionAutoComplete() {
            if (isset($_GET['q'])) {
                $criteria = new CDbCriteria;
                $criteria->with['translations'] = array(
                    'alias'=>'translations',
                    'together'=>true
                );
                $criteria->addSearchCondition('t.name', $_GET['q'],true,'OR');
                $criteria->addSearchCondition('translations.name', $_GET['q'],true,'OR');

                if (isset($_GET['limit']) && is_numeric($_GET['limit'])) {
                    $criteria->limit = $_GET['limit'];
                }

                $items = Items::model()->findAll($criteria);

                $resStr = '';
                foreach ($items as $item) {
                    $resStr .= ($item->getTranslation($this->Lang)->name!=''?$item->getTranslation($this->Lang)->name:$item->name)."|".$item->id."\n";
                }
                $ld = CHtml::listData($items, 'id', 'name');
                //echo CJSON::encode($ld);
                echo $resStr;
            }
        }
        public function actionAddRecommended($id){
            $itemId = Yii::app()->getRequest()->getParam('itemId',0);
            $tmp = new ItemsRecommended();
            $tmp->parent_id = (int)$id;
            $tmp->child_id = (int)$itemId;
            $tmp->sort = 0;
            $tmp->save();
            //$this->redirect($this->createUrl('items/update',array('id'=>$id,'#'=>'reccomended')));
            $this->renderPartial('recommended-container',array('model'=>Items::model()->findByPk($id)));
        }
        public function actionDeleteRecommended($id,$itemId){
            ItemsRecommended::model()->deleteAllByAttributes(array('parent_id'=>$id,'child_id'=>$itemId));
            echo 1;
        }
        public function actionAutocomplete2()
        {
           if(Yii::app()->request->isAjaxRequest && isset($_GET['q']))
           {
                /* q is the default GET variable name that is used by
                / the autocomplete widget to pass in user input
                */
              $name = $_GET['q']; 
                      $catIds = (int ) Yii::app()->getRequest()->getParam('category',null);

                        // this was set with the "max" attribute of the CAutoComplete widget
              $limit = min($_GET['limit'], 50); 
                      $critBook = new CDbCriteria;

              $criteria = new CDbCriteria;

                     // $criteria->addCondition('completed=1', 'AND');
                     // $criteria->addCondition('newArrival!=1', 'AND');


              $criteria->limit = $limit;
              $userArray = Items::model()->findAll($criteria);
              $returnVal = '';
              foreach($userArray as $userAccount)
              {
                 $returnVal .= $userAccount->name.'|'
                                             .$userAccount->id."\n";
              }
              echo $returnVal;
           }
        }
        public function actionParamsetTamamla($term,$language,$id)
        {
                $crit = new CDbCriteria();
                $crit->addSearchCondition('value', $term);
                $crit->distinct='value';
                $crit->limit=12;
                $crit->group='value';
                $crit->addCondition('t.value!=""');
                $items = ItemsParamset::model()->findAllByAttributes(array('fieldset_id'=>$id,'language'=>$language),$crit);

                $ld = CHtml::listData($items, 'id', 'value');
                echo CJSON::encode($ld);
        }
        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Items the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Items::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Items $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='items-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
