<?php
/* @var $this CompetitionScheduleController */
/* @var $model CompetitionSchedule */
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
		<?php echo $form->label($model,'date_r_n'); ?>
		<?php echo $form->textField($model,'date_r_n'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_r_k'); ?>
		<?php echo $form->textField($model,'date_r_k'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_pk_n'); ?>
		<?php echo $form->textField($model,'date_pk_n'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_pk_k'); ?>
		<?php echo $form->textField($model,'date_pk_k'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'go'); ?>
		<?php echo $form->textField($model,'go'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'open'); ?>
		<?php echo $form->textField($model,'open'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->