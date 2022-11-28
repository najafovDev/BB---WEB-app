<?php
/* @var $this ItemsStockController */
/* @var $model ItemsStock */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'items-stock-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <?php if (!$model->item_id):?>
            <div class="col-sm-4">
                    <?php echo $form->labelEx($model,'item_id'); ?>
                    <?php echo $form->dropDownList($model,'item_id',  CHtml::listData(Items::model()->findAll(array('order'=>'t.name asc')), 'id', 'name'),array('class'=>'form-control input-lg')); ?>
                    <?php echo $form->error($model,'item_id'); ?>
            </div>
        <?php endif;?>
	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'artikul'); ?>
		<?php echo $form->textField($model,'artikul',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'artikul'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'artikul2'); ?>
		<?php echo $form->textField($model,'artikul2',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'artikul2'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'barcode'); ?>
		<?php echo $form->textField($model,'barcode',array('size'=>60,'maxlength'=>255,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'barcode'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'color_id'); ?>
		<?php echo $form->dropDownList($model,'color_id',  CHtml::listData(Colors::model()->findAll(array('order'=>'t.name asc')), 'id', 'name'),array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'color_id'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'size'); ?>
		<?php echo $form->textField($model,'size',array('size'=>60,'maxlength'=>255,'class'=>'input-lg form-control')); ?>
		<?php echo $form->error($model,'size'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'discount'); ?>
		<?php echo $form->textField($model,'discount',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'discount'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'stock'); ?>
		<?php echo $form->textField($model,'stock',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'stock'); ?>
	</div>

	<div class="col-sm-12 buttons mt10">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary input-lg')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->