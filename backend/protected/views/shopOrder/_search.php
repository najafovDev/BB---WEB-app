<?php
/* @var $this ShopOrderController */
/* @var $model ShopOrder */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'order_id'); ?>
		<?php echo $form->textField($model,'order_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customer_id'); ?>
		<?php echo $form->textField($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ordering_date'); ?>
		<?php echo $form->textField($model,'ordering_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ordering_done'); ?>
		<?php echo $form->textField($model,'ordering_done'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ordering_confirmed'); ?>
		<?php echo $form->textField($model,'ordering_confirmed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shipped'); ?>
		<?php echo $form->textField($model,'shipped'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'finished'); ?>
		<?php echo $form->textField($model,'finished'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cancelled'); ?>
		<?php echo $form->textField($model,'cancelled'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transaction_id'); ?>
		<?php echo $form->textField($model,'transaction_id',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transaction_result'); ?>
		<?php echo $form->textArea($model,'transaction_result',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shipping_fee'); ?>
		<?php echo $form->textField($model,'shipping_fee'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shipping_name'); ?>
		<?php echo $form->textField($model,'shipping_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shipping_surname'); ?>
		<?php echo $form->textField($model,'shipping_surname',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'message'); ?>
		<?php echo $form->textField($model,'message',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'payment_method'); ?>
		<?php echo $form->textField($model,'payment_method',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->