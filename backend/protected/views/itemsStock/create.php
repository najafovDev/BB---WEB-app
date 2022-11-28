<?php
/* @var $this ItemsStockController */
/* @var $model ItemsStock */

$this->breadcrumbs=array(
	'Items Stocks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ItemsStock', 'url'=>array('index')),
	array('label'=>'Manage ItemsStock', 'url'=>array('admin')),
);
?>

<h1>Create ItemsStock</h1>
<div>
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
