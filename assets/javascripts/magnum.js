var distanceWidget,activeRoute=null,activeRoutes=null;
var map,pano1,pano2;
var geocodeTimer, markerDest,markerOrigin,directionLines=[];
var profileMarkers = [],poly=[];
var resultsArray = {};
var intervalStatus=false;
var officeWindow, infoWindow;
var lastDirection;
var profileWindows = [],officeCoordinate, markerOffice,updateApiInterval;
var GMStyle = [{"featureType":"all","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"administrative.country","elementType":"labels.text.fill","stylers":[{"color":"#ff0000"}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#c4c4c4"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.fill","stylers":[{"color":"#ff0000"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21},{"visibility":"on"}]},{"featureType":"poi.business","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ff0000"},{"lightness":"0"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"color":"#ff0000"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#575757"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"labels.text.stroke","stylers":[{"color":"#2c2c2c"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#999999"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}];
// bounds of the desired area

$(document).ready(function(){
    officeCoordinate = new google.maps.LatLng(40.356806, 49.980544);
    bakuCenter = new google.maps.LatLng(40.382158, 49.840041);
    map = new google.maps.Map(document.getElementById('google-map'), {
        center: bakuCenter,
        zoom: 14,
        zoomControl:true,
//        scrollwheel:false,
        key:'AIzaSyCq-_gXgDgF_UMGjjdPx8vRu2KA5Non2E4',
        styles:GMStyle,
        disableDefaultUI: true        
    });
    poly = new google.maps.Polyline({
        map: map,
        strokeColor: 'black',
        strokeWeight:7,
    });
    var contentString = '<div id="officeInfoWindow" class="col bus-item">'+
      '<div id="siteNotice" class="bus-inner-wrap">'+
      '<div class="item-body">'+
      '<h1 id="firstHeading" class="firstHeading">BakuBus MMC</h1>'+
      '<div id="bodyContent">'+
      '<div class="">'+
      '<div><strong>Email:</strong>&nbsp;<a href="http://mailto:info@bakubus.az/"><strong>info@bakubus.az</strong></a>.</div><div><br></div><div><strong>Hotline:</strong>&nbsp;*4242&nbsp; <strong>Office reception</strong><strong>:&nbsp;</strong>012 404 11 10</div>'+
      '<div class="clearfix"></div>'+
      '</div>'+
      '</div>'+
      '</div>'+
      '</div>'+
      '</div>';
    officeWindow= new google.maps.InfoWindow({
      content: contentString,
      disableAutoPan: true
    });
//    infoWindow = new google.maps.InfoWindow({map: map});

    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            markerOrigin.position = new google.maps.LatLng(pos.lat, pos.lng);
            markerOrigin.setPosition(markerOrigin.position);
            markerOrigin.setVisible(true);
            $('#origin').val('Current location');
        }, function() {
        });
    } else {
    }


    markerOffice = new google.maps.Marker({
        map: map,
        position: officeCoordinate,
        icon: new google.maps.MarkerImage('/assets/images/bakubus-marker2.png',
            null, null, null, new google.maps.Size(30,30)),          
        zIndex: 40,
        animation: google.maps.Animation.DROP,
        infoBox:officeWindow
    });
    markerOffice.addListener('click', function() {
      markerOffice.infoBox.open(map,this);
    });
    $('.selectpicker').selectpicker();
//    $('[data-toggle="tooltip"]').tooltip()
    var owl = $(".sidebar-menu2 .banner-rotator .carousel");

    owl.owlCarousel({
      itemsCustom :[[0,2]] ,
      navigation : true

    });
    var owl = $(".menubar .banner-rotator .carousel");

    owl.owlCarousel({
      itemsCustom :[[0,1],[406,1],[550,3]] ,
      navigation : true

    });
    getApi();
    updateApiInterval = setInterval(function(){
        if (intervalStatus) return;
        intervalStatus = true;
//        clearMarkers();
        getApi();
        intervalStatus = false;
    },10000);
    $('.sidebar-menu .bus-search .method-change span a').click(function(e){
        e.preventDefault();
        $('.sidebar-menu .bus-search div.search-method').toggleClass('hidden');
//        $('.sidebar-menu .bus-search form>div.method-change span').toggleClass('hidden');
        $('.sidebar-menu .bus-search '+$(this).data('target')).show();
//        $(this).parent().siblings('span').show();
    });
    $('form.navbar-form.closed button').on('click',function(e){
        if ($(this).parents('form').hasClass('closed')){
            e.preventDefault();
            $('nav.navbar form.navbar-form.open input').val('');            
        }
        else {
        }
            e.stopPropagation();
            $('nav.navbar form.navbar-form.closed input').focus();
            $(this).parents('form.closed').removeClass('closed').addClass('open');
    });
    $('form.navbar-form.closed input').on('click',function(e){
            e.stopPropagation();
    });
    $('html').on('click',function(e){
        $('.footer form.navbar-form.open input').val('').blur();
        $('.footer form.navbar-form.open').removeClass('open').addClass('closed');
    }); 
    $('.line-form form').submit(function(e){
        e.preventDefault();
        $('.search-method select').trigger('change');
    });
    $(document).on('click','.news-items a', function(e){
       e.preventDefault();
       $.ajax({
          url:$(this).attr('href'),
          data:{  
            ajax:1
          },
          dataType:'json',
          context:$(this),
          success:function(data){
                $('.article--expand').remove();
                str = '<div class="article--expand">'+
                    '   <a href="#close-jump-1" class="expand__close"></a>'+
                    '   <div class="article-summary">'+data.content+''+
                    '       <div class="clearfix"></div>'+
                    '   </div>'+
                    '</div>';

                $(this).parents('.news-items').after(str);
                var owl = $(".article-summary .owl-single-insider");

                owl.owlCarousel({
//                  itemsCustom :[[0,2]] ,
                    singleItem:true,
                  navigation : true

                });
                $(".contentModal .modal-body .nano").nanoScroller({ destroy: true});
                $(".contentModal .modal-body .nano").nanoScroller({iOSNativeScrolling: true,scrollTo: $('.article-summary h3') });
          }
       });
    });
    $('.search-method select').change(function(e){
        activeRoutes =null;
        removeDirectionLines();
        markerDest.setMap(null);
        markerOrigin.setMap(null);
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        activeRoute = $('.search-method select option[value='+$(this).val()+']').text(); 
        activeRoute = ($(this).val()?activeRoute:null);
        removeRoutePathInfo();
        if ($(this).val())
        $.ajax({
           url:'/az/ajax/getPaths/'+$(this).val(),
           dataType:'json',
           context:$(this),
           success:function(data){
                directionsDisplay.setMap(map);
                if (data.Forward!==undefined)
                    renderPath(data.Forward.busstops,'#7afbff',true,data.Forward.id);
                if (data.Backward!==undefined)
                    renderPath(data.Backward.busstops,'#CC99FE',false,data.Backward.id);
                $('.bus-results').removeClass('bus-results__halfopacity');
                $('.bus-results .caption-distance .distance').html(data.Backward.length+' km');
                $('.bus-results .caption-buses .buses').html(countBusesByRoute(activeRoute)+ ' ədəd');
           }
        });
    });
    $(document).on('click','.vacancies-item .btn-apply',function(e){
        e.preventDefault();
        $('.modal').modal('hide');
        $('#vacancyFormModal .input-subject').val($(this).parents('.vacancies-item').find('span').text());
        $('#vacancyFormModal .modal-body .nano').height($(document).outerHeight()-200-$('#vacancyFormModal .modal-header').outerHeight());
        $('#vacancyFormModal .modal-dialog').width($(document).width()-130-$('.sidebar-menu2').width());
        if ($(document).outerHeight()>500){
            $(".nano").nanoScroller({ destroy: true });
            $(".nano").nanoScroller({iOSNativeScrolling: true});
        }
        $('#vacancyFormModal').modal('show');
        
    });
    $('.search-method .form-control').click(function(e){
        $('.modal').modal('hide');
        $(this).focus();
    });
    $(document).on('click','.menubar .navbar-nav li a,.banner-rotator .item a,.search-content a',function(e){
       e.preventDefault();
        if ($(this).data('keyword')!='contactus'  && $(document).outerHeight()>500){
            $('#contentModal .modal-dialog').width($(document).width()-130-$('.sidebar-menu2').width());
            $('#contentModal .modal-body .nano').height($(document).outerHeight()-200-$('#contentModal .modal-header').outerHeight());
        }
        toggleSearchBar();
       $.ajax({
          url:$(this).attr('href'),
          data:{
              ajax:1
          },
          dataType:'json',
          context:$(this),
          success:function(data){
//                console.log(data);
                if ($(this).data('keyword')!='contactus'){
                    $('#contentModal .modal-header h1.modal-title').html(data.topic);
                    $('#contentModal .modal-body .nano-content').html(data.content);
                    if ($('#virtualtour1ext').length){
                            // create the panorama player with the container
                            extpano1=new object2vrPlayer("virtualtour1ext");
                            // add the skin object
                            skinext=new object2vrSkin(extpano1,'/assets/javascripts/pano2vr/images/');
                            // load the configuration
                            extpano1.readConfigUrl("/assets/virtualtours/crealisExt/Crealis.xml");
                            
                            setTimeout(function(){
                                extpano1.jl1();
                            },1500);
                    }
//                    if ($(this).data('keyword')=='allnews'){
//                      $('.nano-content').masonry({
//                        // options
//                        itemSelector: '.news-items',
//                        
//                      });
//
//                    }
                    if ($('#virtualtour2ext').length){
                            // create the panorama player with the container
                            extpano2=new object2vrPlayer("virtualtour2ext");
                            // add the skin object
                            skinext=new object2vrSkin(extpano2,'/assets/javascripts/pano2vr/images/');
                            // load the configuration
                            extpano2.readConfigUrl("/assets/virtualtours/urbanExt/Urbanway.xml");
                            
                            setTimeout(function(){
                                extpano2.jl1();
                            },1500);
                    }
                    if ($('#virtualtour1').length){
                            // create the panorama player with the container
                            pano1=new pano2vrPlayer("virtualtour1");
                            // add the skin object
                            skin=new pano2vrSkin(pano1,'/assets/javascripts/pano2vr/');
                            // load the configuration
                            pano1.readConfigUrl("/assets/virtualtours/01/01_out.xml");
                            
                            setTimeout(function(){
                                pano1.Ba('pano1');
                            },1500);
                    }
                    if ($('#virtualtour2').length){
                            // create the panorama player with the container
                            pano2=new pano2vrPlayer("virtualtour2");
                            // add the skin object
                            skin=new pano2vrSkin(pano2,'/assets/javascripts/pano2vr/');
                            // load the configuration
                            pano2.readConfigUrl("/assets/virtualtours/02/02_out.xml");
                            setTimeout(function(){
                                pano2.Ba('pano1');
                            },1500);

                    }
                    if ($(document).outerHeight()>500){
                        $(".nano").nanoScroller({ destroy: true });
                        $(".nano").nanoScroller({iOSNativeScrolling: true});
                    }
                    $('#contactModal').modal('hide');
                    $('#contactFormModal').modal('hide');
                    $('#contentModal').modal({backdrop:'static',show:true});
                } else {
                    $('.navbar-toggle').click();
                    markerOffice.infoBox.open(map,markerOffice);
                    map.panTo(officeCoordinate);
                    
//                    centerMap();
//                    $('#contactModal .modal-dialog').width($(document).width()-130-$('.sidebar-menu2').width());
                    $('#contactFormModal .modal-dialog').width($(document).width()-130-$('.sidebar-menu2').width());
//                    $('#contactModal .modal-header h1.modal-title').html(data.topic);
//                    $('#contactModal .modal-body .nano-content').html(data.content);
                    if ($(document).outerHeight()>500){
                        $(".nano").nanoScroller({ destroy: true });
                        $(".nano").nanoScroller({iOSNativeScrolling: true});
                    }
                    $('#contentModal').modal('hide');
                    $('#contactModal').modal({backdrop:'static',show:true});
                    $('#contactFormModal').modal({backdrop:'static',show:true});
                }
          },
          error:function(){
              alert('Error, please refresh');
          }
       });
    });
    $('.search-form form').submit(function(e){
       e.preventDefault();
        if ($(this).data('keyword')!='contactus'  && $(document).outerHeight()>500){
            $('#contentModal .modal-dialog').width($(document).width()-130-$('.sidebar-menu2').width());
            $('#contentModal .modal-body .nano').height($(document).outerHeight()-200-$('#contentModal .modal-header').outerHeight());
        }
       $.ajax({
          url:$(this).attr('action'),
          data:$(this).serialize()+'&ajax=true',
          dataType:'json',
          context:$(this),
          success:function(data){
//                console.log(data);
                    $('#contentModal .modal-header h1.modal-title').html(data.topic);
                    $('#contentModal .modal-body .nano-content').html(data.content);
                    if ($(document).outerHeight()>500){
                        $(".nano").nanoScroller({ destroy: true });
                        $(".nano").nanoScroller({iOSNativeScrolling: true});
                    }
                    $('#contactModal').modal('hide');
                    $('#contactFormModal').modal('hide');
                    $('#contentModal').modal({backdrop:'static',show:true});
          },
          error:function(){
              alert('Error, please refresh');
          }
       });
    });
    $('.modal').on('shown.bs.modal',function(){
        $('.navbar-toggle').click();
    });
    $('.modal .modal-header button.close').on('click',function(){
       toggleSearchBar(); 
    });
    $('#contactModal').on('hide.bs.modal',function(){
            $('#contactFormModal').modal('hide');
    });
    $('.open-toggle').click(function(e){
        $(this).parent().toggleClass('open');
       $(this).parent().find('form').toggleClass('hidden-xs') ;
       $(this).parent().find('form').toggleClass('hidden-sm') ;
    });
   markerDest= new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0, -29),
    draggable:true,
        icon: new google.maps.MarkerImage('/assets/images/marker-end.png',
            null, null, null, new google.maps.Size(30,51)),          
    title:"Drag me!"
    
  });
   markerOrigin = new google.maps.Marker({
    map: map,
        icon: new google.maps.MarkerImage('/assets/images/marker-start.png',
            null, null, null, new google.maps.Size(30,51)),          
    anchorPoint: new google.maps.Point(0, -29),
    draggable:true,
    title:"Drag me!"
  });
  
  google.maps.event.addListener(markerOrigin, 'dragstart', function() {
//     map.setOptions({ draggable: false }); 
  });
  google.maps.event.addListener(markerDest, 'dragstart', function() {
//     map.setOptions({ draggable: false }); 
  });
  google.maps.event.addListener(markerOrigin, 'dragend', function() {
    $('.direction-form form').submit();
  });
  google.maps.event.addListener(markerDest, 'dragend', function() {
    $('.direction-form form').submit();
  });
    var dest = (document.getElementById('destination'));
    var origin = (document.getElementById('origin'));
  var destAc = new google.maps.places.Autocomplete(dest,{
      componentRestrictions: {country: "az"}
  });
  destAc.bindTo('bounds', map);
  var originAc = new google.maps.places.Autocomplete(origin,{
      componentRestrictions: {country: "az"}
  });
  originAc.bindTo('bounds', map);
  destAc.addListener('place_changed', function() {
//    infowindow.close();
    markerDest.setVisible(false);
    var place = destAc.getPlace();
    if (!place.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
    }
    markerDest.setPosition(place.geometry.location);
    markerDest.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }
  });
  originAc.addListener('place_changed', function() {
//    infowindow.close();
    markerOrigin.setVisible(false);
    var place = originAc.getPlace();
    if (!place.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
    }
    markerOrigin.setPosition(place.geometry.location);
    markerOrigin.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }
  });
    $('.solution-block').click(function(e){
       $(this).css('opacity',1); 
       $(this).addClass('fixed');
    });
    $(document).on('click','.solution',function(e){
        changeRouteSuggestion($(this).data('index'));
    });
    $('.direction-form form').submit(function(e){
       e.preventDefault();
       if (!markerOrigin.position || !markerDest.position){
           alert($(this).data('error-str'));
           return;
       }
       removeRoutePathInfo();
       $.ajax({
           url:'/ajax/getDirections',
           dataType:'json',
           jsonp:false,
           cache:true,
           data:{
               fromPlace:markerOrigin.position.lat()+','+markerOrigin.position.lng(),
               toPlace:markerDest.position.lat()+','+markerDest.position.lng(),
           },
//           jsoncallback:'updateRouteSuggestion',
           success:updateRouteSuggestion
       });
    });
});
function drawDirection(itinerary){
    colors = {
        'h1':'#ff0000',
        1:'#CA9E67',
        14:'#01FF52',
        13:'#fa8d00',
        7:'#b000fa',
        2:'#662483',
        3:'#E6007E',
        5:'#01FEFF',
        6:'#FFFF0E',
        8:'#CD96FF'
    };
    distance = 0;
    for(ii=0;ii<itinerary.legs.length;ii++){
        leg = itinerary.legs[ii];
        distance+=leg.distance;
        w = L.PolylineUtil.decode(itinerary.legs[ii].legGeometry.points);
        waypoints =[];
        for(iii=0;iii<w.length;iii++){
            waypoints.push({
                lat:w[iii][0],
                lng:w[iii][1]
            });
        }
        var flightPath = new google.maps.Polyline({
          path: waypoints,
          geodesic: true,
          strokeColor: leg.mode=='WALK'?'#919191':colors[leg.route],
          strokeOpacity: 1.0,
          strokeWeight: 4,
          map:map
        });
        directionLines.push(flightPath);
        if (leg.mode!='WALK')
            activeRoutes.push(leg.route);
        if (leg.mode!='WALK')
            $('.bus-results .caption-buses .buses').append('<span class="bus-path"><span class="bus-prefix" style="background-color:'+colors[leg.route]+'"></span>'+leg.route+'</span>');
    }
    $('.bus-results').removeClass('bus-results__halfopacity');
    $('.bus-results .caption-distance .distance').html(parseFloat(distance/1000).toFixed(2)+' km');
}
function changeRouteSuggestion(no){
     plan = lastDirection;
    removeDirectionLines();
    $('.bus-results .caption-buses .buses').html('');
    $('.bus-results .caption-distance .distance').html('');
    activeRoutes = [];
    $('.solution-block').html('');
    for(i=0;i<plan.itineraries.length;i++){
        $('.solution-block').append('<div class="solution" data-index="'+i+'">Yol '+(i+1)+'</div>');
        
    }
    drawDirection(plan.itineraries[no]);
    if (!activeRoutes.length)
        activeRoutes = null;
    getApi();
    
}
function updateRouteSuggestion(plan){
    res = plan;
    lastDirection = plan = plan.plan;
    removeDirectionLines();
    $('.bus-results .caption-buses .buses').html('');
    $('.bus-results .caption-distance .distance').html('');
    activeRoutes = [];
    $('.solution-block').html('');
    if (res && res.error){
      alert(res.error.msg);
      return;
    }
    if (!plan || !plan.itineraries.length)
        return;
    for(i=0;i<plan.itineraries.length;i++){
        $('.solution-block').append('<div class="solution" data-index="'+i+'">Yol '+(i+1)+'</div>');
        
    }
    drawDirection(plan.itineraries[0]);
    if (!activeRoutes.length)
        activeRoutes = null;
    getApi();

}

function removeDirectionLines(){
    for(i=0;i<directionLines.length;i++){
        directionLines[i].setMap(null);
    }
    directionLines=[];
}
function getApi(){
    intervalStatus = true;
    var xhr = $.ajax({
        url:'/az/ajax/apiNew',
        dataType:'json',
//        success:function(data){
//
//        }
    }).done(function(data){
        addMarkers(data);
        console.log('done api');
        delete data;

    }).always(function(data){
        intervalStatus =false;
        console.log('completed api');
        
    });
    
}
function removeRoutePathInfo(){
    for (i = 0; i < busstopsMarker.length; i++) {
        busstopsMarker[i].setMap(null);
    }
    busstopsMarker = [];
    for (i = 0; i < poly.length; i++) {
        poly[i].setMap(null);
    }
    poly = [];
}
function centerMap(){
    offset = -1*($(document).width()/2-($(document).width()-470)/2);
    if ($(document).width()>1080)
        map.panBy(offset,0);

}

function toggleSearchBar(){
    if ($(document).width()<1080){
        $('.sidebar-menu2').toggle();
    }
        
}