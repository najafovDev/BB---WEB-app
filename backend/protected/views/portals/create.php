<?php
/* @var $this PortalsControllerController */
/* @var $model Portals */

$this->breadcrumbs=array(
	'Portals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Portals', 'url'=>array('index')),
	array('label'=>'Manage Portals', 'url'=>array('admin')),
);
?>

<h1>Create Portals</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>