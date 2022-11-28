 <script type="text/javascript" charset="utf-8">
     $().ready(function() {
         var opts = {
                absoluteURLs: false,
                cssClass : 'el-rte',
                lang     : 'en',
                height   : 320,
                toolbar  : 'maxi',
                cssfiles : ['/mfe/elrted/css/elrte-inner.css'],
                fmOpen : function(callback) {
                    $('<div id="myelfinder" />').elfinder({
                        url : '/mfe/elfind/connectors/php/connector.php',
                        lang : 'en',
                        dialog : { height : 900, modal : true, title : 'elFinder - file manager for web' },
                        closeOnEditorCallback : true,
                        editorCallback : callback
                    })

            }
         };
         // create editor
         $('#ArticlesTranslate_body').elrte(opts);

         // or this way
         // var editor = new elRTE(document.getElementById('our-element'), opts);
     });


 </script>
<div id="static" class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'articles-translate-articlesTranslate-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data')
	
)); ?>asd

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<div>
			<?=$form->errorSummary($model);?>
			<?=$form->errorSummary($model1);?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>
	<div class="delMenu">
			<a href="<?php if (isset($model)&&$model1->type=='news') print $this->CreateUrl('site/delNews',array('language'=>$lang,'id'=>$model->articles_id)); else '#'; ?>">Delete </a>
	</div>
	<?php if (isset($model)) echo $form->errorSummary($model); ?>


		
	<?php if (isset($model1)) : ?>
    <div class="row">
        <?php //echo $form->labelEx($model,'parent_id'); ?>
        <?php echo $form->hiddenField($model1,'parent_id'); ?>
        <?php //echo $form->error($model,'parent_id'); ?>
    </div>
	<?php endif; ?>

	<div class="row">
		<?php if (isset($model1)): ?>
				<?php echo $form->labelEx($model1,'pic_name'); ?>
				<?php echo $form->fileField($model1,'pic_name',array('style'=>'width:200px')); ?>
				<?php echo $form->error($model1,'pic_name'); ?>
				<img height=50 src="<?="/images/menu/".$model1->pic_name;?>"/>
		<?php endif; ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'id'); ?>
		<?php //echo $form->textField($model,'id'); ?>
		<?php //echo $form->error($model,'id'); ?>
	</div>

	<?php if (isset($model)) : ?>
	<div class="row">	
		<?php //echo $form->labelEx($model,'articles_id'); ?>
		<?php echo $form->hiddenField($model,'articles_id'); ?>
		<?php echo $form->error($model,'articles_id'); ?>
	</div>
	<?php endif; ?>

	<?php if (isset($model)) : ?>
	<div class="row">
		<?php //echo $form->labelEx($model,'language'); ?>
		<?php echo $form->hiddenField($model,'language'); ?>
		<?php echo $form->error($model,'language'); ?>
	</div>
	<?php endif; ?>

	<?php if (isset($model)) : ?>
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<?php endif; ?>


	<?php if (isset($model1) && $model1->type=='news') : ?>
	<div class="row">
		<?php echo $form->labelEx($model1,'date'); ?>
		<?php echo $form->textField($model1,'date'); ?>
		<?php echo $form->error($model1,'date'); ?>
	</div>
	<?php endif; ?>


	<?php if (isset($model)) : ?>
	<div class="row">
		<?php echo $form->labelEx($model,'summary'); ?>
		<?php echo $form->textArea($model,'summary'); ?>
		<?php echo $form->error($model,'summary'); ?>
	</div>
	<?php endif; ?>

	<?php if (isset($model)) : ?>
	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body'); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>
	<?php endif; ?>



<?php $this->endWidget(); ?>

</div><!-- form -->
