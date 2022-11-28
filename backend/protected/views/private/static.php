<div id="body" class="static">

		<div id="right" >
				<h1><?=(isset($model->content->translations[$this->Lang])?$model->content->translations[$this->Lang]->name:(isset($model->translations[$this->Lang])?$model->translations[$this->Lang]->name:""));?></h1>
				<div class="article">
						<div>
								<?=(isset($model->content->translations[$this->Lang])?$model->content->translations[$this->Lang]->body:"");?>
						</div>
				</div>
		</div>
		<div class="clearfix"></div>
 </div>
