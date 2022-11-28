<? $tmp='label_'.$this->Lang;?>
<div class="question">
	<table>
		<? $i=0;foreach($choices as $key=>$choice):?>
		<? $i++;?>
		<tr>
			<td width=130>
			<?        echo CHtml::ajaxLink(
          $choice,
          array('',  'ajax' => TRUE),
          array(
            'type' => 'POST',
			'data'=>array('PortletPollVote_choice_id'=>$key),
            'success' => 'js:function(){window.location.reload();}',
          )        );
			?>
			<? //=$choice;?></td><td width=20><?=$i;?></td>
		</tr>
		<? endforeach;?>
	</table>
</div>

