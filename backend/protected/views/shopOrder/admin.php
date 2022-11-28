<h1>Manage Shop Orders</h1>
<div>
<?php 
//    echo CHtml::link(Yii::t('system','Add new ShopOrder'), $this->createUrl('create'), array('class'=>'btn btn-primary'));
?>    
<?php $this->widget('MfeTbExtendedGridView', array(
	'id'=>'shop-order-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'order_id',
		'customer_id',
		'shipping_name',
		'ordering_date',
		'ordering_done',
		'ordering_confirmed',
		'shipped',
		'finished',
		'cancelled',
		/*
		'transaction_id',
		'transaction_result',
		'shipping_fee',
		'shipping_surname',
		'address',
		'email',
		'phone',
		'message',
		'payment_method',
		'ip',
		*/
		array(
			'class'=>'MfeTbButtonColumn',
		),
	),
)); ?>
</div>