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
class EmptyThumbnailsAction extends CAction{
    public function run($dirs =null,$delete=false){
            //echo Yii::app()->getRequest()->getParam('delete');
            if (! YII_DEBUG) return;
            if (!$dirs)
                $dirs = array(Yii::app()->basePath.'/../site/images',Yii::app()->basePath.'/../site/uploads');
            foreach($dirs as $dir ){
                if (is_dir($dir))
                    $scan = scandir($dir);
                else {
                    if ($delete)
                        unlink($dir);
                    return;
                }
                foreach($scan as $tmp){
                    if ($tmp!='.' && $tmp!='..'){
                        $this->run(array($dir."/$tmp"),$delete);
                        echo $dir."/$tmp<br>";
                    }
                }
                if ($delete && is_dir($dir))
                    rmdir($dir);
            }
           //print_r( scandir(Yii::app()->basePath.'/../site/'.$dir));
    }
}