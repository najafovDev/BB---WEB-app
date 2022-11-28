
jQuery(window).load(function() {

   // Page Preloader
   //jQuery('#status').fadeOut();
   //jQuery('#preloader').delay(350).fadeOut(function(){
   //   jQuery('body').delay(350).css({'overflow':'visible'});
   //});
});

jQuery(document).ready(function() {
    $(".magnify").elevateZoom({
        scrollZoom : true,  cursor: "crosshair"
    });  
   // Toggle Left Menu
   jQuery('.nav-parent > a').click(function() {
      
      var parent = jQuery(this).parent();
      var sub = parent.find('> ul');
      
      // Dropdown works only when leftpanel is not collapsed
      if(!jQuery('body').hasClass('leftpanel-collapsed')) {
         if(sub.is(':visible')) {
            sub.slideUp(200, function(){
               parent.removeClass('nav-active');
               jQuery('.mainpanel').css({height: ''});
               adjustmainpanelheight();
            });
         } else {
            closeVisibleSubMenu();
            parent.addClass('nav-active');
            sub.slideDown(200, function(){
               adjustmainpanelheight();
            });
         }
      }
      return false;
   });
   
   function closeVisibleSubMenu() {
      jQuery('.nav-parent').each(function() {
         var t = jQuery(this);
         if(t.hasClass('nav-active')) {
            t.find('> ul').slideUp(200, function(){
               t.removeClass('nav-active');
            });
         }
      });
   }
   
   function adjustmainpanelheight() {
      // Adjust mainpanel height
      var docHeight = jQuery(document).height();
      if(docHeight > jQuery('.mainpanel').height())
         jQuery('.mainpanel').height(docHeight);
   }
   
   
   // Tooltip
   jQuery('.tooltips').tooltip({ container: 'body'});
   
   // Popover
   jQuery('.popovers').popover();
   
   // Close Button in Panels
   jQuery('.panel .panel-close').click(function(){
      jQuery(this).closest('.panel').fadeOut(200);
      return false;
   });
   
   // Form Toggles
   jQuery('.toggle').toggles({on: true});
   
   jQuery('.toggle-chat1').toggles({on: false});
   
   // Sparkline
   jQuery('#sidebar-chart').sparkline([4,3,3,1,4,3,2,2,3,10,9,6], {
	  type: 'bar', 
	  height:'30px',
      barColor: '#428BCA'
   });
   
   jQuery('#sidebar-chart2').sparkline([1,3,4,5,4,10,8,5,7,6,9,3], {
	  type: 'bar', 
	  height:'30px',
      barColor: '#D9534F'
   });
   
   jQuery('#sidebar-chart3').sparkline([5,9,3,8,4,10,8,5,7,6,9,3], {
	  type: 'bar', 
	  height:'30px',
      barColor: '#1CAF9A'
   });
   
   jQuery('#sidebar-chart4').sparkline([4,3,3,1,4,3,2,2,3,10,9,6], {
	  type: 'bar', 
	  height:'30px',
      barColor: '#428BCA'
   });
   
   jQuery('#sidebar-chart5').sparkline([1,3,4,5,4,10,8,5,7,6,9,3], {
	  type: 'bar', 
	  height:'30px',
      barColor: '#F0AD4E'
   });
   
   
   // Minimize Button in Panels
   jQuery('.minimize').click(function(){
      var t = jQuery(this);
      var p = t.closest('.panel');
      if(!jQuery(this).hasClass('maximize')) {
         p.find('.panel-body, .panel-footer').slideUp(200);
         t.addClass('maximize');
         t.html('&plus;');
      } else {
         p.find('.panel-body, .panel-footer').slideDown(200);
         t.removeClass('maximize');
         t.html('&minus;');
      }
      return false;
   });
   
   
   // Add class everytime a mouse pointer hover over it
   jQuery('.nav-bracket > li').hover(function(){
      jQuery(this).addClass('nav-hover');
   }, function(){
      jQuery(this).removeClass('nav-hover');
   });
   
   
   // Menu Toggle
   jQuery('.menutoggle').click(function(){
      
      var body = jQuery('body');
      var bodypos = body.css('position');
      
      if(bodypos != 'relative') {
         
         if(!body.hasClass('leftpanel-collapsed')) {
            body.addClass('leftpanel-collapsed');
            jQuery('.nav-bracket ul').attr('style','');
            
            jQuery(this).addClass('menu-collapsed');
            
         } else {
            body.removeClass('leftpanel-collapsed chat-view');
            jQuery('.nav-bracket li.active ul').css({display: 'block'});
            
            jQuery(this).removeClass('menu-collapsed');
            
         }
      } else {
         
         if(body.hasClass('leftpanel-show'))
            body.removeClass('leftpanel-show');
         else
            body.addClass('leftpanel-show');
         
         adjustmainpanelheight();         
      }
    $('.contextpanel').css('left',$('.leftpanel').width()*($('.leftpanel').css('display')!='none'));
    $('.contextpanel.actionpanel').css('left',($('.leftpanel').width()*($('.leftpanel').css('display')!='none'))+$('.contextpanel1').width());

   });
   
   // Chat View
   jQuery('#chatview').click(function(){
      
      var body = jQuery('body');
      var bodypos = body.css('position');
      
      if(bodypos != 'relative') {
         
         if(!body.hasClass('chat-view')) {
            body.addClass('leftpanel-collapsed chat-view');
            jQuery('.nav-bracket ul').attr('style','');
            
         } else {
            
            body.removeClass('chat-view');
            
            if(!jQuery('.menutoggle').hasClass('menu-collapsed')) {
               jQuery('body').removeClass('leftpanel-collapsed');
               jQuery('.nav-bracket li.active ul').css({display: 'block'});
            } else {
               
            }
         }
         
      } else {
         
         if(!body.hasClass('chat-relative-view')) {
            
            body.addClass('chat-relative-view');
            body.css({left: ''});
         
         } else {
            body.removeClass('chat-relative-view');   
         }
      }
      
   });
   
   reposition_searchform();
   
   jQuery(window).resize(function(){
                    $('.contextpanel').css('left',$('.leftpanel').width()*($('.leftpanel').css('display')!='none'));
                    $('.contextpanel.actionpanel').css('left',($('.leftpanel').width()*($('.leftpanel').css('display')!='none'))+$('.contextpanel1').width());
      
      if(jQuery('body').css('position') == 'relative') {

         jQuery('body').removeClass('leftpanel-collapsed chat-view');
         
      } else {
         
         jQuery('body').removeClass('chat-relative-view');         
         jQuery('body').css({left: '', marginRight: ''});
      }
      
      reposition_searchform();
      
   });
   
   function reposition_searchform() {
      if(jQuery('.searchform').css('position') == 'relative') {
         jQuery('.searchform').insertBefore('.leftpanelinner .userlogged');
      } else {
         jQuery('.searchform').insertBefore('.header-right');
      }
   }
   
   
   // Sticky Header
   if(jQuery.cookie('sticky-header'))
      jQuery('body').addClass('stickyheader');
      
   // Sticky Left Panel
   if(jQuery.cookie('sticky-leftpanel')) {
      jQuery('body').addClass('stickyheader');
      jQuery('.leftpanel').addClass('sticky-leftpanel');
   }
   
   // Left Panel Collapsed
   if(jQuery.cookie('leftpanel-collapsed')) {
      jQuery('body').addClass('leftpanel-collapsed');
      jQuery('.menutoggle').addClass('menu-collapsed');
   }
   
   // Changing Skin
   var c = jQuery.cookie('change-skin');
   if(c) {
      jQuery('head').append('<link id="skinswitch" rel="stylesheet" href="css/style.'+c+'.css" />');
   }
   

});

