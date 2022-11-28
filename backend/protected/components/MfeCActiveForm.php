<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MfeCActiveForm
 *
 * @author sahil1
 */
class MfeCActiveForm extends CActiveForm {
    //put your code here
	public function styledFileField($model,$attribute,$htmlOptions=array())
	{
            $input = CHtml::activeFileField($model,$attribute,array('class'=>'form-control hide'));
            $link = CHtml::link($model->$attribute,"/uploads/".  strtolower(get_class($model))."/".$model->$attribute,array("target"=>"_blank"));
            $html = <<<HTML
                <div class=" fileupload fileupload-new" data-provides="fileupload">
                    <div class="input-append ">
                          <div class="uneditable-input" data-trigger="fileupload">
                              <i class="glyphicon glyphicon-file fileupload-exists"></i>
                              <span class="fileupload-preview"></span>
                          </div>
                          <span class="btn btn-default btn-file">
                              <span class="fileupload-new" data-trigger="fileupload">Select file</span>
                              <span class="fileupload-exists" data-trigger="fileupload">Change</span>
                              $input
                          </span>
                          <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                          {$link}
                    </div>
                </div>   
HTML;
		return $html;
	}
}
