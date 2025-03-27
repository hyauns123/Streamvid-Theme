<?php 
$id = get_the_ID();
$args = array();
$args = wp_parse_args( $args, array(
    'image_size'   =>  'thumbnail',
    'img_two' => true
) );
extract( $args );


?>

<div class="post-inner">
   
    <div class="post-media">
       
        <?php 
                 
           do_action('streamvid_post_videos_media',$args);
	
        ?>
      
      <?php  if(isset($video_progress_data[$id]['time']) && !empty($video_progress_data[$id]['time'])) {

		$time = $video_progress_data[$id]['time'] / $video_progress_data[$id]['endtime'] * 100;

	  ?>
	  <div class="time-data">
		   <span style="width:<?php echo esc_attr($time) ?>%;" class=""></span>
			   <?php 

			   ?>
		</div>
	<?php } ?>
    </div>
</div>