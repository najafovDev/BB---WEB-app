<?php
/* @var $this CompetitionScheduleController */
/* @var $model CompetitionSchedule */

$this->breadcrumbs=array(
	'Competition Schedules'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CompetitionSchedule', 'url'=>array('index')),
	array('label'=>'Create CompetitionSchedule', 'url'=>array('create')),
);

?>
<h1>Manage Competition Schedules</h1>
<div class=" mt10">
    <?=CHtml::link(Yii::t('system','Add Competition'), $this->createUrl('competitionSchedule/create'), array('class'=>'btn btn-default'));?>
</div>


<?php $this->widget('MfeTbExtendedGridView', array(
	'id'=>'competition-schedule-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'date_r_n',
		'date_r_k',
		'date_pk_n',
		'date_pk_k',
		'go',
		'open',
		'title',
                array(
                    'name'=>'open',
                    'filter'=>CHtml::activeDropDownList($model, 'open',$model->getOpenList(),array('class'=>'form-control input-lg')),
                    'value' => '$data->getOpenList($data->open)',
                ),
		/*
		*/
                array(
                    'class'=>'MfeTbButtonColumn',
                    'template'=>'{update}{delete}',
                )
	),
)); ?>
