							<div id="news">
									<h2>News</h2>
									
									<ul>
										<?php if(isset($model) && is_array($model)) : ?>
											<?php for($i=0;$i<count($model);$i++) :?>
													<li>
													<a href="<?=$this->createUrl('/site/addNews' , array('id'=>$model[$i]->id, 'language'=>$lang)); ?>"><h3><?=(isset($model[$i]->translations[$lang]->name)?$model[$i]->translations[$lang]->name:'---'); ?>  </h3></a><span class="date">(<?=date('d.m.Y',strtotime($model[$i]->date));?>)</span>

													<div class="right">
															<div class="summary">
															<?=(isset($model[$i]->translations[$lang]->summary)?$model[$i]->translations[$lang]->summary:'---'); ?>

															</div>
													</div>
													<div class="clearfix"></div>

															
													</li>
											<?php endfor; ?>
										<?php endif; ?>
											
									</ul>									
							</div>
