<?php
/* @var $this BrandsController */
/* @var $model Brands */

$this->breadcrumbs=array(
	'Brands'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Brands', 'url'=>array('index')),
	array('label'=>'Manage Brands', 'url'=>array('admin')),
);
?>

<h1>Create Author</h1>
<div>
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>