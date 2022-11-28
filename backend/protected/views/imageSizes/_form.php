<?php
/* @var $this ImageSizesController */
/* @var $model ImageSizes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'image-sizes-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <div class="col-sm-4">
                <?php echo $form->labelEx($model,'parent_id'); ?>
                <?php echo $form->dropDownList($model,'parent_id',CHtml::listData(Modules::model()->findAll(),'id','name'),array('class'=>'form-control input-lg')); ?>
                <?php echo $form->error($model,'parent_id'); ?>
        </div>

        <div class="col-sm-4">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

        <div class="col-sm-4">
		<?php echo $form->labelEx($model,'width'); ?>
		<?php echo $form->textField($model,'width',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'width'); ?>
	</div>

        <div class="col-sm-4">
		<?php echo $form->labelEx($model,'height'); ?>
		<?php echo $form->textField($model,'height',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'height'); ?>
	</div>

        <div class="col-sm-4">
		<?php echo $form->labelEx($model,'crop_location'); ?>
		<?php echo $form->textField($model,'crop_location',array('class'=>'form-control input-lg','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'crop_location'); ?>
	</div>

        <div class="col-sm-4">
		<?php echo $form->labelEx($model,'w'); ?>
		<?php echo $form->textField($model,'w',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'w'); ?>
	</div>

        <div class="col-sm-4">
		<?php echo $form->labelEx($model,'keep_aspect'); ?>
		<?php echo $form->textField($model,'keep_aspect',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'keep_aspect'); ?>
	</div>
        <div class="clearfix"></div>
	<div class=" buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->