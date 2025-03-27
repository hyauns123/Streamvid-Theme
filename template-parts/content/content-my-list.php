<?php 
$args = wp_parse_args( $args , array(
    'id'    =>  0,
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

    <div class="post-media" data-trailer="<?php echo esc_attr($url); ?>">
       <a href="<?php echo get_the_permalink($id); ?>">
        <?php     
           
            $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $args['image_size']));
            echo !empty($image) ? $image : '';
	        
            if(!empty($video_time)) {
                echo '<span class="time"><i class="jws-icon-play-circle"></i>'.$video_time.'</span>';
            }
               
        ?>
        </a> 
    </div>
    <div class="videos-content">
        <h6 class="title">
           <a href="<?php echo get_the_permalink($id); ?>">
                 <?php echo get_the_title($id); ?>
           </a> 
        </h6>
        <div class="videos-meta">
                <span class="view">
                    <?php  printf( _n( '%s view', '%s views', jws_get_videos_view($args) , 'streamvid' ), jws_get_videos_view($args) ); ?> 
                </span>
                <span class="time">
                    <?php echo jws_videos_time_ago_function($args); ?>
                </span>
            </div>
    </div>
    <div class="popup-detail">
      
      <h6 class="title">
           <a href="<?php echo get_the_permalink($id); ?>">
                 <?php echo get_the_title($id); ?>
           </a> 
        </h6>
      <div class="video-meta mr_b_20">
            <?php 
                echo !empty($years) ? '<div class="video-years">'.$years.'</div>' : '';
                echo !empty($time) ? '<div class="video-time">'.$time.'</div>' : '';
                echo !empty($badge) ? '<div class="video-badge">'.$badge.'</div>' : '';
                echo !empty($imdb) ? '<div class="video-imdb">'.$imdb.'</div>' : '';
                
            ?>
        </div>
      <div class="video-play">
            <a class="btn-main button-default jws-popup-detail" href="<?php echo get_the_permalink($id); ?>" data-post-id="<?php echo esc_attr($id); ?>">
                <span><?php echo esc_html__('View Detail','streamvid'); ?></span>
                <i class="jws-icon-info-light"></i>
            </a>
            <a class="btn-main button-custom watchlist-add<?php if(!empty($watchlisted)) echo esc_attr($watchlisted); ?>" href="<?php echo get_the_permalink(); ?>" data-post-id="<?php echo esc_attr($id); ?>">
                <span class="added"><?php echo esc_html__('Watchlisted','streamvid'); ?></span>
                <span><?php echo esc_html__('Watchlist','streamvid'); ?></span>
                <i class="jws-icon-bookmark-simple"></i>
            </a>
         
        </div>
        
    
    </div>
</div>