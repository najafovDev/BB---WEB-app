<style>
		#searchResults .results{
			margin-bottom:20px;
		}
		
		#searchUl li{
			margin-bottom:10px;
		}
</style>
<div id="body" class="static">

		<div id="right" >
                        <h1><?=Yii::t('left','Search'); ?></h1>

						<div id="searchResults" class="content">
															<div class="results">
																	<div class="keyword"><?=Yii::t('left','You searched for "{query}"',array('{query}'=>$keyword)).' - '. Yii::t('left','"{count}" results found.', array('{count}'=>count($items))); ?></div>  
															</div>
															<ul id="searchUl" class="search">
																	<?php for($i=0;$i<count($items);$i++) : ?>
																	<li <?php if($i%2) print 'class="even"'; ?> >
																			 <div class="info"> 
																					
																					<div class="text" >
																							<a href="/<?=$this->Lang;?>/<?=($items[$i]->article->type=='additional'?'elave':($items[$i]->article->type=='news'?'news':'goto'));?>/<?=($items[$i]->article->type=='static'?$items[$i]->article->parent_id:$items[$i]->article->id);?>"><?php print $items[$i]->name;?></a>
																							
																							<div class="summary">
																									<?php 
																										$var1 = $var = strip_tags(preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $items[$i]->body));
																										$var = mb_strtolower($var,'utf-8');
																										if ($keyword!='' && $strPos = mb_strpos($var,$keyword)){
																												//$strLen = strlen($var);
																												
																												if ($strPos<100) $minPos=0;
																												else $minPos = $strPos-100;
																												$minPos = mb_strpos($var1," ",$minPos);
																												
																												if ($minPos) $minPos=0;
																												$var = mb_substr($var1,$minPos,190,'utf-8');
																												
																												$var = mb_str_replace($keyword,'<b style="color: #FEB915;">'.$keyword.'</b>',$var);
																												print $var; 
																										}
																										else print $var = mb_substr($var,0,200,'utf-8');;
																									?> ...
																							</div>
																					</div>
																			</div>
																	</li>
																	<?php endfor; ?>

															</ul>
						</div>
		</div>
</div>
