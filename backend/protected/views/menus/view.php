<?php
/* @var $this ContentController */
/* @var $model Menus */

$this->breadcrumbs=array(
	'Menuses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Menus', 'url'=>array('index')),
	array('label'=>'Create Menus', 'url'=>array('create')),
	array('label'=>'Update Menus', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Menus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Menus', 'url'=>array('admin')),
);
?>

<h1>View Menus #<?php echo $model->getTranslation($this->Lang)->name; ?></h1>
<div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parent_id',
		'pic_name',
		'banner',
		'sort',
		'keyword',
	),
)); ?>
</div>