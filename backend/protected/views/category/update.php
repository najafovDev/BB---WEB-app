<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'View Category', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Category', 'url'=>array('admin')),
);
?>

<h1>Update Category <?php echo $model->id; ?></h1>
<div>
<ul class="nav nav-tabs nav-justified">
  <?php if ($model && $model->id):?>  
    <?php foreach($this->languages as $code=>$name):?>
        <li><a href="#<?=$name;?>" data-toggle="tab"><?=$name;?></a>
    <?php endforeach;?>
  <?php endif;?>
    <li><a href="#photo-gallery" data-toggle="tab">GALLERY</a>
    <li class="active"><a href="#settings" data-toggle="tab">SETTINGS</a>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="settings">
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
    <div class="tab-pane" id="photo-gallery">
        <?php $this->renderPartial('//gallery-widget', array('model'=>$model)); ?>        
    </div>
    <? foreach($this->languages as $code=>$name):?>  
        <?php
            $tmpLang = $code;
            $modelContent = $model->getTranslation($tmpLang);
            $modelContent->language = $tmpLang;
            $modelContent->parent_id = $model->id;
        ?>
        <div class="tab-pane <?=($modelContent->name?'':'tab-empty');?>" id="<?=$name;?>">
            <?php $this->renderPartial('_form-content', array('model'=>$modelContent)); ?>
        </div>
    <? endforeach;?>
    
</div>
</div>