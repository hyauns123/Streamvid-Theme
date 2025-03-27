<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage streamvid
 * @since 1.0.0
 */

get_header();
global $jws_option; 
$version = isset($_GET['version']) ? $_GET['version'] : $jws_option['select-layout-tv_shows'];
$episodes_slug = jws_streamvid_options('episodes_slug');
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main <?php echo esc_attr('version-'.$version); ?>">
         
            <div class="container-full">
                <?php 
                   if( have_posts() ): the_post();
                        global $wp_query;
                       
                        if ( isset( $wp_query->query_vars[!empty($episodes_slug) ? $episodes_slug : 'episodes'] ) ) {
                            get_template_part( 
                              'template-parts/content/tv_shows/post','episodes-all'
                            );
                        } else {
                            
                           get_template_part( 
        	                		'template-parts/content/tv_shows/single/content-single',$version
        	               ); 
                           
                           jws_gt_set_videos_view();
                           
                        }
   
                       

                       
                   endif;
    			?>

           </div>      
          
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();