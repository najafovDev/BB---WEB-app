<?php
/* @var $this CustomersController */
/* @var $model Customers */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('MfeCActiveForm', array(
	'id'=>'customers-form',
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
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',$model->getUserTypes(),array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
	<div class="col-sm-4 mb30 mt10">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<div class="col-sm-4 mb30 mt10">
		<?php echo $form->labelEx($model,'surname'); ?>
		<?php echo $form->textField($model,'surname',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'surname'); ?>
	</div>

        <div class="col-sm-4 nopal mb30 mt10">
                <?php echo $form->labelEx($model,'phone'); ?>
                <a href="javascript:void(0);" onclick="addPhone()">
                    <span class="add-phone glyphicon glyphicon-plus"></span>
                </a>
                <div class=" nopal">
                        <?php echo $form->textField($model,'phone',array('class'=>'form-control input-lg')); ?>
                </div>
        </div>
	<div class="col-sm-4 mb30 mt10">
		<?php echo $fmrom->labelEx($model,'website'); ?>
		<?php echo $form->textField($model,'website',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'website'); ?>
	</div>

        <div class="col-sm-4 mb30 mt10">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>


	<div class="col-sm-4 mb30 mt10">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'form-control input-lg','value'=>'')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<div class="col-sm-12 mb30 mt10">
		<?php echo $form->labelEx($model,'pic_name'); ?>
		<?php echo $form->styledFileField($model,'pic_name'); ?>
		<?php echo $form->error($model,'pic_name'); ?>
	</div>
	<div class="col-sm-4 mb30 mt10">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->checkBox($model,'active',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="col-sm-4 mb30 mt10">
		<?php echo $form->labelEx($model,'email_confirmed'); ?>
		<?php echo $form->checkBox($model,'email_confirmed',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'email_confirmed'); ?>
	</div>

	<div class="col-sm-4 mb30 mt10">
		<?php echo $form->labelEx($model,'subscribe'); ?>
		<?php echo $form->checkBox($model,'subscribe',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'subscribe'); ?>
	</div>



        <div class="col-sm-12 buttons mt10">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'input-lg btn btn-primary')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
function addPhone(){
    if ($('.custom-phone').length + 1 >3) return;
    tmp = $('.custom-phone').last().clone();
    id = $('.custom-phone').length + 1;
    $(tmp).find('select').attr('name','Phones['+(id)+'][prefix]');
    $(tmp).find('select').attr('id','Phones_'+id+'_prefix');
    $(tmp).find('select').val([]);
    $(tmp).find('input[type=hidden]').remove();
    $(tmp).find('input').attr('name','Phones['+id+'][phone]');
    $(tmp).find('input').val('');
    $('.custom-phone').last().after(tmp);
//    $(tmp).find('.bootstrap-select').remove();
//    $('.custom-phone').last().find('select').selectpicker();
    
}
    
</script>    