<?php
/* @var $this ItemPhotosController */
/* @var $model ItemPhotos */

$this->breadcrumbs=array(
	'Item Photoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ItemPhotos', 'url'=>array('index')),
	array('label'=>'Manage ItemPhotos', 'url'=>array('admin')),
);
?>

<h1>Create ItemPhotos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>