<div class="innerList">
							<div class="topic topic1">
									Partnyorlar
							</div>
							<div class="partners">
								<ul>
									<? foreach($items as $item):?>
											<li>
												<div class="left img">
													<a href="<?=$this->createUrl('site/addOffer',array('id'=>$item->id));?>"><img src="/site/images/offers/partner/<?=$item->pic_name;?>" alt="" /></a>
												</div>
												<div class="left text">
													<div class="title"><b><?=$item->name;?></b></div>
													<div class="body"><?=$item->body;?></div>
													<? if ($item->website):?>
														<div class="website"><a target="_blank" href="http://<?=$item->website;?>"><?=$item->website;?></a></div>
													<? endif;?>
												</div>
												<div class="clearfix"></div>
											</li>
									<? endforeach;?>
									
								</ul>
								<div class="clearfix"></div>
								
							</div>

							<div class="clearfix"></div>
</div>