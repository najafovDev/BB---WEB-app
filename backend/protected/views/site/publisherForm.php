<style >

.gallImage{
	position:relative;
	display:inline-block;
}
.delNA{
	font-family:Arial;
	cursor:pointer;
	top:-12px;
	left:0px;
	position:absolute;
	color:red;
	font-weight:bolder;

}

.delBS{
	font-family:Arial;
	cursor:pointer;
	top:10px;
	left:160px;
	position:relative;
	color:red;
	font-weight:bolder;

}

.gallDel {
	cursor:pointer;
	top:0px;
	left:5px;
	position:absolute;
	color:red;
	font-weight:bolder;
}
</style>


<div id="static" class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'articles-translate-articlesTranslate-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data')
	
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>
	<div class="delMenu">
			<a href="<?php if (isset($model)) print $this->CreateUrl('site/delPublisher',array('language'=>$lang,'id'=>$model->parent_id)); else '#'; ?>">Delete </a>
	</div>
	<?php if (isset($model)) echo $form->errorSummary($model); ?>
	<?php if (isset($model1)) echo $form->errorSummary($model1); ?>


		
	<?php if (isset($model1)) : ?>
    <div class="row">
        <?php echo $form->labelEx($model1,'parent_id'); ?>
		<? $ld = CHtml::listData($parents,'id','keyword');?>
		<?=$form->dropDownList($model1,'parent_id',$ld,array('empty'=>'Choose One'));?>
        <?php echo $form->error($model1,'parent_id'); ?>
    </div>
	<?php endif; ?>


	<div class="row">
		<?php if (isset($model1)): ?>
				<?php echo $form->labelEx($model1,'pic_name'); ?>
				<?php echo $form->fileField($model1,'pic_name',array('style'=>'width:200px')); ?>
				<?php echo $form->error($model1,'pic_name'); ?>
				<img height=50 src="<?="/images/publishers/".$model1->pic_name;?>"/>
		<?php endif; ?>
	</div>
	<div class="row">
		<?php if (isset($model1)): ?>
				<?php echo $form->labelEx($model1,'phone'); ?>
				<?php echo $form->textField($model1,'phone'); ?>
				<?php echo $form->error($model1,'phone'); ?>
		<?php endif; ?>
	</div>
	<div class="row">
		<?php if (isset($model1)): ?>
				<?php echo $form->labelEx($model1,'fax'); ?>
				<?php echo $form->textField($model1,'fax'); ?>
				<?php echo $form->error($model1,'fax'); ?>
		<?php endif; ?>
	</div>
	<div class="row">
		<?php if (isset($model1)): ?>
				<?php echo $form->labelEx($model1,'link'); ?>
				<?php echo $form->textField($model1,'link'); ?>
				<?php echo $form->error($model1,'link'); ?>
		<?php endif; ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'id'); ?>
		<?php //echo $form->textField($model,'id'); ?>
		<?php //echo $form->error($model,'id'); ?>
	</div>

	<?php if (isset($model)) : ?>
	<div class="row">	
		<?php //echo $form->labelEx($model,'articles_id'); ?>
		<?php echo $form->hiddenField($model,'parent_id'); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>
	<?php endif; ?>

	<?php if (isset($model)) : ?>
	<div class="row">
		<?php //echo $form->labelEx($model,'language'); ?>
		<?php echo $form->hiddenField($model,'language'); ?>
		<?php echo $form->error($model,'language'); ?>
	</div>
	<?php endif; ?>

	<?php if (isset($model)) : ?>
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<?php endif; ?>





	<?php if (isset($model)) : ?>
	<div class="row">
		<?php echo $form->labelEx($model,'teaser'); ?>
		<?php echo $form->textArea($model,'teaser'); ?>
		<?php echo $form->error($model,'teaser'); ?>
	</div>
	<?php endif; ?>



<?php $this->endWidget(); ?>

</div><!-- form -->
