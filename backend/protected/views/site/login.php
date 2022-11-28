<? $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableAjaxValidation'=>true,
)); ?>
    <h4 class="nomargin">Sign In</h4>
    <p class="mt5 mb20">Login to access your account.</p>

    <?php echo $form->textField($model,'username',array('class'=>'form-control uname','placeholder'=>'Username')); ?>
    <?php echo $form->passwordField($model,'password',array('class'=>'form-control pword','placeholder'=>'Password')); ?>
     <a href="<?=$this->createUrl('private/forgotpassword');?>"><small>Forgot Your Password?</small></a>
    <?php echo CHtml::submitButton('Sign in',array('class'=>'btn btn-success btn-block')); ?>

<?php $this->endWidget(); ?>
