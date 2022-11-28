<ol class="breadcrumb">
  <?php foreach($items as $key=>$value):?>
    <?php if (is_array($value)):?>
        <li><?php echo CHtml::link($key,$value);?></li>
    <?php else :?>
        <li><?php echo CHtml::link($value,'#');?></li>
    <?php endif;?>
  <?php endforeach;?>
</ol>
