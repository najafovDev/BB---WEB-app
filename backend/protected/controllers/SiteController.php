<?php
class SiteController extends Controller
{
	public function actions()
	{
		return array(
                        'connector' => array(
                            'class' => 'application.extensions.elfinder.ElFinderConnectorAction',
                            'settings' => array(
                                'root' => Yii::getPathOfAlias('webroot') . '/../files/',
                                'URL' => '/files/',
                                'rootAlias' => 'Home',
                                'mimeDetect' => 'none'
                            )
                        ),
		);
	}
	/**
		 * Declares class-based actions.
		 */
	public function actionLogin(){
			// renders the view file 'protected/views/site/index.php'
			// using the default layout 'protected/views/layouts/main.php'

			$model=new LoginForm;

			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			{
					echo CActiveForm::validate($model);
					Yii::app()->end();
			}

			// collect user input data
			if(isset($_POST['LoginForm']))
			{
					$model->attributes=$_POST['LoginForm'];
					// validate user input and redirect to the previous page if valid
					if($model->validate() && $model->login())
							$this->redirect(Yii::app()->user->returnUrl);
			}
			$output = array();
			$output['model'] = $model;
                        $this->layout='//layouts/column2';

			$this->render('login', $output );
	}

	public function actionLogout(){
                Yii::app()->user->logout();
                $this->redirect(Yii::app()->homeUrl);
		}
 
	public function actionAddColor(){
	

	$id = (int) Yii::app()->getRequest()->getParam('id',-1);
	$output = array();

		
		

		$criteria = new CDbCriteria ; 
		$criteria->condition= 'id=\''.$id.'\'';
	
	if (($model1 = Colors::Model()->find($criteria))&&$id!=-1) {

	}
	else {
			$model1=new Colors;
			
	}

    if(isset($_POST['Colors']))
    {
        $model1->attributes=$_POST['Colors'];


        if($model1->validate())
        {
				$model1->save();
				$this->redirect(array('site/allcolors'));
        }
    }

	$output['model1'] = $model1;
	$output['imgUpl'] = $this->imgUpl;

    $this->render('colorForm',$output);	

	}

	public function actionAllColors()	{
		$id = Yii::app()->getRequest()->getParam('id');
		
		$output = array();
		$output['model'] = Colors::Model()->with()->findAll();
		$this->render('allcolors', $output );

	}

	public function actionDelColor(){
	$id = (int) Yii::app()->getRequest()->getParam('id',-1);

	$criteria = new CDbCriteria ; 
	$criteria->condition= 'id=\''.$id.'\'';			
	if ($model = Colors::Model()->find($criteria)) {$model->delete();}
	$this->redirect(array('site/allcolors'));
	}

	public function actionIndex(){
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'


		

			$output = array();

		$crit = new CDbCriteria;
		$crit->order = 't.id asc';
		$cat = Category::Model()->findByAttributes(array('name'=>'Gəlinliklər'));
		if ($cat){
			$crit->addCondition('category.parent_id='.$cat->id);
			$crit->addCondition('category.id='.$cat->id,'OR');
		}
		$crit->limit=6;
		$output['items']=Items::Model()->with(array('category'=>array('alias'=>'category')))->findAll($crit);
		
		$crit = new CDbCriteria;
		$crit->order = 't.id asc';
		$cat = Category::Model()->findByAttributes(array('name'=>'Ziyafət Geyimləri'));
		if ($cat){
			$crit->addCondition('category.parent_id='.$cat->id);
			$crit->addCondition('category.id='.$cat->id,'OR');
		}
		$crit->limit=6;
		$output['items2']=Items::Model()->with(array('category'=>array('alias'=>'category')))->findAll($crit);

		$this->render('frontPage', $output );
	}
        public function actionExcel(){
            $sheet_array = Yii::app()->yexcel->readActiveSheet(Yii::app()->basePath.'/../../uploaded/exported.xlsx');

            echo "<table>";
            ItemsStock::model()->updateAll(array('stock'=>0));

            foreach( $sheet_array as $row ) {
                
                if ($color = Colors::model()->find('name=:name',array(':name'=>$row['F']))){}
                else {
                    $color = new Colors();
                    $color->name = $row['F'];
                    $color->save();
                }
                
                if  ($item = Items::model()->findByAttributes(array('name'=>$row['A']))){}
                else {
                    $item = new Items('Import');
                    $item->category_id = 37;
                    $item->body = 'Imported';
                    $item->name = $row['A'];
                    $item->save();
                }
                
                if ($tmp2=  ItemsStock::model()->find('item_id=:id and barcode=:barcode',array(
                            ':id'=>$item->id,
                            ':barcode'=>$row['C']
                    ))){}
                else {
                    $tmp2 = new ItemsStock();
                    $tmp2->item_id = $item->id;
                    $tmp2->discount= 0;
                    $tmp2->barcode = $row['C'];
                }
                
                $tmp2->size = $row['E'];
                $tmp2->color_id = $color->id;
                $tmp2->artikul = $row['B'];
                $tmp2->artikul2 = $row['D'];
                $tmp2->stock=(int) $row['G'];
                $tmp2->price= $row['H'];
                if (!$tmp2->save()){
                    echo "<tr><td>".print_r($tmp2,true)."</td><td>".print_r($item,true)."</td><td>".print_r($color,true)."</td></tr>";
                }
                else echo "<tr><td>OK".$tmp2->stock."</td></tr>";

            }

            echo "</table>";
        }

	public function actionError(){
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	public function actionSitemap(){
		 function getSitemap($lang, $secId,$tp=''){
			$menuli =(Menus::Model()->with()->findAll(array('condition'=> ' t.parent_id='.(int)$secId,'order'=>'sort asc')));

			
			if (count($menuli)){
					$tp.='<ol >';
					foreach($menuli as $item){
							
							$tp.='<li class="stLevel"><a href="'.('?r=site/addMenu&id='.$item->id.'&language='.$lang).'">'.(isset($item->translations[$lang]->name)?$item->translations[$lang]->name:'Menu not InterNationalized').'</a> <a style="margin-left:25px;color:green;" href="?r=site/editPage&id='.$item->id.'&language='.$lang.'">Edit Content</a><a style="margin-left:25px;color:red;" href="?r=site/delMenu&id='.$item->id.'&language='.$lang.'">Delete Item</a>';
							$tp.=getSitemap($lang,$item->id, '');
							$tp.='</li>';
					}
					$tp.='</ol>';
			}
			return $tp;
		}
		$tp = '';
		
		$rs=getSitemap($this->Lang, -1, $tp); 
		$output['lang'] = $this->Lang;
		$output['tp'] = '<div style="margin-bottom:30px;">'.$rs.'</div>';
		$rs=getSitemap($this->Lang, -2, $tp); 
		$output['tp2'] = '<div style="margin-top:0;">'.$rs.'</div>';

		
		
		$this->render('sitemap', $output );	
		
	}

}