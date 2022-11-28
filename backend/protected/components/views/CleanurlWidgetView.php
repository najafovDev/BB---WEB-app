<?php $controller = Yii::app()->controller;?>
        <div class="col-sm-6">
		<?php echo CHtml::activeLabelEx($model,$attr); ?>
		<?php echo CHtml::activeTextField($model,$attr,array('class'=>'form-control data-cleanurl-str-field-'.$this->Lang)); ?>
		<?php echo CHtml::error($model,$attr); ?>
	</div>
        <?php if ($this->Lang!=null):?>
            <div class="col-sm-6">
                    <?php echo CHtml::activeLabelEx($cleanurl,'url'); ?>
                    <?php echo CHtml::activeTextField($cleanurl,'url',array('class'=>'form-control data-cleanurl-url-field-'.$this->Lang)); ?>
                    <?php echo CHtml::error($cleanurl,'url'); ?>
            </div>
        <?php else:?>
            <?php foreach($controller->languages as $code=>$str):?>
            <div class="col-sm-2">
                    <?php echo CHtml::activeLabelEx($cleanurl,'url'); ?>
                    <?php echo CHtml::activeTextField($cleanurl,'url',array('class'=>'form-control data-cleanurl-url-field-'.$this->Lang)); ?>
                    <?php echo CHtml::error($cleanurl,'url'); ?>
            </div>
            <?php endforeach;?>
        <?php endif;?>
<?php 

$tmp=<<<JAVASCRIPT
    $('.data-cleanurl-str-field-{$this->Lang}').bind('change',function(e){
        $.ajax({
            url:'{$controller->createUrl('str2url')}',
            data:{'str':$(this).val(),'language':'{$this->Lang}','id':'{$cleanurl->id}'},
            context:this,
        }).done(function(msg){
            $(this).parents('form').find('.data-cleanurl-url-field-{$this->Lang}').val(msg);
        });
   });
    $('.data-cleanurl-url-field-{$this->Lang}').bind('input',function(e){
        $.ajax({
            url:'{$controller->createUrl('url2db')}',
            data:{'str':$(this).val(),'language':'{$this->Lang}','parent_id':'{$cleanurl->parent_id}'},
            context:this,
            dataType:'json'
        }).done(function(msg){
            if (typeof(msg.length)==='undefined')
             $(this).parent('div').addClass('has-error');
            else $(this).parent('div').removeClass('has-error');
        });
   });
JAVASCRIPT;
            
    Yii::app()->clientscript->registerScript('str2urlScript'.$this->Lang,$tmp,  CClientScript::POS_READY);
?>