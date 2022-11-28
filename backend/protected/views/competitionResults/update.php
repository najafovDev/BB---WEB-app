<?php
/* @var $this CompetitionResultsController */
/* @var $model CompetitionResults */

$this->breadcrumbs=array(
	'Competition Results'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CompetitionResults', 'url'=>array('index')),
	array('label'=>'Create CompetitionResults', 'url'=>array('create')),
	array('label'=>'View CompetitionResults', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CompetitionResults', 'url'=>array('admin')),
);
?>

<h1>Update CompetitionResults <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>