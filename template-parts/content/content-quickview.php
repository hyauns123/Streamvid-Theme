<?php
$id = get_the_ID();
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
jws_streamvid_load_template("tool/share/share.php", false); 
wp_enqueue_script( 'jws-single-tv-shows');
          
?>
<div class="close-overlay"></div>

<div id="jws-videos-detail" class="single-movies single-tv_shows">
<button class="close-button" type="button"><i class="jws-icon-x"></i></button>
<div class="video-player">
    <div class="post-media" data-trailer="<?php echo esc_attr($url); ?>">
        <?php     
      
            $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
            echo !empty($image) ? $image : '';
	  
               
        ?>

 
    </div>
    <div class="jws-tool clear-both">
  
      
       <?php if(function_exists('jws_like_button')) jws_like_button('tv_shows',get_the_ID()); ?>
    
   
      <?php if(function_exists('jws_share_button')) jws_share_button(); ?>
      
      <div class="jws-view">

        <?php $view = jws_get_videos_view();  echo sprintf( _n( '<i class="jws-icon-eye"></i> %s View', '<i class="jws-icon-eye"></i> %s Views', $view, 'streamvid' ), $view );  ?>
        
      </div>
    
</div>
</div>
<div class="quicview-content version-v2">
<div class="video-content-holder">
    <div class="row">
        <div class="col-12">
            <div class="video-inner">
                <div class="video-cat">
                    <?php echo jws_get_cat_list('movies_cat',', ', $id); ?>
                </div>
                <h3 class="video_title">
                  <a href="<?php echo get_the_permalink(); ?>">  
                    <?php echo get_the_title(); ?>
                  </a>  
                </h3>
                <div class="video-meta">
                    <?php 
                      
                        echo !empty($imdb) ? '<div class="video-imdb"><i class="fas fa-star"></i>'.$imdb.'</div>' : '';
                        echo !empty($years) ? '<div class="video-years">'.$years.'</div>' : '';
                        echo !empty($time) ? '<div class="video-time">'.$time.'</div>' : '';
                        echo !empty($badge) ? '<div class="video-badge">'.$badge.'</div>' : '';
                    ?>
                </div>
               <?php 
                     get_template_part( 
                      'template-parts/content/movies/post','meta-info2'
                    );
               ?>
               <div class="video-description">
                    <?php  echo  get_the_excerpt(); ?>
               </div>
            
                <div class="video-play">
                    <a class="btn-main button-default btn-left" href="<?php echo get_the_permalink(); ?>"><?php echo esc_html__('Play Now', 'streamvid'); ?>
                    <i class="jws-icon-play-circle"></i>
                    </a>
                    <?php  if(jws_streamvid_options('videos_watchlist')) : ?>
                        <a class="btn-right watchlist-add <?php  if(!empty($watchlisted)) echo esc_attr($watchlisted); ?>" href="<?php echo get_the_permalink(); ?>" data-post-id="<?php echo esc_attr($id); ?>">
                        <?php 
                           
                            echo '<span>'.esc_html__('Watchlist', 'streamvid').'</span>';
                            echo '<span class="added">'.esc_html__('Watchlisted', 'streamvid').'</span>';
                            echo '<i class="jws-icon-bookmark-simple"></i>';
                          
                         ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$post_type = get_post_type($id); 

            
if($post_type == 'movies') {
 get_template_part( 
      'template-parts/content/movies/post','related'
 );   
}elseif($post_type == 'tv_shows') {
 get_template_part( 
       'template-parts/content/tv_shows/post','seasion'
 );
 get_template_part( 
	    'template-parts/content/tv_shows/post','episodes'
);
 get_template_part( 
      'template-parts/content/tv_shows/post','related'
 );   
}

          


?>
</div>
</div>
<?php
     