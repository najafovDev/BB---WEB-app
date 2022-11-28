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

<h1>Manage Items</h1>
<div>
<?php echo CHtml::link(Yii::t('system','Add new item'), $this->createUrl('create'), array('class'=>'btn btn-primary'));?>
<?php echo CHtml::link(Yii::t('system','Import items'), $this->createUrl('import'), array('class'=>'btn btn-success'));?>

<?php $this->widget('MfeTbExtendedGridView', array(
        //'fixedHeader' => true,
        'type' => 'striped bordered',
        'headerOffset' => 40,
	'id'=>'items-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'selectableRows'=>10,
	'columns'=>array(
		'name',
                array(
                    'name'=>'category_id',
                    'value'=>'($data->category?$data->category->name:"")',
                    'filter' => CHtml::activeDropDownList($model, 'category_id', CHtml::listData(Category::model()->findAll(), 'id', 'name'),array('class'=>'form-control input-lg','empty'=>'')), // fields from country table
                ),

		/*
		'pic_name',
		'sort',
		'params',
		'deleted',
		'active',
		*/

                array(
                    'name'=>'new',
                    'type'=>'raw',
                    'value'=>'$data->new?"<div class=\'btn btn-success\'>On</div>":"<div class=\'btn btn-danger\'>Off</div>"'

                ),
                array(
                        'class'=>'MfeTbButtonColumn',
                        'template'=>'{update}{delete}',
                )
	),
)); ?>

</div>
