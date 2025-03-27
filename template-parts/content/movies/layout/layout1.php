<?php 
$id = get_the_ID();
$imdb = get_post_meta($id , 'videos_imdb' , true);
$years = get_post_meta($id , 'videos_years' , true);
$time = get_post_meta($id , 'videos_time' , true);
$badge = get_post_meta($id , 'videos_badge' , true);
$watchlisted = jws_watchlist_check($id);
$args = wp_parse_args( $args, array(
    'image_size'   =>  'full',
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

<div class="post-inner">
  
    <div class="post-media" data-trailer="<?php echo esc_attr($url); ?>">
        <a href="<?php echo get_the_permalink(); ?>">
        <?php 
                 
           do_action('streamvid_post_videos_media',$args);
	
        ?>
        </a>
        <div class="media-play">
            <a href="<?php echo get_the_permalink(); ?>">
                <i class="jws-icon-play-circle"></i>
            </a>
        </div>
        <?php  if(jws_streamvid_options('videos_watchlist')) : ?>
        <a class="btn-right watchlist-add<?php if(!empty($watchlisted)) echo esc_attr($watchlisted); ?>" href="<?php echo get_the_permalink(); ?>" data-post-id="<?php echo esc_attr($id); ?>">
            <span class="added"><?php echo esc_html__('Added to My List','streamvid'); ?></span>
            <span><?php echo esc_html__('Add to My List','streamvid'); ?></span>
        </a>
        <?php endif; ?>
    </div>
    <div class="movies-content">
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
    </div>
</div>