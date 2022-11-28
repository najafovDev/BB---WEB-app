<?php
/* @var $this ImageSizesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Image Sizes',
);

$this->menu=array(
	array('label'=>'Create ImageSizes', 'url'=>array('create')),
	array('label'=>'Manage ImageSizes', 'url'=>array('admin')),
);
?>

<h1>Image Sizes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
