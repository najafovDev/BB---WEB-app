<?php
/* @var $this ImageSizesController */
/* @var $model ImageSizes */

$this->breadcrumbs=array(
	'Image Sizes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ImageSizes', 'url'=>array('index')),
	array('label'=>'Create ImageSizes', 'url'=>array('create')),
	array('label'=>'View ImageSizes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ImageSizes', 'url'=>array('admin')),
);
?>

<h1>Update ImageSizes <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>