<?php

//error_reporting(E_ALL);
//ini_set('display_errors',true);
ini_set('memory_limit','256M');
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
class ThumbnailAction extends CAction{
    public function run(){
		global $basePath;
		$picSizes = array();
		$folder = Yii::app()->getRequest()->getParam('folder');
		$sub = Yii::app()->getRequest()->getParam('sub');
		$pic =  Yii::app()->getRequest()->getParam('pic');
		$parent =  Yii::app()->getRequest()->getParam('parent');
                
                $crit = new CDbCriteria();
                $crit->compare('name',$folder);
                
                $module = Modules::model()->with()->find($crit);
                $module = $module->thumbnails[$sub];
		$baseUrl = Yii::app()->basePath.'/..';
					
                
		if ($pic&&$folder&&file_exists($baseUrl.'/'.$parent.'/'.$folder.'/'.$pic)){
				$image = Yii::app()->image->load($baseUrl.'/'.$parent.'/'.$folder.'/'.$pic);	
				
		}
		else {
			 print '<img src="/'.$parent.'/'.$folder.'/'.$pic.'">Pic not exists ('.$baseUrl.')!!!!';
			return;
		}

		if ($pic&&$folder&&!is_dir($baseUrl.'/site/'.$parent.'/'.$folder.'/'.$sub))
				if ( !mkdir($baseUrl.'/site/'.$parent.'/'.$folder.'/'.$sub.'/')) 
				 {
					print 'Thumbnail folder not created !!!!';
					return;
				}
				else {
					 chmod($baseUrl.'/site/images/'.$folder.'/'.$sub.'/',0777);
				}
		else {
				
		}
		//($picSizes[$folder][$sub]['width']>$picSizes[$folder][$sub]['height']?$ratio=Image::HEIGHT:$ratio=Image::WIDTH); 
		//if ($image->__get('width')/$image->__get('height')>=$module->width/$module->height)
                $picAspect = $image->width/$image->height;// 1000/500=2 100/40=2.5 
                if ($module->height)
                    $thumbAspect = $module->width/$module->height;
                if ($picAspect <= $thumbAspect){
                    $tmpCrop = Image::HEIGHT;
                    $width = $image->width;
                    $height = $width/$thumbAspect;
                    $tmpSize = $module->height;
                }
                else {
                    $tmpCrop = Image::WIDTH;
                    $height = $image->height;
                    $width = $height*$thumbAspect;
                    $tmpSize = $module->width;
                }
                if ($module->keep_aspect)
                    $imageCrop = Image::AUTO;
                else $imageCrop = Image::NONE;
                
                if (!$module->keep_aspect &&
                    $module->width!=0 and $module->height!=0)
                    $image->crop($width, $height,null,null);
                if ($module->width!=0 and $module->height!=0)
                    $image->resize($module->width, $module->height,$imageCrop)->sharpen(20);
                if ($module->keep_aspect && $image->height>$module->height && 
                    $module->width!=0 and $module->height!=0)
                    $image->crop($width, $height,null,null);
                if (isset($module->w)&& $module->w){
                    $watermark = Yii::app()->image->load($baseUrl.'/assets/img/logo.png');                
                    $image->watermark($watermark,null,null,30);
                }
		$image->save(($baseUrl.'/site/'.$parent.'/'.$folder.'/'.$sub.'/'.$pic));
		$image = Yii::app()->image->load($baseUrl.'/site/'.$parent.'/'.$folder.'/'.$sub.'/'.$pic);	
                Yii::app()->controller->redirect('/site/'.$parent.'/'.$folder.'/'.$sub.'/'.$pic);
		$image->render('jpg');	
    }
}