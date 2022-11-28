<?php
/* @var $this ImageSizesController */
/* @var $model ImageSizes */

$this->breadcrumbs=array(
	'Image Sizes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ImageSizes', 'url'=>array('index')),
	array('label'=>'Manage ImageSizes', 'url'=>array('admin')),
);
?>

<h1>Create ImageSizes</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>