<?php 
$args = wp_parse_args( $args , array(
    'id'    =>  0,
    'history' => array()
) );

extract( $args );

$imdb = get_post_meta($id , 'videos_imdb' , true);
$video_time = get_post_meta($id , 'time' , true);
$years = get_post_meta($id , 'videos_years' , true);
$time = get_post_meta($id , 'videos_time' , true);
$badge = get_post_meta($id , 'videos_badge' , true);
$trailer_type = get_post_meta($id , 'videos_trailer_type' , true);
$url = '';
if($trailer_type == 'url') {
    $url =  get_post_meta($id , 'videos_trailer_url' , true);
} else {
    $video_id =  get_post_meta($id , 'videos_trailer_file' , true);
    $url = wp_get_attachment_url($video_id);
}

$background_banner = get_post_meta( $id , 'featured_image_two', true );  

$attach_id = get_post_thumbnail_id($id);
$watchlisted = jws_watchlist_check($id);
if(!empty($background_banner)) {
  $attach_id = $background_banner;
}
?>
<div class="post-inner hover-video">
    <input type="checkbox" name="watchlisted[]" value="<?php echo esc_attr($id); ?>" />
    <div class="post-media" data-trailer="<?php echo esc_attr($url); ?>">
        <?php     
      
            $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => 'full'));
            echo !empty($image) ? $image : '';
	  
               
        ?>
        <?php if(isset($history['time']) && !empty($history['time']) && !empty($history['endtime'])) {
            
            $time = !empty($history['time']) ? $history['time'] / $history['endtime'] * 100 : 0;
         
          ?>
          <div class="time-data">
               <span style="width:<?php echo esc_attr($time) ?>%;" class=""></span>
                   <?php 
 
                   ?>
            </div>
        <?php } ?>
 
    </div>
    <div class="videos-content">
        <h6 class="title">
           <?php  
           
           if(isset($history['episodes'])) { 
             
             ?>
               
               <a href="<?php echo get_the_permalink($history['episodes']); ?>">
                     <?php echo get_the_title($history['episodes']); ?>
               </a>
             
             <?php
            
           } else {
              
              ?>
                
               <a href="<?php echo get_the_permalink($id); ?>">
                     <?php echo get_the_title($id); ?>
               </a>
              
              <?php
            
           }
           
           ?>
           
        </h6>
        
        <?php
          
          if(isset($history['episodes'])) {
            
            $seasion = jws_episodes_check_season( array('id_tv' => $id , 'id' => $history['episodes']) );
          
             printf(
                 __('Seasion','streamvid').' %s - %s',
                 $seasion,
                 get_the_title($history['episodes'])
                  
             );
            ?>
             
             <div>
               
            
            
            </div>
            
            <?php
            
          }
        
         ?>
        

    </div>
    <div class="popup-detail">
    
     <h6 class="title">
           <?php  
           
           if(isset($history['episodes'])) { 
             
             ?>
               
               <a href="<?php echo get_the_permalink($history['episodes']); ?>">
                     <?php echo get_the_title($history['episodes']); ?>
               </a>
             
             <?php
            
           } else {
              
              ?>
                
               <a href="<?php echo get_the_permalink($id); ?>">
                     <?php echo get_the_title($id); ?>
               </a>
              
              <?php
            
           }
           
           ?>
           
        </h6>
            <div class="video-meta mr_b_20">
            <?php 
                echo !empty($years) ? '<div class="video-years">'.$years.'</div>' : '';
                echo !empty($video_time) ? '<div class="video-time">'.$video_time.'</div>' : '';
                echo !empty($badge) ? '<div class="video-badge">'.$badge.'</div>' : '';
                echo !empty($imdb) ? '<div class="video-imdb">'.$imdb.'</div>' : '';
                
            ?>
        </div>
      <div class="video-play">
            <a class="btn-main button-default" href="<?php echo get_the_permalink($id); ?>">
                <?php echo esc_html__('Play Now','streamvid'); ?>
                <i class="jws-icon-play-circle"></i>
            </a>
            <a class="btn-main button-custom watchlist-add<?php if(!empty($watchlisted)) echo esc_attr($watchlisted); ?>" href="<?php echo get_the_permalink(); ?>" data-post-id="<?php echo esc_attr($id); ?>">
                <span class="added"><?php echo esc_html__('Watchlisted','streamvid'); ?></span>
                <span><?php echo esc_html__('Watchlist','streamvid'); ?></span>
                <i class="jws-icon-bookmark-simple"></i>
            </a>
         
        </div>
    </div>
</div>