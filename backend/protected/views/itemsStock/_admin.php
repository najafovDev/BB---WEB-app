
<?php $this->widget('booster.widgets.TbExtendedGridView', array(
	'id'=>'items-stock-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                    'name'=>'item_id',
                    'value'=>'($data->item?$data->item->name:"")',
                ),
		'artikul',
		'artikul2',
		'barcode',
                array(
                    'name'=>'color_id',
                    'value'=>'($data->color?$data->color->name:"")',
                ),
		'size',
		'price',
		'discount',
		'stock',
		array(
                        'class'=>'booster.widgets.TbButtonColumn',
                        'template'=>'{update}{delete}',
		),
	),
)); ?>
