<?php
/* @var $this QuotePairsController */
/* @var $data QuotePairs */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ps')); ?>:</b>
	<?php echo CHtml::encode($data->ps); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('v')); ?>:</b>
	<?php echo CHtml::encode($data->v); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('broker_percent_long')); ?>:</b>
	<?php echo CHtml::encode($data->broker_percent_long); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('broker_percent_short')); ?>:</b>
	<?php echo CHtml::encode($data->broker_percent_short); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('coefficient')); ?>:</b>
	<?php echo CHtml::encode($data->coefficient); ?>
	<br />


</div>