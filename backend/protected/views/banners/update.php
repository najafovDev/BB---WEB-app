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
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Banners', 'url'=>array('index')),
	array('label'=>'Create Banners', 'url'=>array('create')),
	array('label'=>'View Banners', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Banners', 'url'=>array('admin')),
);
?>

<h1>Update Banners <?php echo $model->id; ?></h1>
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
        <? foreach($this->languages as $code=>$name):?>
            <?php
                $tmpLang = $code;
                $modelContent = $model->getTranslation($tmpLang);
                $modelContent->language = $tmpLang;
                $modelContent->parent_id = $model->id;
            ?>
            <div class="tab-pane <?=($modelContent->topic?'':'tab-empty');?>" id="<?=$name;?>">
                <?php $this->renderPartial('_form-content', array('model'=>$modelContent)); ?>
            </div>
        <? endforeach;?>

    </div>

</div>
