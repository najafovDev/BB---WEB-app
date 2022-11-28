<?php
/* @var $this DistrictsController */
/* @var $model Districts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'districts-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'latitude'); ?>
		<?php echo $form->textField($model,'latitude',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'latitude'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'longitude'); ?>
		<?php echo $form->textField($model,'longitude',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'longitude'); ?>
	</div>
        <div class='map-canvas' style="width:100%;height:500px;"></div>
	<div class="col-xs-12 buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success pull-right')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
<?php     Yii::app()->clientscript->registerScriptFile('https://maps.googleapis.com/maps/api/js',  CClientScript::POS_HEAD);?>
function initializeModal(canvas) {
    var mapOptions = {
        zoom: 12,
        center: new google.maps.LatLng(<?php echo ($model->latitude?$model->latitude:'40.3418415').', '.($model->longitude?$model->longitude:'49.8889152');?>)
    };

    var map = new google.maps.Map(document.getElementsByClassName(canvas)[0],mapOptions);

    var marker = new google.maps.Marker({
        position: map.getCenter(),
        map: map,
        title: 'Click to zoom'
    });

    google.maps.event.addListener(map, 'click', function(e) {
        // 3 seconds after the center of the map has changed, pan back to the
        // marker.
        marker.setPosition( e.latLng);
        $('#Districts_latitude').val(e.latLng.lat());
        $('#Districts_longitude').val(e.latLng.lng());

        //map.setCenter(this.latLng);
    });

    google.maps.event.addListener(marker, 'click', function(e) {
        map.setZoom(12);
        map.setCenter(this.latLng);
    });
}
      initializeModal('map-canvas');          
</script>            