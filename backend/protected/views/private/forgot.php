<h1><?php echo Yii::t('system','Forgot Your Password?');?></h1>
<div>
    <? $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'register-form',
                    'action'=>$this->createUrl('private/forgotpassword'),
                    'enableAjaxValidation'=>true,
            'focus'=>array($model,'username'),
            'htmlOptions'=>array('enctype'=>'multipart/form-data'),
            'clientOptions'=>array(
               'validateOnSubmit'=>true,
               'validateOnChange'=>false,//this needs to stay on false always.
               'beforeValidate'=>"js:function(form){
                            return true;
               }",
               'afterValidate'=>"js:function(form, data, hasError){
                            if(hasError){
                                    //do smth if there is an error.   
                            }else{
                                    // submit the data to your controller.
                                    $.ajax({
                                                    url: '".$this->createUrl('private/forgotpassword')."',//$(form).attr('action'),
                                                    type:'POST',
                                                    data:$(form).serialize(),
                                                    dataType:'json',
                                                    success:function(obj){
                                                            if( obj.result === 'success' ){
                                                                    $('.innerList .register').html('Email adresinizi yoxlayın!');
                                                                    return false;
                                                            }
                                                            else {
                                                                    $('.innerList .register .row.inputs').addClass('error');
                                                            }
                                                    }
                                    });
                            }
                            return false;
               }"
            ),
    ));
    ?>

        <div class="row inputs">
                <?php echo $form->textField($model,'username',array('class'=>'uname form-control','placeholder'=>'Username')); ?>
                <?php echo $form->error($model,'username'); ?>
        </div>


        <div class="row buttons ">
                <?php echo CHtml::submitButton('Şifre tələb et',array('class'=>'btn btn-success btn-block')); ?>
        </div>
        <div class="clearfix"></div>

    <?php $this->endWidget(); ?>
</div>