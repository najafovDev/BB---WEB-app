<?php
/* @var $this ItemsController */
/* @var $model Items */
/* @var $form CActiveForm */
?>

            <div class="form col-xs-6" >

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



                    <div class="">
                            <?php echo $form->labelEx($model,'file'); ?>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                              <div class="input-append">
                                <div class="uneditable-input">
                                  <i class="glyphicon glyphicon-file fileupload-exists"></i>
                                  <span class="fileupload-preview"></span>
                                </div>
                                <span class="btn btn-default btn-file">
                                  <span class="fileupload-new">Select file</span>
                                  <span class="fileupload-exists">Change</span>
                                        <?php echo $form->fileField($model,'file',array('class'=>'')); ?>
                                </span>
                                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                              </div>
                            </div>
                            <?php echo $form->error($model,'file'); ?>
                    </div>

                    <div class="">
                        <div class="ckbox ckbox-primary">
                            <?php echo $form->checkBox($model,'skip'); ?>
                            <?php echo $form->labelEx($model,'skip'); ?>
                        </div>
                    </div>
                    <div class="">
                        <div class="ckbox ckbox-primary">
                            <?php echo $form->checkBox($model,'includesHeaders'); ?>
                            <?php echo $form->labelEx($model,'includesHeaders'); ?>
                        </div>
                    </div>


                    <div class="col-sm-12 buttons nopa mt10">
                            <?php echo CHtml::submitButton('Import',array('class'=>'input-lg btn btn-primary')); ?>
                    </div>

            <?php $this->endWidget(); ?>

            </div><!-- form -->
            <div class="col-xs-6">
                <?php 
                    $models = ImportForm::model()->findAll(array('order'=>'t.date desc'));
                    foreach($models as $model):
                ?>
                    <div>
                         <?php  echo CHtml::link(date('Y-m-d h:i:s',  strtotime($model->date)),
                                                $model->getFileName(),array(
                                                ));
                        ?>
                         <?php  echo CHtml::link('Results',
                                                'javascript:void(0)',array(
                                                    'data-trigger'=>'focus',
                                                    'title'=>'Results',
                                                    'data-content'=>$model->results,
                                                    'data-toggle'=>'popover',
                                                    'data-html'=>true,
                                                    
                                                ));
                        ?>
                    </div>
                <?php endforeach;?>
            </div>
            <div class="clearfix"></div>
            <div>
                <?php echo $importResults;?>
            </div>
                