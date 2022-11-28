
<h1>Manage Articles</h1>
<div>
    <div class="col-xs-2">

    <?php $this->widget(
            'booster.widgets.TbButton',
            array(
                'label' => 'Create',
                'context' => 'common',
                'url'=>$this->createUrl('articles/create',array('type'=>$_GET['type'],'parent_id'=>$_GET['parent_id'])),
                'buttonType'=>  'link',
                'htmlOptions'=>array(
                    'class'=>'btn btn-default col-xs-12'
                )
            )
    ); echo ' ';
    ?>
    </div>
    <div class="col-xs-2">
    <?php echo CHtml::button('Publish',  array('class'=>'btn btn-success col-xs-12','onClick'=>'js:$("#publishArticle").click();return false'));?>
    </div>
    <div class="col-xs-2">
    <?php echo CHtml::button('Unpublish', array('class'=>'btn btn-warning col-xs-12','onClick'=>'js:$("#unpublishArticle").click();return false'));?>
    </div>
    <div class="col-xs-2">
    <?php echo CHtml::button('Delete', array('class'=>'btn btn-danger col-xs-12','onClick'=>'js:$("#deleteArticle").click();return false'));?>
    </div>


    <?php $this->widget('booster.widgets.TbExtendedGridView', array(
            'id'=>'articles-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'bulkActions' => array(
                'actionButtons' => array(
                    array(
                    'buttonType' => 'button',
                    'type' => 'success',
                    'size' => 'large',
                    'label' => 'Publish',
                    'click' => 'js:function(values){'.
                                CHtml::ajax(array(
                                    'method'=>'post',
                                    'url'=>$this->createUrl('articles/publishAll'),
                                    'data'=>array('ids'=>'js:values'),
                                    'complete'=>"js:$('#articles-grid').yiiGridView('update')"
                                )).'}',
                    'id' => 'publishArticle',
                    'htmlOptions'=>array('class'=>'btn btn-success'),
                    ),
                    array(
                    'buttonType' => 'button',
                    'type' => 'warning',
                    'size' => 'large',
                    'label' => 'Unpublish',
                    'click' => 'js:function(values){'.
                                CHtml::ajax(array(
                                    'method'=>'post',
                                    'url'=>$this->createUrl('articles/unpublishAll'),
                                    'data'=>array('ids'=>'js:values'),
                                    'complete'=>"js:$('#articles-grid').yiiGridView('update')"
                                )).'}',
                    'id' => 'unpublishArticle',
                    'htmlOptions'=>array('class'=>'btn btn-warning'),
                    ),
                    array(
                    'buttonType' => 'button',
                    'type' => 'danger',
                    'size' => 'large',
                    'label' => 'Delete',
                    'click' => 'js:function(values){'.
                                CHtml::ajax(array(
                                    'method'=>'post',
                                    'url'=>$this->createUrl('articles/deleteAll'),
                                    'data'=>array('ids'=>'js:values'),
                                    'complete'=>"js:$('#articles-grid').yiiGridView('update')"
                                )).'}',
                    'id' => 'deleteArticle',
                    'htmlOptions'=>array('class'=>'btn btn-danger'),
                    ),
                ),
            ),
            'columns'=>array(
                    array('class'=>'CCheckBoxColumn','selectableRows'=>100),
                    array(
                        'name'=>'translations.name',
                        'value'=>'isset($data->translations[Yii::app()->controller->Lang])?$data->translations[Yii::app()->controller->Lang]->name:""'
                        ),
                    array(
                        'name'=>'date',
                        //'value'=>'date("d.m.Y",strtotime($data->date))',
                        'htmlOptions'=>array('style'=>'text-align:center'),
                    ),
                    /*
                    'type',
                    'menucontent',
                    'front',
                    'right',
                    'date',
                    */
                    array(
                        'name'=>'active',
                        'value'=>'($data->active?"Yes":"No")',
                        'htmlOptions'=>array('style'=>'text-align:center'),
                        'filter' => array('0'=>'No','1'=>'Yes'), // fields from country table
                    ),
                    array(
                        'class'=>'booster.widgets.TbButtonColumn',
                        'template'=>'{update}{delete}',
                    ),
            )
    )); ?>

    <script>
        function collectArticles(){
            tmp = [];
            tmp['ids'] = [];
            $('input[type=checkbox]:checked').each(function(index){
                    tmp['ids[]'].push($(this).val());
            });
            return tmp;
        }
    </script>

    <style>
        tfoot{
            display:none;
        }

    </style>
</div>