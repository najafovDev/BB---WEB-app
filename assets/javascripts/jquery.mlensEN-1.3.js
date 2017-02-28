/************************************************************************************************
 * jquery.mlens.js
 * http://mlens.musings.it 
 * magnifying lens jQuery plugin for images
 * originally developed for the project "RubiniFirma" and released as a freebie
 * based on jquery.imageLens.js by http://www.dailycoding.com
 *  
 * mlens supports multiple instances, these are the configurable parameters
 * lensShape: shape of the lens (square or circle)
 * lensSize: lens dimension (in px)
 * borderSize: lens border size (in px)
 * borderColor: lens border color (hex value)
 * borderRadius: lens border radius (if you like rounded corners when the shape is "square")
 * imgSrc: address of the hi-res image
 * lensCss: lens class if you like to style it your own way
 * imgOverlay: address of the overlay image for the lens (optional)
 * overlayAdapt: boolean that indicates if the overlay image has to adapt to the lens size (dafault: true)
 * imgSrc2x: address of the double pixel density image (for retina displays)
 * 
 * @author Federica Sibella
 * Copyright (c) 2012-13 Federica Sibella - musings(at)musings(dot)it | http://www.musings.it
 * Double licensed MIT or GPLv3.
 * Date: 2013/12/16
 * @version 1.3
 * changelog:
 * 2013/08/26 added touch support for version 1.1
 * 2013/09/25 added overlay image control version 1.2
 * 2013/12/16 added retina support version 1.3
 ************************************************************************************************/

