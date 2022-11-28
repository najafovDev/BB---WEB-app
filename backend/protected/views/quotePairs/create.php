<?php
/* @var $this QuotePairsController */
/* @var $model QuotePairs */

$this->breadcrumbs=array(
	'Quote Pairs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List QuotePairs', 'url'=>array('index')),
	array('label'=>'Manage QuotePairs', 'url'=>array('admin')),
);
?>

<h1>Create QuotePairs</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>