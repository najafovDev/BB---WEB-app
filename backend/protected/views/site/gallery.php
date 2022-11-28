<link rel="stylesheet" type="text/css" href="/css/prettyPhoto.css">
<script type="text/javascript" language="javascript" src="/js/jquery.prettyPhoto.js"></script>
<div id="static">
			<div class="delMenu">
					<a href="<?php  print $this->CreateUrl('site/delImageAll',array()); ?>">Delete All</a>
			</div>
		<div style="clear:both"></div>
		<div class="galleryItems">
				<ul>
					<?php for($i=0;$i<count($model) && isset($model[$i]);$i++):?>
									<li <?=(($i%3==2)?'class="fourth"':'');?>>
										<a href="<?=$this->CreateUrl('site/addImage',array('id'=>$model[$i]->id,'language'=>$lang));?>" alt="" rel="prettyPhoto[gall]">
											<img width=145  src="<?=''.$this->imgUpl['gallery'].''.$model[$i]->pic_name;?>" alt=""/>
										</a>
									</li>
					<?php endfor; ?>
				</ul>
		</div>
		<div id="pager">
			<?php 
			//unset($_GET['url']);
			
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

<script type="text/javascript">	
//$(function(){$(".gallery:not(.slideshow) a[rel^='prettyPhoto']").prettyPhoto();
//$(".galleryItems a[rel^='prettyPhoto']").prettyPhoto({theme:'light_square',slideshow:5000, autoplay_slideshow:false});	});
</script>