(function($) {
  'use strict';
  $(document)
    .ready(function() {
        
        $('#_box_points , #_box_points_total').select2();  
        
       
      function variationGallery() {
        $('.jws-variation-gallery-wrapper')
          .each(function() {
            var $this = $(this);
            var $galleryImages = $this.find('.jws-variation-gallery-images');
            var $imageGalleryIds = $this.find('.variation-gallery-ids');
            var galleryFrame;
            $this.on('click', '.jws-add-variation-gallery-image', function(event) {
              event.preventDefault();
              // If the media frame already exists, reopen it.
              if (galleryFrame) {
                galleryFrame.open();
                return;
              }
              // Create the media frame.
              galleryFrame = wp.media.frames.product_gallery = wp.media({
                states: [
                  new wp.media.controller.Library({
                    filterable: 'all',
                    multiple: true
                  })
                ]
              });
              // When an image is selected, run a callback.
              galleryFrame.on('select', function() {
                var selection = galleryFrame.state()
                  .get('selection');
                var attachment_ids = $imageGalleryIds.val();
                selection.map(function(attachment) {
                  attachment = attachment.toJSON();
                  if (attachment.id) {
                    var attachment_image = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
                    attachment_ids = attachment_ids ? attachment_ids + ',' + attachment.id : attachment.id;
                    $galleryImages.append('<li class="image" data-attachment_id="' + attachment.id + '"><img src="' + attachment_image + '"><a href="#" class="delete jws-remove-variation-gallery-image"><span class="dashicons dashicons-dismiss"></span></a></li>');
                    $this.trigger('jws_variation_gallery_image_added');
                  }
                });
                $imageGalleryIds.val(attachment_ids);
                $this.parents('.woocommerce_variation')
                  .eq(0)
                  .addClass('variation-needs-update');
                $('#variable_product_options')
                  .find('input')
                  .eq(0)
                  .change();
              });
              // Finally, open the modal.
              galleryFrame.open();
            });
            // Image ordering.
            if (typeof $galleryImages.sortable !== 'undefined') {
              $galleryImages.sortable({
                items: 'li.image',
                cursor: 'move',
                scrollSensitivity: 40,
                forcePlaceholderSize: true,
                forceHelperSize: false,
                helper: 'clone',
                opacity: 0.65,
                placeholder: 'wc-metabox-sortable-placeholder',
                start: function(event, ui) {
                  ui.item.css('background-color', '#f6f6f6');
                },
                stop: function(event, ui) {
                  ui.item.removeAttr('style');
                },
                update: function() {
                  var attachment_ids = '';
                  $galleryImages.find('li.image')
                    .each(function() {
                      var attachment_id = $(this)
                        .attr('data-attachment_id');
                      attachment_ids = attachment_ids + attachment_id + ',';
                    });
                  $imageGalleryIds.val(attachment_ids);
                  $this.parents('.woocommerce_variation')
                    .eq(0)
                    .addClass('variation-needs-update');
                  $('#variable_product_options')
                    .find('input')
                    .eq(0)
                    .change();
                }
              });
            }
            // Remove images.
            $(document)
              .on('click', '.jws-remove-variation-gallery-image', function(event) {
                event.preventDefault();
                $(this)
                  .parent()
                  .remove();
                var attachment_ids = '';
                $galleryImages.find('li.image')
                  .each(function() {
                    var attachment_id = $(this)
                      .attr('data-attachment_id');
                    attachment_ids = attachment_ids + attachment_id + ',';
                  });
                $imageGalleryIds.val(attachment_ids);
                $this.parents('.woocommerce_variation')
                  .eq(0)
                  .addClass('variation-needs-update');
                $('#variable_product_options')
                  .find('input')
                  .eq(0)
                  .change();
              });
          });
      }
      $('#woocommerce-product-data')
        .on('woocommerce_variations_loaded', function() {
          variationGallery();
        });
      $('#variable_product_options')
        .on('woocommerce_variations_added', function() {
          variationGallery();;
        }); 
        
     
      $('body').on('submit', '#check_purchase_code', function(e) {
        
            e.preventDefault(); 
                 
            var form = $(this);
            var $html;
            var formData = new FormData(this);
             formData.append('action', 'check_purchase_code'); 
             $.ajax({
        			url: jws_script.ajax_url,
        			data: formData,
        			dataType: 'json',
        			method: 'POST',
                    processData: false,
                    contentType: false,
        			success: function(response) {
        	        console.log(response);
                       if(response.success) { 
    
                           location.reload();
                        
                       } else {
                        $html = response.data.error;
                        if($html == '404') {
                            
                            $html = response.data.description;
                        }
                        if($html == '403') {
                            
                            $html = response.data.body;
                        }
                        
                        $('.data-return').html('<span class="error">'+$html+'</span>');
                        
                       }
        			},
        			error: function() {
        				console.log('error');
        			},
        			complete: function() {
        			 
        			},
        	});  
            
        
        });
    
     
        
        
    });
})(jQuery);