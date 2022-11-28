<?php
/* @var $this CategoryFieldsetController */
/* @var $model CategoryFieldset */

$this->breadcrumbs=array(
	'Category Fieldsets'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CategoryFieldset', 'url'=>array('index')),
	array('label'=>'Manage CategoryFieldset', 'url'=>array('admin')),
);
?>

<h1>Create CategoryFieldset</h1>
<div>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div>