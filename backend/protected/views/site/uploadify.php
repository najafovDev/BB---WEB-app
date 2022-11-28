<style >

.gallImage{
	position:relative;
	display:inline-block;
}
.delNA{
	font-family:Arial;
	cursor:pointer;
	top:-12px;
	left:0px;
	position:absolute;
	color:red;
	font-weight:bolder;

}

.delBS{
	font-family:Arial;
	cursor:pointer;
	top:10px;
	left:160px;
	position:relative;
	color:red;
	font-weight:bolder;

}

.gallDel {
	cursor:pointer;
	top:0px;
	left:5px;
	position:absolute;
	color:red;
	font-weight:bolder;
}
</style>

<div id="static" class="form">
<script type="text/javascript" src="/js/jquery.uploadify.v2.1.0.min.js"></script>
	<?
			$tmp = Menus::Model()->with()->findAll('t.keyword=\'gallery\'');
			$id = (isset($_GET['id'])?$_GET['id']:'menu'.$tmp[0]->id);
	?>

<?
$this->widget('application.extensions.uploadify.EuploadifyWidget', 
    array(
        'name'=>'uploadme',
        'options'=> array(
            //'uploader' => '/js/uploadify.swf',
            'script' => $this->createUrl('site/UploadedFiles'), 
            //'cancelImg' => '/js/cancel.png',
            'auto' => true,
            'multi' => true,
            'folder' => '/tmp',
            'scriptData' => array('extraVar' => 1234, 'PHPSESSID' => session_id(),'id'=>$id),
            //'fileDesc' => 'Declaratiebestanden',
            //'fileExt' => '*.*',
            'buttonText' => 'Upload a lot!',
            'width' => 150,
            ),
        'callbacks' => array( 
           'onError' => 'function(evt,queueId,fileObj,errorObj){alert("Error: " + errorObj.type + "\nInfo: " + errorObj.info);}',
           'onComplete' => 'function(evt,queueId,fileObj,errorObj){getLast(-1,evt,queueId,fileObj,errorObj);}',
         //  'onCancel' => 'function(evt,queueId,fileObj,data){alert("Cancelled");}',
        )
    )); 

?>
<script>
	$(document).ready(function(){
		$('select[name=\'Menus\']').change(function(){
			window.location = '<?=$this->createUrl('site/uploadify',array('language'=>$this->Lang));?>&id='+$(this).val();
		});
	});
</script>
	<select name="Menus">
				

				<? foreach($tmp as $menu):?>
					<option value="menu<?=$menu->id;?>" <?=('menu'.$menu->id==$id?"selected":"");?>><?=$menu->translations[$this->Lang]->name;?></option>
				<? endforeach;?>
	</select>
	<div class="row galleryPics">
	<script type="text/javascript">
		function getLast(paramid,evt,queueId,fileObj,errorObj){
                                $.get(
                                    "/mfe/index.php?r=site/getLast",
                                    {id:paramid , filename:fileObj.name},
                                    function(data) {
                                       $('.galleryPics').append(data);
                                       //alert('page content: ' + data);
                                    }
                                );

			
		}
		function delImage(paramid){
			var agree=confirm("Are you sure you want to delete?");
			if (agree){
				$.get(
				    "/mfe/index.php?r=site/delImg",
				    {id:paramid },
				    function(data) {
				       if (data == "deleted")	$('.gallImage'+paramid).remove();
				       //alert('page content: ' + data);
				    }
				);
				
				return true ;
			}
		}
	</script>
	<?		{
			if ($gallerMod)
			foreach($gallerMod as $gallImage){
				print "<div class='gallImage gallImage".$gallImage->id."'><div class='gallDel' onClick='delImage(".$gallImage->id.")' >X</div><img height=40 src='/images/gallery/".$gallImage->pic_name."'></div>";
			}
			//print_r($gallerMod);
			}
		?>
	</div>

</div>