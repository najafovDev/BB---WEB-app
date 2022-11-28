<?php
/* @var $this QuotePairsController */
/* @var $model QuotePairs */

$this->breadcrumbs=array(
	'Quote Pairs'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List QuotePairs', 'url'=>array('index')),
	array('label'=>'Create QuotePairs', 'url'=>array('create')),
	array('label'=>'View QuotePairs', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage QuotePairs', 'url'=>array('admin')),
);
?>

<h1>Update QuotePairs <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>