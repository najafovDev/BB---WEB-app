<style >

.gallImage{
	position:relative;
	display:inline-block;
}
.delNA{
	font-family:Arial;
	cursor:pointer;
	top:-12px;
	left:0px;
	position:absolute;
	color:red;
	font-weight:bolder;

}

.delBS{
	font-family:Arial;
	cursor:pointer;
	top:10px;
	left:160px;
	position:relative;
	color:red;
	font-weight:bolder;

}

.gallDel {
	cursor:pointer;
	top:0px;
	left:5px;
	position:absolute;
	color:red;
	font-weight:bolder;
}
</style>

 <script type="text/javascript" charset="utf-8">
     $().ready(function() {
         var opts = {
                absoluteURLs: false,
                cssClass : 'el-rte',
                lang     : 'en',
                height   : 320,
                absoluteURLs  : 0,
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
	
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
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


<script type="text/javascript" src="/js/jquery.uploadify.v2.1.0.min.js"></script>
<?php 
/*$clientScript = Yii::app()->getClientScript();
        $clientScript->scriptMap=array(
            "jquery.js"=>false,
        );
$clientScript->registerCoreScript('jquery');
*/

/* if ($model1->id )

$this->widget('application.extensions.uploadify.EuploadifyWidget', 
    array(
        'name'=>'uploadme',
        'options'=> array(
            //'uploader' => '/js/uploadify.swf',
            'script' => $this->createUrl('site/UploadedFiles'), 
            //'cancelImg' => '/js/cancel.png',
            'auto' => true,
            'multi' => true,
            'folder' => '/tmp',
            'scriptData' => array('extraVar' => 1234, 'PHPSESSID' => session_id(),'id'=>$model1->id),
            //'fileDesc' => 'Declaratiebestanden',
            //'fileExt' => '*.*',
            'buttonText' => 'Upload a lot!',
            'width' => 150,
            ),
        'callbacks' => array( 
           'onError' => 'function(evt,queueId,fileObj,errorObj){alert("Error: " + errorObj.type + "\nInfo: " + errorObj.info);}',
           'onComplete' => 'function(evt,queueId,fileObj,errorObj){getLast('.$model1->id.',evt,queueId,fileObj,errorObj);}',
         //  'onCancel' => 'function(evt,queueId,fileObj,data){alert("Cancelled");}',
        )
    )); 
*/
?>
	<div class="row galleryPics">
	<script type="text/javascript">
		function getLast(paramid,evt,queueId,fileObj,errorObj){
                                $.get(
                                    "/mfe/index.php?r=site/getLast",
                                    {id:paramid , filename:fileObj.name},
                                    function(data) {
                                       $('.galleryPics').append(data);
                                       //alert('page content: ' + data);
                                    }
                                );

			
		}
		function delImage(paramid){
			var agree=confirm("Are you sure you want to delete?");
			if (agree){
				$.get(
				    "/mfe/index.php?r=site/delImg",
				    {id:paramid },
				    function(data) {
				       if (data == "deleted")	$('.gallImage'+paramid).remove();
				       //alert('page content: ' + data);
				    }
				);
				
				return true ;
			}
		}
	</script>
		<?php if ( $model1->id )
			{
			$gallerMod = new Gallery(); 
			$gallerMod = $gallerMod ->findAll('parent_id='.$model1->id);
			if ($gallerMod)
			foreach($gallerMod as $gallImage){
				print "<div class='gallImage gallImage".$gallImage->id."'><div class='gallDel' onClick='delImage(".$gallImage->id.")' >X</div><a target='_blank' href='/mfe/index.php?r=site/addImage&id=".$gallImage->id."&language=".$lang."'><img height=40 src='/images/gallery/".$gallImage->pic_name."'></a></div>";
			}
			//print_r($gallerMod);
			}
		?>
	</div>

	<?php if (isset($model1) && $model1->type=='news') : ?>
	<div class="row">
		<?php echo $form->labelEx($model1,'date'); ?>
		<?php echo $form->textField($model1,'date'); ?>
		<?php echo $form->error($model1,'date'); ?>
	</div>
	<?php endif; ?>

	<?php if (isset($model1) && $model1->type=='news') : ?>
	<div class="row">
		<?php //echo $form->labelEx($model1,'parent_id'); ?>
		<? //$ld = CHtml::listData($parents,'id','keyword');
			$model1->parent_id=-1;
		?>
		<?=$form->hiddenField($model1,'parent_id');?>
		<?php //echo $form->error($model1,'parent_id'); ?>
	</div>
	<?php endif; ?>
	<?php if (isset($model1) && $model1->type=='news') : ?>
	<div class="row">
		<?php echo $form->labelEx($model1,'front'); ?>
		<?=$form->dropDownList($model1,'front',array('empty'=>'Choose One','0'=>'Do not show on frontpage','1'=>'Show on frontpage'));?>
		<?php echo $form->error($model1,'front'); ?>
	</div>
	<?php endif; ?>
	
	<?php if (isset($model1) && $model1->type=='news') : ?>
	<div class="row">
		<?php echo $form->labelEx($model1,'magyar'); ?>
		<?php echo CHtml::activeCheckBox($model1,'magyar');?>
		<?php echo $form->error($model1,'magyar'); ?>
	</div>
	<?php endif; ?>
	
	<?php if (isset($model1) && $model1->type=='news') : ?>
	<div class="row">
		<?php echo $form->labelEx($model1,'azerbaijani'); ?>
		<?php echo CHtml::activeCheckBox($model1,'azerbaijani');?>
		<?php echo $form->error($model1,'azerbaijani'); ?>
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
