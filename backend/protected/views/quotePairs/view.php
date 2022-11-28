<?php
/* @var $this QuotePairsController */
/* @var $model QuotePairs */

$this->breadcrumbs=array(
	'Quote Pairs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List QuotePairs', 'url'=>array('index')),
	array('label'=>'Create QuotePairs', 'url'=>array('create')),
	array('label'=>'Update QuotePairs', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete QuotePairs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage QuotePairs', 'url'=>array('admin')),
);
?>

<h1>View QuotePairs #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'ps',
		'v',
		'broker_percent_long',
		'broker_percent_short',
		'coefficient',
	),
)); ?>
