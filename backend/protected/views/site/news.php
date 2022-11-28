<div id="static">
		<div id="articleTitle">
			<?=((isset($news->translations[$lang]->name))?$news->translations[$lang]->name:''); ?>
		</div>
		<div id="articleText">
			<?=((isset($model->translations[$lang]->body))?$model->translations[$lang]->body:''); ?>
		</div>

</div>