<?php
/* @var $this ItemPhotosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Item Photoses',
);

$this->menu=array(
	array('label'=>'Create ItemPhotos', 'url'=>array('create')),
	array('label'=>'Manage ItemPhotos', 'url'=>array('admin')),
);
?>

<h1>Item Photoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
