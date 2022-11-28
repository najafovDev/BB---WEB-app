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

                    <div class="col-sm-4 field_category_id">
                            <?php echo $form->labelEx($model,'category_id'); ?>
                            <?php echo $form->dropDownList($model,'category_id',Category::model()->getList(),array('class'=>'form-control input-lg','empty'=>  Utilities::t('Choose...'))); ?>
                            <?php echo $form->error($model,'category_id'); ?>
                    </div>


                 <div class="col-sm-4 ">
                            <?php echo $form->labelEx($model,'brands_id'); ?>
                            <?php echo $form->dropDownList($model,'brands_id',  CHtml::listData(Brands::model()->findAll(array('order'=>'name asc')), 'id', 'name'),array('class'=>'form-control input-lg','empty'=>  Utilities::t('Choose...'))); ?>
                            <?php echo $form->error($model,'brands_id'); ?>
                    </div>
                    <div class="col-sm-4 ">
                            <?php echo $form->labelEx($model,'name'); ?>
                            <?php echo $form->textField($model,'name',array('class'=>'form-control input-lg','size'=>60,'maxlength'=>255)); ?>
                            <?php echo $form->error($model,'name'); ?>
                    </div>

<!--                    <div class="col-sm-2 field_wrapper field_price">
                            <?php echo $form->labelEx($model,'price'); ?>
                            <?php echo $form->textField($model,'price',array('class'=>'form-control input-lg','size'=>60,'maxlength'=>255)); ?>
                            <?php echo $form->error($model,'price'); ?>
                    </div>-->
<!--                    <div class="col-sm-2 field_wrapper field_price">
                            <?php echo $form->labelEx($model,'discount'); ?>
                            <?php echo $form->textField($model,'discount',array('class'=>'form-control input-lg','size'=>60,'maxlength'=>255)); ?>
                            <?php echo $form->error($model,'discount'); ?>
                    </div>-->
                    <div class="col-sm-2 hidden">
                            <?php echo $form->labelEx($model,'sort'); ?>
                            <?php echo $form->textField($model,'sort',array('class'=>'form-control input-lg')); ?>
                            <?php echo $form->error($model,'sort'); ?>
                    </div>


                    <div class="col-sm-3">
                        <div class="ckbox ckbox-primary">
                            <?php echo $form->checkBox($model,'new'); ?>
                            <?php echo $form->labelEx($model,'new'); ?>
                        </div>
                            <?php echo $form->error($model,'new'); ?>
                    </div>

          
                    <div class="col-sm-12">
                            <?php echo $form->labelEx($model,'body'); ?>
                            <?php echo $form->textArea($model,'body',array('class'=>'form-control input-lg')); ?>
                            <?php echo $form->error($model,'body'); ?>
                    </div>
                    <div class="clearfix"></div>

                    <?php // echo $form->hiddenField($model,'latitude');?>
                    <?php // echo $form->hiddenField($model,'longitude');?>
                    <div class="col-sm-12 buttons mt10">
                            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'input-lg btn btn-primary')); ?>
                    </div>

            <?php $this->endWidget(); ?>

            </div><!-- form -->
