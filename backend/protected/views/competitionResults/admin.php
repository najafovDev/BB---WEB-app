<?php
/* @var $this CompetitionResultsController */
/* @var $model CompetitionResults */

$this->breadcrumbs=array(
	'Competition Results'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CompetitionResults', 'url'=>array('index')),
	array('label'=>'Create CompetitionResults', 'url'=>array('create')),
);

?>

<h1>Manage Competition Results</h1>
<div class=" mt10">
    <?=CHtml::link(Yii::t('system','Add User Result'), $this->createUrl('competitionResults/create'), array('class'=>'btn btn-success'));?>
</div>


<?php $this->widget('booster.widgets.TbGroupGridView', array(
	'id'=>'competition-results-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'extraRowColumns'=> array('date'),
    'extraRowExpression' => '"<b style=\"font-size: 3em; color: #333;\">".$data->date."</b>"',
	'columns'=>array(
		'id',
                array(
                    'name'=>'compt_id',
                    'filter'=>CHtml::activeDropDownList($model, 'compt_id',CHtml::listData(CompetitionSchedule::model()->findAll(array('order'=>'title asc')), 'id', 'title'),array('class'=>'form-control input-lg','empty'=>'')),
                ),
		'login',
		'name',
		'balance',
		'equity',
                array(
                    'name'=>'statement',
                    'type'=>'raw',
                    'value'=>'CHtml::link($data->statement,"/uploaded/results/".$data->statement,array("target"=>"_blank"))',

                ),
		array(
                    'name'=>'date',
                    'type'=>'raw',
                    'value'=>'date("Y-m-d",strtotime($data->date))'
                ),
		'place',
		/*
		*/
		array(
                    'class'=>'MfeTbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl(\'competitionResults/update\',array("id"=>$data->id))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl(\'competitionResults/delete\',array("id"=>$data->id))',
		),
	),
)); ?>
