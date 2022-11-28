<?php
/* @var $this UserListController */
/* @var $model UserList */

$this->breadcrumbs=array(
	'User Lists'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserList', 'url'=>array('index')),
	array('label'=>'Create UserList', 'url'=>array('create')),
	array('label'=>'View UserList', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserList', 'url'=>array('admin')),
);
?>

<h1>Update '<?php echo $model->competition->title;?>' Competition User: <?php echo $model->name.' '.$model->sername; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>