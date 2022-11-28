<?php
/* @var $this QuotePairsController */
/* @var $model QuotePairs */

$this->breadcrumbs=array(
	'Quote Pairs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List QuotePairs', 'url'=>array('index')),
	array('label'=>'Create QuotePairs', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#quote-pairs-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Calculator</h1>

<div>
    
    <div class=" mb20">
        <?=CHtml::link(Yii::t('system','Add Quote Pair'), $this->createUrl('quotePairs/create'), array('class'=>'btn btn-default'));?>
        <?=CHtml::link(Yii::t('system','Add Country Currency'), $this->createUrl('countryCurrency/create'), array('class'=>'btn btn-default'));?>
    </div>
    <ul class="nav nav-tabs nav-justified">
        <li><a href="#country" data-toggle="tab">Manage Country Currencies</a>
        <li class="active"><a href="#quote" data-toggle="tab">Manage Quote Pairs</a>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="quote">
                <?php $this->widget('MfeTbExtendedGridView', array(
                        'id'=>'quote-pairs-grid',
                        'dataProvider'=>$model->search(),
                        'filter'=>$model,
                        'columns'=>array(
                                'id',
                                'name',
                                'ps',
                                'v',
                                'broker_percent_long',
                                'broker_percent_short',
                                /*
                                'coefficient',
                                */
                                array(
                                    'class'=>'MfeTbButtonColumn',
                                    'template'=>'{update}{delete}',
                                ),
                        ),
                )); ?>
        </div>
        <div class="tab-pane" id="country">
            <?php 
                $country = new CountryCurrency();
                $country->unsetAttributes();
                if (isset($_GET['CountryCurrency']))
                    $country->attributes = $_GET[get_class($country)];
            ?>
            <?php $this->renderPartial('//countryCurrency/admin', array('model'=>$country)); ?>        
        </div>    
    </div>

</div>
