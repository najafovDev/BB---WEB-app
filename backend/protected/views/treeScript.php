<scipt>
    $('.contextpanel1 .panel-tree').on('changed.jstree', function (e, data) {
    var i, j, r = [];
    for(i = 0, j = data.selected.length; i < j; i++) {
      r.push(data.instance.get_node(data.selected[i]).text);
    }            
    $('.actionpanel .panel-body').html('Selected: ' + r.join(', '));
    $.ajax({'url':'<?=$this->createUrl(Yii::app()->controller->id.'/getactions');?>', 
                'data':{'id':data.instance.get_node(data.selected[0]).id},
                'dataType':'html',
                'success':function( data ) {
                        $('.actionpanel .panel-body').html(data);
                        $('.actionpanel').show();
                }
    });

  }).on('move_node.jstree',function(e,d){
    //alert(d);
    $.ajax({
    'url':'<?=$this->createUrl(Yii::app()->controller->id.'/changeParent');?>',
        'data':{
            'menuArr':jQuery('.contextpanel1 .panel-tree').jstree().get_node('#'+d.node.parent).children,
            'id':d.node.id,
            'new_parent':d.parent,
            'sort':d.position,
        },
        'dataType':'json',
        'success':function(data){
            if (data.message=='error'){
                alert('Error occured. Please refresh and retry!');
            }
        }
    })
}).
jstree({
                'core' : {
                    "animation" : 0,
                    "check_callback" : true,
                    'data' : {
                        'url' : <?=$this->createUrl(Yii::app()->controller->id.'/getTree');?>,
                        'dataType':'JSON',
                        'data' : function (node) {
                          return { 'id' : node.id };
                        }
                      },
                    'themes':{
                            'responsive':true,
                            "stripes" : false
                    }
                },
                'plugins':['dnd','state','crrm','core','themes','types','wholerow'],
                "types" : {
                    "#" : {
                      "valid_children" : ["root",'recycle']
                    },
                    "root" : {
                      "valid_children" : ["default",'file']
                    },
                    'recycle':{
                        'valid_children':['deleted']
                    },
                    'deleted':{
                        'valid_children':['deleted']
                    },
                    "default" : {
                      "valid_children" : ["default","file"]
                    },
                    "file" : {
                      "valid_children" : ['file','default']
                    }
                },
});
</scipt>