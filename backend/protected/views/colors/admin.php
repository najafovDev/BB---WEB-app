
<h1>Manage Colors</h1>
<div>

<?php echo CHtml::link(Yii::t('system','Add color'), $this->createUrl('create'), array('class'=>'btn btn-primary'));?>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'colors-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'name',
array(
'class'=>'booster.widgets.TbButtonColumn',
'template'=>'{update}{delete}'
),
),
)); ?>
</div>