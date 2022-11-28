<?php
/* @var $this CategoryFieldsetController */
/* @var $model CategoryFieldset */

$this->breadcrumbs=array(
	'Category Fieldsets'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List CategoryFieldset', 'url'=>array('index')),
	array('label'=>'Create CategoryFieldset', 'url'=>array('create')),
	array('label'=>'Update CategoryFieldset', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CategoryFieldset', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CategoryFieldset', 'url'=>array('admin')),
);
?>

<h1>View CategoryFieldset #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'type',
	),
)); ?>
