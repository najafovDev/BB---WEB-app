<? $tmp = 'title_'.$this->Lang;?>
<? $tmp2 = 'description_'.$this->Lang;?>
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
  'action'=>Yii::app()->createUrl($this->route),
  'method'=>'get',
)); ?>

  <div class="row">
    <?php echo $form->label($model,'title_en'); ?>
    <?php echo $form->textField($model,'title_en',array('size'=>60,'maxlength'=>255)); ?>
  </div>

  <div class="row">
    <?php echo $form->label($model,'title_az'); ?>
    <?php echo $form->textField($model,'title_az',array('size'=>60,'maxlength'=>255)); ?>
  </div>

  <div class="row">
    <?php echo $form->label($model,'description_en'); ?>
    <?php echo $form->textArea($model,'description_en',array('rows'=>6, 'cols'=>50)); ?>
  </div>

  <div class="row">
    <?php echo $form->label($model,'description_az'); ?>
    <?php echo $form->textArea($model,'description_az',array('rows'=>6, 'cols'=>50)); ?>
  </div>

  <div class="row">
    <?php echo $form->label($model,'status'); ?>
    <?php echo $form->dropDownList($model,'status',$model->statusLabels()); ?>
  </div>

  <div class="row buttons">
    <?php echo CHtml::submitButton('Search'); ?>
  </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
