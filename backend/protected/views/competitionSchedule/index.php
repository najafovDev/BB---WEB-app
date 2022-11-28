<?php
/* @var $this CompetitionScheduleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Competition Schedules',
);

$this->menu=array(
	array('label'=>'Create CompetitionSchedule', 'url'=>array('create')),
	array('label'=>'Manage CompetitionSchedule', 'url'=>array('admin')),
);
?>

<h1>Competition Schedules</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
