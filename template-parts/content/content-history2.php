<?php 
$args = wp_parse_args( $args , array(
    'id'    =>  0,
    'history' => array(),
    'image_size'   =>  'full',
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

<div class="post-inner hover-video popup-v2">
   
    <div class="post-media" data-trailer="<?php echo esc_attr($url); ?>">
        <a href="<?php echo get_the_permalink($id); ?>">
        <?php 
        
            $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
            echo !empty($image) ? $image : '';
	  
             
        ?>
        </a>
        <?php if(isset($history['time']) && !empty($history['time']) && !empty($history['endtime'])) {
            
            $time_history = !empty($history['time']) ? $history['time'] / $history['endtime'] * 100 : 0;
         
          ?>
          <div class="time-data">
               <span style="width:<?php echo esc_attr($time_history) ?>%;" class=""></span>
                   <?php 
 
                   ?>
            </div>
        <?php } ?>
    </div>
    <div class="popup-detail">
        <h6 class="video_title">
           <a href="<?php echo get_the_permalink($id); ?>">
                 <?php echo get_the_title($id); ?>
           </a> 
        </h6>
 
        <div class="video-meta">
            <?php 
                echo !empty($years) ? '<div class="video-years">'.$years.'</div>' : '';
                echo !empty($time) ? '<div class="video-time">'.$time.'</div>' : '';
                echo !empty($badge) ? '<div class="video-badge">'.$badge.'</div>' : '';
            ?>
        </div>
        <div class="video-play">
            <a class="btn-main button-default" href="<?php echo get_the_permalink($id); ?>">
                <i class="jws-icon-play-fill"></i>
                <?php echo esc_html__('Play Now','streamvid'); ?>
            </a>
             <?php  if(jws_streamvid_options('videos_watchlist')) : ?>
            <a class="btn-main button-custom watchlist-add<?php if(!empty($watchlisted)) echo esc_attr($watchlisted); ?>" href="<?php echo get_the_permalink($id); ?>" data-post-id="<?php echo esc_attr($id); ?>">
                 <i class="jws-icon-plus"></i>
                <span class="added"><?php echo esc_html__('Watchlisted','streamvid'); ?></span>
                <span><?php echo esc_html__('Watch Later','streamvid'); ?></span>
            </a>
            <?php endif; ?>
            <a class="btn-main button-custom jws-popup-detail" href="<?php echo get_the_permalink($id); ?>" data-post-id="<?php echo esc_attr($id); ?>"><i class="jws-icon-info-light"></i></a>
        </div>
    </div>
</div>