function jstree_create() {
        var ref = $('.contextpanel1 .panel-tree').jstree(true),
                sel = ref.get_selected();
        if(!sel.length) { return false; }
        sel = sel[0];
        //str1 = $('.contextpanel1 .panel-tree').jstree(true).get_selected();
        str1 = sel;
        parent_id = parseInt(str1.replace(/[A-Za-z$-]/g, ""));
        parent_type = str1.replace(/[0-9$-]/g, "");

        if (parent_type =='root')
            parent_id = -1*parent_id;
        dataValues = {};
        dataValues['ajax']=1;
        dataValues[$('.sidebaritems a[jstree-openned=1]').attr('data-module')+'[sort]']=$('.contextpanel1 .panel-tree').jstree(true).get_node(sel).children.length+1;
        dataValues[$('.sidebaritems a[jstree-openned=1]').attr('data-module')+'[parent_id]']=parent_id;

        $.ajax({'url': $('.sidebaritems a[jstree-openned=1]').attr('jstree-createchild'),
                'dataType':'json',
                'type':'POST',
                'data':dataValues,
                'success': function(data){
                    if (data.message == 'success')
                        $('.contextpanel1 .panel-tree').jstree(true).refresh();
                    else window.location.reload();
                }
        });
        /*Selected_node = $('.contextpanel1 .panel-tree').jstree(true).get_node($('.contextpanel1 .panel-tree').jstree(true).get_selected()).children;
        sel = Selected_node[Selected_node.length-1];
        if(sel) {
                ref.edit(sel);
        }*/
};

