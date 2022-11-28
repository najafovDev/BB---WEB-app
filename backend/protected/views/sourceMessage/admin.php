<?php
/* @var $this SourceMessageController */
/* @var $model SourceMessage */

$this->breadcrumbs=array(
	'Source Messages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SourceMessage', 'url'=>array('index')),
	array('label'=>'Create SourceMessage', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#source-message-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Translations</h1>
<div>
    <div class=" mt10">
        <?=CHtml::link(Yii::t('system','Add Source Message'), $this->createUrl('sourceMessage/create'), array('class'=>'btn btn-default'));?>
        <?=CHtml::link(Yii::t('system','Add Message Translation'), $this->createUrl('message/create'), array('class'=>'btn btn-default'));?>
    </div>
    <div class="table-responsive">
    <?php $this->widget('MfeTbExtendedGridView', array(
            'id'=>'source-message-grid',
            'filter'=>$model,
            'dataProvider'=>$model->search(),
            //'cssFile'=>false,
            //'htmlOptions' => array('class' => 'table dataTable'),
            'columns'=>array(
                    'message',
                    array(
                        'name'=> 'translation.translation',
                        //'value'=>'CHtml::link(Yii::t("system","Translate"),array("message/create","id"=>$data->id))',
                        //'type'=>'raw'
                    ),
                    array(
                        'name'=> 'translation.controls',
                        'value'=>'CHtml::link(($data->translation && $data->translation->translation!=""?Yii::t("system","Update"):Yii::t("system","Translate")),'
                        . '             array("message/".($data->translation && $data->translation->translation!=""?"update":"create"),"id"=>($data->translation && $data->translation->translation!=""?$data->translation->fid:$data->id)))',
                        'type'=>'raw'
                    ),
                    array(
                        'class'=>'booster.widgets.TbRelationalColumn',
                        'name' => 'translation',
                        'url' => $this->createUrl('message/admin2'),
                        'value'=> 'Yii::t("system","Translations")',
                    ),
                    array(
                        'class'=>'MfeTbButtonColumn',
                            'template' => '{update}{delete}',
                    ),
            ),
    )); ?>
    </div>
</div>