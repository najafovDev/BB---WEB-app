<?php
/* @var $this ArticlesController */
/* @var $data Articles */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
	<?php echo CHtml::encode($data->parent_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sort')); ?>:</b>
	<?php echo CHtml::encode($data->sort); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('carousel')); ?>:</b>
	<?php echo CHtml::encode($data->carousel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pic_name')); ?>:</b>
	<?php echo CHtml::encode($data->pic_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_name')); ?>:</b>
	<?php echo CHtml::encode($data->file_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('menucontent')); ?>:</b>
	<?php echo CHtml::encode($data->menucontent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('front')); ?>:</b>
	<?php echo CHtml::encode($data->front); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('right')); ?>:</b>
	<?php echo CHtml::encode($data->right); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	*/ ?>

</div>