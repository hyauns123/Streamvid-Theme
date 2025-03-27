<?php 
$id = get_the_ID();
$imdb = get_post_meta($id , 'videos_imdb' , true);
$years = get_post_meta($id , 'videos_years' , true);
$time = get_post_meta($id , 'videos_time' , true);
$badge = get_post_meta($id , 'videos_badge' , true);
$watchlisted = jws_watchlist_check($id);
$args = wp_parse_args( $args, array(
    'image_size'   =>  'full',
    'img_two' => jws_theme_get_option('tv_image2')
) );
extract( $args );

$trailer_type = get_post_meta($id , 'videos_trailer_type' , true);

if($trailer_type == 'url') {
    $url =  get_post_meta($id , 'videos_trailer_url' , true);
    
  
} else {
    $video_id =  get_post_meta($id , 'videos_trailer_file' , true);
    $url = wp_get_attachment_url($video_id);
}
$tv_shows_seasons = get_field('tv_shows_seasons',$id);
?>

<div class="post-inner hover-video">
  
    <div class="post-media" data-trailer="<?php echo esc_attr($url); ?>">
       <a href="<?php echo get_the_permalink(); ?>">
        <?php 
                 
           do_action('streamvid_post_videos_media',$args);
	
        ?>
       </a> 
        
    </div>
   <div class="videos-content">
        <h6 class="video_title">
           <a href="<?php echo get_the_permalink(); ?>">
                 <?php echo get_the_title(); ?>
           </a> 
        </h6>
 
        <div class="video-meta">
            <?php 
                echo !empty($years) ? '<div class="video-years">'.$years.'</div>' : '';
             
                if(!empty($tv_shows_seasons)) {
                   $number = count($tv_shows_seasons);  
                   ?>   
                   <div class="seasions-numer"> <?php  printf( _n( '%s Season', '%s Seasons', $number , 'streamvid' ), number_format_i18n( $number ) ); ?> </div>
                   <?php 
                }
             ?>
            
        </div>
    </div>
    <div class="popup-detail">
        <h6 class="video_title">
           <a href="<?php echo get_the_permalink(); ?>">
                 <?php echo get_the_title(); ?>
           </a> 
        </h6>
 
        <div class="video-meta">
            <?php 
                echo !empty($years) ? '<div class="video-years">'.$years.'</div>' : '';
             
                if(!empty($tv_shows_seasons)) {
                   $number = count($tv_shows_seasons);  
                   ?>   
                   <div class="seasions-numer"> <?php  printf( _n( '%s Season', '%s Seasons', $number , 'streamvid' ), number_format_i18n( $number ) ); ?> </div>
                   <?php 
                }
             ?>
            
        </div>
        <div class="video-cat">
            <?php echo jws_get_cat_list('movies_cat',' ',$id); ?>
        </div>
        <div class="video-play">
           <a class="btn-main button-default jws-popup-detail" href="<?php echo get_the_permalink($id); ?>" data-post-id="<?php echo esc_attr($id); ?>">
                <span><?php echo esc_html__('View Detail','streamvid'); ?></span>
                <i class="jws-icon-info-light"></i>
            </a>
            <a class="btn-main button-custom watchlist-add<?php if(!empty($watchlisted)) echo esc_attr($watchlisted); ?>" href="<?php echo get_the_permalink(); ?>" data-post-id="<?php echo esc_attr($id); ?>">
                <span class="added"><?php echo esc_html__('Added watchlist','streamvid'); ?></span>
                <span><?php echo esc_html__('Watch Later','streamvid'); ?></span>
                <i class="jws-icon-bookmark-simple"></i>
            </a>
        </div>
    </div>
</div>