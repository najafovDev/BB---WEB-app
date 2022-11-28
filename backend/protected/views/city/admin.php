<h1>Manage Cities</h1>
<div>
    <?php echo CHtml::link(Yii::t('system','Add new City'), $this->createUrl('create'), array('class'=>'btn btn-primary'));?>

    <?php $this->widget('MfeTbExtendedGridView', array(
            'id'=>'city-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'columns'=>array(
                    'id',
                    'name',
                    'latitude',
                    'longitude',
                    array(
                            'class'=>'MfeTbButtonColumn',
                    ),
            ),
    )); ?>
</div>