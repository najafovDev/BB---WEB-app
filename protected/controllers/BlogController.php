<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BlogController
 *
 * @author sahil1
 */
class BlogController extends Controller{
    
    public function actionIndex(){
        $this->layout = 'searchLayout';
        $this->bodyClass = 'detailed-view menus-view';
        
        $output['model'] = $model = Menus::model()->findByAttributes(array('keyword'=>'blog'),array('order'=>'t.date desc'));
        $this->render('index',$output);
    }
    public function actionView($id){
        $this->layout = 'searchLayout';
        $this->bodyClass = 'detailed-view menus-view';
        $output['parent'] = $parent = Menus::model()->findByAttributes(array('keyword'=>'blog'));        
        $output['model'] = $model = Articles::model()->findByPk($id);
        $this->render('//blog/article',$output);
    }
}
