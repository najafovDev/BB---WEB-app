<?php
/* @var $this ShopOrderController */
/* @var $model ShopOrder */

$this->breadcrumbs=array(
	'Shop Orders'=>array('index'),
	$model->order_id=>array('view','id'=>$model->order_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ShopOrder', 'url'=>array('index')),
	array('label'=>'Create ShopOrder', 'url'=>array('create')),
	array('label'=>'View ShopOrder', 'url'=>array('view', 'id'=>$model->order_id)),
	array('label'=>'Manage ShopOrder', 'url'=>array('admin')),
);
?>

<h1>Update ShopOrder <?php echo $model->order_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>