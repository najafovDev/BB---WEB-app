<?php
/* @var $this UserListController */
/* @var $model UserList */

$this->breadcrumbs=array(
	'User Lists'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List UserList', 'url'=>array('index')),
	array('label'=>'Create UserList', 'url'=>array('create')),
	array('label'=>'Update UserList', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserList', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserList', 'url'=>array('admin')),
);
?>

<h1>View UserList #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'sername',
		'nicname',
		'country',
		'city',
		'mail',
		'phone',
		'id',
		'pass',
		'comp_id',
	),
)); ?>
