<h1><?php echo Yii::t('system','Registration');?></h1>
	<div class="register">

			<div class="">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'login-form',
				'enableAjaxValidation'=>false,
			)); ?>
				<div class="row inputs  ">
					<?php echo $form->labelEx($model,'name'); ?>
					<?php echo $form->textField($model,'name'); ?>
				</div>
				<div class="row inputs  ">
					<?php echo $form->labelEx($model,'uname'); ?>
					<?php echo $form->textField($model,'uname'); ?>
				</div>
				<div class="row inputs ">
					<? $model->pass ='';?>
					<?php echo $form->labelEx($model,'pass'); ?>
					<?php echo $form->passwordField($model,'pass',array('placeholder'=>'nümunə: 1234567')); ?>
				</div>
				<div class="row inputs ">
					<? $model->pass2 ='';?>
					<?php echo $form->labelEx($model,'pass2'); ?>
					<?php echo $form->passwordField($model,'pass2',array('placeholder'=>'nümunə: 1234567')); ?>
				</div>
				<div class="row inputs ">
					<?php echo $form->labelEx($model,'email'); ?>
					<?php echo $form->textField($model,'email',array('placeholder'=>'numune@box.az')); ?>
				</div>
				<div class="row inputs ">
					<?php echo $form->labelEx($model,'phone'); ?>
					<?php echo $form->textField($model,'phone'); ?>
				</div>

				<div class="clearfix"></div>
				<div class="row buttons ">
					<?php echo CHtml::submitButton('QEYDİYYAT'); ?>
				</div>
				<div class="clearfix"></div>

			<?php $this->endWidget(); ?>
			</div><!-- form -->
	</div>
	
 
