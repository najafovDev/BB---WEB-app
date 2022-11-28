<div id="static">

		<h1>	<?=((isset($model->translations[$lang]->name))?$model->translations[$lang]->name:''); ?></h1>

		<div class="summary">
			<?=((isset($model->translations[$lang]->body))?$model->translations[$lang]->body:''); ?>
		</div>

</div>