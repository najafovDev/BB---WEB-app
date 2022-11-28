<h1><?php echo Yii::t('system','Users');?></h1>
<div id="news">
                <ul>
                        <?php if(isset($model) && is_array($model)) : ?>
                                <?php for($i=0;$i<count($model);$i++) :?>
                                                <li>
                                                <div class="">
                                                                <a href="<?=$this->createUrl('/private/register' , array('id'=>$model[$i]->id)); ?>"><?=$model[$i]->uname;?> </a> 

                                                </div>



                                                </li>
                                                <br>
                                <?php endfor; ?>
                        <?php endif; ?>

                </ul>									
</div>
