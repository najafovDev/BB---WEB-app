<div >
			
					<?php for($i=0;$i<count($model)	&&isset($model[$i]);$i++):?>
									<div class="news_el2">
											<a href="<?=$this->createUrl('site/addBanner',array('id'=>$model[$i]->id));?>">
													<img src="/images/banners/<?=$model[$i]->pic_name;?>" alt="" height=30>
											</a>
									</div>
					<?php endfor; ?>
</div>

