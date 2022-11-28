<?php
/* @var $this CountryCurrencyController */
/* @var $model CountryCurrency */

$this->breadcrumbs=array(
	'Country Currencies'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CountryCurrency', 'url'=>array('index')),
	array('label'=>'Create CountryCurrency', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#country-currency-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



<?php $this->widget('MfeTbExtendedGridView', array(
	'id'=>'country-currency-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'currency',
		'percent',
		array(
                    'class'=>'MfeTbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl(\'countryCurrency/update\',array("id"=>$data->id))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl(\'countryCurrency/delete\',array("id"=>$data->id))',
		),
	),
)); ?>
