<?php
/* @var $this BrandsController */
/* @var $model Brands */

$this->breadcrumbs=array(
	'Brands'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Brands', 'url'=>array('index')),
	array('label'=>'Create Brands', 'url'=>array('create')),
	array('label'=>'View Brands', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Brands', 'url'=>array('admin')),
);
?>

<h1>Update Brands <?php echo $model->id; ?></h1>
<div>
    <ul class="nav nav-tabs nav-justified">
        <li class="active"><a href="#SETTINGS" data-toggle="tab"><?='SETTINGS';?></a>
        <?php foreach($this->languages as $code=>$name):?>
        <li class="<?=($code==$this->getSetting('defaultLanguage','az')?'':'');?>"><a href="#<?=$name;?>" data-toggle="tab"><?=$name;?></a>
        <?php endforeach;?>
        <li><a href="#photo-gallery" data-toggle="tab">GALLERY</a>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="SETTINGS">
            <?php $this->renderPartial('_form', array('model'=>$model)); ?>
        </div>
        <?php foreach($this->languages as $code=>$name):?>
            <?php
                $tmpLang = $code;
                $modelContent = $model->getTranslation($tmpLang);
                $modelContent->language = $tmpLang;
                $modelContent->parent_id = $model->id;
            ?>
            <div class="tab-pane <?=($code==$this->getSetting('defaultLanguage','az')?'':'');?> <?=($modelContent->name?'':'tab-empty');?>" id="<?=$name;?>">
                <?php $this->renderPartial('_form-Translate', array('model'=>$modelContent)); ?>
            </div>
        <?php endforeach;?>
        <div class="tab-pane" id="photo-gallery">
            <?php $this->renderPartial('//gallery-widget', array('model'=>$model)); ?>        
        </div>

    </div>
</div>