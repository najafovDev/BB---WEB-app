<?php
/* @var $this ColorsControllerController */
/* @var $model Colors */

$this->breadcrumbs=array(
	'Colors'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Colors', 'url'=>array('index')),
	array('label'=>'Create Colors', 'url'=>array('create')),
	array('label'=>'View Colors', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Colors', 'url'=>array('admin')),
);
?>

<h1>Update Colors <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>