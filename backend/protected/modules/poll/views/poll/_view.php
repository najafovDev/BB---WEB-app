<? $tmp = 'title_'.$this->Lang;?>
<? $tmp2 = 'description_'.$this->Lang;?>
<div class="view poll-item">

  <div class="poll-id">
    #<?php echo CHtml::encode($data->id); ?>
  </div>

  <strong><?php echo CHtml::link(CHtml::encode($data->$tmp), array('view', 'id'=>$data->id)); ?></strong>

  <p class="description"><?php echo CHtml::encode($data->$tmp2); ?></p>

</div>
