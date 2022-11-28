<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ImportForm extends CActiveRecord
{
	public $skip;
	public $file;
	public $module=false;
        public $includesHeaders = false;
        public $columns=array();

	/**
	 * Returns the static model of the specified AR class.
	 * @return Languages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        /**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
                        array('file,columns','required'),
                        array('skip,includesHeaders','boolean'),
                        array('results','length','allowEmpty'=>true),
                        array('skip,includesHeaders','default','value'=>0),
			// email has to be a valid email address
			array('file', 'file','types'=>'xls,xlsx'),
			// verifyCode needs to be entered correctly
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'verifyCode'=>'Verification Code',
		);
	}
        public function tableName() {
            return 'importForm';
        }
        public function beforeSave() {
            if (is_array($this->columns)){
                $this->columns = CJSON::encode($this->columns);
            }
            return true;
        }
        public function getFileName(){
             $tmp = (realpath(Yii::app()->basePath.'/../import/'.strtolower($this->module)).'/'.$this->file);
            return $tmp;
        }
        public function import(){
            $sheet_array = Yii::app()->yexcel->readActiveSheet($this->getFileName());

            //${$this->module}::model()->updateAll(array('stock'=>0));
            $model = $this->module;
            if ($this->skip){
                $model::model()->deleteAll();
            }
            $tmp = $this->checkIncludesHeaders($sheet_array);
            $models = array();
            $unique_indexes = array();
            foreach($tmp as $key=>$column){
                
                $matches = explode('::', $column);
                ($matches[0][0]=='*'?$matches[0]=substr($matches[0],1):'');
                if (count($matches)>1){
                    $this->columns[$key] = array('model'=>$matches[0],'field'=>$matches[1]);
                    if (isset($matches[2]))
                        $this->columns[$key]['destination_field'] = $matches[2];
                    else 
                        $this->columns[$key]['destination_field'] = $matches[1];
                    
                    if ($this->skip)
                        $matches[0]::model()->deleteAll();
                    $models[$matches[0]] = '';
                }
                else {
                    $this->columns[$key] = array('model'=>$this->module,'field'=>$matches[0],'destination_field'=>$matches[0]);
                    $models[$this->module] = '';
                }
                if ($column[0]=='*')
                    $unique_indexes[$this->columns[$key]['destination_field']] = $key;                
           }
            //print_r($sheet_array);
            //die();
            $importNumber=0;
            $tmpStr = '<table>';
            foreach( $sheet_array as $row ) {

                $values = array_values($row);
                //$modelObj = new $model();
                $models =  array();
                $tmpIndexes = array();
                foreach($unique_indexes as $unique_index=>$key){
                    $tmpIndexes[$unique_index] = $values[$key];
                }
                $models[$this->module] = $model::model()->findByAttributes($tmpIndexes);
                foreach($values as $key=>$value){
                    if (isset($this->columns[$key]) && count($this->columns[$key])>=2){
                        $tmpFieldName = $this->columns[$key]['field'];
                        $tmpDestName = $this->columns[$key]['destination_field'];
                        $tmpModelName = $this->columns[$key]['model'];
                        
                        if (isset($models[$tmpModelName]) && is_a($models[$tmpModelName], $tmpModelName)){
                            if ($models[$tmpModelName]->hasAttribute($tmpFieldName))
                                $models[$tmpModelName]->$tmpFieldName = $value;
                            
                        } else {
                            if ($tmpModelName!=$this->module && $models[$tmpModelName] = $tmpModelName::model()->findByAttributes(array($tmpFieldName=>$value))){
                                $models[$tmpModelName]->scenario = 'Import';
                                $models[$tmpModelName]->$tmpFieldName = $value;
                                if ($tmpModelName != $this->module){
                                    if ($models[$tmpModelName]->save())
                                        if (isset($models[$this->module])){
                                            $models[$this->module]->$tmpDestName = $models[$tmpModelName]->id;
                                        } 
                                    //else print_r($models[$tmpModelName]);
                                }
                            } else {
                                $models[$tmpModelName] = new $tmpModelName('Import');
                                $models[$tmpModelName]->$tmpFieldName = $value;
                                if ($tmpModelName != $this->module){
                                    if ($models[$tmpModelName]->save())
                                        if (isset($models[$this->module])){
                                            $models[$this->module]->$tmpDestName = $models[$tmpModelName]->id;
                                        } 
                                    //else print_r($models[$tmpModelName]);
                                }
                            }
                        }
                        //$field = $this->columns[$key]['field'];
                        //$modelObj->$field = $value;
                        if ($tmpFieldName == 'images'){
                            $imgFolder = $value;
                        }
                    }
                }
                //print_r($models);
                if ($models[$this->module]->save())
                    $importNumber++;
                $tmpErrors = (count($models[$this->module]->errors)?print_r($models[$this->module]->errors,true):'OK');
                $tmpName = $models[$this->module]->name;
                $tmpStr.= "<tr>"
                        . "     <td>{$tmpName}</td><td>{$tmpErrors}</td>";
                        
                $files =  CFileHelper::findFiles(Yii::getPathOfAlias('application').'/../import/itemphotos/'.$imgFolder,array('fileTypes'=>array('jpg','JPG')));
                $newpath = Yii::getPathOfAlias('application').'/../../uploads/items/';
                foreach($files as $file){
                    copy($file, $newpath.'/'.time().'_'.strtolower(basename($file)));
                    $gall = new ItemPhotos();
                    $gall->color_id = 0;
                    $gall->pic_name = time().'_'.strtolower(basename($file));
                    $gall->item_id = $models[$this->module]->id;
                    $gall->created_by = Users::model()->findByAttributes(array('uname'=>Yii::app()->user->name))->id;
                    $gall->save();
                    $gallErrors = print_r($gall->errors,true);
                    $tmpStr.="  <td>{$gallErrors}</td>";
                }
                $tmpStr.= "</tr>";
            }
            $rowCount = count($sheet_array);
            $tmpStr .= '</table>';  
            return "<div>Rows inside file:{$rowCount}</div><div>Imported Rows: {$importNumber}</div>".$tmpStr;
        }
        private function checkIncludesHeaders(&$sheet_array){
            if ($this->includesHeaders){
                $tmp = $sheet_array[1];
                $tmp = array_values($tmp);
                unset($sheet_array[1]);
            } else $tmp = $this->columns; 
            $this->columns = array();
            return $tmp;
        }
}