<div class="table-responsive">
          <table class="table mb30">
            <thead>
              <tr>
                <th><?php echo Yii::t('System','Photo');?></th>
                <th><?php echo Yii::t('System','Name');?></th>
                <th><?php echo Yii::t('System','Category');?></th>
                <!--<th><?php // echo Yii::t('System','Brand');?></th>-->
                <th><?php echo Yii::t('System','Price');?></th>
                <!--<th><?php echo Yii::t('System','Stock');?></th>-->
                <th><?php echo Yii::t('System','Actions');?></th>
              </tr>
            </thead>
            <tbody>
        <?php if (isset($model->recommended) && is_array($model->recommended)):?>
            <?php foreach($model->recommended as $item):?>
              <tr>
                <td><img class="" height=50 src="<?=$item->getPhoto(0);?>" alt=""></td>
                <td><?php echo ($item->getTranslation($this->Lang)->name!=''?$item->getTranslation($this->Lang)->name:$item->name);?></td>
                <td><?php echo ($item->category?$item->category->name:'NO CATEGORY');?></td>
                <!--<td><?php echo ($item->brand?$item->brand->name:'NO BRAND');?></td>-->
                <td><?php // echo $item->minPriceStat;?></td>
                <!--<td><?php echo $item->getStockSum();?></td>-->
                <td class="table-action">
                  <a href="<?php echo $this->createUrl('items/update',array('id'=>$item->id));?>"><i class="fa fa-pencil"></i></a>
                  <a href="<?php echo $this->createUrl('items/deleteRecommended',array('id'=>$model->id,'itemId'=>$item->id));?>" class="delete-row"><i class="fa fa-trash-o"></i></a>
                </td>
              </tr>
            <?php endforeach;?>
        <?php endif;?>
            </tbody>
          </table>
</div>

