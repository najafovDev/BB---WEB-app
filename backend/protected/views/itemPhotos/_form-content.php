<?php
/* @var $this ContentController */
/* @var $model Menus */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'menus-form-'.$model->language.'-'.$model->id,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('class'=>'translatable translatable-'.$model->language),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>



	<div class="col-sm-12">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<div class="col-sm-12">
		<?php echo $form->labelEx($model,'summary'); ?>
		<?php echo $form->textArea($model,'summary',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'summary'); ?>
	</div>
	<div class="row">
		<?php echo $form->hiddenField($model,'language'); ?>
	</div>


	<div class="col-xs-12 mt10 buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-success pull-right')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->