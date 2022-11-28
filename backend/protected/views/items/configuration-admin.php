<?php
/* @var $this ItemsController */
/* @var $model Items */

$this->breadcrumbs=array(
	'Items'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Items', 'url'=>array('index')),
	array('label'=>'Create Items', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#items-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Configurations</h1>
<div>
<?php echo CHtml::link(Yii::t('system','Add new item'), $this->createUrl('itemsConfiguration/create',array('id'=>$model->parent_id)), array('class'=>'btn btn-primary','target'=>'_blank'));?>
<?php echo CHtml::link(Yii::t('system','Refresh table'), 'javascript:$.fn.yiiGridView.update("itemsconf-grid");', array('class'=>'btn btn-success'));?>

<?php $this->widget('MfeTbExtendedGridView', array(
        //'fixedHeader' => true,
        'type' => 'striped bordered',
        'headerOffset' => 40,
	'id'=>'itemsconf-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'selectableRows'=>10,
	'columns'=>array(
		'id',
                'title',
                'price',
                'rooms',
                'general_area',
                'living_area',
                'bathrooms',
                array(
                        'class'=>'MfeTbButtonColumn',
                        'template'=>'{update}{delete}',
                        'updateButtonUrl'=>'Yii::app()->controller->createUrl("itemsConfiguration/update",array("id"=>$data->primaryKey))',
                        'deleteButtonUrl'=>'Yii::app()->controller->createUrl("itemsConfiguration/delete",array("id"=>$data->primaryKey))',
                        'updateButtonOptions'=>array(
                            'target'=>'_blank',
                            'class'=>'update'
                        ),
                )
	),
)); ?>
    
</div>
