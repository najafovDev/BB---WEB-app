<?php
/* @var $this ColorsControllerController */
/* @var $model Colors */

$this->breadcrumbs=array(
	'Colors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Colors', 'url'=>array('index')),
	array('label'=>'Manage Colors', 'url'=>array('admin')),
);
?>

<h1>Create Colors</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>