<h1>Manage <?php echo $this->pluralize($this->class2name($this->modelClass)); ?></h1>
<div>
<?php echo '<?php';?> 
    echo CHtml::link(Yii::t('system','Add new <?php echo $this->modelClass;?>'), $this->createUrl('create'), array('class'=>'btn btn-primary'));
<?php echo '?>';?>
    
<?php echo "<?php"; ?> $this->widget('MfeTbExtendedGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
	echo "\t\t'".$column->name."',\n";
}
if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'class'=>'MfeTbButtonColumn',
		),
	),
)); ?>
</div>