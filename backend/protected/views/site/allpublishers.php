							<div id="news">
									<h2>Documents</h2>
									
									<ul>
										<?php if(isset($model) && is_array($model)) : ?>
											<?php for($i=0;$i<count($model);$i++) :?>
													<li>
													<div class="left">
															<a href="<?=$this->createUrl('site/addPublisher' , array('id'=>$model[$i]->id, 'language'=>$lang)); ?>"><img src="/images/publishers/<?=$model[$i]->pic_name;?>" width=100 alt="" />	</a>
																											
													</div>

													<div class="right">
															<div class="summary">
															<?=(isset($model[$i]->translations[$lang]->teaser)?$model[$i]->translations[$lang]->teaser:'---'); ?>

															</div>
													</div>
													
													<div class="clearfix"></div>

															
													</li>
													<br>
													<br>
											<?php endfor; ?>
										<?php endif; ?>
											
									</ul>									
							</div>
