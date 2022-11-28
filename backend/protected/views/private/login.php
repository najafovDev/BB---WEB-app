<?php
$this->pageTitle=Yii::app()->name . ' - Login';
?>
<h1><?php echo Yii::t('system','Login');?></h1>
	<div class="register">
		<div class="form">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'login-form',
				'enableAjaxValidation'=>false,
			)); ?>

				<div class="row inputs">
					<?php echo $form->labelEx($model,'username'); ?>
					<?php echo $form->textField($model,'username'); ?>
				</div>

				<div class="row inputs">
					<?php echo $form->labelEx($model,'password'); ?>
					<?php echo $form->passwordField($model,'password'); ?>
				</div>


				<div class="row buttons left">
					<?php echo CHtml::submitButton('Daxil ol'); ?>
				</div>
				<div class="row forgot right">
					<a href="<?=$this->createUrl('private/forgotpassword');?>">Şifrəmi unutdum</a>
				</div>
				<div class="clearfix"></div>

			<?php $this->endWidget(); ?>
		</div><!-- form -->
	</div>

 
