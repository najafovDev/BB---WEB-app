<div id="static" class="form">
	<?php if (isset($model1)): ?>
		<div class="delMenu">
				<a href="<?=$this->CreateUrl('site/delMenu', array('id'=>$model1->id,'language'=>$lang)); ?>">Delete Menu
				</a>
		</div>
	<?php endif; ?>
	
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'menus-translate-menusTranslate-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php if (isset($model)): ?>
			<?php echo $form->errorSummary($model); ?>
	<?php endif; ?>


	<div class="row">
		<?php if (isset($model)): ?>
				<?php //echo $form->labelEx($model,'language'); ?>
				<?php echo $form->hiddenField($model,'language'); ?>
				<?php echo $form->error($model,'language'); ?>
		<?php endif; ?>
	</div>

	<div class="row">
		<?php if (isset($model)): ?>
				<?php echo $form->labelEx($model,'name'); ?>
				<?php echo $form->textField($model,'name'); ?>
				<?php echo $form->error($model,'name'); ?>
		<?php endif; ?>
	</div>

	<div class="row">
		<?php if (isset($model)): ?>
				<?php echo $form->labelEx($model1,'pic_name'); ?>
				<?php echo $form->fileField($model1,'pic_name'); ?>
				<?php echo $form->error($model1,'pic_name'); ?>
				<img height=50 src="<?="/images/menu/".$model1->pic_name;?>"/>
		<?php endif; ?>
	</div>

	<div class="row">
		<?php if (isset($model)): ?>
				<?php echo $form->labelEx($model,'link'); ?>
				<?php echo $form->textField($model,'link'); ?>
				<?php echo $form->error($model,'link'); ?>
		<?php endif; ?>
	</div>


	<div class="row">
		<?php if (isset($model1)): ?>
				<?php echo $form->labelEx($model1,'sort'); ?>
				<?php echo $form->textField($model1,'sort'); ?>
				<?php echo $form->error($model1,'sort'); ?>
		<?php endif; ?>
	</div>

	<div class="row">
		<?php if (isset($model1)): ?>
				<?php echo $form->labelEx($model1,'banner'); ?>
				<?php echo $form->dropDownlist($model1,'banner',array(0=>'Do not show', 1=>'Show')); ?>
				<?php echo $form->error($model1,'banner'); ?>
		<?php endif; ?>
	</div>

	<div class="row">
		<?
			$parents=Menus::model()->with()->findAll('parent_id=-1');
			$listData[''] = '--Chose one--';
			$listData['-1'] = 'Primary Root';
			foreach($parents as $prnt){
				$listData[$prnt->id]=(isset($prnt->translations[$this->Lang]) && $prnt->translations[$this->Lang]->name?$prnt->translations[$this->Lang]->name:$prnt->keyword);
				foreach($prnt->childs as $child){
					$listData[$child->id]='--'.(isset($child->translations[$this->Lang]) && $child->translations[$this->Lang]->name?$child->translations[$this->Lang]->name:$child->keyword);
					foreach($child->childs as $child2){
						$listData[$child2->id]='-----'.(isset($child2->translations[$this->Lang]) && $child2->translations[$this->Lang]->name?$child2->translations[$this->Lang]->name:$child2->keyword);
						foreach($child2->childs as $child3){
							$listData[$child3->id]='--------'.(isset($child3->translations[$this->Lang]) && $child3->translations[$this->Lang]->name?$child3->translations[$this->Lang]->name:$child3->keyword);
							foreach($child3->childs as $child4){
								$listData[$child4->id]='-----------'.(isset($child4->translations[$this->Lang]) && $child4->translations[$this->Lang]->name?$child4->translations[$this->Lang]->name:$child4->keyword);
								foreach($child4->childs as $child5){
									$listData[$child5->id]='-------------'.(isset($child5->translations[$this->Lang]) && $child5->translations[$this->Lang]->name?$child5->translations[$this->Lang]->name:$child5->keyword);
								}
								
							}
						}
						
					}
					
				}
			}	
			$listData['-2'] = 'Secondary Root';
			$parents=Menus::model()->with()->findAll('parent_id=-2');
			foreach($parents as $prnt){
				$listData[$prnt->id]=(isset($prnt->translations[$this->Lang]) && $prnt->translations[$this->Lang]->name?$prnt->translations[$this->Lang]->name:$prnt->keyword);
				foreach($prnt->childs as $child){
					$listData[$child->id]='--'.(isset($child->translations[$this->Lang]) && $child->translations[$this->Lang]->name?$child->translations[$this->Lang]->name:$child->keyword);
					foreach($child->childs as $child2){
						$listData[$child2->id]='-----'.(isset($child2->translations[$this->Lang]) && $child2->translations[$this->Lang]->name?$child2->translations[$this->Lang]->name:$child2->keyword);
						foreach($child2->childs as $child3){
							$listData[$child3->id]='--------'.(isset($child3->translations[$this->Lang]) && $child3->translations[$this->Lang]->name?$child3->translations[$this->Lang]->name:$child3->keyword);
							foreach($child3->childs as $child4){
								$listData[$child4->id]='-----------'.(isset($child4->translations[$this->Lang]) && $child4->translations[$this->Lang]->name?$child4->translations[$this->Lang]->name:$child4->keyword);
								foreach($child4->childs as $child5){
									$listData[$child5->id]='-------------'.(isset($child5->translations[$this->Lang]) && $child5->translations[$this->Lang]->name?$child5->translations[$this->Lang]->name:$child5->keyword);
								}
								
							}
						}
						
					}
					
				}
			}	
			
			echo CHtml::activeDropDownList($model1,'parent_id',$listData); 
		
		?>
	</div>

	<div class="row">
		<?php if (isset($model1)): ?>
				<?php echo $form->labelEx($model1,'keyword'); ?>
				<?php echo $form->textField($model1,'keyword'); ?>
				<?php echo $form->error($model1,'keyword'); ?>
		<?php endif; ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->