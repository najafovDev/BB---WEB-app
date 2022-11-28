                 	<div id="insider">
                    	<a name="top"></a>
                    	<div id="article">

                            <div class="articleText settings" style="position: relative; left: -10px;">
									<div class="sortThings">
											<label><?php print Yii::t('left','Process type'); ?></label>
											<select id="langSort" onchange="window.open('<?=$this->createUrl('site/orders', array('language'=>$lang, 'page'=>$page,'display'=>$display,'order'=>$order)); ?>&process='+this.options[this.selectedIndex].value,'_top')">
														<option value="0" <?=($process==0?'selected':'');?>>---</option>
														<? $pro_types = array('1'=>'Finished','2'=>'Being processed','3'=>'Cancelled','4'=>'Delivered','5'=>'Confirmed(card payments are already confirmed)'); ?>
														<? foreach ($pro_types as $key=>$val): ?>
																<option  <?=($process==$key?'selected':'');?> value="<?=$key;?>"><?=$val;?></option>
														<? endforeach;?>
											</select>
											<label><?php print Yii::t('left','Order type'); ?></label>
											<select id="langSort" onchange="window.open('<?=$this->createUrl('site/orders', array('language'=>$lang, 'page'=>$page,'display'=>$display,'process'=>$process)); ?>&display=<?=$pager->pageSize;?>&order='+this.options[this.selectedIndex].value,'_top')">
														<option value="0" <?=(($order=='')?'selected':'');?>>---</option>
														<? $order_types = array('card'=>'card','cash'=>'cash'); ?>
														<? foreach ($order_types as $key=>$val): ?>
																<option  <?=($order==$val?'selected':'');?> value="<?=$key;?>"><?=$val;?></option>
														<? endforeach;?>
											</select>


											<label><?php print Yii::t('left','Display'); ?></label>
						
											<select id="displayNo" onchange="window.open('<?=$this->createUrl('site/orders', array('language'=>$lang, 'page'=>1,'order'=>$order,'process'=>$process)); ?>&display='+this.options[this.selectedIndex].value,'_top')">
														<?php 
															$VolselectParam  = array(10,30,50,100);
															foreach($VolselectParam as $slct):
														?>
																					<option <?php if ($slct==$pager->pageSize) print "selected";?> value="<?=$slct; ?>"><?=$slct; ?></option>
														<?php endforeach; ?>
											</select>
									</div>				
								<div class="xett"> </div>
                            	<ul id="catItems">
											<style>
												.row input{
													width:auto;
												}
												.param{
													padding:5px;
													display:inline;
													border:1px solid green;
													margin-left:5px;
												}
											</style>
											<? foreach($models as $model):?>
													<div class="popup border">
															<div class="title left bold"><?=$model->order_id.": ".$model->shipping_name." ".$model->shipping_surname." : ".$model->address;?></div>
															
															<div class="edit right">
																	<img src="/css/img/edit.jpg" alt="">Edit</div>
															<div class="clearfl"></div>
															<div class="content hidden">
																<div class="">
																			<?php $form=$this->beginWidget('CActiveForm', array(
																				'id'=>'products-form',
																				'action'=>$this->createUrl('',array_merge($_GET,array('id'=>$model->order_id))),
																				'enableAjaxValidation'=>false,
																				'htmlOptions'=>array('enctype'=>'multipart/form-data'),
																			)); ?>
																				<div class="row left">
																						<div class="param">
																							<?=$form->errorSummary($model);?>
																							<?php echo $form->labelEx($model,'shipped'); ?>
																							<?php echo $form->checkBox($model,'shipped'); ?>
																							<?php echo $form->error($model,'shipped'); ?>
																						</div>
																						<div class="param">
																							<?php echo $form->labelEx($model,'finished'); ?>
																							<?php echo $form->checkBox($model,'finished'); ?>
																							<?php echo $form->error($model,'finished'); ?>
																						</div>
																						<div class="param">
																							<?php echo $form->labelEx($model,'cancelled'); ?>
																							<?php echo $form->checkBox($model,'cancelled'); ?>
																							<?php echo $form->error($model,'cancelled'); ?>
																						</div>
																						<div class="param">
																							<? if ($model->payment_method == 'cash') :?>
																								<?php echo $form->labelEx($model,'ordering_confirmed'); ?>
																								<?php echo $form->checkBox($model,'ordering_confirmed'); ?>
																								<?php echo $form->error($model,'ordering_confirmed'); ?>
																							<? endif; ?>
																						</div>
																				</div>
																				<div class="row right submit">
																							<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
																				</div>
																		 
																			<?php $this->endWidget(); ?>
																</div>
															</div>
															<div class="clearfl"></div>
															
													</div>
								<? endforeach;?>
                                </ul>
				<div  style="clear:both;"></div>
				<div id="pager">
					<?php 
					unset($_GET['url']);
					$this->widget('CLinkPager', array(
					    'pages' => $pager,
					    'cssFile'=>false,    
					    'prevPageLabel'=>Yii::t('left','Previous'),
					    'nextPageLabel'=>Yii::t('left','Next'),
					    'firstPageLabel'=>'',
					    'lastPageLabel'=>'',
					    'header' => '',
					)) ?>

				</div>
                            </div>
							
						</div>

                     </div>

<script type="text/javascript">
	$(".settings .popup").click(function(event){
		$('.settings .popup').addClass('border');
		$('.settings .popup .content').addClass('hidden');
		$(this).removeClass('border');
		$(this).children('.content').removeClass('hidden');
	  //alert($(this).text());
	});
</script>
