<?php
/* @var $this MessageController */
/* @var $model Message */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'message-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); 
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class=" col-sm-6">
		<?php echo $form->labelEx($model,'id'); ?>
                <?php 
                    $sm = SourceMessage::model()->findAll(array('order'=>'message asc'));
                    $ld = CHtml::listData($sm, 'id', 'message');
                ?>
            
		<?php echo $form->dropDownList($model,'id',$ld,array('class'=>'form-control chosen-select')); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class=" col-sm-6">
		<?php echo $form->labelEx($model,'language'); ?>
		<?php echo $form->dropDownList($model,'language',$this->languages,array('class'=>'form-control input-lg chosen-select')); ?>
		<?php echo $form->error($model,'language'); ?>
	</div>

	<div class=" col-sm-12">
		<?php echo $form->labelEx($model,'translation'); ?>
		<?php echo $form->textField($model,'translation',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'translation'); ?>
	</div>
        <br>
	<div class=" buttons col-sm-12">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

