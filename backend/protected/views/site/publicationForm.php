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
			<a href="<?php if (isset($model)&&$model1->type=='publication') print $this->CreateUrl('site/delPublication',array('language'=>$lang,'id'=>$model->articles_id)); else '#'; ?>">Delete </a>
	</div>
	<?php if (isset($model)) echo $form->errorSummary($model); ?>


		
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
				<?php echo $form->labelEx($model1,'carousel'); ?>
				<?php echo $form->dropDownlist($model1,'carousel',array(0=>'Do not show', 1=>'Show')); ?>
				<?php echo $form->error($model1,'carousel'); ?>
		<?php endif; ?>
	</div>

	<div class="row">
		<?php if (isset($model1)): ?>
				<?php echo $form->labelEx($model1,'pic_name'); ?>
				<?php echo $form->fileField($model1,'pic_name',array('style'=>'width:200px')); ?>
				<?php echo $form->error($model1,'pic_name'); ?>
				<img height=50 src="<?="/images/menu/".$model1->pic_name;?>"/>
		<?php endif; ?>
	</div>
	<div class="row">
		<?php if (isset($model1)): ?>
				<?php echo $form->labelEx($model1,'file_name'); ?>
				<?php echo $form->fileField($model1,'file_name',array('style'=>'width:200px')); ?>
				<?php echo $form->error($model1,'file_name'); ?>
				<a href="<?="/images/pdf/".$model1->file_name;?>" alt="" >File</a>
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
		<?php echo $form->hiddenField($model,'articles_id'); ?>
		<?php echo $form->error($model,'articles_id'); ?>
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




	<?php if (isset($model1) && $model1->type=='docs') : ?>
	<div class="row">
		<?php echo $form->labelEx($model1,'date'); ?>
		<?php echo $form->textField($model1,'date'); ?>
		<?php echo $form->error($model1,'date'); ?>
	</div>
	<?php endif; ?>



	<?php if (isset($model)) : ?>
	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body'); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>
	<?php endif; ?>



<?php $this->endWidget(); ?>

</div><!-- form -->
