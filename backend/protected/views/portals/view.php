<?php
/* @var $this PortalsControllerController */
/* @var $model Portals */

$this->breadcrumbs=array(
	'Portals'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Portals', 'url'=>array('index')),
	array('label'=>'Create Portals', 'url'=>array('create')),
	array('label'=>'Update Portals', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Portals', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Portals', 'url'=>array('admin')),
);
?>

<h1>View Portals #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parent_id',
		'name',
		'latitude',
		'longitude',
	),
)); ?>
