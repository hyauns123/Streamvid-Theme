<?php 


$tv_shows_seasons = get_field('tv_shows_seasons',$args['tv_shows']);
$seasion = ($args['season'] - 1);
if(isset($tv_shows_seasons[$seasion]['episodes']) && !empty($tv_shows_seasons[$seasion]['episodes'])) : 

$episodes = $tv_shows_seasons[$seasion]['episodes'];

$image_size = jws_theme_get_option('tv_shows_imagesize');  

$user_id = get_current_user_id();
$video_progress_data = get_user_meta($user_id, 'video_progress_data',true);
$post_id = get_the_ID();

$episodes_view = jws_theme_get_option('episodes-list-view');
if(isset($_GET['episodes_view'])) {$episodes_view = $_GET['episodes_view'];}

if($episodes_view == 'list_number') {
    $show_nav = true;
    $active = 'list';
} elseif($episodes_view == 'number_list') {
    $show_nav = true;
    $active = 'grid';
} elseif($episodes_view == 'number') {
    $show_nav = false;
    $active = 'grid';
} else {
   $show_nav = false; 
   $active = 'list';
}

?>    
<div class="sidebar-list <?php echo esc_attr($active); ?>">
<div class="tv-shows-info">
    <h5><a target="_blank" href="<?php echo get_the_permalink($args['tv_shows']); ?>"><?php echo get_the_title($args['tv_shows']); ?></a></h5>
    <div class="jws-list-top">
    
        <div class="total-number">
          <?php 
          
          if(!empty($episodes)) {
            
             echo esc_html__('Episodes','streamvid').' 1-'.count($episodes);
            
          } else {
            
             echo esc_html__('Episodes','streamvid').' 0';
          }
          
         ?>
        </div>
        <?php if($show_nav) : ?>
            <a href="javascript:void(0)" class="change-layout"></a>
        <?php endif; ?>
    </div>
</div>
<div class="jws-episodes_advanced-element layout-list">
    <div class="episodes-content layout4 jws-scrollbar">
        <?php 
            $number = 1;
            foreach($episodes as $episodes_value) {
               $active = ($episodes_value == $post_id)  ? ' active' : ''; 
               $link = get_the_permalink($episodes_value); 
               if(isset($_GET['version'])) {
                 $link .= '?version=v2'; 
               }
               
                $pmpro_id = $episodes_value;
        
                $pmpro_id = function_exists('jws_check_episodes_membership_access') ? jws_check_episodes_membership_access($pmpro_id) : $episodes_value;
               ?>
               
                
               <div id="episodes-item-<?php echo esc_attr($episodes_value); ?>" class="jws-pisodes_advanced-item<?php echo esc_attr($active); ?>">
                
                
               <?php 
               
               $number_ep = get_post_meta($episodes_value , 'episodes_number' , true);
               $time = get_post_meta($episodes_value , 'episodes_time' , true);
               
               
                ?>
                <div class="post-inner">
                    <a href="<?php echo esc_attr($link); ?>">
                            <div class="post-media">
                                
                                    <?php 
                                        $attach_id = get_post_thumbnail_id($episodes_value);
                                        $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
                                        echo !empty($image) ? $image : '';
                                        if(function_exists('pmpro_has_membership_access') && !pmpro_has_membership_access( $pmpro_id, get_current_user_id() ))  { 
                            
                                            echo '<span class="jws-vip">'.esc_html('VIP','streamvid').'</span>';
                                            
                                        } 
                                         ?>
                              
                                <?php echo !empty($time) ? '<span class="time"><i class="jws-icon-play-circle"></i>'.$time.'</span>' : ''; ?>
                                <?php  if(isset($video_progress_data[$episodes_value]['time']) && !empty($video_progress_data[$episodes_value]['time'])) {
    
                    				$time = $video_progress_data[$episodes_value]['time'] / $video_progress_data[$episodes_value]['endtime'] * 100;
                    
                    			  ?>
                    			  <div class="time-data">
                    				   <span style="width:<?php echo esc_attr($time) ?>%;" class=""></span>
                    					   <?php 
                    
                    					   ?>
                    				</div>
                    			<?php } ?>
                            </div>
                            
                            <div class="episodes-info">
                                <span class="episodes-number"><?php echo esc_attr($number_ep); ?></span>
                                <h6><?php echo get_the_title($episodes_value); ?></h6>
                            </div>
                    </a>        
                </div>
                <div class="number-item">
                    <a href="<?php echo esc_attr($link); ?>"> 
                        <?php echo esc_attr($number); ?>  
                        <?php 
                       
                        
                        
                        if(function_exists('pmpro_has_membership_access') && !pmpro_has_membership_access( $pmpro_id, get_current_user_id() ))  { 
                            
                            echo '<span class="jws-vip">'.esc_html('VIP','streamvid').'</span>';
                            
                        } ?>
                    </a>        
                </div>
                
                </div>
               
               
               <?php  $number++;
            }
         ?>
    </div>
</div>
<?php  endif; ?>
</div>  