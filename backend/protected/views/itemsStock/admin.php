<?php
/* @var $this ItemsStockController */
/* @var $model ItemsStock */

$this->breadcrumbs=array(
	'Items Stocks'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ItemsStock', 'url'=>array('index')),
	array('label'=>'Create ItemsStock', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#items-stock-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Items Stocks</h1>
<div>
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('//itemsStock/_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form 7pCOD7CDyR_W -->

<?php $this->widget('booster.widgets.TbExtendedGridView', array(
	'id'=>'items-stock-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                    'name'=>'item_id',
                    'value'=>'($data->item?$data->item->name:"")',
                ),
		'artikul',
		'artikul2',
		'barcode',
                array(
                    'name'=>'color_id',
                    'value'=>'($data->color?$data->color->name:"")',
                ),
		'size',
		'price',
		'discount',
		'stock',
	),
)); ?>
</div>