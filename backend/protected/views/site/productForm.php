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
         $('#ProductsTranslate_body').elrte(opts);

         // or this way
         // var editor = new elRTE(document.getElementById('our-element'), opts);
     });


 </script>
<div id="static" class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'products-translate-articlesTranslate-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data')
	
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<div class="delMenu">
			<a href="<?php if (isset($model)) print $this->CreateUrl('site/delNews',array('language'=>$lang,'id'=>$model1->id)); else '#'; ?>">Delete </a>
	</div>
	<?php if (isset($model)) echo $form->errorSummary($model); ?>


	<?php if (isset($model1)) : ?>
	<img src="/images/products/<?=$model1->pic_name; ?>" />
	<div class="row">	
		<?php echo $form->labelEx($model1,'pic_name'); ?>
		<?php echo $form->fileField($model1,'pic_name'); ?>
		<?php echo $form->error($model1,'pic_name'); ?>
	</div>
	<?php endif; ?>


	<?php if (isset($model1)) : ?>
	<div class="row">	
		<?php echo $form->labelEx($model1,'show_on_front'); ?>
		<?php echo CHtml::activeDropDownList($model1,'show_on_front',array(0=>'Do not publish on front',1=>'Publish on front'));?>
		<?php echo $form->error($model1,'show_on_front'); ?>
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

	<?php if (isset($model)) : ?>
	<div class="row">
		<?php echo $form->labelEx($model,'teaser'); ?>
		<?php echo $form->textArea($model,'teaser'); ?>
		<?php echo $form->error($model,'teaser'); ?>
	</div>
	<?php endif; ?>

	<?php if (isset($model)) : ?>
	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body'); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>
	<?php endif; ?>
	


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
