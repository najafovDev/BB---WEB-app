<?php
/* @var $this PortalsControllerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Portals',
);

$this->menu=array(
	array('label'=>'Create Portals', 'url'=>array('create')),
	array('label'=>'Manage Portals', 'url'=>array('admin')),
);
?>

<h1>Portals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
