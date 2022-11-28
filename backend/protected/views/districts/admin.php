<h1>Manage Districts</h1>
<div>
<?php 
    echo CHtml::link(Yii::t('system','Add new Districts'), $this->createUrl('create'), array('class'=>'btn btn-primary'));
?>    
<?php $this->widget('MfeTbExtendedGridView', array(
	'id'=>'districts-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'latitude',
		'longitude',
		array(
			'class'=>'MfeTbButtonColumn',
                        'template'=>'{update}{delete}',
		),
	),
)); ?>
</div>