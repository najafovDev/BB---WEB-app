<?php
/* @var $this BannersController */
/* @var $model Banners */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'banners-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="col-sm-4 mb30 mt10">
		<?php echo $form->labelEx($model,'sort'); ?>
		<?php echo $form->textField($model,'sort',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'sort'); ?>
	</div>
	<div class="col-sm-4 mb30 mt10">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',$model->types(),array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="col-sm-4 mb30 mt10">
		<?php echo $form->labelEx($model,'pic_name'); ?>
		<?php echo $form->fileField($model,'pic_name',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'pic_name'); ?>
                <?php if ($model->pic_name):?>
                    <?php echo CHtml::image($this->baseUrl.$model->pic_name,'',array('width'=>440));?>
                <?php endif;?>
	</div>
        <div class="clearfix"></div>

	<div class=" buttons col-xs-2 mt10">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'form-control input-lg btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->