							<div class="topic topic1">
									Gəlinliklər
							</div>
							<div class="items">
								<ul>
									<? 	$items = $model;
										foreach($items as $item):?>
											<li>
												<a href="<?=$this->createUrl('site/addItem',array('id'=>$item->id));?>"><img src="/site/images/items/frontMain/<?=$item->pic_name;?>" alt="" /></a>
												<div class="hover">
													<div class="left">
														<div class="title"><a href="<?=$this->createUrl('site/addItem',array('id'=>$item->id));?>"><?=$item->name;?></a></div>
														<div class="price <?=($item->discount?"old":"");?>"><a href="<?=$this->createUrl('site/addItem',array('id'=>$item->id));?>">Qiymət : <?=$item->price;?></a></div>
														<? if ($item->discount):?>
																<div class="price red"><a href="<?=$this->createUrl('site/addItem',array('id'=>$item->id));?>">Endirimlə: <?=($item->price*(100-$item->discount)/100);?></a></div>
														<? endif;?>
													</div>
													
													<? if ($item->discount || $item->new):?>
														<div class="right">
															<div class="discount"><?=($item->new?"Yeni!":($item->discount?"-".$item->discount."%":""));?></div>
														</div>
													<? endif;?>
													<div class="cartbutton left"><a href="#">Səbətə at</a></div>
													<div class="lookbutton right"><a href="<?=$this->createUrl('site/addItem',array('id'=>$item->id));?>">BAX</a></div>
												</div>
											</li>
									<? endforeach;?>
								</ul>
							</div>