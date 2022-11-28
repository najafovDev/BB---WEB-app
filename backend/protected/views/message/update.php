<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	$model->fid=>array('view','id'=>$model->fid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Message', 'url'=>array('index')),
	array('label'=>'Create Message', 'url'=>array('create')),
	array('label'=>'View Message', 'url'=>array('view', 'id'=>$model->fid)),
	array('label'=>'Manage Message', 'url'=>array('admin')),
);
?>

<h1>Update Translation <?php echo $model->fid; ?></h1>

<div><?php $this->renderPartial('_form', array('model'=>$model)); ?></div>