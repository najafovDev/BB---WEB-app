<?php
/* @var $this ContentController */
/* @var $model Menus */

$this->breadcrumbs=array(
	'Menus'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>
<h1>Update Menu #<?php echo $model->getTranslation($this->Lang)->name; ?> content</h1>
<div>
    <ul class="nav nav-tabs nav-justified">

        <? foreach($this->languages as $code=>$name):?>
        <li class="<?=($code==$this->getSetting('defaultLanguage','az')?'active':'');?>"><a href="#<?=$name;?>" data-toggle="tab"><?=$name;?></a>
        <? endforeach;?>
    </ul>
    <div class="tab-content">
        <? foreach($this->languages as $code=>$name):?>  
            <? $tmpLang = $code;
               $modelContent = $model->getTranslation($tmpLang);
               $modelContent->language = $tmpLang;
               $modelContent->articles_id = $model->id;
            ?>
            <div class="tab-pane <?=($code==$this->getSetting('defaultLanguage','az')?'active':'');?> <?=($modelContent->name?'':'tab-empty');?>" id="<?=$name;?>">
                <?php $this->renderPartial('_form-content', array('model'=>$modelContent)); ?>
            </div>
        <? endforeach;?>

    </div>
</div>