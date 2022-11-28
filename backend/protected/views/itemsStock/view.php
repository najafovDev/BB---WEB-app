<?php
/* @var $this ItemsStockController */
/* @var $model ItemsStock */

$this->breadcrumbs=array(
	'Items Stocks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ItemsStock', 'url'=>array('index')),
	array('label'=>'Create ItemsStock', 'url'=>array('create')),
	array('label'=>'Update ItemsStock', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ItemsStock', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ItemsStock', 'url'=>array('admin')),
);
?>

<h1>View ItemsStock #<?php echo $model->id; ?></h1>
<div>
    <?php $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                    'id',
                    'item_id',
                    'artikul',
                    'artikul2',
                    'barcode',
                    'color_id',
                    'size',
                    'price',
                    'discount',
                    'stock',
            ),
    )); ?>
</div>