<?php
/* @var $this CompetitionResultsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Competition Results',
);

$this->menu=array(
	array('label'=>'Create CompetitionResults', 'url'=>array('create')),
	array('label'=>'Manage CompetitionResults', 'url'=>array('admin')),
);
?>

<h1>Competition Results</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
