<?php
/* @var $this ItemsController */
/* @var $model Items */

$this->breadcrumbs=array(
	'Items'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Items', 'url'=>array('index')),
	array('label'=>'Create Items', 'url'=>array('create')),
	array('label'=>'View Items', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Items', 'url'=>array('admin')),
);
?>

<h1>Update Item : <?php echo $model->name; ?></h1>
<div>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#general" data-toggle="tab"><strong>General</strong></a></li>
        <li><a href="#specs" data-toggle="tab"><strong>Specifications</strong></a></li>
        <li><a href="#images" data-toggle="tab"><strong>Images</strong></a></li>
        <li><a href="#recommended" data-toggle="tab"><strong>Recommended items</strong></a></li>
        <li><a href="#stock" data-toggle="tab"><strong>Stock</strong></a></li>
        <?php foreach($this->languages as $code=>$val):?>
            <li><a href="#<?php echo $val;?>" data-toggle="tab"><strong><?php echo $val;?></strong></a></li>
        <?php endforeach;?>
    </ul>
    <div class="tab-content">
        <?php foreach($this->languages as $code=>$name):?>
            <?php
                $tmpLang = $code;
                $modelContent = $model->getTranslation($tmpLang);
                $modelContent->language = $tmpLang;
                $modelContent->parent_id = $model->id;
            ?>
            <div class="tab-pane <?=($modelContent->name?'':'tab-empty');?>" id="<?=$name;?>">
                <?php $this->renderPartial('_form-content', array('model'=>$modelContent)); ?>
            </div>
        <?php endforeach;?>
        <div class="tab-pane" id="recommended">
            <?php if (!$model->isNewRecord):?>
                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'recommendedAddForm',
                        'enableAjaxValidation'=>false,
                        'action'=>$this->createUrl('items/addRecommended',array('id'=>$model->id)),
                        'method'=>'post',
                        'htmlOptions'=>array('enctype' => 'multipart/form-data'),

                )); ?>


                        <?php $this->widget('CAutoComplete',
                                            array(
                                                'name'=>'Recommended Items',
                                                'url'=>array('items/autocomplete'),
                                                'max'=>10,
                                                'minChars'=>2,
                                                'delay'=>500, //number of milliseconds before lookup occurs
                                                'matchCase'=>false, //match case when performing a lookup?
                                                'htmlOptions'=>array('size'=>'40','class'=>''),
                                                'methodChain'=>".result(function(event,item){\$(\"#itemId\").val(item[1]);})",
                             ));
                        ?>
                        <?php echo CHtml::hiddenField('itemId'); ?>

                <?php $this->endWidget(); ?>
            <?php endif;?>
            <div class="mt10"></div>
            <div class="recommended-container">
                <?php $this->renderPartial('recommended-container',array('model'=>$model));?>
            </div>
        </div>
        <div class="tab-pane" id="specs">
            <?php if (isset($model->category->fields) && is_array($model->category->fields) && !empty($model->category->fields)):?>
                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'items-form',
                        'enableAjaxValidation'=>false,
                )); ?>
                <div class="panel-group panel-group-dark col-sm-12 mt10" id="private-settings">
                        <?php foreach($this->languages as $key=>$value):?>
                        <div class="panel col-sm-4">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#private-settings" href="#setting-name-<?=$key;?>" class="collapsed">
                                        <?=Yii::t('system','Additional fields ('.$value.")");?>
                                    </a>
                                </h4> 
                            </div>
                            <div id="setting-name-<?=$key;?>" class="panel-collapse " style="height: 0px;">
                                <div class="panel-body">
                                    <div class="">
                                            <?php foreach($model->category->fields as $fieldset):?>
                                                <?php 
                                                    if ($field = ItemsParamset::model()->findByAttributes(array(
                                                                        'items_id'=>$model->id,
                                                                        'fieldset_id'=>$fieldset->id,
                                                                        'language'=>$key
                                                                ))){}
                                                    else {
                                                        $field = new ItemsParamset;
                                                        $field->items_id = $model->id;
                                                        $field->fieldset_id = $fieldset->id;
                                                    }
                                                ?>

                                                <div class="col-sm-12">
                                                        <?php echo CHtml::label($fieldset->name,"ItemsParamset[{$key}][{$fieldset->id}]"); ?>
                                                        <?php echo CHtml::textField("ItemsParamset[{$key}][{$fieldset->id}]",$field->value,array('class'=>'form-control input-lg')); ?>
                                                </div>

                                            <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                </div>
                <div class="col-sm-12 buttons mt10">
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'input-lg btn btn-primary')); ?>
                </div>
                <?php $this->endWidget(); ?>
            <?php endif;?>
        </div>
        <div class="tab-pane" id="stock">
            <?php if (!$model->isNewRecord):?>
                <?php
                        $stocks=new ItemsStock('search');
                        $stocks->unsetAttributes();  // clear any default values
                        if(isset($_GET['ItemsStock']))
                                $stocks->attributes=$_GET['ItemsStock'];
                        $stocks->item_id = $model->id;
                        $this->renderPartial('stockAdmin',array(
                                'model'=>$stocks,
                        ));
                ?>
            <?php endif;?>
        </div>
        <div class="tab-pane" id="images">
            <?php $this->renderPartial('gallery-widget', array('model'=>$model)); ?>
        </div>
        <div class='tab-pane active' id='general'>
            <?php $this->renderPartial('_form', array('model'=>$model)); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
       $('#recommendedAddForm').on('submit',function(e){
           e.preventDefault();
           $.ajax({
              'url':$(this).attr('action'),
              'data':{itemId:$('#itemId').val()},
              'type':'post',
              'dataType':'html',
              'success':function(data){
                  $('.recommended-container').html(data);
                  $('#recommendedAddForm input').val('');
              }
           });
       });
       $(document.body).on('click','.recommended-container table tr td.table-action .delete-row',function(e){
           e.preventDefault();
           $.ajax({
              'url':$(this).attr('href'),
              'dataType':'html',
              'context':this,
              'success':function(data){
                  $(this).parents('tr').remove();
              }
           });
       });
    });
</script>
