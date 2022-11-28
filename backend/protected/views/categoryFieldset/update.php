<?php
/* @var $this CategoryFieldsetController */
/* @var $model CategoryFieldset */

$this->breadcrumbs=array(
	'Category Fieldsets'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CategoryFieldset', 'url'=>array('index')),
	array('label'=>'Create CategoryFieldset', 'url'=>array('create')),
	array('label'=>'View CategoryFieldset', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CategoryFieldset', 'url'=>array('admin')),
);
?>

<h1>Update Category Field  <?php echo ($model->group?' Group #':'#').$model->name; ?></h1>
<div>
    <?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
<? if ($model->group):?>
<div class="col-xs-12">
<?php echo CHtml::button('add field', array(
        'class'=>'btn btn-default',
        'data-toggle'=>'modal',
        'data-target'=>'#fieldsetModal',
  ));
  ?>
<?php echo CHtml::link(Yii::t('system','Manage fieldsets'),$this->createUrl('categoryFieldset/admin'),array('class'=>'btn btn-warning')); ?>

<?php
    $searchModel = new CategoryFieldset();
    $searchModel->parent_id = $model->id;
    $this->widget('MfeTbExtendedGridView', array(
	'id'=>'category-fieldset-grid',
	'dataProvider'=>$searchModel->searchChildren(),
	'columns'=>array(
		'id',
		'name',
		'type',
                array(
                    'class'=>'MfeTbButtonColumn',
                    'template'=>'{update}{delete}',
                )
	),
)); ?>
</div>
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
                    <?php 
                        $tmp = new CategoryFieldset;
                        $tmp->parent_id = $model->id;
                    ?>
                    <div class="col-sm-6">
                            <?php echo $form->labelEx($tmp,'name'); ?>
                            <?php echo $form->textField($tmp,'name',array('class'=>'form-control input-lg')); ?>
                            <?php echo $form->error($tmp,'name'); ?>
                    </div>
                    <?php echo CHtml::hiddenField('ajax', 1);?>
                    <?php echo $form->hiddenField($tmp,'parent_id');?>
                    <div class="col-sm-6">
                            <?php echo $form->labelEx($tmp,'type'); ?>
                            <?php echo $form->dropDownList($tmp,'type',$tmp->getListData(),array('class'=>'form-control input-lg')); ?>
                            <?php echo $form->error($tmp,'type'); ?>
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
            $.fn.yiiGridView.update("category-fieldset-grid");            
        });
        $('#fieldsetModal').on('show.bs.modal',function(e){
        });
JAVASCRIPT;
        Yii::app()->getClientScript()->registerScript('fieldSetRefreshParentList',$str,  CClientScript::POS_READY);
?>
<? endif;?>