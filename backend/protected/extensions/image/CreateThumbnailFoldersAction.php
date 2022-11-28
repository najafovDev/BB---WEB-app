<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ThumbnailAction
 *
 * @author sahil1
 */
class CreateThumbnailFoldersAction extends CAction{
    public function run(){
            $modules  = Modules::model()->with()->findAll();
            foreach($modules as $module){
                echo $module->name.'<br>';
                $dir = Yii::app()->basePath.'/../uploads/'.$module->name;
                if (!file_exists($dir)){
                    mkdir($dir,0775);
                }
                @mkdir(Yii::app()->basePath.'/../site/',0777);
                @mkdir(Yii::app()->basePath.'/../site/uploads/',0777);
                @mkdir(Yii::app()->basePath.'/../site/uploads/'.$module->name,0775);
                foreach($module->thumbnails as $thumbnail){
                    @mkdir(Yii::app()->basePath.'/../site/uploads/'.$module->name.'/'.$thumbnail->name,0775);
                }
            }

    }
}