<?php
/* @var $this ItemPhotosController */
/* @var $model ItemPhotos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-photos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <div class="col-lg-4">
            <div >
                <?php echo CHtml::textField('dataX');?>
                <?php echo CHtml::textField('dataY');?>
                <?php echo CHtml::textField('dataHeight');?>
                <?php echo CHtml::textField('dataWidth');?>
            </div>
            <?php echo CHtml::link('Rotate', $this->createUrl('rotate',array('id'=>$model->id)), array());?>
            <?php echo CHtml::link('Resize', $this->createUrl('resize',array('id'=>$model->id)), array('class'=>'rotateButton'));?>
        </div>
        <div class="col-lg-8 col-md-10">
            <?php echo CHtml::image($model->getImageUrl(),'',array('class'=>'img-responsive croplanan'));?>
        </div>
        <div class="col-lg-4 col-md-2">
            <div class="img-preview"></div>
        </div>
	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',$model->getTypes(),array('class'=>'chosen-select')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="col-sm-12 buttons mt10">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
    $str = <<<JS
$('img.croplanan').cropper({
//  aspectRatio: 16 / 9,
  preview:'.img-preview',
  crop: function(e) {
    $("#dataX").val(Math.round(e.x));
    $("#dataY").val(Math.round(e.y));
    $("#dataHeight").val(Math.round(e.height));
    $("#dataWidth").val(Math.round(e.width));
//    $("#dataRotate").val(e.rotate);
//    $("#dataScaleX").val(e.scaleX);
//    $("#dataScaleY").val(e.scaleY);
  }
});
$('.rotateButton').on('click',function(e){
    e.preventDefault();
    $.ajax({
        url:$(this).attr('href'),
        data:{
            dataX:$("#dataX").val(),
            dataY:$("#dataY").val(),
            dataHeight:$("#dataHeight").val(),
            dataWidth:$("#dataWidth").val(),
        },
        success: function(data){
            window.location.reload();
        }
    });
});
JS;
    Yii::app()->clientscript->registerScript('image-cropper-init',$str,  CClientScript::POS_READY);

?>