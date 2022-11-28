<?php
/* @var $this ContentController */
/* @var $model Menus */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'menus-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'parent_id'); ?>: 
                <?php echo ($model->parent_id>0?$model->getparent->getTranslation($this->Lang)->name:$model->parent_id);?>
		<?php //echo $form->textField($model,'parent_id',array('class'=>'form-control')); ?>
		<?php //echo $form->error($model,'parent_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'pic_name'); ?>
		<?php //echo $form->textField($model,'pic_name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php //echo $form->error($model,'pic_name'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'banner'); ?>
		<?php //echo $form->textField($model,'banner',array('class'=>'form-control')); ?>
		<?php //echo $form->error($model,'banner'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'sort'); ?>
		<?php //echo $form->textField($model,'sort',array('class'=>'form-control')); ?>
		<?php //echo $form->error($model,'sort'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'keyword'); ?>
		<?php echo $form->textField($model,'keyword',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'keyword'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-success pull-right')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->