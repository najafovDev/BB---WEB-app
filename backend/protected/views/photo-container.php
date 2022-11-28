
        <?php if (isset($model->photos)):?>
                <?php foreach($model->photos as $img):?>
                    <div class="col-xs-6 col-sm-4 col-md-3 mt10 photo-block">
                        <div class="blog-item sortable" data-sortable="<?php echo $img->id;?>">
                          <img src="<?php echo $this->baseUrl.$img->pic_name;?>" class="img-responsive" alt="">
                          <div class="blog-details">
                            <ul class="blog-meta">
                                <li>
                                        <?php echo (file_exists(Yii::app()->basePath.'/../..'.$this->baseUrl.$img->pic_name)?  
                                        ceil(filesize(Yii::app()->basePath.'/../..'.$this->baseUrl.$img->pic_name)/1024):0);?> Kb
                                </li>
                                <li><?php echo date('d/m/Y',  strtotime($img->created_date));?></li>
                                <li>By: <?php echo Users::model()->findByPk($img->created_by)->uname;?></li>
                                <li><a class="delete-button delete"  href="<?php echo $this->createUrl('deleteImg',array('id'=>$img->id));?>">Delete</a></li>
                            </ul>
                          </div>
                          <div class="blog-content">
                          </div>
                        </div><!-- blog-item -->
                    </div>        
                <?php endforeach;?>
        <?php endif;?>
