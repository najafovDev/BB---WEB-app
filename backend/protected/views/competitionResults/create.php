<?php
/* @var $this CompetitionResultsController */
/* @var $model CompetitionResults */

$this->breadcrumbs=array(
	'Competition Results'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CompetitionResults', 'url'=>array('index')),
	array('label'=>'Manage CompetitionResults', 'url'=>array('admin')),
);
?>

<h1>Create CompetitionResults</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>