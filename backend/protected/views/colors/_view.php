<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rgb')); ?>:</b>
	<?php echo CHtml::encode($data->rgb); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pic_name')); ?>:</b>
	<?php echo CHtml::encode($data->pic_name); ?>
	<br />


</div>