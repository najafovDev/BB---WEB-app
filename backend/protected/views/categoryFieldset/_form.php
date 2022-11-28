<?php
/* @var $this CategoryFieldsetController */
/* @var $model CategoryFieldset */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-fieldset-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="col-sm-6 mb30">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="col-sm-6 mb30">
		<?php echo $form->labelEx($model,'type'); ?>
                <?php echo $form->dropDownList($model,'type',$model->getListData(),array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
        <?php if (isset($this->settings['feature_fieldGroup']) && $this->settings['feature_fieldGroup']):?>
            <div class="col-sm-6">
                <div class="ckbox ckbox-primary">
                    <?php echo $form->checkBox($model,'group'); ?>
                    <?php echo $form->labelEx($model,'group'); ?>
                    <?php echo $form->error($model,'group'); ?>
                </div>
            </div>
            <div class="col-sm-6">
                    <?php echo $form->labelEx($model,'parent_id'); ?>
                    <?php echo $form->dropDownList($model,'parent_id',CHtml::listData(CategoryFieldset::model()->findAllByAttributes(array('parent_id'=>null,'group'=>1)),'id','name'),array('empty'=>'Leave blank if not group', 'class'=>'form-control input-lg')); ?>
                    <?php echo $form->error($model,'parent_id'); ?>
            </div>
        <?php endif;?>
	<div class=" col-sm-12">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn-primary btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
