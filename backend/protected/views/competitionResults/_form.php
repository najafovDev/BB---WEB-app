<?php
/* @var $this CompetitionResultsController */
/* @var $model CompetitionResults */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'competition-results-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'compt_id'); ?>
		<?php echo $form->dropDownList($model,'compt_id',CHtml::listData(CompetitionSchedule::model()->findAll(array('order'=>'title asc')), 'id', 'title'),array('class'=>'chosen-select form-control input-lg')); ?>
		<?php echo $form->error($model,'compt_id'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="col-sm-2">
		<?php echo $form->labelEx($model,'balance'); ?>
		<?php echo $form->textField($model,'balance',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'balance'); ?>
	</div>

	<div class="col-sm-2">
		<?php echo $form->labelEx($model,'equity'); ?>
		<?php echo $form->textField($model,'equity',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'equity'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php  $this->widget('booster.widgets.TbDatePicker',array(
                    'model'=>$model,
                    'attribute'=>'date',
                    'form'=>$form,
                    'options'=>array(
                        'language'=>'en',//$this->Lang,
                        'format'=>'yyyy-mm-dd',
                        'autoclose'=>true,
                        'todayHighlight'=>true,
                    ),
                    'htmlOptions'=>array(
                        'class'=>'form-control'
                    )
                )); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'place'); ?>
		<?php echo $form->textField($model,'place',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'place'); ?>
	</div>
	<div class="col-sm-12 mb10">
		<?php echo $form->labelEx($model,'statement'); ?>
                <div class=" fileupload fileupload-new" data-provides="fileupload">
                    <div class="input-append ">
                          <div class="uneditable-input" data-trigger="fileupload">
                              <i class="glyphicon glyphicon-file fileupload-exists"></i>
                              <span class="fileupload-preview"></span>
                          </div>
                          <span class="btn btn-default btn-file">
                              <span class="fileupload-new" data-trigger="fileupload">Select file</span>
                              <span class="fileupload-exists" data-trigger="fileupload">Change</span>
                              <?php echo $form->fileField($model,'statement',array('class'=>'form-control hide')); ?>
                          </span>
                          <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                          <?php echo CHtml::link($model->statement,"/uploaded/results/".$model->statement,array("target"=>"_blank"));?>
                    </div>
                </div>                
		<?php echo $form->error($model,'statement'); ?>
	</div>
	<div class="col-sm-12 buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'input-lg btn btn-primary')); ?>
		<?php echo $model->isNewRecord?'':CHtml::link('Return to competition',$this->createUrl('competitionSchedule/update',array('id'=>$model->compt_id)),array('class'=>'input-lg btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->