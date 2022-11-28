
<div id="static" class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'products-translate-articlesTranslate-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data')
	
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<div class="delMenu">
			<a href="<?php if (isset($model1)) print $this->CreateUrl('site/delOffer',array('id'=>$model1->id)); else '#'; ?>">Delete </a>
	</div>
	<?php if (isset($model)) echo $form->errorSummary($model); ?>



	<div class="row">
		<script>
			$(document).ready(function(){
				$('#Offers_type').change(function(){
					if ($('#Offers_type').val()=='partner')
						$('.phoneRow').hide();
					else $('.phoneRow').show();
				});
			});
		</script>
		<?php echo $form->labelEx($model1,'type'); ?>
		<?php echo $form->dropDownList($model1,'type',array('empty'=>'-------','offer'=>'offer','partner'=>'partner')); ?>
		<?php echo $form->error($model1,'type'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model1,'name'); ?>
		<?php echo $form->textField($model1,'name'); ?>
		<?php echo $form->error($model1,'name'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model1,'body'); ?>
		<?php echo $form->textArea($model1,'body'); ?>
		<?php echo $form->error($model1,'body'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model1,'pic_name'); ?>
		<?php echo $form->fileField($model1,'pic_name'); ?>
		<?php echo $form->error($model1,'pic_name'); ?>
	</div>
	<div class="row phoneRow">
		<?php echo $form->labelEx($model1,'phone'); ?>
		<?php echo $form->textField($model1,'phone'); ?>
		<?php echo $form->error($model1,'phone'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model1,'website'); ?>
		<?php echo $form->textField($model1,'website'); ?>
		<?php echo $form->error($model1,'website'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
