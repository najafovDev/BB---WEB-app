<?php
/* @var $this BrandsController */
/* @var $model Brands */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'brands-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="col-sm-6">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<div class="col-sm-6">
		<?php echo $form->labelEx($model,'sort'); ?>
		<?php echo $form->textField($model,'sort',array('size'=>60,'maxlength'=>255,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'sort'); ?>
	</div>

	<div class="col-sm-12 mb30 mt10">
		<?php echo $form->labelEx($model,'logo'); ?>
		<?php echo $form->fileField($model,'logo',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'logo'); ?>
                <?php if ($model->logo!=''):?>
                    <?php echo CHtml::image('/uploads/brands/'.$model->logo,'',array('width'=>140));?>
                <?php endif;?>
	</div>

	<div class="col-sm-12 mb30 mt10">
		<?php //echo $form->labelEx($model,'logo_dark'); ?>
		<?php //echo $form->fileField($model,'logo_dark',array('class'=>'form-control input-lg')); ?>
		<?php //echo $form->error($model,'logo_dark'); ?>
                <?php if ($model->logo_dark!=''):?>
                    <?php echo CHtml::image('/uploads/brands/'.$model->logo_dark,'',array('width'=>140));?>
                <?php endif;?>
	</div>

	<div class="col-sm-12">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary input-lg')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->