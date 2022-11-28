<div id="partner_form">
		<div id="left">
					<div class="delBanner delete">
							<? if (isset($model)):?>
									<a href="<?=$this->createUrl('site/delBanner',array('id'=>$model->id));?>">
											Delete Banner
									</a>
							<? endif; ?>
					</div>
				
					<div class="form">

					<?php $form=$this->beginWidget('CActiveForm', array(
						'id'=>'banners-bannersForm-form',
						'enableAjaxValidation'=>false,
						'htmlOptions'=>array('enctype' => 'multipart/form-data')						
					)); ?>

						<p class="note">Fields with <span class="required">*</span> are required.</p>
						<?=$form->errorSummary($model);?>
						<div class="row">
							<?php if ($model->pic_name!=''): ?>
							<a style="margin: 15px 0 ;display:block;" href="<?=$imgUpl['banners'].'/'.$model->pic_name;?>" target="_blank" >
									<img src="<?=$imgUpl['banners'].'/'.$model->pic_name;?>" alt="" width="250" />
							</a>
							<?php endif; ?>
							<?php echo $form->labelEx($model,'pic_name'); ?>
							<?php echo $form->fileField($model,'pic_name'); ?>
							<?php echo $form->error($model,'pic_name'); ?>
						</div>

						<? if (isset($model1)):?>
							<div class="row">
								<?php echo $form->labelEx($model1,'link'); ?>
								<?php echo $form->textField($model1,'link'); ?>
								<?php echo $form->error($model1,'link'); ?>
							</div>
							<div class="row">
								<?php echo $form->labelEx($model1,'topic'); ?>
								<?php echo $form->textArea($model1,'topic'); ?>
								<?php echo $form->error($model1,'topic'); ?>
							</div>
							<div class="row">
								<?php echo $form->labelEx($model1,'content'); ?>
								<?php echo $form->textArea($model1,'content'); ?>
								<?php echo $form->error($model1,'content'); ?>
							</div>
						<? endif;?>							
						<div class="row">
							<?php echo $form->labelEx($model,'sort'); ?>
							<?php echo $form->textField($model,'sort'); ?>
							<?php echo $form->error($model,'sort'); ?>
						</div>

						<div class="row buttons">
							<?php echo CHtml::submitButton('Submit'); ?>
						</div>

						

					<?php $this->endWidget(); ?>

					</div><!-- form -->
		</div>
	
</div>