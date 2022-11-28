<?php
/* @var $this UserListController */
/* @var $model UserList */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-list-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'form-control input-lg', 'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'sername'); ?>
		<?php echo $form->textField($model,'sername',array('class'=>'form-control input-lg', 'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'sername'); ?>
	</div>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'nicname'); ?>
		<?php echo $form->textField($model,'nicname',array('class'=>'form-control input-lg', 'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nicname'); ?>
	</div>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('class'=>'form-control input-lg', 'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('class'=>'form-control input-lg', 'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'mail'); ?>
		<?php echo $form->textField($model,'mail',array('class'=>'form-control input-lg', 'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mail'); ?>
	</div>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('class'=>'form-control input-lg', 'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'pass'); ?>
		<?php echo $form->passwordField($model,'pass',array('class'=>'form-control input-lg', 'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'pass'); ?>
	</div>

	<div class="col-sm-4 col-md-3 buttons mt10">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary input-lg')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->