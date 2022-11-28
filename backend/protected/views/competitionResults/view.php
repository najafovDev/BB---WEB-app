<?php
/* @var $this CompetitionResultsController */
/* @var $model CompetitionResults */

$this->breadcrumbs=array(
	'Competition Results'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List CompetitionResults', 'url'=>array('index')),
	array('label'=>'Create CompetitionResults', 'url'=>array('create')),
	array('label'=>'Update CompetitionResults', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CompetitionResults', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CompetitionResults', 'url'=>array('admin')),
);
?>

<h1>View CompetitionResults #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'compt_id',
		'login',
		'name',
		'balance',
		'equity',
		'statement',
		'date',
		'place',
	),
)); ?>
