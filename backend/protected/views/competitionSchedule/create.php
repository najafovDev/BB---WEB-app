<?php
/* @var $this CompetitionScheduleController */
/* @var $model CompetitionSchedule */

$this->breadcrumbs=array(
	'Competition Schedules'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CompetitionSchedule', 'url'=>array('index')),
	array('label'=>'Manage CompetitionSchedule', 'url'=>array('admin')),
);
?>

<h1>Create CompetitionSchedule</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>