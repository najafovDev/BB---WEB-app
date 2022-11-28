<?php
/* @var $this SourceMessageController */
/* @var $model SourceMessage */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'source-message-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="col-sm-6">
		<?php echo $form->labelEx($model,'category'); ?>
                <?php 
                    $ld = $model->getModules();
                ?>
		<?php echo $form->dropDownList($model,'category',$ld,array('class'=>'form-control chosen-select')); ?>
            
		<?php echo $form->error($model,'category'); ?>
	</div>

	<div class="col-sm-6">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textField($model,'message',array('rows'=>6, 'cols'=>50,'class'=>'form-control ')); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>

	<div class="col-sm-12 buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->