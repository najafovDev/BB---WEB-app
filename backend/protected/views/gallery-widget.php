<?php
/* @var $this ItemsController */
/* @var $model Items */
/* @var $form CActiveForm */
?>
    <div class="tab-pane" id="images">
        <?php if (!$model->isNewRecord):?>
            <div class="col-sm-12">
                <?php $this->widget('application.extensions.plupload2.Plupload',
                                    array(
                                        'url'=>$this->createUrl('upload',
                                            array('id'=>$model->id)),
                                        'init'=>array('FileUploaded'=>"js:function(up,file,res){
                                                        req = $.ajax({
                                                            'url':'".$this->createUrl('getLastPhotos',array('id'=>$model->id,'type'=>  get_class($model)))."',
                                                            'dataType':'html',
                                                            'success':function(data){
                                                                $('.photo-rel-container').html(data);
                                                            },
                                                        });
                                                        req.fail(function(jqXHR,textStatus){
                                                            if (confirm('Error occured, refresh please')){}
                                                            //window.location.reload();
                                                         });
                                    }"))
                        ); ?>
            </div>
        <?php endif;?>
        <?php if (isset($model->photos)):?>
            <div class="photo-rel-container">
                <?php $this->renderPartial('//photo-container', array('model'=>$model)); ?>        
            </div>
        <?php endif;?>
<script>
    $(document).ready(function(){
        $('.photo-rel-container').sortable({
            items:' .photo-block',
            placeholder: "ui-state-highlight"
        });
        $( ".photo-rel-container" ).on( "sortupdate", function( event, ui ) {
            $('.photo-rel-container .photo-block').each(function(){
                request = $.ajax({
                   data:{
                       'id':$(this).find('.sortable').attr('data-sortable'),
                       'sort':$('.photo-rel-container .photo-block').index($(this)),
                    },
                   url:'<?php echo $this->createUrl('changeImgSort');?>',

                });
                request.fail(function( jqXHR, textStatus ) {
                  alert( "Request failed (not saved):  " + textStatus );
                });
            });
        });

        $(document.body).on('change','.photocolorselector',function(e){
            request = $.ajax({
               data:{'color':$(this).val()},
               url:$(this).attr('data-action-href'),

            });
            request.fail(function( jqXHR, textStatus ) {
              alert( "Request failed (not saved):  " + textStatus );
            });
        });
        $(document.body).on('click','.delete-button',function(e){
            e.preventDefault();
            if (confirm('This photo will be deleted. Are you sure?'))
            $.ajax({
               url:$(this).attr('href'),
               context:this,
               data:{'ajax':1},
               success:function(data){
                   $(this).parents('.photo-block').hide();
               }
            });

        });
    });
</script>
    </div>
