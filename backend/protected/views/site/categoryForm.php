
<div id="static" class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'products-translate-articlesTranslate-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data')
	
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<div class="delMenu">
			<a href="<?php if (isset($model1)) print $this->CreateUrl('site/delColor',array('id'=>$model1->id)); else '#'; ?>">Delete </a>
	</div>
	<?php if (isset($model)) echo $form->errorSummary($model); ?>


	<?php if (isset($model1)) : ?>
	<div class="row">
		<?php echo $form->labelEx($model1,'name'); ?>
		<?php echo $form->textField($model1,'name'); ?>
		<?php echo $form->error($model1,'name'); ?>
	</div>
	<?php endif; ?>
	
	<?php if (isset($model1)) : ?>
	<div class="row">
		<?php echo $form->labelEx($model1,'parent_id'); ?>
		<?php echo $form->dropDownList($model1,'parent_id',Category::getList()); ?>
		<?php echo $form->error($model1,'parent_id'); ?>
	</div>
	<?php endif; ?>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
