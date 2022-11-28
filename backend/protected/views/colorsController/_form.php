<?php
/* @var $this ColorsControllerController */
/* @var $model Colors */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'colors-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'rgb'); ?>
		<?php echo $form->textField($model,'rgb',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'rgb'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'pic_name'); ?>
		<?php echo $form->textField($model,'pic_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'pic_name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success pull-right')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->