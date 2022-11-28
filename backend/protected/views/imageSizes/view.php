<?php
/* @var $this ImageSizesController */
/* @var $model ImageSizes */

$this->breadcrumbs=array(
	'Image Sizes'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ImageSizes', 'url'=>array('index')),
	array('label'=>'Create ImageSizes', 'url'=>array('create')),
	array('label'=>'Update ImageSizes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ImageSizes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ImageSizes', 'url'=>array('admin')),
);
?>

<h1>View ImageSizes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parent_id',
		'name',
		'width',
		'height',
		'crop_location',
		'w',
		'keep_aspect',
	),
)); ?>
