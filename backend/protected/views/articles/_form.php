<?php
/* @var $this ArticlesController */
/* @var $model Articles */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'articles-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


        
	<div class="col-sm-6">
		<?php //echo $form->labelEx($model,'pic_name'); ?>
		<?php //echo $form->fileField($model,'pic_name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php //echo $form->error($model,'pic_name'); ?>
	</div>

	<div class="col-sm-12">
            <?php echo CHtml::label('Author', 'Articles_brands_rel');//print_r($model->n2nrel)?>
            <?php echo CHtml::dropDownList('Articles[n2nrel_ids][Brands]', 
                                            $model->getN2nrel_ids('Brands'), 
                                            CHtml::listData(Brands::model()->findAll(array('order'=>'name asc')),'id','name'), 
                                            array('class'=>'chosen-select','multiple'=>true,'id'=>'Articles_brands_rel','data-placeholder'=>'Select Brands'));?>
	</div>
	<div class="col-sm-12">
            <?//php echo CHtml::label('Categories', 'Articles_category_rel');//print_r($model->getN2nrel_ids('Category'));?>
            <?//php echo CHtml::dropDownList('Articles[n2nrel_ids][Category]', 
                                     //       $model->getN2nrel_ids('Category'), 
                                     //       CHtml::listData(Category::model()->findAll(array('order'=>'name asc')),'id','name'), 
                                      //      array('class'=>'chosen-select','multiple'=>true,'id'=>'Articles_category_rel','data-placeholder'=>'Select Categories'));?>
	</div>
	<div class="col-sm-12">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php  $this->widget('booster.widgets.TbDateTimePicker',array(
                    'model'=>$model,
                    'attribute'=>'date',
                    'form'=>$form,
                    'options'=>array(
                        'language'=>'en',//$this->Lang,
						'changeMonth' => true,
						'changeYear' => true,
                        'autoclose'=>true,
                        'todayHighlight'=>true,
                    ),
                    'htmlOptions'=>array(
                        'class'=>'form-control'
                    )
                )); ?>
		<?php echo $form->error($model,'right'); ?>
	</div>


	<div class="col-sm-12">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->