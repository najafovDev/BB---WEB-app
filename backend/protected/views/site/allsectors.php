							<div id="partner_form">
									<h1>Sectors</h1>
									
									<ul>
										<?php if(isset($model) && is_array($model)) : ?>
											<?php for($i=0;$i<count($model);$i++) :?>
													<li>
													<a href="<?=$this->createUrl('site/addSector' , array('id'=>$model[$i]->id)); ?>"><h3><?=(isset($model[$i]->name)?$model[$i]->name:'---'); ?>  </h3></a>

													
													<div class="clearfix"></div>

															
													</li>
											<?php endfor; ?>
										<?php endif; ?>
											
									</ul>									
							</div>
