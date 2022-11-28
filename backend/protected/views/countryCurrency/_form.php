<?php
/* @var $this CountryCurrencyController */
/* @var $model CountryCurrency */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'country-currency-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'currency'); ?>
		<?php echo $form->textField($model,'currency',array('class'=>'form-control input-lg', 'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'currency'); ?>
	</div>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'percent'); ?>
		<?php echo $form->textField($model,'percent',array('class'=>'form-control input-lg', 'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'percent'); ?>
	</div>
        <div class="clearfix"></div>
	<div class="col-sm-4 col-md-3 buttons mt10">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary input-lg')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->