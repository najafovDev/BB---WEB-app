<?php
/* @var $this UserListController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Lists',
);

$this->menu=array(
	array('label'=>'Create UserList', 'url'=>array('create')),
	array('label'=>'Manage UserList', 'url'=>array('admin')),
);
?>

<h1>User Lists</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
