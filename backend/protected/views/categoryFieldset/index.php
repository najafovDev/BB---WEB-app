<?php
/* @var $this CategoryFieldsetController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Category Fieldsets',
);

$this->menu=array(
	array('label'=>'Create CategoryFieldset', 'url'=>array('create')),
	array('label'=>'Manage CategoryFieldset', 'url'=>array('admin')),
);
?>

<h1>Category Fieldsets</h1>
<div>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>