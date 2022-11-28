<?php
/* @var $this ContentController */
/* @var $model Menus */

$this->breadcrumbs=array(
	'Menus'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>
<h1>Update Menu #<?php echo $model->getTranslation($this->Lang)->name; ?></h1>

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
        <?php foreach($this->languages as $code=>$name):?>
            <?php $tmpLang = $code;
               $modelContent = $model->getTranslation($tmpLang);
               $modelContent->language = $tmpLang;
               $modelContent->menus_id = $model->id;
            ?>
            <div class="tab-pane <?=($modelContent->name?'':'tab-empty');?>" id="<?=$name;?>">
                <?php $this->renderPartial('_form-Translate', array('model'=>$modelContent)); ?>
            </div>
        <?php endforeach;?>

    </div>
</div>