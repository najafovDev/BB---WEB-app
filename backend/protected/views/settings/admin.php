<?php
$this->breadcrumbs=array(
	'Settings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Settings', 'url'=>array('index')),
	array('label'=>'Create Settings', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('settings-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Settings</h1>
<div>
    
    <?php echo CHtml::link(Yii::t('system','Add new setting'),$this->createUrl('create'),array('class'=>'btn btn-primary'));?>

    <br>
    <?php $this->widget('MfeTbExtendedGridView', array(
            'id'=>'settings-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'columns'=>array(
                    'id',
                    'attribute',
                    'value',
                    array(
                        'class'=>'MfeTbButtonColumn',
                        'template'=>'{update}{delete}',
                    ),
            ),
    )); ?>
</div>