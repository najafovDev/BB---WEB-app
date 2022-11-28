<?php
/* @var $this SourceMessageController */
/* @var $model SourceMessage */

$this->breadcrumbs=array(
	'Source Messages'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SourceMessage', 'url'=>array('index')),
	array('label'=>'Create SourceMessage', 'url'=>array('create')),
	array('label'=>'View SourceMessage', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SourceMessage', 'url'=>array('admin')),
);
?>

<h1>Update SourceMessage <?php echo $model->id; ?></h1>
<div>
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
