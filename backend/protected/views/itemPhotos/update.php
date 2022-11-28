<?php
/* @var $this ItemPhotosController */
/* @var $model ItemPhotos */

$this->breadcrumbs=array(
	'Item Photoses'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ItemPhotos', 'url'=>array('index')),
	array('label'=>'Create ItemPhotos', 'url'=>array('create')),
	array('label'=>'View ItemPhotos', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ItemPhotos', 'url'=>array('admin')),
);
?>

<h1>Update ItemPhotos <?php echo $model->id; ?></h1>

<?php echo CHtml::link('Back to Item', $this->createUrl('items/update',array('language'=>$this->Lang,'id'=>$model->item_id)));?>
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