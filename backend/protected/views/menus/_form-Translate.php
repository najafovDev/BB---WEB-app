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


        <?php $this->widget('application.components.CleanurlWidget',array(
                    'model'=>$model,
                    'cleanurl'=>$model->menu->getCleanurl($model->language),
                    'attr'=>'name',
                    'Lang'=>$model->language
                ));
        ?>

        <?php echo $form->hiddenField($model,'language',array('class'=>'form-control')); ?>

	<div class="col-sm-12">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>
        <?php 
            $modelTr = $model;
            $model = $model->menu->getContentTranslation($model->language);
            
            if ($model->name=='')
                $model->name = $modelTr->name;
        ?>
        <div class="clearfix"></div>
        <div class=" bg-success mt10 mb10"> 
            <h3 class="col-sm-12"><?php echo Yii::t('menus','Content related fields');?></h3>
            <div class="clearfix"></div>
        </div>
	<div class="col-sm-6">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="col-sm-6">
		<?php echo $form->labelEx($model,'summary'); ?>
		<?php echo $form->textArea($model,'summary',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'summary'); ?>
	</div>
	<div class="col-sm-6">
		<?php echo $form->hiddenField($model,'language'); ?>
	</div>

	<div class="col-sm-12">
		<?php echo $form->labelEx($model,'body'); ?>
                <?php  $this->widget('application.extensions.elrtef.elRTE', array( 
                                'model' => $model,
                                'attribute' => 'body',
                                'htmlOptions'=>array('id'=>  get_class($model).'_body_'.$model->language),
                                'options'=>array(
                                                    'fmAllow'=>true,
                                                    'fmOpen'=>'js:function(callback) {$("<div />").dialogelfinder(%elfopts%);}',//here used placeholder for settings
                                                    'absoluteURLs'=>true,
                                                    'allowSource' => true,
                                                ),
                 )); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-success pull-right')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

