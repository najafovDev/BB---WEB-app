<div class="row">
    <?=CHtml::link(Yii::t('system','Add Message Translation'), $this->createUrl('message/create',array('id'=>$model->id)), array('class'=>'btn btn-default'));?>
</div>

<?php $this->widget('booster.widgets.TbExtendedGridView', array(
	'id'=>'message-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                    'name'=>'parent.message',
                    'value'=>'CHtml::link($data->parent->message,array("sourcemessage/update","id"=>$data->id))',
                    'type'=>'raw'
                ),
		'language',
		'translation',
		array(
                    'class'=>'booster.widgets.TbButtonColumn',
                    'template' => '{update}{delete}',
		),
	),
)); ?>
