<?php
/* @var $this CompetitionScheduleController */
/* @var $model CompetitionSchedule */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'competition-schedule-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'date_r_n'); ?>
                <?php 
                        $this->widget(
                            'booster.widgets.TbDatePicker',
                            array(
                                'model' => $model,
                                'attribute' => 'date_r_n',
                                'options'=>array(
                                    'format' => 'yyyy-mm-dd',
                                    'viewformat' => 'mm/dd/yyyy',                                    
                                ),
                                'htmlOptions'=>array(
                                    'class'=>'form-control input-lg'
                                )
                            )
                        );
                ?>
		<?php echo $form->error($model,'date_r_n'); ?>
	</div>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'date_r_k'); ?>
                <?php 
                        $this->widget(
                            'booster.widgets.TbDatePicker',
                            array(
                                'model' => $model,
                                'attribute' => 'date_r_k',
                                'options'=>array(
                                    'format' => 'yyyy-mm-dd',
                                    'viewformat' => 'mm/dd/yyyy',                                    
                                ),
                                'htmlOptions'=>array(
                                    'class'=>'form-control input-lg'
                                )
                            )
                        );
                ?>
		<?php echo $form->error($model,'date_r_k'); ?>
	</div>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'date_pk_n'); ?>
                <?php 
                        $this->widget(
                            'booster.widgets.TbDatePicker',
                            array(
                                'model' => $model,
                                'attribute' => 'date_pk_n',
                                'options'=>array(
                                    'format' => 'yyyy-mm-dd',
                                    'viewformat' => 'mm/dd/yyyy',                                    
                                ),
                                'htmlOptions'=>array(
                                    'class'=>'form-control input-lg'
                                )
                            )
                        );
                ?>
		<?php echo $form->error($model,'date_pk_n'); ?>
	</div>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'date_pk_k'); ?>
                <?php 
                        $this->widget(
                            'booster.widgets.TbDatePicker',
                            array(
                                'model' => $model,
                                'attribute' => 'date_pk_k',
                                'options'=>array(
                                    'format' => 'yyyy-mm-dd',
                                    'viewformat' => 'mm/dd/yyyy',                                    
                                ),
                                'htmlOptions'=>array(
                                    'class'=>'form-control input-lg'
                                )
                            )
                        );
                ?>
		<?php echo $form->error($model,'date_pk_k'); ?>
	</div>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'open'); ?>
		<?php echo $form->dropDownList($model,'open',$model->getOpenList(),array('class'=>'form-control input-lg selectpicker')); ?>
		<?php echo $form->error($model,'open'); ?>
	</div>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="col-sm-4 col-md-3">
		<?php echo $form->labelEx($model,'go'); ?>
		<?php echo $form->checkBox($model,'go',array('class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'go'); ?>
	</div>

        <div class="clearfix"></div>
	<div class=" buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn input-lg btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
    $user = new UserList();
    $user->unsetAttributes();
    $user->comp_id = $model->id;
    if (isset($_GET['UserList']))
        $user->attributes = $_GET['UserList'];

    $this->renderPartial('//userList/admin',array(
            'model'=>$user,
    ));
?>