							<div id="services">
									<ul>
										<?php if(isset($products) && is_array($products)) : ?>
											<?php for($i=0;$i<count($products);$i++) :?>
													<li>
													<div class="left">
															<a class="photo" href="<?=$this->createUrl('site/addProduct' , array('id'=>$products[$i]->id, 'language'=>$lang)); ?>"><img src="<?=$imgUpl['products'].$products[$i]->pic_name; ?>"></a>
													</div>
													<div class="right">
															<h3><?=(isset($products[$i]->productsTranslate[$lang]->name)?$products[$i]->productsTranslate[$lang]->name:'---'); ?></h3>
															<div class="summary">
															<?=(isset($products[$i]->productsTranslate[$lang]->teaser)?$products[$i]->productsTranslate[$lang]->teaser:'---'); ?>
															<a class="more" href="<?=$this->createUrl('site/addProduct' , array('id'=>$products[$i]->id, 'language'=>$lang)); ?>">More</a>.

															</div>
													</div>
													<div class="clearfix"></div>

															
													</li>
											<?php endfor; ?>
										<?php endif; ?>
									</ul>
							</div>