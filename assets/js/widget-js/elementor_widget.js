(function($) {
    "use strict";
    
    
    var jws_dropdown_text = function($scope, $) {
		$scope.find('.jws_dropdown_text').eq(0).each(function() {

		});
	};
    

	var product_tabs_filter = function($scope, $) {
		$scope.find('.jws-wrap').eq(0).each(function() {
			var wrap = $(this);
            if(wrap.hasClass('jws-carousel')) {
                
                jws_carousel($scope, $);
             
			}
            if(wrap.hasClass('metro')){
                wrap.find('.products-tab').isotope({
					itemSelector: ".product-item",
					layoutMode: 'masonry',
					transitionDuration: "0.3s",
					masonry: {
						// use outer width of grid-sizer for columnWidth
						columnWidth: '.grid-sizer',
					}
				});  
            }
			wrap.find('.jws-ajax-load a.ajax-load').on('click', function(e) {
				e.preventDefault();
				var $this = $(this) , intervalID;
				var key = $this.data('value');
				if($this.hasClass('active')) {
					return;
				}
                clearInterval(intervalID);
                wrap.addClass('jws-animated-products');
				$this.parents('.jws-ajax-load').find('a').removeClass('active');
				$this.addClass('active');
				if($this.hasClass('opened')) {
					wrap.find('.products-tab').html(wrap.find('.products-tab').data(key));
					if(wrap.hasClass('jws-carousel')) {
						jws_carousel($scope, $);
					}
                     var iter = 0;
                    intervalID = setInterval(function() {
                            wrap.find('.product-item').eq(iter).addClass('jws-animated');
                            iter++;
                     }, 100);
					return;
				}
				$this.addClass('opened');
				wrap.addClass('loading');
                if(!wrap.find('.loader').length) {    
                        wrap.append('<div class="loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>');    
                }
				var data = wrap.data('args');
				data.action = 'jws_ajax_product_filter';
				if($this.data('type') == 'product_cat') {
					data.filter_categories = $this.data('value');
				}
				if($this.data('type') == 'asset_type') {
					data.asset_type = $this.data('value');
				}
				$.ajax({
					url: wrap.data('url'),
					data: data,
					type: 'POST',
                    dataType: 'json',
				}).success(function(response) {
					wrap.removeClass('loading');
					let content = response.items;
					wrap.find('.products-tab').html(content);
					wrap.find('.products-tab').data(key, content);
					if(wrap.hasClass('jws-carousel')) {
						jws_carousel($scope, $);
					}
                    var iter = 0;
                    intervalID = setInterval(function() {
                            wrap.find('.product-item').eq(iter).addClass('jws-animated');
                            iter++;
                     }, 100);
				}).error(function(ex) {
					console.log(ex);
				});
			});
            
            wrap.find('.jws-products-load-more').off('click').on('click', function(e) {
                e.preventDefault();
                var $this = $(this),
                  data = wrap.data('args'),
                  paged = wrap.data('paged');
                  paged++;
                loadProducts2(data, paged, wrap, $this)
             });
             
             var loadProducts2 = function(data, paged, wrap, btn) {
                  var intervalID,
                  total = wrap.find('.product-item').length,
                  iter = total;
                  clearInterval(intervalID);  
                  data.action = 'jws_ajax_product_filter';
                  data.paged = paged;
                  btn.addClass('loading');
                  wrap.find('.product-item').addClass('jws-animated');
                  wrap.addClass('jws-animated-products');
                  
                  btn.append('<div class="loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>');
                  $.ajax({
                    url: wrap.data('url'),
                    data: data,
                    method: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        
                        if (response.items) {
                            wrap.find('.products-tab').append(response.items);
                            intervalID = setInterval(function() {
                                wrap.find('.product-item').eq(iter).addClass('jws-animated');
                                iter++;
                            }, 100); 
                            wrap.data('paged', paged);
                        }
                        
                        if (response.status == 'no-more-posts') { 
                           btn.hide();
                        }
                    
					   
                    },
                    error: function(data) {
                      console.log('ajax error');
                      console.log(data);
                    },
                    complete: function() {
                      btn.removeClass('loading');
                      $('.loader').remove();
                   
                    },
                  });
              };
		});
	};
    
    
    var jws_carousel = function($scope, $) {

		$scope.find('.jws-carousel').eq(0).each(function() {
		  
		    var $this = $(this);

            jwsThemeModule.owl_caousel_init($(this).find('.carousel'));


		});

	};
    
     /**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Image Carousel
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */
	var images_carousel = function($scope, $) {
		$scope.find('.jws-image_carousel-element').eq(0).each(function() {
	       let $this = $(this);
            if($this.find('.jws-image_carousel').hasClass('slider')) {
                jwsThemeModule.owl_caousel_init($this.find('.jws-image_carousel'));
            }
    	});
	};
	
	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * video popup
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */
	var demo_filter = function($scope, $) {
		$scope.find('.jws_demo_element').eq(0).each(function() {
			//Check to see if the window is top if not then display button
			$scope.find('.jws_demo_element .jws_demo_item').each(function() {
				var btn = $(this).find('.jws_image_content_inner');
				$(this).find('.jws_image a').scroll(function() {
					if($(this).scrollTop() > 100) {
						btn.fadeOut("slow");
					} else {
						btn.fadeIn("slow");
					}
				});
				//Click event to scroll to top
				$(this).find('.jws_column_content').on("mouseleave", function() {
					$(this).find('.jws_image a').animate({
						scrollTop: 0
					}, 800);
					return false;
				});
			});
		});
	};
	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * video popup
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */
	var video_popup = function($scope, $) {
		$scope.find('.jws_video_popup').eq(0).each(function() {
			$(this).find('.jws_video_popup_inner').lightGallery();
		});
	};
    
    
    
	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * testimonials_slider
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */
	var testimonials_slider = function($scope, $) {
		$scope.find('.jws_testimonials_slider_wrap').eq(0).each(function() {
		  
          
            let centerMode = true;
            let slider = $(this).find('.testimonials_slider');
            let thumbnail = $(this).find('.testimonials_slider_thumbnail');
            
   
            jwsThemeModule.owl_caousel_init(slider);
            
         
            if(thumbnail.length) {
               slider.on('changed.owl.carousel', function(event) {
                syncPosition(event , thumbnail);
               });
               var options = thumbnail.data('owl-option'); 
               thumbnail.owlCarousel(options);
               
               thumbnail.on("click", ".owl-item", function(e){
                  
                    e.preventDefault();
                    var number = $(this).find('.slider-item').data('index');
                    var clone = slider.find('.cloned').length;
                    var change_nav = slider.find('.owl-item').not( ".cloned" ).find('.slider-item[data-index="'+number+'"]');
                    slider.trigger("to.owl.carousel", change_nav.parent().index() - clone / 2 )
        
                   
               });    
                  
            } 
		});
	};

    
	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Blog Filter
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */
	var blog_filter = function($scope, $) {
		$scope.find('.jws-blog-element').eq(0).each(function() {
			var $this = $(this);
			var $container = $this.find('.blog_content');
			if($container.hasClass('jws_blog_slider')) {
    		   jwsThemeModule.owl_caousel_init($container);
			}
		});
	};


    
	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * team_slider
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */
	var team_slider = function($scope, $) {
	   $scope.find('.jws_team_element').eq(0).each(function() {

            jwsThemeModule.owl_caousel_init($(this).find('.jws_team_slider'));
           
		});

	};


	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * gallery Filter
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */
	var jws_gallery = function($scope, $) {
        
		$scope.find('.jws_gallery_element').eq(0).each(function() {
			var $this = $(this),
				$container = $this.find('.jws_gallery');
          
			//init flickity
			var pageDots = false;
			if($container.hasClass('has-dots')) {
				pageDots = true;
			}

            if($('.jws_gallery_item .jws-popup-global').length) {
                $container.lightGallery({
    				thumbnail: true,
    				selector: '.jws_gallery_item .jws-popup-global'
    		    });
            }
            
            
			if($container.hasClass('slider')) {
			 
               jwsThemeModule.owl_caousel_init($container);
      
			}

		});
	};


	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Tabs
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */
	var jws_tabs = function($scope, $) {
		$scope.find('.jws_tab_wrap').eq(0).each(function() {
			var $this = $(this);
			/** Line magic tabs filter **/
			if($this.find('.tab_nav').length) {

			$this.find('.tab_nav li a').click(function(e) {
				e.preventDefault();
				var tab_id = $(this).attr('data-tab');
				$this.find('.tab_nav li a').parent().removeClass('current');
				$this.find('.jws_tab_item').removeClass('current');
				$(this).parent().addClass('current');
				$this.find("#" + tab_id).addClass('current');
			});
		};
	});
    };
	
	var blogLoadMore = function($scope, $) {
		$scope.find('.jws-blog-element').eq(0).each(function() {
			loadmore_btn($(this));
		});
	};
	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Load more button for blog
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */
     
       var loadmore_btn = function($scope) {
		var $element = $scope.find('[data-ajaxify=true]');
		  var options = $element.data('ajaxify-options');
          if($element.length < 1) return false;
          var wap =  options.wrapper;
          var page = 1;
	      $(document.body).on('click', '.jws-load-more' , function(e) {
            e.preventDefault();
            var $this = $(this);
            if($this.hasClass('all-items-loaded')) return false;
            page++;
            $(this).append('<div class="loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>');
            $(this).addClass('loading');
            var url = $this.attr('href');

            if ('?' == url.slice(-1)) {
                url = url.slice(0, -1);
            }

            url = url.replace(/%2C/g, ',');


            $.get(url, function(res) {
           
                var $newItemsWrapper = $(res).find(options.wrapper);
                var $newItems = $newItemsWrapper.find(options.items);
                var $total = options.total;
                $this.removeClass('loading');
           
                if($total == page) {
                    
                  $this.addClass('all-items-loaded'); 
                   
                } else {
                    
                  $this.parents('.jws_pagination').html($(res).find('.jws_pagination').html()); 
                    
                }
                $(wap).append($newItems);
		
			    $this.find('.loader').remove();
			

                
              
            }, 'html');
        });   
	
	}; 

	/**
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 * Google Map
	 *-------------------------------------------------------------------------------------------------------------------------------------------
	 */
	var WidgetjwsGoogleMapHandler = function($scope) {
		if('undefined' == typeof $scope) return;
		var selector = $scope.find('.jws-google-map').eq(0),
			locations = selector.data('locations'),
			map_style = (selector.data('custom-style') != '') ? selector.data('custom-style') : '',
			predefined_style = (selector.data('predefined-style') != '') ? selector.data('predefined-style') : '',
			info_window_size = (selector.data('max-width') != '') ? selector.data('max-width') : '',
			animate = selector.data('animate'),
			auto_center = selector.data('auto-center'),
			maker_offset = selector.data('offset'),
			map_options = selector.data('map_options'),
			i = '',
			bounds = new google.maps.LatLngBounds(),
			marker_cluster = [],
			className = 'map_pin_jws';
		var animation;
		if('drop' == animate) {
			animation = google.maps.Animation.DROP;
		} else if('bounce' == animate) {
			animation = google.maps.Animation.BOUNCE;
		}

		function _typeof(obj) {
			var _typeof;
			if(typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
				_typeof = function _typeof(obj) {
					return typeof obj;
				};
			} else {
				_typeof = function _typeof(obj) {
					return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
				};
			}
			return _typeof(obj);
		}

		function CustomMarker(latlng, map, className) {
			this.latlng_ = latlng;
			this.className = className; // Once the LatLng and text are set, add the overlay to the map.  This will
			// trigger a call to panes_changed which should in turn call draw.
			this.setMap(map);
		}
		if((typeof google === "undefined" ? "undefined" : _typeof(google)) !== _typeof(undefined) && _typeof(google.maps) !== _typeof(undefined)) {
			CustomMarker.prototype = new google.maps.OverlayView();
			CustomMarker.prototype.draw = function() {
				var me = this; // Check if the div has been created.
				var div = this.div_,
					divChild,
					divChild2;
				if(!div) {
					// Create a overlay text DIV
					div = this.div_ = document.createElement('DIV');
					div.className = this.className;
					divChild = document.createElement("div");
					div.appendChild(divChild);
					divChild2 = document.createElement("div");
					div.appendChild(divChild2);
					google.maps.event.addDomListener(div, "click", function() {
						google.maps.event.trigger(me, "click");
					}); // Then add the overlay to the DOM
					var panes = this.getPanes();
					panes.overlayImage.appendChild(div);
				} // Position the overlay
				var point = this.getProjection().fromLatLngToDivPixel(this.latlng_);
				if(point) {
					div.style.left = point.x + 'px';
					div.style.top = point.y + 'px';
				}
			};
			CustomMarker.prototype.remove = function() {
				// Check if the overlay was on the map and needs to be removed.
				if(this.div_) {
					this.div_.parentNode.removeChild(this.div_);
					this.div_ = null;
				}
			};
			CustomMarker.prototype.getPosition = function() {
				return this.latlng_;
			};
		}
		var skins = {
			"silver": "[{\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#f5f5f5\"}]},{\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#616161\"}]},{\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#f5f5f5\"}]},{\"featureType\":\"administrative.land_parcel\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#bdbdbd\"}]},{\"featureType\":\"poi\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#eeeeee\"}]},{\"featureType\":\"poi\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#757575\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#e5e5e5\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#9e9e9e\"}]},{\"featureType\":\"road\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#ffffff\"}]},{\"featureType\":\"road.arterial\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#757575\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#dadada\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#616161\"}]},{\"featureType\":\"road.local\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#9e9e9e\"}]},{\"featureType\":\"transit.line\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#e5e5e5\"}]},{\"featureType\":\"transit.station\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#eeeeee\"}]},{\"featureType\":\"water\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#c9c9c9\"}]},{\"featureType\":\"water\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#9e9e9e\"}]}]",
			"retro": "[{\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#ebe3cd\"}]},{\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#523735\"}]},{\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#f5f1e6\"}]},{\"featureType\":\"administrative\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#c9b2a6\"}]},{\"featureType\":\"administrative.land_parcel\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#dcd2be\"}]},{\"featureType\":\"administrative.land_parcel\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#ae9e90\"}]},{\"featureType\":\"landscape.natural\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#dfd2ae\"}]},{\"featureType\":\"poi\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#dfd2ae\"}]},{\"featureType\":\"poi\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#93817c\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#a5b076\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#447530\"}]},{\"featureType\":\"road\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#f5f1e6\"}]},{\"featureType\":\"road.arterial\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#fdfcf8\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#f8c967\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#e9bc62\"}]},{\"featureType\":\"road.highway.controlled_access\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#e98d58\"}]},{\"featureType\":\"road.highway.controlled_access\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#db8555\"}]},{\"featureType\":\"road.local\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#806b63\"}]},{\"featureType\":\"transit.line\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#dfd2ae\"}]},{\"featureType\":\"transit.line\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#8f7d77\"}]},{\"featureType\":\"transit.line\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#ebe3cd\"}]},{\"featureType\":\"transit.station\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#dfd2ae\"}]},{\"featureType\":\"water\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#b9d3c2\"}]},{\"featureType\":\"water\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#92998d\"}]}]",
			"dark": "[{\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#212121\"}]},{\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#757575\"}]},{\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#212121\"}]},{\"featureType\":\"administrative\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#757575\"}]},{\"featureType\":\"administrative.country\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#9e9e9e\"}]},{\"featureType\":\"administrative.land_parcel\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"administrative.locality\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#bdbdbd\"}]},{\"featureType\":\"poi\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#757575\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#181818\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#616161\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#1b1b1b\"}]},{\"featureType\":\"road\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#2c2c2c\"}]},{\"featureType\":\"road\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#8a8a8a\"}]},{\"featureType\":\"road.arterial\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#373737\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#3c3c3c\"}]},{\"featureType\":\"road.highway.controlled_access\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#4e4e4e\"}]},{\"featureType\":\"road.local\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#616161\"}]},{\"featureType\":\"transit\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#757575\"}]},{\"featureType\":\"water\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#000000\"}]},{\"featureType\":\"water\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#3d3d3d\"}]}]",
			"night": "[{\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#242f3e\"}]},{\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#746855\"}]},{\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#242f3e\"}]},{\"featureType\":\"administrative.locality\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#d59563\"}]},{\"featureType\":\"poi\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#d59563\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#263c3f\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#6b9a76\"}]},{\"featureType\":\"road\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#38414e\"}]},{\"featureType\":\"road\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#212a37\"}]},{\"featureType\":\"road\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#9ca5b3\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#746855\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#1f2835\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#f3d19c\"}]},{\"featureType\":\"transit\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#2f3948\"}]},{\"featureType\":\"transit.station\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#d59563\"}]},{\"featureType\":\"water\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#17263c\"}]},{\"featureType\":\"water\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#515c6d\"}]},{\"featureType\":\"water\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#17263c\"}]}]",
			"aubergine": "[{\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#1d2c4d\"}]},{\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#8ec3b9\"}]},{\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#1a3646\"}]},{\"featureType\":\"administrative.country\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#4b6878\"}]},{\"featureType\":\"administrative.land_parcel\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#64779e\"}]},{\"featureType\":\"administrative.province\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#4b6878\"}]},{\"featureType\":\"landscape.man_made\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#334e87\"}]},{\"featureType\":\"landscape.natural\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#023e58\"}]},{\"featureType\":\"poi\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#283d6a\"}]},{\"featureType\":\"poi\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#6f9ba5\"}]},{\"featureType\":\"poi\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#1d2c4d\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#023e58\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#3C7680\"}]},{\"featureType\":\"road\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#304a7d\"}]},{\"featureType\":\"road\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#98a5be\"}]},{\"featureType\":\"road\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#1d2c4d\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#2c6675\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#255763\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#b0d5ce\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#023e58\"}]},{\"featureType\":\"transit\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#98a5be\"}]},{\"featureType\":\"transit\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#1d2c4d\"}]},{\"featureType\":\"transit.line\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#283d6a\"}]},{\"featureType\":\"transit.station\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#3a4762\"}]},{\"featureType\":\"water\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#0e1626\"}]},{\"featureType\":\"water\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#4e6d70\"}]}]",
			"magnesium": "[{\"featureType\":\"all\",\"stylers\":[{\"saturation\":0},{\"hue\":\"#e7ecf0\"}]},{\"featureType\":\"road\",\"stylers\":[{\"saturation\":-70}]},{\"featureType\":\"transit\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"water\",\"stylers\":[{\"visibility\":\"simplified\"},{\"saturation\":-60}]}]",
			"classic_blue": "[{\"featureType\":\"all\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"administrative.country\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"administrative.country\",\"elementType\":\"labels.text\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"administrative.province\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"administrative.province\",\"elementType\":\"labels.text\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"administrative.locality\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"administrative.neighborhood\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"administrative.land_parcel\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"landscape\",\"elementType\":\"all\",\"stylers\":[{\"hue\":\"#FFBB00\"},{\"saturation\":43.400000000000006},{\"lightness\":37.599999999999994},{\"gamma\":1}]},{\"featureType\":\"landscape\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"saturation\":\"-40\"},{\"lightness\":\"36\"}]},{\"featureType\":\"landscape.man_made\",\"elementType\":\"geometry\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"landscape.natural\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"saturation\":\"-77\"},{\"lightness\":\"28\"}]},{\"featureType\":\"landscape.natural\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi\",\"elementType\":\"all\",\"stylers\":[{\"hue\":\"#00FF6A\"},{\"saturation\":-1.0989010989011234},{\"lightness\":11.200000000000017},{\"gamma\":1}]},{\"featureType\":\"poi\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi.attraction\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"saturation\":\"-24\"},{\"lightness\":\"61\"}]},{\"featureType\":\"road\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"road\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"road\",\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"all\",\"stylers\":[{\"hue\":\"#FFC200\"},{\"saturation\":-61.8},{\"lightness\":45.599999999999994},{\"gamma\":1}]},{\"featureType\":\"road.highway\",\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"road.highway.controlled_access\",\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"road.arterial\",\"elementType\":\"all\",\"stylers\":[{\"hue\":\"#FF0300\"},{\"saturation\":-100},{\"lightness\":51.19999999999999},{\"gamma\":1}]},{\"featureType\":\"road.local\",\"elementType\":\"all\",\"stylers\":[{\"hue\":\"#ff0300\"},{\"saturation\":-100},{\"lightness\":52},{\"gamma\":1}]},{\"featureType\":\"road.local\",\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"transit\",\"elementType\":\"geometry\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"transit\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"transit\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"transit\",\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"transit.line\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"transit.station\",\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"water\",\"elementType\":\"all\",\"stylers\":[{\"hue\":\"#0078FF\"},{\"saturation\":-13.200000000000003},{\"lightness\":2.4000000000000057},{\"gamma\":1}]},{\"featureType\":\"water\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]}]",
			"aqua": "[{\"featureType\":\"administrative\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#444444\"}]},{\"featureType\":\"landscape\",\"elementType\":\"all\",\"stylers\":[{\"color\":\"#f2f2f2\"}]},{\"featureType\":\"poi\",\"elementType\":\"all\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"road\",\"elementType\":\"all\",\"stylers\":[{\"saturation\":-100},{\"lightness\":45}]},{\"featureType\":\"road.highway\",\"elementType\":\"all\",\"stylers\":[{\"visibility\":\"simplified\"}]},{\"featureType\":\"road.arterial\",\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"transit\",\"elementType\":\"all\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"water\",\"elementType\":\"all\",\"stylers\":[{\"color\":\"#46bcec\"},{\"visibility\":\"on\"}]}]",
			"earth": "[{\"featureType\":\"landscape.man_made\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#f7f1df\"}]},{\"featureType\":\"landscape.natural\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#d0e3b4\"}]},{\"featureType\":\"landscape.natural.terrain\",\"elementType\":\"geometry\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi.business\",\"elementType\":\"all\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi.medical\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#fbd3da\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#bde6ab\"}]},{\"featureType\":\"road\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"road\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#ffe15f\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#efd151\"}]},{\"featureType\":\"road.arterial\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#ffffff\"}]},{\"featureType\":\"road.local\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"black\"}]},{\"featureType\":\"transit.station.airport\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#cfb2db\"}]},{\"featureType\":\"water\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#a2daf2\"}]}]"
		};
		if('undefined' != typeof skins[predefined_style]) {
			map_style = JSON.parse(skins[predefined_style]);
		}
		(function initMap() {
			var latlng = new google.maps.LatLng(locations[0][0], locations[0][1]);
			map_options.center = latlng;
			map_options.styles = map_style;
			if(false == map_options.gestureHandling) {
				map_options.gestureHandling = 'none';
			}
			var map = new google.maps.Map($scope.find('.jws-google-map')[0], map_options);
			var infowindow = new google.maps.InfoWindow();
			var marker;
			for(i = 0; i < locations.length; i++) {
				var title = locations[i][3];
				var description = locations[i][4];
				var images_info = locations[i][5];
				var icon_size = parseInt(locations[i][8]);
				var icon_type = locations[i][6];
				var icon = '';
				var icon_url = locations[i][7];
				var enable_iw = locations[i][2];
				var click_open = locations[i][9];
				var lat = locations[i][0];
				var lng = locations[i][1];
                var infoWindow_opened = false;
				if('undefined' === typeof locations[i]) {
					return;
				}
				if('' != lat.length && '' != lng.length) {
					if('custom' == icon_type) {
						icon = {
							url: icon_url,
						};
						if(!isNaN(icon_size)) {
							icon.scaledSize = new google.maps.Size(icon_size, icon_size);
							icon.origin = new google.maps.Point(0, 0);
							icon.anchor = new google.maps.Point(icon_size / 2, icon_size);
						}
						marker = new google.maps.Marker({
							position: new google.maps.LatLng(lat, lng),
							map: map,
							title: title,
							icon: icon,
							animation: animation
						});
					} else if('html' == icon_type) {
						marker = new CustomMarker(new google.maps.LatLng(lat, lng), map, className);
					} else {
						marker = new google.maps.Marker({
							position: new google.maps.LatLng(lat, lng),
							map: map,
							title: title,
							icon: icon,
							animation: animation
						});
					}
					if('undefined' !== typeof maker_offset) {
						map.panBy(0, maker_offset);
					}
					if(locations.length > 1) {
						// Extend the bounds to include each marker's position
						bounds.extend(marker.position);
					}
					marker_cluster[i] = marker;
					if(enable_iw && 'iw_open' == click_open) {
					    infoWindow_opened = true;   
						var has_image = '';
						if(images_info != '') {
							has_image = ' has-image';
						}
                      
						var content_string = '<div class="jws-infowindow-content'+has_image+'">';
                        
                       
                       	if(images_info != '') {
							content_string += '<div class="info-left"><img src="' + images_info + '"></div>';
						}
						if('' != description.length) {
							content_string += ' <div class="content-right"><div class="jws-infowindow-title">' + title + '</div><div class="jws-infowindow-description">' + description + '</div></div>';
						}
					
						content_string += '</div>';
						if('' != info_window_size) {
							var width_val = parseInt(info_window_size);
							infowindow = new google.maps.InfoWindow({
								content: content_string,
								maxWidth: width_val
							});
						} else {
							infowindow = new google.maps.InfoWindow({
								content: content_string,
							});
						}
						infowindow.open(map, marker);
					}
					// Adding close event for info window
                    infowindow.addListener('closeclick', ()=>{
                         infoWindow_opened = false; 
                    });
                    if(enable_iw && '' != locations[i][3]) {
						google.maps.event.addListener(marker, 'click', (function(marker, i) {
						  	var infowindow = new google.maps.InfoWindow();
                               var has_image = '';
        						if(locations[i][5] != '') {
        							has_image = ' has-image';
        						}       	
								var	content_string = '<div class="jws-infowindow-content'+has_image+'">';
							     
                                 
                                 if('' != locations[i][5]) {
                                    
							                 content_string += '<div class="info-left"><img src="' + locations[i][5] + '"></div>';
					
                                  } 
                                
								 content_string += '<div class="content-right"><div class="jws-infowindow-title">' + locations[i][3] + '</div>';
								if('' != locations[i][4].length) {
									content_string += '<div class="jws-infowindow-description">' + locations[i][4] + '</div></div>';
								}
                          
								content_string += '</div>';
                                
                               return function() {
                              
								infowindow.setContent(content_string);
								if('' != info_window_size) {
									var width_val = parseInt(info_window_size);
									var InfoWindowOptions = {
										maxWidth: width_val
									};
									infowindow.setOptions({
										options: InfoWindowOptions
									});
								}

                                if(!infoWindow_opened) {
                                       infowindow.open(map, marker);   
                                }
                               
                                	
							};   
							
						})(marker, i));
					}
				}
			}
			if(locations.length > 1) {
				if('center' == auto_center) {
					// Now fit the map to the newly inclusive bounds.
					map.fitBounds(bounds);
				}
				// Restore the zoom level after the map is done scaling.
				var listener = google.maps.event.addListener(map, "idle", function() {
					map.setZoom(map_options.zoom);
					google.maps.event.removeListener(listener);
				});
			}
		})();
	};

	/**
	 * Menu Style.
	 *
	 */
	var jws_menu_style = function($scope, $) {
		if('undefined' == typeof $scope) {
			return;
		}
		$scope.find('.jws_main_menu').eq(0).each(function() {
			var $this = $(this);
			$(this).find('.elementor-icon-list-item.active').parents('.nav > li').addClass('current-menu-item');
			if($this.closest('.elementor-widget-jws_menu_nav').hasClass('elementor-before-menu-skin-animation-line')) {
				var main = $this.find(".jws_main_menu_inner"),
					curent_item = main.find('> ul > li.current-menu-item , > ul > li.current-menu-ancestor'),
					curent_item_sub = main.find('ul li.current-menu-item , .elementor-icon-list-item.active');
				if(main.find('> ul > li.current-menu-item').length == 0) {
					if(curent_item_sub.length > 0) {
						curent_item = curent_item_sub.parents('.nav > li');
					} else {
						curent_item = main.find('> ul > li:first-child');
					}
				}
			}
			/** Menu toggle **/
			$this.find('.click-show-menu-v').on('click', function() {
				$this.find('.menu-toggle').toggleClass('open');
			});
		});
        //mega menu  
        var mainMenu = $('.elementor_jws_menu_layout_menu_horizontal').find('.nav');
        var mega_item = mainMenu.find(' > li.menu-item-design-mega_menu_full_width');
        
        if (mega_item.length > 0) {
            $('.jws_header').addClass('has-mega-full');
        }

        mega_item.mouseenter(function() {
            $('.jws_header.has-mega-full').addClass('mega-has-hover');
        });

        mega_item.mouseleave(function() {
            $('.jws_header.has-mega-full').removeClass('mega-has-hover');
        });
        
	};

	var tooltip = function($scope, $) {
		$scope.find('.jws-tooltip-list').eq(0).each(function() {
			$(this).find('button').on("click", function() {
				var item = $(this).parents('li');
				item.toggleClass('active').siblings().removeClass('active');
			});
		});
	};
	var instagram = function($scope, $) {
		$scope.find('.jws-instagram').eq(0).each(function() {
		    var $this = $(this); 
            var height_start =  $this.find('.jws-instagram-item.col-xl-4').height();
            $this.find('.instagram-wap').css('height',height_start);
			if($(this).hasClass('metro')){
            setTimeout(function() {
                $this.find('.loader').remove();
                 $this.find('.instagram-wap').removeClass('loading').isotope({
					itemSelector: ".jws-instagram-item",
					layoutMode: 'masonry',
					transitionDuration: "0.3s",
					masonry: {
						// use outer width of grid-sizer for columnWidth
						columnWidth: '.grid-sizer',
					}
				}); 
            }, 2000);       
            }
		});
	};
    
    
    var syncPosition = function(el,thumbnail_nav) {
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - el.item.count / 2 - 0.5);
                
                var clone_lenght = el.relatedTarget._clones.length;                
            
                if (current < 0) {
                  current = count;
                }
                if (current > count) {
                  current = 0;
                }
           
                var change_nav = thumbnail_nav
                  .find(".owl-item").not( ".cloned" ).find('.slider-item[data-index="'+current+'"]');
                  var change = change_nav.parent().index();
               
                //to this
                thumbnail_nav
                  .find(".owl-item")
                  .removeClass("current")
                  .eq(change)
                  .addClass("current");
                
                var end = thumbnail_nav
                .find(".owl-item.active")
                .last()
                .index();
         
                if (change > end) {
                   thumbnail_nav.data("owl.carousel").to(change  - 1, 100, true);
                }else {
                   thumbnail_nav.data("owl.carousel").to(change, 100, true);
                }
               
    };
    
    var slider_elementor =  function($scope, $) {
         var $events,
            prev_side,
            current_side,
            current,
            current_index,
            current_side_item;
  
             $scope.find('.jws_slider_element').eq(0).each(function() {
                var $container = $(this).find('.jws_slider');  
                var $this = $(this);
                var verticalSwiping = false;
                var window_offset = 0;
                var thumbnail_nav =  $container.next('.thumbnail-nav');
       
            
            
            
              $container.on("initialized.owl.carousel", function(event) {
                   current = event.item.index;
                   current_side_item = $this.find('.owl-item').eq(current);
                   current_side = current_side_item.find('.slider-item');
                   current_index = current_side.data('index') + 1;
                   $this.find(".jws-button-prev").text(parseInt(current_index));
                   $this.find(".jws-button-next").text(parseInt(current_index + 1));
                   $this.find(".jws-nav-pre span").css('width',parseInt(current_index) / event.item.count * 100+'%');
                    
                   current_side_item.prev().removeClass('nextdiv').addClass('prevdiv');
                   current_side_item.next().removeClass('prevdiv').addClass('nextdiv');
              }); 
            
               
               jwsThemeModule.owl_caousel_init($container);
               
               $container.on('translate.owl.carousel', function(event) {
                
               current = event.item.index;
               current_side_item = $this.find('.owl-item').eq(current);
               current_side = current_side_item.find('.slider-item');
               current_index = current_side.data('index') + 1;
                
               $events = 'no';
               section_change(current_side,$events);
  
               current_side_item.prev().removeClass('nextdiv').addClass('prevdiv');
               current_side_item.next().removeClass('prevdiv').addClass('nextdiv');
               
                
               $this.find(".jws-button-prev").text(current_index);
               console.log(parseInt(current));
               console.log(event.item.count);
               if(parseInt(current_index + 1) > event.item.count) {
                   $this.find(".jws-button-next").text(current_index); 
               }else{
                   $this.find(".jws-button-next").text(parseInt(current_index + 1));
               }
               $this.find(".jws-nav-pre span").css('width',parseInt(current_index) / event.item.count * 100+'%');
               });
               
               
               $container.on('translated.owl.carousel', function(event) {
                   
               current = event.item.index;
               current_side = $this.find('.owl-item').eq(current).find('.slider-item'); 
                
     
               $events = 'next';
               section_change(current_side,$events);
             
      
                   
               });

              $this.find(".jws-button-next").click(function() {
                $container.trigger('next.owl.carousel');
              });
              $this.find(".jws-button-prev").click(function() {
                $container.trigger('prev.owl.carousel');
              });  
                
              if(thumbnail_nav.length) {
       
                    $container.on('changed.owl.carousel', function(event) {
                        syncPosition(event , thumbnail_nav);
                    });
                    
                    var options_nav = thumbnail_nav.data('owl-option'); 
                    thumbnail_nav.on("initialized.owl.carousel", function() {
                        thumbnail_nav
                          .find(".owl-item")
                          .eq(0)
                          .addClass("current");
                    });
                    thumbnail_nav.owlCarousel(options_nav);
              
                    
                   thumbnail_nav.on("click", ".owl-item", function(e){
                     e.preventDefault();
                    var number = $(this).find('.slider-item').data('index');
                    var clone = $container.find('.cloned').length;
                    var change_nav = $container.find('.owl-item').not( ".cloned" ).find('.slider-item[data-index="'+number+'"]');
                    $container.trigger("to.owl.carousel", change_nav.parent().index() - clone / 2 )
       
                    
                  });
            }

    		}); 
            function section_change($slick,$events) {
                $slick.find('[data-element_type="widget"] , [data-element_type="section"] > [data-element_type="section"] , [data-element_type="column"]').each(function() { 
                	var data = $(this).data('settings');
                    var $this = $(this);
                    var $animation;
                    var $animation_delay;
                    if(data !== undefined ) {

                    if($this.hasClass('elementor-section') || $this.hasClass('elementor-column')) {
                        $animation = data.animation;
                        $animation_delay = data.animation_delay;
                    }else {
                        $animation = data._animation
                        $animation_delay = data._animation_delay;
                    }
            
                    if($animation !== undefined) {
                        $this.addClass('has_animated'); 
                    }
                    if($animation_delay !== undefined) {
                        
                       if($events == 'next') {
                        setTimeout(function(){
                           $this.addClass('animated');
                          $this.addClass($animation);
                       },$animation_delay);  ;   
                       }else {
                             $this.removeClass('animated');
                             $this.removeClass($animation);
                       } 
                    }else if(data !== undefined) {
                       if($events == 'next') {
                        setTimeout(function(){
                           $this.addClass('animated');
                          $this.addClass($animation);
                       },0);  
                       }else {
                             $this.removeClass('animated');
                             $this.removeClass($animation);
                       }  
                    }
                     }
            	});
               
            }
         
    };
    

    
    var countdown = function($scope, $) {
		$scope.find('.countdown-container').eq(0).each(function() {
	           var $coundown = $(this).find('.countdown');
               $().jws_countdown($coundown);
		});
	};
    
    var category_list = function($scope, $) {
     
	   	$scope.find('.jws-category-list').eq(0).each(function() {
                jwsThemeModule.owl_caousel_init($(this).find('.jws-slider'));
		});
	};

    
 
	$(window).on('elementor/frontend/init', function() {

    
    elementorFrontend.hooks.addAction('refresh_page_css', function (css) {
        var $obj = $('style#jws_elementor_custom_css');
        if (!$obj.length) {
            $obj = $('<style id="jws_elementor_custom_css"></style>').appendTo('head');
        }
        css = css.replace('/<script.*?\/script>/s', '');
        $obj.html(css).appendTo('head');
    });

	   var widgets = {
			'jws_video_popup.default': video_popup,
			'jws_testimonial_slider.default': testimonials_slider,
			'jws_blog.default': [blogLoadMore, blog_filter],
			'jws_tab.default': jws_tabs,
			'jws_map.default': WidgetjwsGoogleMapHandler,
			'jws_team.default': [team_slider],
			'jws_menu_nav.default': jws_menu_style,
			'jws_gallery.default': jws_gallery,
			'jws_demo.default': [demo_filter],
			'jws-product-advanced.default': [product_tabs_filter],
			'tooltip.default': tooltip,
			'jws_instagram.default': instagram,
            'jws_slider.default': slider_elementor,  
            'jws-category-list.default': category_list, 
            'jws_widget_countdown.default': countdown,
            'jws_dropdown_text.default': jws_dropdown_text,
            'jws_image_carousel.default': images_carousel,

		};
        
		$.each(widgets, function(widget, callback) {
			if('object' === typeof callback) {
				$.each(callback, function(index, cb) {
					elementorFrontend.hooks.addAction('frontend/element_ready/' + widget, cb);
				});
			} else {
				elementorFrontend.hooks.addAction('frontend/element_ready/' + widget, callback);
			}
		});
	});
  
 
    
})(jQuery);