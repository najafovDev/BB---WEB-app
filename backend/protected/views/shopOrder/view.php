<?php
/* @var $this ShopOrderController */
/* @var $model ShopOrder */

$this->breadcrumbs=array(
	'Shop Orders'=>array('index'),
	$model->order_id,
);

$this->menu=array(
	array('label'=>'List ShopOrder', 'url'=>array('index')),
	array('label'=>'Create ShopOrder', 'url'=>array('create')),
	array('label'=>'Update ShopOrder', 'url'=>array('update', 'id'=>$model->order_id)),
	array('label'=>'Delete ShopOrder', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->order_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ShopOrder', 'url'=>array('admin')),
);
?>

<h1>View ShopOrder #<?php echo $model->order_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'order_id',
		'customer_id',
		'ordering_date',
		'ordering_done',
		'ordering_confirmed',
		'shipped',
		'finished',
		'cancelled',
		'transaction_id',
		'transaction_result',
		'shipping_fee',
		'shipping_name',
		'shipping_surname',
		'address',
		'email',
		'phone',
		'message',
		'payment_method',
		'ip',
	),
)); ?>
