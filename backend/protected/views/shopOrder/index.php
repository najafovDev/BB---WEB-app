<?php
/* @var $this ShopOrderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Shop Orders',
);

$this->menu=array(
	array('label'=>'Create ShopOrder', 'url'=>array('create')),
	array('label'=>'Manage ShopOrder', 'url'=>array('admin')),
);
?>

<h1>Shop Orders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
