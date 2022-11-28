<?php
/* @var $this DistrictsController */
/* @var $model Districts */

$this->breadcrumbs=array(
	'Districts'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Districts', 'url'=>array('index')),
	array('label'=>'Create Districts', 'url'=>array('create')),
	array('label'=>'View Districts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Districts', 'url'=>array('admin')),
);
?>

<h1>Update Districts <?php echo $model->name; ?></h1>

<div>
    <ul class="nav nav-tabs nav-justified">
      <?php if ($model && $model->id):?>  
        <?php foreach($this->languages as $code=>$name):?>
            <li><a href="#<?=$name;?>" data-toggle="tab"><?=$name;?></a>
        <?php endforeach;?>
      <?php endif;?>
        <li class="active"><a href="#settings" data-toggle="tab">SETTINGS</a>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="settings">
            <?php $this->renderPartial('_form', array('model'=>$model)); ?>
        </div>
        <?php foreach($this->languages as $code=>$name):?>  
            <?php $tmpLang = $code;
               $modelContent = $model->getTranslation($tmpLang);
               $modelContent->language = $tmpLang;
               $modelContent->parent_id = $model->id;
            ?>
            <div class="tab-pane <?=($modelContent->name?'':'tab-empty');?>" id="<?=$name;?>">
                <?php $this->renderPartial('_form-content', array('model'=>$modelContent)); ?>
            </div>
        <?php endforeach;?>

    </div>
</div>