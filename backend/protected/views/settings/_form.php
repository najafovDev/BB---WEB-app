<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'settings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'attribute'); ?>
		<?php echo $form->textField($model,'attribute',array('size'=>60,'maxlength'=>255,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'attribute'); ?>
	</div>

	<div class="col-sm-8">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textField($model,'value',array('size'=>60,'maxlength'=>600,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>

	<div class=" col-sm-12">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'input-lg btn btn-primary mt10')); ?>
	</div>
        <div class="clearfix"></div>
<?php $this->endWidget(); ?>

</div><!-- form -->