<h1><?php echo Yii::t('system','My Settings');?></h1>
<div class="settings">
		<div id="insider" class="checkout">
                    	<a name="top"></a>
                    	<div id="article" >
                            <div class="articleText">
                                <div class="panel-group " id="private-settings">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#private-settings" href="#setting-name" class="collapsed">
                                                    <?=Yii::t('left','Adınız, Soyadınız');?>
                                                </a>
                                            </h4> 
                                        </div>
                                        <div id="setting-name" class="panel-collapse collapse" style="height: 0px;">
                                            <div class="panel-body">
                                                <div class="">
                                                                <?php echo CHtml::beginForm('','post'); ?>

                                                                <div class=" col-sm-9">
                                                                <?php echo CHtml::activeTextField($user,'name', array('class'=>'form-control input-lg')); ?>
                                                                <?php echo CHtml::hiddenField("setting",'name'); ?>
                                                                </div>
                                                                <div class=" col-sm-3">
                                                                                <?php echo CHtml::submitButton(Yii::t('left','Yadda saxla'),array(
                                                                                                  "class"=>"logmein  btn-primary input-lg form-control"
                                                                                )); ?>
                                                                </div>

                                                                <?php echo CHtml::endForm(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#private-settings" href="#setting-phone" class="collapsed">
                                                    <?=Yii::t('left','Phone');?>
                                                </a>
                                            </h4> 
                                        </div>
                                        <div id="setting-phone" class="panel-collapse collapse" style="height: 0px;">
                                            <div class="panel-body">
                                                <div class="">
                                                    <?php echo CHtml::beginForm('','post'); ?>

                                                    <div class=" col-sm-9">
                                                    <?php echo CHtml::activeTextField($user,'phone', array('class'=>'form-control input-lg ')); ?>
                                                    <?php echo CHtml::hiddenField("setting",'phone'); ?>
                                                    </div>
                                                    <div class=" col-sm-3">
                                                                    <?php echo CHtml::submitButton(Yii::t('left','Yadda saxla'),array(
                                                                                                  "class"=>"logmein  btn-primary input-lg form-control"
                                                                    )); ?>
                                                    </div>

                                                    <?php echo CHtml::endForm(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#private-settings" href="#setting-email" class="collapsed">
                                                    <?=Yii::t('left','E-mail');?>
                                                </a>
                                            </h4> 
                                        </div>
                                        <div id="setting-email" class="panel-collapse collapse" style="height: 0px;">
                                            <div class="panel-body">
                                                <div class="">
                                                    <?php echo CHtml::beginForm('','post'); ?>

                                                    <div class=" col-sm-9">
                                                    <?php echo CHtml::activeTextField($user,'email', array('class'=>'form-control input-lg')); ?>
                                                    <?php echo CHtml::hiddenField("setting",'email'); ?>
                                                    </div>
                                                    <div class=" col-sm-3">
                                                                    <?php echo CHtml::submitButton(Yii::t('left','Yadda saxla'),array(
                                                                                                  "class"=>"logmein  btn-primary input-lg form-control"
                                                                    )); ?>
                                                    </div>

                                                    <?php echo CHtml::endForm(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#private-settings" href="#setting-password" class="collapsed">
                                                    <?=Yii::t('left','Password');?>
                                                </a>
                                            </h4> 
                                        </div>
                                        <div id="setting-password" class="panel-collapse collapse" style="height: 0px;">
                                            <div class="panel-body">
                                                <div class="">
                                                    <?php echo CHtml::beginForm('','post'); ?>

                                                    <div class=" username">
                                                        <div class="col-sm-3">
                                                           <?php echo CHtml::textField('password',(isset($_POST['password'])?$_POST['password']:Yii::t('left','Mövcud şifrəniz')), array('class'=>'form-control input-lg', "onfocus"=>"this.value='';this.type='password'; this.onfocus=null;")); ?>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <?php echo CHtml::textField('password2',(isset($_POST['password2'])?$_POST['password2']:Yii::t('left','Yeni şifrəniz')), array('class'=>'form-control input-lg', "onfocus"=>"this.value='';this.type='password'; this.onfocus=null;")); ?>
                                                        </div>
                                                        <div class="col-sm-3">
                                                             <?php echo CHtml::textField('password3',(isset($_POST['password3'])?$_POST['password3']:Yii::t('left','Yeni şifrənizi təkrar edin')), array('class'=>'form-control input-lg', "onfocus"=>"this.value=''; this.type='password';this.onfocus=null;")); ?>
                                                        </div>
                                                        <div class="col-sm-3">
                                                             <?php echo CHtml::hiddenField("setting",'password'); ?>
                                                            <?php echo CHtml::submitButton(Yii::t('left','Yadda saxla'),array(
                                                                                                  "class"=>"logmein  btn-primary input-lg form-control"
                                                            )); ?>
                                                            
                                                        </div>
                                                    </div>

                                                    <?php echo CHtml::endForm(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="xett"></div>
                            </div>
						</div>

                     </div>
</div>
