<link rel="stylesheet" type="text/css" href="/css/prettyPhoto.css">
<script type="text/javascript" language="javascript" src="/js/jquery.prettyPhoto.js"></script>
<div id="static">
		<div id="articleTitle">
			<?=((isset($menuArr->translations[$lang]->name))?$menuArr->translations[$lang]->name:''); ?>
		</div>
		<div id="extraLinks" style="font-size:17px;float:right;">
				<a href="<?=$this->CreateUrl('site/gallery',array('language'=>$lang));?>">
					Image Gallery
				</a>
		</div>
		
		<div class="galleryItems">
				<ul>
					<?php for($i=0;$i<count($model) && isset($model[$i]);$i++):?>
									<li <?=(($i%4==3)?'class="fourth"':'');?>>
										<a href="<?=$this->CreateUrl('site/addImage',array('id'=>$model[$i]->id,'language'=>$lang));?>" alt="<?=((isset($model[$i]->translations[$lang]->name))?$model[$i]->translations[$lang]->name:'');?>"rel="prettyPhoto[gall]">
											
											<img width=145 height=122 src="<?='/site'.$imgUpl['gallery'].'small/'.$model[$i]->pic_name;?>" alt="<?=((isset($model[$i]->translations[$lang]->name))?$model[$i]->translations[$lang]->name:'');?>"/>
										</a>
									</li>
					<?php endfor; ?>
				</ul>
		</div>
</div>

<script type="text/javascript">	
//$(function(){$(".gallery:not(.slideshow) a[rel^='prettyPhoto']").prettyPhoto();
//$(".galleryItems a[rel^='prettyPhoto']").prettyPhoto({theme:'light_square',slideshow:5000, autoplay_slideshow:false});	});
</script>