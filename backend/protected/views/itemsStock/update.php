<?php
/* @var $this ItemsStockController */
/* @var $model ItemsStock */

$this->breadcrumbs=array(
	'Items Stocks'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ItemsStock', 'url'=>array('index')),
	array('label'=>'Create ItemsStock', 'url'=>array('create')),
	array('label'=>'View ItemsStock', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ItemsStock', 'url'=>array('admin')),
);
?>

<h1>Update <b><?php echo $model->item->name; ?></b> stock </h1>

<div>
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>