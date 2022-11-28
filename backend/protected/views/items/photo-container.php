
        <?php if (isset($model->photos)):?>
                <?php foreach($model->photos as $img):?>
                    <div class="col-xs-6 col-sm-4 col-md-3 mt10 photo-block">
                        <div class="blog-item sortable" data-sortable="<?php echo $img->id;?>">
                          <img src="/site/uploads/items/adminList/<?php echo $img->pic_name;?>" class="img-responsive" alt="">
                          <div class="blog-details">
                            <ul class="blog-meta">
                                <li><?php echo (file_exists(Yii::app()->basePath.'/../../uploads/items/'.$img->pic_name)?  ceil(filesize(Yii::app()->basePath.'/../../uploads/items/'.$img->pic_name)/1024):0);?> Kb</li>
                                <li><?php echo date('d/m/Y',  strtotime($img->created_date));?></li>
                                <li>By: <?php echo ($tmp = Users::model()->findByPk($img->created_by))? $tmp->uname:'';?></li>
                                <li><a class="edit-button edit" href="<?php echo $this->createUrl('itemPhotos/update',array('id'=>$img->id));?>">Edit</a></li>
                                <li><a class="delete-button delete" href="<?php echo $this->createUrl('items/deleteImg',array('id'=>$img->id));?>">Delete</a></li>
                            </ul>
                          </div>
                          <div class="blog-content">
                                    <?php 
                                          $ld = array('0'=>'Photos','1'=>'Schemas');
                                    ?>
                                    <?php echo CHtml::dropDownList('type', $img->type, $img->getTypes(), 
                                                        array(
                                                            'empty'=>'Select Color',
                                                            'class'=>"form-control photocolorselector",
                                                            'data-action-href'=>$this->createUrl('itemPhotos/update',array('id'=>$img->id)),
                                                        ));?>
                          </div>
                        </div><!-- blog-item -->
                    </div>        
                <?php endforeach;?>
        <?php endif;?>
