<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'parent_id'); ?>
	</div>

	<div class="col-sm-6">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

        <div class="col-xs-6">
                <?php echo $form->labelEx($model,'front'); ?>
                <?php echo $form->checkBox($model,'front',array('class'=>'form-control input-lg')); ?>
                <?php echo $form->error($model,'front'); ?>
        </div>
        <div class="col-xs-6">
                <?php echo $form->labelEx($model,'main'); ?>
                <?php echo $form->checkBox($model,'main',array('class'=>'form-control input-lg')); ?>
                <?php echo $form->error($model,'main'); ?>
        </div>
        <div class="clearfix"></div>
        <?php if ($model->id):?>
            <div class="col-sm-12 tagsCont mt10">
                    <?php echo CHtml::button('add field', array(
                                'class'=>'btn btn-default',
                                'data-toggle'=>'modal',
                                'data-target'=>'#fieldsetModal',
                          ));
                          ?>
                    <?php echo CHtml::link(Yii::t('system','Manage fieldsets'),$this->createUrl('categoryFieldset/admin'),array('class'=>'btn btn-warning')); ?>
                    <?php if (isset($this->settings['feature_fieldGroup']) && $this->settings['feature_fieldGroup']):?>
                        <label for="">Field groups</label><br>
                        <?php   echo $form->checkBoxList($model, 'fieldsetIds',
                                CHtml::listData((
                                                            CategoryFieldset::model()->findAllByAttributes(array(
                                                                                'group'=>1)
                                                            )
                                                ), 'id', 'name'),
                                array(
                                    'attributeitem' => 'id', 
                                    //'checkAll' => 'Check All',
                                    'separator'=>false, 
                                    'template'=>'<div class="col-xs-6 col-sm-3 ckbox ckbox-primary">{input}{label}</div>'
                                ));
                     ?>
                    <?php else:?>
                        <?php echo $form->labelEx($model,'fields');?><br>   
                        <br>
                        <?php   echo $form->checkBoxList($model, 'fieldsetIds',
                                CHtml::listData((//$model->parent_id!=-1 && $model->parent?$model->parent->fields:
                                                            CategoryFieldset::model()->findAllByAttributes(array(
                                                                                'parent_id'=>null,'group'=>0)
                                                            )
                                                ), 'id', 'name'),
                                array(
                                    'attributeitem' => 'id', 
                                    //'checkAll' => 'Check All',
                                    'separator'=>false, 
                                    'template'=>'<div class="col-xs-6 col-sm-3 ckbox ckbox-primary">{input}{label}</div>'
                                ));
                         ?>
                        <div class="clearfix"></div>
                    <?php endif;?>
                    <?php echo $form->error($model,'tagIds'); ?>
            </div>
        <?php endif;?>
        <div class="clearfix"></div>
	<div class="col-sm-4 buttons mt10">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php if ($model->id):?>
<div class="modal fade" id="fieldsetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Add Field</h4>
      </div>
      <div class="modal-body">
            <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'category-form',
                    // Please note: When you enable ajax validation, make sure the corresponding
                    // controller action is handling ajax validation correctly.
                    // There is a call to performAjaxValidation() commented in generated controller code.
                    // See class documentation of CActiveForm for details on this.
                    'enableAjaxValidation'=>false,
            )); ?>
                    <?php $model = new CategoryFieldset;?>
                    <div class="col-sm-6">
                            <?php echo $form->labelEx($model,'name'); ?>
                            <?php echo $form->textField($model,'name',array('class'=>'form-control input-lg')); ?>
                            <?php echo $form->error($model,'name'); ?>
                    </div>
                    <?php echo CHtml::hiddenField('ajax', 1);?>
                    <div class="col-sm-6">
                            <?php echo $form->labelEx($model,'type'); ?>
                            <?php echo $form->dropDownList($model,'type',$model->getListData(),array('class'=>'form-control input-lg')); ?>
                            <?php echo $form->error($model,'type'); ?>
                    </div>
                    <div class="clearfix"></div>
            <?php $this->endWidget();?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div>

<?php 
    $tmpAjax = '';/*CHtml::ajax(array(
        'url'=>$this->createUrl('categoryFieldset/getList'),
        'dataType'=>'json',
        'complete'=>'js:function(data){'
        . 'data=data.responseJSON;'
        . '$select = $("#CategoryFieldset_parent_id");'
        . '$select.html("<option value>'.Yii::t('system','Leave blank if group').'</option>");'
        . '$.each(data,function(i,item){'
        . '$select.append("<option value=\""+i+"\">"+item+"</option>");'
        . '})'
        . '}'
    ));*/
    $tmpAjax2 = CHtml::ajax(array(
        'url'=>$this->createUrl('categoryFieldset/create'),
        'dataType'=>'json',
        'type'=>'post',
        'data'=>'js:jQuery(this).serialize()',
        'success'=>'js:function(data){'
        . ''
        . '$("<div class=\"col-sm-3 ckbox ckbox-primary\"></div>").'
        . 'append("<input attributeitem=\"id\"  id=\"Category_fieldsetIds_"+data.id+"\" value=\""+data.id+"\" type=\"checkbox\" checked=\"checked\" name=\"Category[fieldsetIds][]\">").'
        . 'append("<label for=\"Category_fieldsetIds_"+data.id+"\">"+data.name+"</label>").appendTo("#Category_fieldsetIds");'
        . '$("#fieldsetModal").modal("hide");'
        . '}'
    ));

    $str = <<<JAVASCRIPT
        $('#fieldsetModal .modal-footer .btn-primary').click(function(e){
            $('#fieldsetModal form').submit();
        });
        $('#fieldsetModal form').on('submit',function(e){
            e.preventDefault();
            {$tmpAjax2}
        });
        //$('#fieldsetModal').on('show.bs.modal',function(e){
        //    {$tmpAjax}
        //});
JAVASCRIPT;
        Yii::app()->getClientScript()->registerScript('fieldSetRefreshParentList',$str,  CClientScript::POS_READY);
?>
<? endif;?>