var distanceWidget;
var map;
var geocodeTimer;
var profileMarkers = [];
var resultsArray = [];
var profileWindows = [];
var styles=[{"featureType":"all","elementType":"all","stylers":[{"invert_lightness":true},{"saturation":20},{"lightness":50},{"gamma":0.4},{"hue":"#00ffee"}]},{"featureType":"all","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"all","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"administrative","elementType":"all","stylers":[{"color":"#ffffff"},{"visibility":"simplified"}]},{"featureType":"administrative.land_parcel","elementType":"geometry.stroke","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#405769"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#232f3a"}]}];
function init() {
  var mapDiv = document.getElementById('map');
  map = new google.maps.Map(mapDiv, {
    center: new google.maps.LatLng(startLat,startLng),
    zoom: 12,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
//    styles:styles,
//    scrollwheel:false,
    zoomControl:true
  });

  distanceWidget = new DistanceWidget({
    map: map,
    distance: searchRadius, // Starting distance in km.
    maxDistance: 15, // Twitter has a max distance of 2500km.
    color: '#ffffff',
    activeColor: '#ffffff',
    sizerIcon: '/assets/images/resize.png',
    activeSizerIcon: '/assets/images/resize.png'
  });

  google.maps.event.addListener(distanceWidget, 'distance_changed',
      updateDistance);

  google.maps.event.addListener(distanceWidget, 'position_changed',
      updatePosition);

    map.fitBounds(distanceWidget.get('bounds'));

  updateDistance();
  updatePosition();
}

function updatePosition() {
  if (geocodeTimer) {
    window.clearTimeout(geocodeTimer);
  }

}


function updateDistance() {
    var distance = distanceWidget.get('distance');
    $('#dist').html(distance.toFixed(2));
}

function addActions() {
  var s = $('#s').submit(search);

  $('#close').click(function() {
    $('#cols').removeClass('has-cols');
    google.maps.event.trigger(map, 'resize');
    map.fitBounds(distanceWidget.get('bounds'));
    $('#results-wrapper').hide();

    return false;
  });
}



function clearMarkers() {
//    profileMarkers.every(function(el,ind,array){
//        el.richmarker.setMap(null);
//        el.setMap(null);
//    });
  for (var i = 0, marker; marker = profileMarkers[i]; i++) {
    marker.richmarker.setMap(null);
    marker.setMap(null);
  }
  profileMarkers = [];
}
function clearAgents() {
  for (var i = 0, marker; marker = profileMarkers[i]; i++) {
    marker.setMap(null);
  }
  profileMarkers = [];
}

function addResults(json) {
  var results = $('#results .items-container');
  results.innerHTML = '';
  html = [];
    resultsArray = [];
    clearMarkers();
  if (json.results && json.results.length) {
    
    $('#results .result-count span b').html(json.itemCount);
    for (var i = 0, ev; ev = json.results[i]; i++) {
        resultsArray[ev.id] = ev;
        var pos = new google.maps.LatLng(parseFloat(ev.latitude),
            parseFloat(ev.longitude));

        evBlock = itemTemplate(ev);

        var richmarker = new RichMarker({
          map: map,
          position: pos,
          content:evBlock.join(''),
          visible:false,
          draggable:false,
          flat:true
        });
        var marker = new google.maps.Marker({
            map: map,
            position: pos,
            icon: new google.maps.MarkerImage('/assets/images/gpins/pin'+parseInt(ev.rooms)+'.svg',
                null, null, null, new google.maps.Size(32,40)),          
//          icon: (ev.active?'/assets/images/fav-house.png':'/assets/images/house.png'),
            zIndex: 25,
            animation: google.maps.Animation.DROP,
            fillColor:'#ff0000',
            richmarker:richmarker,
            listId:i,
            evModel:ev,
            elanId:ev.id
        });
        
        profileMarkers.push(marker);
        resultsArray[ev.id].marker = marker;
        google.maps.event.addListener(marker,'click',function(){
            $('.listed-items .elan[data-elan-id='+this.elanId+']').trigger('click');
        });
        google.maps.event.addListener(marker,'mouseover',function(){
            this.setIcon(new google.maps.MarkerImage('/assets/images/gpins/pin'+parseInt(this.evModel.rooms)+'_hover.svg',null, null, null, new google.maps.Size(32,40)));
            this.richmarker.setVisible(1);
            
//            map.fitBounds(distanceWidget.get('bounds'));
            $('.items-list .items-container .elan[data-elan-id='+this.elanId+']').addClass('active');
        });
        google.maps.event.addListener(marker,'mouseout',function(){
            this.setIcon((this.evModel.active?'/assets/images/fav-house.png':new google.maps.MarkerImage('/assets/images/gpins/pin'+parseInt(this.evModel.rooms)+'.svg',
                null, null, null, new google.maps.Size(32,40))));
            this.richmarker.setVisible(0);
            $('.items-list .items-container .elan[data-elan-id='+this.elanId+']').removeClass('active');
        });
        html.push(evBlock.join(''));
    }
  } else {
    $('#results .result-count span b').html(0);
    html.push('<div class="no-house">Nəticə əldə edilə bilmədi.</div>');
  }

  $(results).html(html.join(''));
//  $('#results-wrapper').show();
}

function addAgents(json) {
  var results = $('#results .items-container');
  results.innerHTML = '';
  html = [];
    resultsArray = [];
    
  if (json.results && json.results.length) {
    clearAgents();
    $('#results .result-count span b').html(json.itemCount);
    for (var i = 0, ev; ev = json.results[i]; i++) {
        resultsArray[ev.id] = ev;
        var pos = new google.maps.LatLng(parseFloat(ev.latitude),
            parseFloat(ev.longitude));

        evBlock = agentTemplate(ev);

        var marker = new google.maps.Marker({
            map: map,
            position: pos,
            icon: ('/assets/images/house.png'),
            zIndex: 25,
            animation: google.maps.Animation.DROP,
            fillColor:'#ff0000',
            listId:i,
            evModel:ev,
            elanId:ev.id
        });
        
        profileMarkers.push(marker);
        google.maps.event.addListener(marker,'click',function(){
            window.location.href=$('.listed-items .agent[data-elan-id='+this.elanId+'] .agent-link').attr('href');
        });
        google.maps.event.addListener(marker,'mouseover',function(){
            this.setIcon('/assets/images/active-house.png');
            $('.items-list .items-container .elan[data-elan-id='+this.elanId+']').addClass('active');
        });
        google.maps.event.addListener(marker,'mouseout',function(){
            this.setIcon('/assets/images/house.png');
            $('.items-list .items-container .elan[data-elan-id='+this.elanId+']').removeClass('active');
        });
        html.push(evBlock.join(''));
    }
  } else {
    $('#results .result-count span b').html(0);
    html.push('<div class="no-house">Axtarış nəticə vermədi.</div>');
  }

  $(results).html(html.join(''));
//  $('#results-wrapper').show();
}

function itemTemplate(ev){
    var html = [];
    html.push('<div class="col col-sm-12 elan needhover" data-elan-id="' +ev.id + '">');
        html.push('<div class="elan-inner-wrap">');
            html.push('<div class="item-body">');
                html.push('<div class="thumbnail col-sm-6">');
                    html.push('<a href="'+ev.link+'">');
                        html.push('<img class="img-responsive" src="'+ev.pic_name+'" alt="">');
                    html.push('</a>');
                    html.push('<div class="add2favorites">');
                        active = (ev.active?'class="active"':'');
                        html.push('<a href="#" data-fav-id="'+ev.id+'" '+active+'>');
                            html.push('<span class="sprite sprite-md sprite-heart"></span>');
                        html.push('</a>');
                    html.push('</div>');
                html.push('</div>');
                html.push('<div class="items-info col-sm-6 col-sm-offset-6">');
                    html.push('<div class="col-sm-12 nopa  name">');
                        html.push('<div>'+ev.rooms+'</div>');
                        html.push('<div>'+ev.propertyType+'</div>');
                    html.push('</div>');
                    html.push('<div class=" col-sm-8 nopa  price">');
                        html.push('<div>');
                            html.push('<span class="sprite sprite-xs sprite-azn"></span>'+ev.price);
                        html.push('</div>');
                    html.push('</div>');

                    html.push('<div class="clearfix"></div>');
                html.push('</div>');
                html.push('<div class="clearfix"></div>');
            html.push('</div>');
        html.push('</div>');
    html.push('</div>');
    return html;
}
function agentTemplate(ev){
    var html = [];
    html.push('<div class="col col-sm-12 agent needhover" data-elan-id="' +ev.id + '">');
        html.push('<div class="elan-inner-wrap">');
            html.push('<div class="item-body">');
                html.push('<div class="thumbnail col-sm-5">');
                    html.push('<div class="thumbnail-wrapper">');
                        html.push('<a class="agent-link" href="'+ev.link+'">');
                            html.push('<img class="img-responsive" src="'+ev.pic_name+'" alt="">');
                        html.push('</a>');
                    html.push('</div>');
                html.push('</div>');
                html.push('<div class="items-info col-sm-7">');
                    html.push('<div class="col-sm-12 nopa">');
                        html.push('<a class="agent-link" href="'+ev.link+'">');
                            html.push('<div class="name">'+ev.name+'</div>');
                        html.push('</a>');
                        html.push('<div class="tags">'+ev.tags+'</div>');
                    html.push('</div>');
                    html.push('<div class="pull-right col-sm-12 nopa listing-stats ">');
                        html.push('<div class="col-xs-6 nopal">');
                            html.push(ev.rentListings);
                        html.push('</div>');
                        html.push('<div class="col-xs-6 nopar">');
                            html.push(ev.sellListings);
                        html.push('</div>');
                    html.push('</div>');
                    html.push('<div class="pull-right col-sm-12 nopa  ">');
                        html.push('<div class="btn btn-block btn-white">');
                            html.push('<span class="glyphicon glyphicon-earphone"></span>'+ev.phone);
                        html.push('</div>');
                    html.push('</div>');

                    html.push('<div class="clearfix"></div>');
                html.push('</div>');
            html.push('</div>');
        html.push('</div>');
    html.push('</div>');
    return html;
}
