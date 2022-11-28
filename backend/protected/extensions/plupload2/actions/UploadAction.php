<?php
defined('PATH') or define('PATH', Yii::app()->basePath . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);

/**
 * The following container integrates the Plupload (http://www.plupload.com)
 * component, allowing you to add multiple images interactively.
 * If you want to change settings, first check the documentation component
 * (http://www.plupload.com/documentation.php)
 * Usage:
 * Embed the action in the controller that makes the call:
 * public function actions() {
 * ...
 * 'upload' => 'ext.plupload.actions.UploadAction',
 * ...
 * }
 * @version 1.0
 * @author Rafael J Torres <rafaelt88@gmail.com>
 * @copyright (c) 2014 Rafael J Torres
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 */
class UploadAction extends CAction {
    /**
     *
     * @var string
     */
    public $basePath = '../uploads/';
    /**
     *
     * @var string
     */
    public $baseUrl = 'uploads/';
    public $picModel = 'Gallery';
    public function run() {
        $this->prepare();
        $picModel = $this->picModel;
        $model = $picModel::model()->findByAttributes(array('pic_name'=>($_POST['name'])));

        $file = CUploadedFile::getInstance(new $picModel(), 'pic_name');
        //$file = new CUploadedFile($_POST['name'], $_FILES['file']['tmp_name'],$_FILES['file']['type'], $_FILES['file']['size'], $_FILES['file']['error']);
        if (!$model && $file) {

            if ($file->saveAs($this->basePath . $_POST['name'])) {
                $this->append($_POST['name']);
                $tmp = new $picModel();
                if ($tmp->hasAttribute('item_id'))
                    $tmp->item_id = (int) Yii::app()->getRequest()->getParam('id');
                if ($tmp->hasAttribute('parent_id'))
                    $tmp->parent_id = (int) Yii::app()->getRequest()->getParam('id');
                $tmp->pic_name = $_POST['name'];
                $tmp->created_by = Users::model()->findByAttributes(array('uname'=>Yii::app()->user->name))->id;
                if ($tmp->hasAttribute('type') && $picModel=='Gallery')
                    $tmp->type = ucfirst(Yii::app()->controller->id);
                $tmp->save();
                echo 'saved';
            }
        }
        if ($model)
            throw new CHttpException(500,'Please rename file!');
    }

    public function prepare() {
        @set_time_limit(5 * 60);
        if (! file_exists($this->basePath)) {
            @mkdir($this->basePath, 0775, true);
        }
    }

    /**
     *
     * @return string
     */
    public function md5($name) {
        $temp = explode('.', strtolower($name));
        return substr(md5(Yii::app()->user->getStateKeyPrefix()), 0, 8) . substr(md5($temp[0]), 0, 8) . ".{$temp[1]}";
    }

    /**
     *
     * @param string $file
     */
    public function append($file) {
        $plupload = json_decode(Yii::app()->user->getState('plupload'), true);
        $plupload[$file] = $this->basePath;
        Yii::app()->user->setState('plupload', json_encode($plupload));
    }

}
