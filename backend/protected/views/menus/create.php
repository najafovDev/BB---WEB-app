<?php
/* @var $this ContentController */
/* @var $model Menus */

$this->breadcrumbs=array(
	'Menuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Menus', 'url'=>array('index')),
	array('label'=>'Manage Menus', 'url'=>array('admin')),
);
?>

<h1>Create Menu Item</h1>

<div><?php $this->renderPartial('_form', array('model'=>$model)); ?></div>