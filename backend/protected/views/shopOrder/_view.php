<?php
/* @var $this ShopOrderController */
/* @var $data ShopOrder */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->order_id), array('view', 'id'=>$data->order_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ordering_date')); ?>:</b>
	<?php echo CHtml::encode($data->ordering_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ordering_done')); ?>:</b>
	<?php echo CHtml::encode($data->ordering_done); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ordering_confirmed')); ?>:</b>
	<?php echo CHtml::encode($data->ordering_confirmed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipped')); ?>:</b>
	<?php echo CHtml::encode($data->shipped); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('finished')); ?>:</b>
	<?php echo CHtml::encode($data->finished); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cancelled')); ?>:</b>
	<?php echo CHtml::encode($data->cancelled); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transaction_id')); ?>:</b>
	<?php echo CHtml::encode($data->transaction_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transaction_result')); ?>:</b>
	<?php echo CHtml::encode($data->transaction_result); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipping_fee')); ?>:</b>
	<?php echo CHtml::encode($data->shipping_fee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipping_name')); ?>:</b>
	<?php echo CHtml::encode($data->shipping_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shipping_surname')); ?>:</b>
	<?php echo CHtml::encode($data->shipping_surname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message')); ?>:</b>
	<?php echo CHtml::encode($data->message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_method')); ?>:</b>
	<?php echo CHtml::encode($data->payment_method); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip')); ?>:</b>
	<?php echo CHtml::encode($data->ip); ?>
	<br />

	*/ ?>

</div>