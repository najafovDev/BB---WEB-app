<?php
/* @var $this QuotePairsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Quote Pairs',
);

$this->menu=array(
	array('label'=>'Create QuotePairs', 'url'=>array('create')),
	array('label'=>'Manage QuotePairs', 'url'=>array('admin')),
);
?>

<h1>Quote Pairs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
