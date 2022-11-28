<?php
/* @var $this QuotePairsController */
/* @var $model QuotePairs */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ps'); ?>
		<?php echo $form->textField($model,'ps'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'v'); ?>
		<?php echo $form->textField($model,'v'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'broker_percent_long'); ?>
		<?php echo $form->textField($model,'broker_percent_long'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'broker_percent_short'); ?>
		<?php echo $form->textField($model,'broker_percent_short'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'coefficient'); ?>
		<?php echo $form->textField($model,'coefficient'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->