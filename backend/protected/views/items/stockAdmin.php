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
<?php echo CHtml::link(Yii::t('system','Add Stock'),$this->createUrl('itemsStock/addStockTo',array('id'=>$model->item_id)),array('class'=>'btn btn-primary'));?>
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>


<?php $this->widget('booster.widgets.TbExtendedGridView', array(
	'id'=>'items-stock-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'barcode',
                array(
                    'name'=>'color_id',
                    'value'=>'($data->color?$data->color->name:"NO COLOR"',
                ),
		'size',
		'price',
		'discount',
		'stock',
                array(
                        'class'=>'booster.widgets.TbButtonColumn',
                        'template'=>'{upd}{del}',
                        'buttons'=>array(
                                    'upd' => array
                                                (
                                                    'label'=>'',
                                                    'imageUrl'=>false,
                                                    'options'=>array('class'=>'glyphicon glyphicon-pencil'),
                                                    'url'=>'Yii::app()->createUrl("itemsStock/update", array("id"=>$data->id))',
                                                ),
                                    'del' => array
                                                (
                                                    'label'=>'',
                                                    'imageUrl'=>false,
                                                    'options'=>array('class'=>'glyphicon glyphicon-trash'),
                                                    'url'=>'Yii::app()->createUrl("itemsStock/update", array("id"=>$data->id))',
                                                ),

                        )
                )
	),
)); ?>
</div>