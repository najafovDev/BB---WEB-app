<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MfeActiveRecord
 *
 * @author sahil1
 */
class MfeActiveRecord  extends CActiveRecord{
    public $rootUploadUrl = '/uploads/';
    public $rootUploadPath = '../../../uploads/';
    
    public function getUploadUrl(){
        return $this->rootUploadUrl.$this->uploadFolder;
    }
    public function getUploadPath(){
        return $this->rootUploadPath.$this->uploadFolder;
    }
    public function getImageUrl($attr='pic_name'){
        return $this->getUploadUrl().'/'.$this->$attr;
    }
}
