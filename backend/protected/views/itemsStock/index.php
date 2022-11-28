<?php
/* @var $this ItemsStockController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Items Stocks',
);

$this->menu=array(
	array('label'=>'Create ItemsStock', 'url'=>array('create')),
	array('label'=>'Manage ItemsStock', 'url'=>array('admin')),
);
?>

<h1>Items Stocks</h1>
<div>
    <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_view',
    )); ?>
</div>