<?php
/* @var $this ItemPhotosController */
/* @var $model ItemPhotos */

$this->breadcrumbs=array(
	'Item Photoses'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ItemPhotos', 'url'=>array('index')),
	array('label'=>'Create ItemPhotos', 'url'=>array('create')),
	array('label'=>'Update ItemPhotos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ItemPhotos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ItemPhotos', 'url'=>array('admin')),
);
?>

<h1>View ItemPhotos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'pic_name',
		'color_id',
		'type',
		'item_id',
		'name',
		'created_date',
		'created_by',
		'sort',
	),
)); ?>
