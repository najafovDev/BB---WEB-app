<?php
/* @var $this CategoryFieldsetController */
/* @var $model CategoryFieldset */

$this->breadcrumbs=array(
	'Category Fieldsets'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CategoryFieldset', 'url'=>array('index')),
	array('label'=>'Create CategoryFieldset', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#category-fieldset-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Category Fieldsets</h1>
<div>

<?php $this->widget('MfeTbExtendedGridView', array(
	'id'=>'category-fieldset-grid',
	'dataProvider'=>$model->search(),
	'filter'=>null,
	'columns'=>array(
		'id',
		'name',
		'type',
                array(
                    'name'=>'group',
                    'value'=>'($data->group?"FieldGroup":"Field")'
                ),
                array(
                    'name'=>'parent_id',
                    'value'=>'($data->parent?$data->parent->name:"No parent")'
                ),
                array(
                    'class'=>'MfeTbButtonColumn',
                    'template'=>'{update}{delete}',
                )
	),
)); ?>
</div>