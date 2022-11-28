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



	<div class="row">
		<?php echo $form->labelEx($model,'topic'); ?>
		<?php echo $form->textField($model,'topic',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'topic'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textArea($model,'link',array('class'=>'form-control','maxlength'=>255)); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>
	<div class="row">
		<?php echo $form->hiddenField($model,'language'); ?>
		<?php echo $form->hiddenField($model,'parent_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
                <?php  $this->widget('application.extensions.elrtef.elRTE', array( 
                                'model' => $model,
                                'attribute' => 'content',
                                'htmlOptions'=>array('id'=>  get_class($model).'_content_'.$model->language),
                                'options'=>array(
                                                    'fmAllow'=>true,
                                                    'fmOpen'=>'js:function(callback) {$("<div />").dialogelfinder(%elfopts%);}',//here used placeholder for settings
                                                    'absoluteURLs'=>true,
                                                    'allowSource' => true,
                                                ),
                 )); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-success pull-right')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->