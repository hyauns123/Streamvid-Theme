<?php 
$id = get_the_ID();
$imdb = get_post_meta($id , 'videos_imdb' , true);
$years = get_post_meta($id , 'videos_years' , true);
$time = get_post_meta($id , 'videos_time' , true);
$badge = get_post_meta($id , 'videos_badge' , true);
$watchlisted = jws_watchlist_check($id);
$args = wp_parse_args( $args, array(
    'image_size'   =>  'full',
    'img_two' => true
) );
extract( $args );

$trailer_type = get_post_meta($id , 'videos_trailer_type' , true);

if($trailer_type == 'url') {
    $url =  get_post_meta($id , 'videos_trailer_url' , true);
} else {
    $video_id =  get_post_meta($id , 'videos_trailer_file' , true);
    $url = wp_get_attachment_url($video_id);
}

?>

<div class="post-inner hover-video popup-v2">
   
    <div class="post-media" data-trailer="<?php echo esc_attr($url); ?>">
        <a href="<?php echo get_the_permalink(); ?>">
        <?php 
                 
           do_action('streamvid_post_videos_media',$args);
	
        ?>
        </a>
        
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
                echo !empty($time) ? '<div class="video-time">'.$time.'</div>' : '';
                echo !empty($badge) ? '<div class="video-badge">'.$badge.'</div>' : '';
            ?>
        </div>
        <div class="video-cat">
            <?php echo jws_get_cat_list('movies_cat',' ',$id); ?>
        </div>
        <div class="video-play">
            <a class="btn-main button-default" href="<?php echo get_the_permalink($id); ?>">
                <i class="jws-icon-play-fill"></i>
                <?php echo esc_html__('Play Now','streamvid'); ?>
            </a>
             <?php  if(jws_streamvid_options('videos_watchlist')) : ?>
            <a class="btn-main button-custom watchlist-add<?php if(!empty($watchlisted)) echo esc_attr($watchlisted); ?>" href="<?php echo get_the_permalink(); ?>" data-post-id="<?php echo esc_attr($id); ?>">
                 <i class="jws-icon-plus"></i>
                <span class="added"><?php echo esc_html__('Watchlisted','streamvid'); ?></span>
                <span><?php echo esc_html__('Watch Later','streamvid'); ?></span>
            </a>
            <?php endif; ?>
            <a class="btn-main button-custom jws-popup-detail" href="<?php echo get_the_permalink(); ?>" data-post-id="<?php echo esc_attr($id); ?>"><i class="jws-icon-info-light"></i></a>
        </div>
    </div>
</div>