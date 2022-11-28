<?php
/* @var $this ImageSizesController */
/* @var $model ImageSizes */

?>
<h1>Manage Image Sizes</h1>
<div>
<?php echo CHtml::link(Yii::t('system','Add new item'), $this->createUrl('create'), array('class'=>'btn btn-primary '));?>
    
<?php echo CHtml::link(Yii::t('system','Empty Thumbnail Folders'), '/ru/emptyThumbnails?delete=true', array('class'=>'btn btn-danger ','target'=>'_blank'));?>
    
<?php echo CHtml::link(Yii::t('system','Create Thumbnail Folders'), '/ru/createThumbnailFolders', array('class'=>'btn btn-success','target'=>'_blank'));?>

<?php $this->widget('MfeTbExtendedGridView', array(
	'id'=>'image-sizes-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
                    'name'=>'parent_id',
                    'value'=>'$data->module->name',
                    'filter' => CHtml::activeDropDownList($model, 'parent_id', CHtml::listData(Modules::model()->findAll(), 'id', 'name'),array('class'=>'form-control input-lg','empty'=>'')), // fields from country table
                ),
		'name',
		'width',
		'height',
		'crop_location',
		'w',
		'keep_aspect',
		
		array(
                        'class'=>'MfeTbButtonColumn',
                        'template'=>'{update}{delete}',
		),
	),
)); ?>
</div>