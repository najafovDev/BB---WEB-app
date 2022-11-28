<?php
/* @var $this QuotePairsController */
/* @var $model QuotePairs */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'quote-pairs-form',
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
		<?php echo $form->labelEx($model,'ps'); ?>
		<?php echo $form->textField($model,'ps',array('class'=>'form-control input-lg', 'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ps'); ?>
	</div>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'v'); ?>
		<?php echo $form->textField($model,'v',array('class'=>'form-control input-lg', 'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'v'); ?>
	</div>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'broker_percent_long'); ?>
		<?php echo $form->textField($model,'broker_percent_long',array('class'=>'form-control input-lg', 'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'broker_percent_long'); ?>
	</div>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'broker_percent_short'); ?>
		<?php echo $form->textField($model,'broker_percent_short',array('class'=>'form-control input-lg', 'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'broker_percent_short'); ?>
	</div>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'coefficient'); ?>
		<?php echo $form->textField($model,'coefficient',array('class'=>'form-control input-lg', 'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'coefficient'); ?>
	</div>
        <div class="clearfix"></div>
	<div class="col-sm-4 col-md-3 buttons mt10">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary input-lg')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->