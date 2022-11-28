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
class DestroyAction extends CAction {
    /**
     * @var string
     */
    public $basePath = 'uploads/';

    public function run() {
        @set_time_limit(5 * 60);
        $file = explode('.', strtolower(Yii::app()->request->getParam('name')));
        $mask = substr(md5(Yii::app()->user->getStateKeyPrefix()), 0, 8) . substr(md5($file[0]), 0, 8) . "*.{$file[1]}";
        array_map( "unlink", glob( $this->basePath . $mask ) );
        $this->remove($file);
    }

    /**
     * @param string $file
     */
    public function remove($file) {
        $plupload = json_decode(Yii::app()->user->getState('plupload'), true);
        unset($plupload[substr(md5(Yii::app()->user->getStateKeyPrefix()), 0, 8) . substr(md5($file[0]), 0, 8) . ".{$file[1]}"]);
        Yii::app()->user->setState('plupload', json_encode($plupload));
    }

}
