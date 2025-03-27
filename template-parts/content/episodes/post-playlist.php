<?php 

$args = wp_parse_args( $args, array(
   'playlist' => $_GET['playlist'],
   'current_id'=>$id
) );

extract( $args );

$term = get_term( $playlist , 'episodes_playlist' );

$image_size = jws_theme_get_option('tv_shows_imagesize');  

$user_id = get_current_user_id();
$video_progress_data = get_user_meta($user_id, 'video_progress_data',true);


if(isset($term)) :

$status = get_term_meta( $playlist , 'status', true);
$thumbnail = get_term_meta( $playlist, 'playlist_image', true);
$count = $term->count;
$url = get_term_link( $term, $term->taxonomy );
$post_ids = get_term_meta($playlist, 'playlist_order', true); 
?>

<div class="playlist-list version_2">

        <?php 
        
          $args = wp_parse_args( $args, array(
                'post_type'         =>  'episodes',
                'post_status'       =>  array( 'publish' ),
                'posts_per_page'    =>  -1,
                'post__in'  => $post_ids, 
                'orderby'   => 'post__in', 
                'order'             =>  'ASC',
                 'fields'          => 'ids', // Only get post IDs
                'tax_query'         =>  array(
                    array(
                        'taxonomy'  =>  $term->taxonomy,
                        'field'     =>  'term_id',
                        'terms'     =>  $playlist
                    )
                )
            ) );
            
            $episodes = get_posts( $args );

          
                ?>
                <div class="playlist-header">
                    <h5><?php echo esc_html($term->name); ?></h5>
                    <div class="playlist-meta">
                        <?php 
                            $icon_class = $status == 'private' ? 'jws-icon-lock-key-fill' : 'jws-icon-globe-hemisphere-west-fill';
                            echo '<span><i class="'.$icon_class.'"></i>'.$status.'</span>';
                            printf( _n( '<span>%s episodes</span>', '<span>%s episodes</span>', $count , 'streamvid' ), number_format_i18n( $count ) );
                        ?>
                    </div>
                </div>
                   <div class="jws-episodes_advanced-element">
            <div class="episodes-content layout4 jws-scrollbar">
                <?php 
                    foreach($episodes as $episodes_value) {
                       $active = ($episodes_value == $current_id)  ? ' active' : ''; 
                       $link = get_the_permalink($episodes_value); 
                       if(isset($_GET['version'])) {
                         $link .= '?version=v2'; 
                       }
                      if(!empty($playlist)) { $link = add_query_arg( 'playlist', $playlist , $link ); }
                       ?>
                       
                        
                        <div id="episodes-item-<?php echo esc_attr($episodes_value); ?>" class="jws-pisodes_advanced-item<?php echo esc_attr($active); ?>">
                        
                        
                       <?php 
                       
                       $number = get_post_meta($episodes_value , 'episodes_number' , true);
                       $time = get_post_meta($episodes_value , 'episodes_time' , true);
                       
                       
                        ?>
                        <div class="post-inner">
                            <a href="<?php echo esc_attr($link); ?>">
                                    <div class="post-media">
                                        
                                            <?php 
                                                $attach_id = get_post_thumbnail_id($episodes_value);
                                                $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
                                                echo !empty($image) ? $image : '';
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
                                        <span class="episodes-number"><?php echo esc_attr($number); ?></span>
                                        <h6><?php echo get_the_title($episodes_value); ?></h6>
                                    </div>
                            </a>        
                        </div>
                        
                        
                        </div>
                       
                       
                       <?php 
                    }
                 ?>
            </div>
        </div>
 </div>
<?php endif; ?>