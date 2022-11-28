<?php
/* @var $this UserListController */
/* @var $model UserList */

$this->breadcrumbs=array(
	'User Lists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserList', 'url'=>array('index')),
	array('label'=>'Manage UserList', 'url'=>array('admin')),
);
?>

<h1>Create UserList</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>