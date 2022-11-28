<h1>Manage Portals</h1>
<div>
<?php 
    echo CHtml::link(Yii::t('system','Add new Portals'), $this->createUrl('create'), array('class'=>'btn btn-primary'));
?>    
<?php $this->widget('MfeTbExtendedGridView', array(
	'id'=>'portals-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
                array(
                  'name'=>'parent_id',
                    'value'=>'$data->district->getTranslation(Yii::app()->controller->Lang)->name;',
                    'filter' => CHtml::activeDropDownList($model, 'parent_id', CHtml::listData(Districts::model()->findAll(), 'id', 'name'),array('class'=>'form-control input-lg','empty'=>'')), // fields from country table
                ),
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