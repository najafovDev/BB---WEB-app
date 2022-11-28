<?php

/**
 * The following container integrates the Plupload (http://www.plupload.com)
 * component, allowing you to add multiple images interactively.
 * If you want to change settings, first check the documentation component
 * (http://www.plupload.com/documentation.php)
 * Usage:
 * Embed the action in the controller that makes the call:
 * public function actions() {
 * ...
 * 'destroy' => 'ext.plupload.actions.DestroyAction',
 * ...
 * }
 * @version 1.0
 * @author Rafael J Torres <rafaelt88@gmail.com>
 * @copyright (c) 2014 Rafael J Torres
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 */
class DeleteImgAction extends CAction {
    /**
     * @var string
     */
    public $basePath = 'uploads/';
    public $picModel = 'Gallery';
    public function run() {
        $id = (int) Yii::app()->getRequest()->getParam('id');
        $picModel = $this->picModel;
        $tmp  = $picModel::model()->findByPk($id);
        $item = ($tmp->hasAttribute('item_id')?$tmp->item_id:($tmp->hasAttribute('parent_id')?$tmp->parent_id:null));
        if (file_exists(Yii::app()->basePath.'/../'.$this->basePath.$tmp->pic_name) && 
            count($picModel::model()->findAllByAttributes(array('pic_name'=>$tmp->pic_name)))==1)
                unlink(Yii::app()->basePath.'/../'.$this->basePath.$tmp->pic_name);
        $tmp->delete();
        Yii::app()->controller->redirect(Yii::app()->controller->createUrl('update',array('id'=>$item)));
    }

    /**
     * @param string $file
     */

}
