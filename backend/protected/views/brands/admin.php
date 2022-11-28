<?php
/* @var $this BrandsController */
/* @var $model Brands */

$this->breadcrumbs=array(
	'Brands'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Authors', 'url'=>array('index')),
	array('label'=>'Create Author', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#brands-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Brands</h1>
<div>
    <?php echo CHtml::link(Yii::t('frontend.strings','Add New Author'), $this->createUrl('create'), array('class'=>'btn btn-primary '));?>
    <br>

    <?php $this->widget('MfeTbExtendedGridView', array(
            'id'=>'brands-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'columns'=>array(
                    'id',
                    'sort',
                    'name',
                    array(
                            'class'=>'MfeTbButtonColumn',
                            'template'=>'{update}{delete}'
                    ),
            ),
    )); ?>
</div>