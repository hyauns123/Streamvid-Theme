<?php 


$tv_shows_seasons = get_field('tv_shows_seasons');

$display = jws_theme_get_option('select-layout-episodes-bottom');  
if(isset($_GET['episodes_grid'])) $display = 'grid';

if(isset($tv_shows_seasons[0]['episodes']) && !empty($tv_shows_seasons[0]['episodes'])) : 

$episodes = $tv_shows_seasons[0]['episodes'];

$image_size = jws_theme_get_option('tv_shows_imagesize'); 


        $data_slick = 'data-owl-option=\'{
        "autoplay":false,
        "nav":true, 
        "loop":false,
        "dots":false, 
        "autoWidth":true,
        "smartSpeed":500, 
        "responsive":{
            "1024":{"items":1,"slideBy":1},
            "768":{"items":1,"slideBy":1},
            "0":{"items":1,"slideBy":1}
        }}\''; 
 
 $class = "episodes-content layout3 clear-both";
$column = "jws-pisodes_advanced-item";
if($display == 'grid') {
  $class .= " row layout-grid";  
  $column .= " col-xl-2 col-lg-3 col-6";   
} else {
  $class .= " jws-pisodes_advanced-slider owl-carousel"; 
  $column .= " slider-item"; 
}       
        
        
        ?>
        <div class="jws-episodes_advanced-element global-episodes">
        
        <?php
          
          if(isset($args['episodes'])) {
            
            ?>
            
            <div class="jws-episodes-heading clear-both">
            
            <h6 class="heading"><?php echo esc_html__('Episodes','streamvid'); ?></h6>
            <?php 
             
               $episodes_slug = jws_streamvid_options('episodes_slug');   
               $episodes_slug = !empty($episodes_slug) ? $episodes_slug : 'episodes';
            
            ?>
            <a class="jws-view-episodes" href="<?php echo trailingslashit( get_the_permalink() ) . $episodes_slug; ?>"><?php echo esc_html__('All Episodes','streamvid'); ?><i class="jws-icon-caret-right"></i></a>
            
            </div>
            
            <?php
            
            
          }
         
         ?>
       
        <div class="<?php echo esc_attr($class); ?>" <?php echo ''.$data_slick; ?>>
            <?php 
                foreach($episodes as $episodes_value) {
                   $args = array(
                        'image_size'    =>  $image_size,
                        'post_id' => $episodes_value,
                   );
                   ?>
                   
                    
                    <div class="<?php echo esc_attr($column); ?>">
                    
                    
                   <?php 
                     
                     get_template_part( 'template-parts/content/episodes/layout/layout4' , '' , $args ); 
                  
                    ?>
                 
                    
                    
                    </div>
                   
                   
                   <?php 
                }
             ?>
        </div>
        <div class="jws-nav-carousel">
             <div class="jws-button-prev"><i class="jws-icon-caret-left"></i></div>
             <div class="jws-button-next"><i class="jws-icon-caret-right"></i></div>
        </div>
        </div>
<?php else:

  
  echo esc_html__('Not found.','streamvid');



  endif; ?>