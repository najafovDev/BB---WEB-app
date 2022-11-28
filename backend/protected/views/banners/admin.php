<style>
  img {
		max-width: 300px !important;
	}
</style>

<?php
/* @var $this BannersController */
/* @var $model Banners */

$this->breadcrumbs=array(
	'Banners'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Banners', 'url'=>array('index')),
	array('label'=>'Create Banners', 'url'=>array('create')),
);


?>
<style>
    #banners-grid .magnify-bg{
        width:160px;
        height:80px;
    }
    #banners-grid .magnify-bg{
        background-color:#d0d0d0;
        width:160px;
        height:80px;
        display:table-cell;
        vertical-align:middle;
        text-align: center;
    }
    #banners-grid .magnify-bg img{
        margin:0 auto;
    }
</style>

<h1>Manage Banners</h1>
<div>
    <?php echo CHtml::link(Yii::t('system','Add new banner'),$this->createUrl('create'),array('class'=>'btn btn-primary'));?>
    <br>

    <?php $this->widget('MfeTbExtendedGridView', array(
            'id'=>'banners-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'afterAjaxUpdate'=>'js:function(){$(".magnify").elevateZoom({scrollZoom:true,cursor:"crosshair"})}',
            'columns'=>array(
                    array(
                        'name'=>'pic_name',
                        'type'=>'raw',
                        'htmlOptions'=>array('width'=>'160px'),
                        'filter'=>false,
                        'value'=>'CHtml::tag(\'div\',array(\'class\'=>\'magnify-bg\'),CHtml::image("/site/uploads/banners/backendList/".$data->pic_name,"",array(\'class\'=>\'magnify\',\'data-zoom-image\'=>"/uploads/banners/".$data->pic_name)),true)',
                    ),
                    array(
                        'name'=>'type',
                        'type'=>'raw',
                        'value'=>'$data->types(true)',
                        'filter'=>CHtml::activeDropDownList($model, 'type',$model->types(),array('class'=>'form-control input-lg','empty'=>'')),
                    ),
                    /*
                    'pic_name',
                    'date',
                    */
                    array(
                            'class'=>'MfeTbButtonColumn',
                            'template'=>'{update}{delete}'
                    ),
            ),
    )); ?>
</div>