(function($){
	// Global variables
	var mlens = [],
		instance = 0;
	var	methods = {
		//function for initializing the lens instance
		init : function(options) {
			this.each(function () {
					// Defaults for lens options
					var defaults = {
						lensShape: "square",
						lensSize: 100,
           				borderSize: 4,
            			borderColor: "#888",
						borderRadius: 0,
						imgSrc: "",
						imgSrc2x: "",
						lensCss: "",
						imgOverlay: "",
						overlayAdapt: true
					}, 
					$obj = $(this), 
					data = $obj.data('mlens'), 
					$options = $(), 
					$target = $(),
					$overlay = $(),
					$parentDiv = $(),
					$imageTag = $(),
					$imgSrc = $(),
					imgWidth = "auto";
					
					$options = $.extend(defaults, options);
					
					if($options.imgSrc == "")
					{
						$imgSrc = $obj.attr("src");
					}
					
					//retina?
					if($options.imgSrc2x != "" && window.devicePixelRatio > 1)
					{
						$imgSrc = $options.imgSrc2x;
						var bigimg = new Image();
						bigimg.onload = function() 
						{
							imgWidth = String(parseInt(this.width/2))+"px";
							$target.css({ 
								backgroundSize: imgWidth + " auto"
							});
							$imageTag.css({width: imgWidth});
						}
						bigimg.src = $imgSrc;
					}
					else
					{
						$imgSrc = $options.imgSrc;
					}
					
					//lens style
					var lensStyle = "background-position: 0px 0px;width: " + String($options.lensSize) + "px;height: " + String($options.lensSize) + "px;"
		            				+ "float: left;display: none;border: " + String($options.borderSize) + "px solid " + $options.borderColor + ";"
		            				+ "background-repeat: no-repeat;position: absolute;";
					
					//image overlay style (just in case)
					var overlayStyle= "position: absolute; width: 100%; height: 100%; left: 0; top: 0; background-position: center center; background-repeat: no-repeat; z-index: 1;"
					//if overlay image has to adapt to lens size
					if($options.overlayAdapt === true)
					{
						overlayStyle = overlayStyle + "background-position: center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;";
					}
					
					switch($options.lensShape)
					{
						case "square":
						case "":
						default:
							lensStyle = lensStyle + "border-radius:"  + String($options.borderRadius) + "px;";
							overlayStyle = overlayStyle + "border-radius:"  + String($options.borderRadius) + "px;";
						break;
						case "circle":
							lensStyle = lensStyle + "border-radius: " + String($options.lensSize / 2 + $options.borderSize) + "px;";
							overlayStyle = overlayStyle + "border-radius: " + String($options.lensSize / 2 + $options.borderSize) + "px;";
						break;
					}
					
					//lens wrapping div to attach target and hi-res image correctly
					$obj.wrap("<div id='mlens_wrapper_" + instance + "' />");
					$parentDiv = $obj.parent();
					$parentDiv.css({"width":$obj.width()});
					
					$target = $("<div id='mlens_target_" + instance + "' style='" + lensStyle + "' class='" + $options.lensCss + "'>&nbsp;</div>").appendTo($parentDiv);
					$imageTag = $("<img style='display:none;width:" + imgWidth + ";height:auto;max-width:none;max-height;none;' src='" + $imgSrc + "' />").appendTo($parentDiv);
					
		            $target.css({ 
						backgroundImage: "url('" + $imgSrc + "')",
						backgroundSize: imgWidth + " auto",
						cursor: "none"
					});
					
					//if there's an overlay append it to $target
					if($options.imgOverlay != "")
					{						
						$overlay = $("<div id='mlens_overlay_" + instance + "' style='" + overlayStyle + "'>&nbsp;</div>");
						
						$overlay.css({ 
							backgroundImage: "url('" + $options.imgOverlay + "')",
							cursor: "none"
						});
						
						$overlay.appendTo($target);
					}
					
		            $obj.attr("data-id","mlens_"+instance);
					
					//saving data in mlens instance
					$obj.data('mlens', {
						lens: $obj,
						options: $options,
						target: $target,
						imageTag: $imageTag,
						imgSrc: $imgSrc,
						parentDiv: $parentDiv,
						overlay: $overlay,
						instance : instance
					});
					
					data = $obj.data('mlens');
					mlens[instance] = data;
					
					//attaching mousemove event both to the target and to the object
					$target.mousemove(function(e)
					{
						$.fn.mlens('move',$obj.attr("data-id"),e);
					});
		            $obj.mousemove(function(e)
					{
						$.fn.mlens('move',$obj.attr("data-id"),e)
					});
					
					//touch events imitating mousemove both for the target and for the object
					$target.on("touchmove",function(e)
					{
						e.preventDefault();
						var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
						$.fn.mlens('move',$obj.attr("data-id"),touch);
					});
		            $obj.on("touchmove",function(e)
					{
						e.preventDefault();
						var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
						$.fn.mlens('move',$obj.attr("data-id"),touch)
					});
					
					//target visibility relies both on its own visibility and that of the original image
					$obj.hover(function()
					{
						$target.show();
					},function()
					{
						$target.hide();
					});
					
					$target.hover(function()
					{
						$target.show();
					},function()
					{
						$target.hide();
					});
					
					//touch events for the object
					$obj.on("touchstart",function(e)
					{
						e.preventDefault();
						$target.show();
					});
					$obj.on("touchend",function(e)
					{
						e.preventDefault();
						$target.hide();
					});
					
					//touch events for the target
					$target.on("touchstart",function(e)
					{
						e.preventDefault();
						$target.show();
					});
					$target.on("touchend",function(e)
					{
						e.preventDefault();
						$target.hide();
					});
					
					//instance increment
					instance++;
				return mlens;
			});
		},
		//function that defines "move" command
		move : function(id,e)
		{
			id = trovaistanza(id);
			//taking parameters values based on the instance
			var data = mlens[id],
				$obj = data.lens,
				$target = data.target,
				$imageTag = data.imageTag,
				offset = $obj.offset(),
        		leftPos = parseInt(e.pageX - offset.left),
        		topPos = parseInt(e.pageY - offset.top),
				widthRatio = $imageTag.width() / $obj.width(),
				heightRatio = $imageTag.height() / $obj.height();
				
			//if mouse position is inside our image
	        if (leftPos > 0 && topPos > 0 && leftPos < $obj.width() && topPos < $obj.height()) 
			{	
				//calculating hi-res image position as target background
	            leftPos = String(-((e.pageX - offset.left) * widthRatio  - $target.width() / 2));
	            topPos = String(-((e.pageY - offset.top) * heightRatio - $target.height() / 2));
	            $target.css({ backgroundPosition: leftPos + 'px ' + topPos + 'px' });
				
				//calculating target position
	            leftPos = String(e.pageX - offset.left - $target.width() / 2);
	            topPos = String(e.pageY - offset.top - $target.height() / 2);
	            $target.css({ left: leftPos + 'px', top: topPos + 'px' });
	        }
			
			//saving new data in the mlens instance
			data.target = $target;
			
			mlens[id] = data;
			return mlens;
		},
		//function that defines "update" command (to modify mlens options on-the-fly)
		update: function(id,settings)
		{
			id = trovaistanza(id);  
			var data = mlens[id],
				$obj = data.lens,
				$target = data.target,
				$overlay = data.overlay,
				$imageTag = data.imageTag,
				$imgSrc = data.imgSrc,
				$options = $.extend(data.options, settings),
				imgWidth = "auto";
			
			if($options.imgSrc == "")
			{
				$imgSrc = $obj.attr("src");
			}
			
			if($options.imgSrc2x != "" && window.devicePixelRatio > 1)
			{
				$imgSrc = $options.imgSrc2x;
				var bigimg = new Image();
				bigimg.onload = function() 
				{
					imgWidth = String(parseInt(this.width/2))+"px";
					$target.css({ 
						backgroundSize: imgWidth + " auto"
					});
					$imageTag.css({width: imgWidth});
				}
				bigimg.src = $imgSrc;
			}
			else
			{
				$imgSrc = $options.imgSrc;
			}
			
			var lensStyle = "background-position: 0px 0px;width: " + String($options.lensSize) + "px;height: " + String($options.lensSize) + "px;"
            				+ "float: left;display: none;border: " + String($options.borderSize) + "px solid " + $options.borderColor + ";"
            				+ "background-repeat: no-repeat;position: absolute;";
			
			var overlayStyle= "position: absolute; width: 100%; height: 100%; left: 0; top: 0; background-position: center center; background-repeat: no-repeat; z-index: 1;"
			
			if($options.overlayAdapt === true)
			{
				overlayStyle = overlayStyle + "background-position: center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;";
			}
			
			switch($options.lensShape)
			{
				case "square":
				case "":
				default:
					lensStyle = lensStyle + "border-radius:"  + String($options.borderRadius) + "px;";
					overlayStyle = overlayStyle + "border-radius:"  + String($options.borderRadius) + "px;";
				break;
				case "circle":
					lensStyle = lensStyle + "border-radius: " + String($options.lensSize / 2 + $options.borderSize) + "px;";
					overlayStyle = overlayStyle + "border-radius: " + String($options.lensSize / 2 + $options.borderSize) + "px;";
				break;
			}
			
			$target.attr("style",lensStyle);
			$imageTag.attr("src",$imgSrc);
			$imageTag.css({width: imgWidth});
            $target.css({ 
				backgroundImage: "url('" + $imgSrc + "')",
				backgroundSize: imgWidth + " auto",
				cursor: "none"
			});
			
			$overlay.attr("style",overlayStyle);
			$overlay.css({ 
							backgroundImage: "url('" + $options.imgOverlay + "')",
							cursor: "none"
						});
			
			data.lens = $obj;
			data.target = $target;
			data.overlay = $overlay;
			data.options = $options;
			data.imgSrc = $imgSrc;
			data.imageTag = $imageTag;
			
			mlens[id] = data;
			return mlens;
		},
		//function that defines "destroy" command
		destroy : function(id)
		{
			id = trovaistanza(id);  
			var data = mlens[id];
            $.removeData(data, this.name);
            this.removeClass(this.name);
		    this.unbind();
		    this.element = null;
        }
	};
	
	/*************************************
	 * service functions
	 *************************************/
	
	/**************************************************
	 * function to find mlens actual instance
	 * @param {Object} id
	 *************************************************/
	function trovaistanza(id)
	{
		if(typeof(id) === "string")
		{
			var position = id.indexOf("_");
			if(position != -1)
			{
				id = id.substr(position+1);  
			}
		}
		return id;
	}
	
	/********************************************
	 * function that generates mlens plugin
	 * @param {Object} method
	 ********************************************/
	$.fn.mlens = function(method){
	    //method calling logic
	    if ( methods[method] ) 
		{
	      return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
	    } 
		else if ( typeof method === 'object' || ! method ) 
		{
	      return methods.init.apply( this, arguments );
	    } 
		else 
		{
	      $.error( 'Method ' +  method + ' does not exist on jQuery.mlens' );
	    }
  	};
})(jQuery);