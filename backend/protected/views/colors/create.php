<?php
$this->breadcrumbs=array(
	'Colors'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Colors','url'=>array('index')),
array('label'=>'Manage Colors','url'=>array('admin')),
);
?>

<h1>Create Colors</h1>
<div>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>