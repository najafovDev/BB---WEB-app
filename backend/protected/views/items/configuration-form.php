<?php
/* @var $this ItemsController */
/* @var $model Items */
/* @var $form CActiveForm */
?>

            <div class="form" >

            <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'items-form',
                    // Please note: When you enable ajax validation, make sure the corresponding
                    // controller action is handling ajax validation correctly.
                    // There is a call to performAjaxValidation() commented in generated controller code.
                    // See class documentation of CActiveForm for details on this.
                    'enableAjaxValidation'=>false,
                    'htmlOptions'=>array('enctype' => 'multipart/form-data'),
            )); ?>

                    <p class="note">Fields with <span class="required">*</span> are required.</p>

                    <?php echo $form->errorSummary($model); ?>
                    <div class="col-sm-2">
                            <?php echo $form->labelEx($model,'pic_name'); ?>
                            <?php echo $form->fileField($model,'pic_name',array('class'=>'form-control input-lg')); ?>
                            <?php echo $form->error($model,'pic_name'); ?>
                            <?php echo CHtml::image($model->getImage(),'',array('height'=>40));?>
                    </div>
                    <div class="col-sm-2">
                            <?php echo $form->labelEx($model,'schema_pic'); ?>
                            <?php echo $form->fileField($model,'schema_pic',array('class'=>'form-control input-lg')); ?>
                            <?php echo $form->error($model,'schema_pic'); ?>
                            <?php echo CHtml::image($model->getImage('','schema_pic'),'',array('height'=>40));?>
                    </div>
                    <div class="col-sm-2">
                            <?php echo $form->labelEx($model,'price'); ?>
                            <?php echo $form->textField($model,'price',array('class'=>'form-control input-lg')); ?>
                            <?php echo $form->error($model,'price'); ?>
                    </div>

                    <div class="col-sm-2">
                            <?php echo $form->labelEx($model,'title'); ?>
                            <?php echo $form->textField($model,'title',array('class'=>'form-control input-lg')); ?>
                            <?php echo $form->error($model,'title'); ?>
                    </div>
                    <div class="col-sm-2">
                            <?php echo $form->labelEx($model,'general_area'); ?>
                            <?php echo $form->textField($model,'general_area',array('class'=>'form-control input-lg')); ?>
                            <?php echo $form->error($model,'general_area'); ?>
                    </div>
                    <div class="col-sm-2">
                            <?php echo $form->labelEx($model,'living_area'); ?>
                            <?php echo $form->textField($model,'living_area',array('class'=>'form-control input-lg')); ?>
                            <?php echo $form->error($model,'living_area'); ?>
                    </div>
                    <div class="col-sm-2">
                            <?php echo $form->labelEx($model,'rooms'); ?>
                            <?php echo $form->textField($model,'rooms',array('class'=>'form-control input-lg')); ?>
                            <?php echo $form->error($model,'rooms'); ?>
                    </div>
                    <div class="col-sm-2">
                            <?php echo $form->labelEx($model,'balconies'); ?>
                            <?php echo $form->textField($model,'balconies',array('class'=>'form-control input-lg')); ?>
                            <?php echo $form->error($model,'balconies'); ?>
                    </div>
                    <div class="col-sm-2">
                            <?php echo $form->labelEx($model,'bathrooms'); ?>
                            <?php echo $form->textField($model,'bathrooms',array('class'=>'form-control input-lg')); ?>
                            <?php echo $form->error($model,'bathrooms'); ?>
                    </div>

                    <div class="col-sm-12 buttons mt10">
                            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'input-lg btn btn-primary')); ?>
                    </div>

            <?php $this->endWidget(); ?>

            </div><!-- form -->
