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

<div id="static" class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'products-translate-articlesTranslate-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data')
	
)); ?>
	<h1>Add Item</h1>
	<br>
	<br>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<div class="delMenu">
			<a href="<?php if (isset($model1)) print $this->CreateUrl('site/delItem',array('id'=>$model1->id)); else '#'; ?>">Delete </a>
	</div>
	<?php if (isset($model1)) echo $form->errorSummary($model1); ?>

		<? if ($model1->pic_name):?>
			<img src="/site/images/items/small/<?=$model1->pic_name; ?>" />
		<? endif;?>
	<div class="row">	
		<?php echo $form->labelEx($model1,'pic_name'); ?>
		<?php echo $form->fileField($model1,'pic_name'); ?>
		<?php echo $form->error($model1,'pic_name'); ?>
	</div>

	<? if ($model1->id):?>

		<script type="text/javascript" src="/js/jquery.uploadify.v2.1.0.min.js"></script>
		<?php 
		/*$clientScript = Yii::app()->getClientScript();
				$clientScript->scriptMap=array(
					"jquery.js"=>false,
				);
		$clientScript->registerCoreScript('jquery');
		*/

		$module = 'items';

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
					'scriptData' => array('extraVar' => 1234, 'PHPSESSID' => session_id(),'id'=>$model1->id,'type'=>$module),
					//'fileDesc' => 'Declaratiebestanden',
					//'fileExt' => '*.*',
					'buttonText' => 'Upload do figa',
					'width' => 150,
					),
				'callbacks' => array( 
				   'onError' => 'function(evt,queueId,fileObj,errorObj){alert("Error: " + errorObj.type + "\nInfo: " + errorObj.info);}',
				   'onComplete' => 'function(evt,queueId,fileObj,errorObj){getLast('.$model1->id.',evt,queueId,fileObj,errorObj);}',
				 //  'onCancel' => 'function(evt,queueId,fileObj,data){alert("Cancelled");}',
				)
			)); 

		?>
			<div class="row galleryPics">
			<script type="text/javascript">
				function getLast(paramid,evt,queueId,fileObj,errorObj){
										$.get(
											"/mfe/index.php?r=site/getLast",
											{id:paramid , filename:fileObj.name,type:'<?=$module;?>'},
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
							{id:paramid,type:'<?=$module;?>' },
							function(data) {
							   if (data == "deleted")	$('.gallImage'+paramid).remove();
							   //alert('page content: ' + data);
							}
						);
						
						return true ;
					}
				}
			</script>
				<?php
					$gallerMod = new Gallery(); 
					$gallerMod = $gallerMod ->findAll('parent_id="'.$module.$model1->id.'"');
					if ($gallerMod)
					foreach($gallerMod as $gallImage){
						print "<div class='gallImage gallImage".$gallImage->id."'><div class='gallDel' onClick='delImage(".$gallImage->id.")' >X</div><img height=40 src='/images/gallery/".$gallImage->pic_name."'></div>";
					}
					//print_r($gallerMod);
					
				?>
			</div>
	<? endif;?>

	<div class="row">
		<?php echo $form->labelEx($model1,'category_id'); ?>
		<?php echo $form->dropDownList($model1,'category_id',Category::getList()); ?>
		<?php echo $form->error($model1,'category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model1,'name'); ?>
		<?php echo $form->textField($model1,'name'); ?>
		<?php echo $form->error($model1,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model1,'body'); ?>
		<?php echo $form->textArea($model1,'body',array('height'=>200)); ?>
		<?php echo $form->error($model1,'body'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model1,'new'); ?>
		<?php echo $form->checkBox($model1,'new'); ?>
		<?php echo $form->error($model1,'new'); ?>
		<?php echo $form->labelEx($model1,'front'); ?>
		<?php echo $form->checkBox($model1,'front'); ?>
		<?php echo $form->error($model1,'front'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model1,'color_id'); ?>
		<?php
		$fa=Colors::model()->findAll();
		$ld=CHtml::listData($fa,'id','name');
		echo CHtml::activeDropDownList($model1,'color_id',$ld); ?>
		<?php echo $form->error($model1,'color_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model1,'size'); ?>
		<?php echo $form->textField($model1,'size'); ?>
		<?php echo $form->error($model1,'size'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model1,'price'); ?>
		<?php echo $form->textField($model1,'price'); ?>
		<?php echo $form->error($model1,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model1,'discount'); ?>
		<?php echo $form->textField($model1,'discount'); ?>
		<?php echo $form->error($model1,'discount'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
