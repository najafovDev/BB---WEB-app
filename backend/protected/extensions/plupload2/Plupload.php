<?php

/**
 * The following container integrates the Plupload (http://www.plupload.com)
 * component, allowing you to add multiple images interactively.
 * If you want to change settings, first check the documentation component
 * (http://www.plupload.com/documentation.php)
 * Usage:
 * <?php $this->widget('ext.plupload.Plupload'); ?>
 * @version 1.0
 * @author Rafael J Torres <rafaelt88@gmail.com>
 * @copyright (c) 2014 Rafael J Torres
 * @license GNU/GPL: http://www.gnu.org/copyleft/gpl.html
 */
class Plupload extends CWidget {
    public $url,$init,$model='Gallery',$attr='pic_name';
    public function init() {
        $assets = Yii::app()->assetManager->publish(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets');
        Yii::app()->clientscript->registerCssFile(
            '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css')
            ->registerCoreScript('jquery.ui',  CClientScript::POS_HEAD)
            ->registerCssFile($assets . '/css/jquery.ui.plupload.css')
            ->registerScriptFile($assets . '/js/plupload.full.min.js', CClientScript::POS_HEAD)
            ->registerScriptFile($assets . '/js/jquery.ui.plupload.min.js', CClientScript::POS_HEAD);
            //->registerScriptFile($assets . '/i18n/' . Yii::app()->language . '.js', CClientScript::POS_HEAD)
        $this->configure();
    }

    public function run() {
        echo "<div id='uploader'>";
        echo "<p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>";
        echo "</div>";
    }

    public function configure() {
        Yii::app()->clientscript->registerScript('plupload',
            '$(function() {
            var btn = $.fn.button.noConflict();
            $.fn.btn = btn;
            $("#uploader").plupload({
                url : "'.$this->url.'",
                max_file_size: "2mb",
                prevent_duplicates: true,
                filters : [{title : "Image files", extensions : "jpg,gif,png,pdf"}],
                rename: true,
                sortable: true,
                dragdrop: true,
                unique_names: true,
                views: {
                    list: true,
                    thumbs: true,
                    active: "thumbs"
                },
                file_data_name:\''.(($this->model))."[{$this->attr}]',".
                'init:'.CJavaScript::encode($this->init).'
            });
        });', CClientScript::POS_READY);
    }

}
