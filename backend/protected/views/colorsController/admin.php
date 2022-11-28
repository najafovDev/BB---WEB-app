<h1>Manage Colors</h1>
<div>
<?php 
    echo CHtml::link(Yii::t('system','Add new Colors'), $this->createUrl('create'), array('class'=>'btn btn-primary'));
?>    
<?php $this->widget('MfeTbExtendedGridView', array(
	'id'=>'colors-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'rgb',
		'pic_name',
		array(
			'class'=>'MfeTbButtonColumn',
		),
	),
)); ?>
</div>