<?php
/* @var $this ShopOrderController */
/* @var $model ShopOrder */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shop-order-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'ordering_date'); ?>
		<?php echo $form->textField($model,'ordering_date',array('readonly'=>true,'size'=>60,'maxlength'=>255,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'ordering_date'); ?>
	</div>
	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'payment_method'); ?>
		<?php echo $form->textField($model,'payment_method',array('readonly'=>true,'size'=>60,'maxlength'=>255,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'payment_method'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('readonly'=>true,'size'=>60,'maxlength'=>255,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'ip'); ?>
	</div>
	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'transaction_id'); ?>
		<?php echo $form->textField($model,'transaction_id',array('readonly'=>true,'size'=>60,'maxlength'=>255,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'transaction_id'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'transaction_result'); ?>
		<?php echo $form->textArea($model,'transaction_result',array('readonly'=>true,'size'=>60,'maxlength'=>255,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'transaction_result'); ?>
	</div>


	<div class="col-sm-4">
                <div class="ckbox ckbox-primary">
                    <?php echo $form->checkBox($model,'ordering_done'); ?>
                    <?php echo $form->labelEx($model,'ordering_done'); ?>
                </div>
                <?php echo $form->error($model,'ordering_done'); ?>
	</div>

	<div class="col-sm-4">
                <div class="ckbox ckbox-primary">
                    <?php echo $form->checkBox($model,'ordering_confirmed'); ?>
                    <?php echo $form->labelEx($model,'ordering_confirmed'); ?>
                </div>
                <?php echo $form->error($model,'ordering_confirmed'); ?>
          
	</div>

	<div class="col-sm-4">
                <div class="ckbox ckbox-primary">
                    <?php echo $form->checkBox($model,'shipped'); ?>
                    <?php echo $form->labelEx($model,'shipped'); ?>
                </div>
                <?php echo $form->error($model,'shipped'); ?>
	</div>

	<div class="col-sm-4">
                <div class="ckbox ckbox-primary">
                    <?php echo $form->checkBox($model,'finished'); ?>
                    <?php echo $form->labelEx($model,'finished'); ?>
                </div>
                <?php echo $form->error($model,'finished'); ?>
	</div>

	<div class="col-sm-4">
                <div class="ckbox ckbox-primary">
                    <?php echo $form->checkBox($model,'cancelled'); ?>
                    <?php echo $form->labelEx($model,'cancelled'); ?>
                </div>
                <?php echo $form->error($model,'cancelled'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'shipping_fee'); ?>
		<?php echo $form->textField($model,'shipping_fee',array('size'=>60,'maxlength'=>255,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'shipping_fee'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'shipping_name'); ?>
		<?php echo $form->textField($model,'shipping_name',array('size'=>60,'maxlength'=>255,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'shipping_name'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'shipping_surname'); ?>
		<?php echo $form->textField($model,'shipping_surname',array('size'=>60,'maxlength'=>255,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'shipping_surname'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>255,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="col-sm-4">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textField($model,'message',array('size'=>60,'maxlength'=>255,'class'=>'form-control input-lg')); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>

        <div class="clearfix"></div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success pull-right')); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<div class="">
  <table class="table table-responsive">
  <?php foreach($model->products as $product):?>
    <tr>
      <td>
        <img src="/site/uploads/items/thumb/<?php echo $product->pic_name;?>" class="product__img">
      </td>
      <td>
        <a target="_blank" href="/<?php echo $this->Lang;?>/product/view/<?php echo $product->product_id;?>" class="product__name">
          <?php echo $product->name;?>
        </a>
      </td>
      <td>
        <?php echo $product->amount;?> azn

      </td>
      <td>
        <?php echo $product->quantity;?>(pcs)
      </td>
    </tr>
  <?php endforeach;?>
  </table>
</div>
