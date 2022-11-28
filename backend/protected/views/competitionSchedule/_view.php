<?php
/* @var $this CompetitionScheduleController */
/* @var $data CompetitionSchedule */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_r_n')); ?>:</b>
	<?php echo CHtml::encode($data->date_r_n); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_r_k')); ?>:</b>
	<?php echo CHtml::encode($data->date_r_k); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_pk_n')); ?>:</b>
	<?php echo CHtml::encode($data->date_pk_n); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_pk_k')); ?>:</b>
	<?php echo CHtml::encode($data->date_pk_k); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('go')); ?>:</b>
	<?php echo CHtml::encode($data->go); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('open')); ?>:</b>
	<?php echo CHtml::encode($data->open); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	*/ ?>

</div>