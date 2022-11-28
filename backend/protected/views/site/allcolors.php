							<div id="news">
									<h2>Colors</h2>
									
									<ul>
										<?php if(isset($model) && is_array($model)) : ?>
											<?php for($i=0;$i<count($model);$i++) :?>
													<li>
													<div class="">
															<a href="<?=$this->createUrl('/site/addColor' , array('id'=>$model[$i]->id)); ?>"><?=$model[$i]->name;?> </a> 
																											
													</div>


															
													</li>
													<br>
											<?php endfor; ?>
										<?php endif; ?>
											
									</ul>									
							</div>
