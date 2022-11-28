<?php
/* @var $this ColorsControllerController */
/* @var $model Colors */

$this->breadcrumbs=array(
	'Colors'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Colors', 'url'=>array('index')),
	array('label'=>'Create Colors', 'url'=>array('create')),
	array('label'=>'Update Colors', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Colors', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Colors', 'url'=>array('admin')),
);
?>

<h1>View Colors #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'rgb',
		'pic_name',
	),
)); ?>
