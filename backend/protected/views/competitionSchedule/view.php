<?php
/* @var $this CompetitionScheduleController */
/* @var $model CompetitionSchedule */

$this->breadcrumbs=array(
	'Competition Schedules'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List CompetitionSchedule', 'url'=>array('index')),
	array('label'=>'Create CompetitionSchedule', 'url'=>array('create')),
	array('label'=>'Update CompetitionSchedule', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CompetitionSchedule', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CompetitionSchedule', 'url'=>array('admin')),
);
?>

<h1>View CompetitionSchedule #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date_r_n',
		'date_r_k',
		'date_pk_n',
		'date_pk_k',
		'go',
		'open',
		'title',
	),
)); ?>
