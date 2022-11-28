<?php
/* @var $this CustomersController */
/* @var $model Customers */

$this->breadcrumbs=array(
	'Customers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Customers', 'url'=>array('index')),
	array('label'=>'Create Customers', 'url'=>array('create')),
);

?>

<h1>Manage Customers</h1>
<div>
<?php echo CHtml::link('Add Customer',$this->createUrl('customers/create'),array('class'=>'btn btn-primary'));?>

<?php $this->widget('MfeTbExtendedGridView', array(
	'id'=>'customers-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
                array(
                    'name'=>'type',
                    'value'=>'$data->getUserTypes($data->type);',  
                    'filter' => CHtml::activeDropDownList($model, 'type', $model->getUserTypes(),array('class'=>'form-control input-lg','empty'=>'')), // fields from country table
                ),
		'name',
		'surname',
		'phone',
		'email',
		'login',
		/*
		'email_confirmed',
		'address',
		'password',
		'subscribe',
		'date',
		'latitude',
		'longitude',
		'pic_name',
		*/
		array(
			'class'=>'MfeTbButtonColumn',
                        'template'=>'{update}{delete}',
		),
	),
)); ?>
</div>