$(document).ready(function(){
    jQuery(".chosen-select").chosen({'width':'100%','white-space':'nowrap'});
    $('.contextpanel .glyphicon-remove').on('click',function(){
        $('.actionpanel').hide();
    })
    $('.contextpanel').on('click',function(e){
        e.stopPropagation();
    })
    $('.leftpanelinner').on('click',function(e){
        e.stopPropagation();
    })
    $('html').on('click',function(e){
        $('.contextpanel').hide();
    })
    $('.actionpanel .panel-body').on('click','.magnum-ajax.magnum-togglevisibility',function(e){
       e.preventDefault();
       jQuery.ajax({
          'url':$(this).attr('href'),
          'dataType':'json',
          'success':function(data){
              $('#'+jQuery('.contextpanel1 .panel-tree').jstree('get_selected')).removeClass('menus-hidden menus-visible').addClass(data.class);
          }
       });
    });
    $('.actionpanel .panel-body').on('click','.magnum-ajax.magnum-jstree-create',function(e){
        e.preventDefault();
        jstree_create();
    });
    $('.actionpanel .panel-body').on('click','.magnum-ajax.magnum-delete',function(e){
       e.preventDefault();
       jQuery.ajax({
          'url':$(this).attr('href'),
          'dataType':'json',
          'success':function(data){
              $('.contextpanel1 .panel-tree').jstree('refresh');
          }
       });
    });
    $('.leftpanelinner .sidebaritems a[ajax-enabled=1]').on('click',function(e){
            $('.contextpanel1').show();
            e.preventDefault();
            $('.leftpanelinner .sidebaritems a').removeAttr('jstree-openned');
            $('.contextpanel1 .panel-tree').jstree('destroy');
            $(this).attr('jstree-openned',1);
                $('.contextpanel1 .panel-tree').on('changed.jstree', function (e, data) {
                    var i, j, r = [];
                    for(i = 0, j = data.selected.length; i < j; i++) {
                      r.push(data.instance.get_node(data.selected[i]).text);
                    }            
                    $('.actionpanel .panel-body').html('Selected: ' + r.join(', '));
                    $.ajax({'url':$('.sidebaritems a[jstree-openned=1]').attr('jstree-getaction'), 
                                'data':{'id':data.instance.get_node(data.selected[0]).id},
                                'dataType':'html',
                                'success':function( data ) {
                                        $('.actionpanel .panel-body').html(data);
                                        $('.actionpanel').show();
                                        $('.actionpanel').css('left',$('.leftpanel').width()+$('.contextpanel1').width()+'px');
                                }
                    });

                  }).on('move_node.jstree',function(e,d){
                    //alert(d);
                    $.ajax({
                        'url':$('.sidebaritems a[jstree-openned=1]').attr('jstree-changeparent'),
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
                                        'url' : $(this).attr('href'),
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
                                      "valid_children" : ["root",'recycle'],
                                    },
                                    "root" : {
                                      "valid_children" : ["default",'file'],
                                      //'icon':'fa-plus-square fa'
                                      'icon':'fa'
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
                                        "valid_children" : ['file','default','item','article'],
                                        'icon':"fa fa-ellipsis-v"
                                    },
                                    "article" : {
                                        "valid_children" : [],
                                        'icon':"fa fa-file-text-o"
                                    },
                                    'item':{
                                        'valid_children':[],
                                        'icon':"glyphicon glyphicon-barcode"
                                    }
                                },
                });
    });
});

