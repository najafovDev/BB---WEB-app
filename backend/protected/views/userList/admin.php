<?php
/* @var $this UserListController */
/* @var $model UserList */

$this->breadcrumbs=array(
	'User Lists'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List UserList', 'url'=>array('index')),
	array('label'=>'Create UserList', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-list-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage User Lists</h1>


<?php $this->widget('MfeTbExtendedGridView', array(
	'id'=>'user-list-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		'sername',
		'nicname',
		'country',
		'city',
		'mail',
		/*
		'phone',
		'id',
		'pass',
		'comp_id',
		*/
                array(
                    'class'=>'MfeTbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl(\'userList/update\',array("id"=>$data->id))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl(\'userList/delete\',array("id"=>$data->id))',
                ),
	),
)); ?>
