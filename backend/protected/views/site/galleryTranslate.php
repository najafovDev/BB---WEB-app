<div id="static" class="form">
<?php 		
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'gallery-translate-galleryTranslate-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data')
	
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php if (isset($model1)):?>
			<div class="delMenu">
					<a href="<?php  print $this->CreateUrl('site/delImage',array('language'=>$lang,'id'=>$model1->id)); ?>">Delete </a>
			</div>
	<?php endif; ?>
	<?php if (isset($model)) echo $form->errorSummary($model); ?>

		<?php if (isset($model1->id)): ?>
		<a href="<?php print $imgUpl['gallery'].$model1->pic_name; ?>" target="_blank"><img width="150" src="<?php print $imgUpl['gallery'].$model1->pic_name; ?>"/></a>
		<?php endif; ?>

	<?php if (isset($model1)) : ?>
        <div class="row">
                <?php echo $form->labelEx($model1,'pic_name'); ?>
                <?php echo $form->fileField($model1,'pic_name'); ?>
                <?php echo $form->error($model1,'pic_name'); ?>
        </div>
	<?php endif; ?>
		



	<?php if (isset($model)) : ?>
	<div class="row">
		<?php //echo $form->labelEx($model,'language'); ?>
		<?php echo $form->hiddenField($model,'language'); ?>
		<?php echo $form->error($model,'language'); ?>
	</div>
	<?php endif; ?>


	<?php if (isset($model1)) : ?>
	<div class="row">
		<?php echo $form->labelEx($model1,'parent_id'); ?>
		<?php
				$criteria = new CDbCriteria;
				$fa=Menus::model()->with()->findAll($criteria);
				print $model1->parent_id;
				$ld = array();
				$ld[0] = "<--Please select-->";
				foreach($fa as $f) {
					$ld[$f->id] = (isset($f->translations[$lang])?$f->translations[$lang]->name:$f->id);
				}
				
				unset($fa);

				echo CHtml::activeDropDownList($model1,'parent_id',$ld);
				unset($ld);

		?>
		<?php echo $form->error($model1,'parent_id'); ?>

	</div>
	<?php endif; ?>




	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->