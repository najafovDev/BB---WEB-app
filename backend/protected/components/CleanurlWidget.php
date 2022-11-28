<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class CleanurlWidget extends CWidget {
 
    public $model,$attr='name',$cleanurl;
    public $Lang=null;
 
    public function run() {	
        $this->render('CleanurlWidgetView',array('model'=>$this->model,'attr'=>$this->attr,'cleanurl'=>$this->cleanurl,'language'=>$this->Lang));
    }
 
}
?>
