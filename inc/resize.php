<?php
/**
* Resizes an image and returns an array containing the resized URL, width, height and file type. Uses native WP functionality.
*
* Because WP 3.5 has added the new 'WP_Image_Editor' class and depreciated some of the functions
* we would normally rely on (such as wp_get_image_editor), a separate function has been created for 3.5+.
*
* Providing two separate functions means we can be backwards compatible and future proof. Hooray!
*
* The first function (3.5+) supports GD Library and Image magic. WP will pick whichever is most appropriate.
* The second function (3.4.2 and lower) only support GD Library.
* If none of the supported libraries are available the function will bail and return the original image.
*
* Both functions produce the exact same results when successful.
* Images are saved to the WP uploads directory, just like images uploaded through the Media Library.
*
* Copyright 2013 Matthew Ruddy (http://easinglider.com)
*
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License, version 2, as
* published by the Free Software Foundation.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*
* @author Matthew Ruddy (http://easinglider.com)
* @return array An array containing the resized image URL, width, height and file type.
*/
if(!function_exists('jws_sv_ct2')) {
 
   function matthewruddy_image_resize( $url, $id , $width = NULL, $height = NULL, $crop = true, $retina = false ) { 
    $image_array = array(
    'url' => $url,

    );
    return $image_array;
   }
   
} else {
   function matthewruddy_image_resize( $url, $id , $width = NULL, $height = NULL, $crop = true, $retina = false ) {
        global $wpdb;
        if ( empty( $url ) )
        //return new WP_Error( 'no_image_url', __( 'No image URL has been entered.', 'streamvid' ), $url );
        // Get default size from database
        $width = ( $width ) ? $width : get_option( 'thumbnail_size_w' );
        $height = ( $height ) ? $height : get_option( 'thumbnail_size_h' );
        // Allow for different retina sizes
        $retina = $retina ? ( $retina === true ? 2 : $retina ) : 1;
        // Get the image file path
        $file_path = parse_url( $url );
        $file_path = (function_exists('jws_sv_ct2')) ? jws_sv_ct2() . $file_path['path'] : '';
        
        // Check for Multisite
        if ( is_multisite() ) {
        global $blog_id;
        $blog_details = get_blog_details( $blog_id );
        $file_path = str_replace( $blog_details->path . 'files/', '/wp-content/blogs.dir/'. $blog_id .'/files/', $file_path );
        }
        // Destination width and height variables
        $dest_width = $width * $retina;
        $dest_height = $height * $retina;
        // File name suffix (appended to original file name)
        $suffix = "{$dest_width}x{$dest_height}";
        // Some additional info about the image
        $info = pathinfo( $file_path );
        
        $dir = $info['dirname'];
        $ext = $info['extension'];
        $name = wp_basename( $file_path, ".$ext" );
        
        if ( 'bmp' == $ext ) {
        return new WP_Error( 'bmp_mime_type', __( 'Image is BMP. Please use either JPG or PNG.', 'streamvid' ), $url );
        }
        
        // Get the destination file name
        $dest_file_name = "{$dir}/{$name}-{$suffix}.{$ext}";
        
        
        
        if ( !file_exists( $dest_file_name ) ) {
            
          
        /*
        * Bail if this image isn't in the Media Library.
        * We only want to resize Media Library images, so we can be sure they get deleted correctly when appropriate.
        */
        
        if ( !$id )
        return array( 'url' => $url, 'width' => $width, 'height' => $height );
        // Load WP Image Editor
        $editor = wp_get_image_editor( $file_path );
        if ( is_wp_error( $editor ) )
        return array( 'url' => $url, 'width' => $width, 'height' => $height );
        
        // Get the original image size
        $size = $editor->get_size();
        $orig_width = $size['width'];
        $orig_height = $size['height'];
        $src_x = $src_y = 0;
        $src_w = $orig_width;
        $src_h = $orig_height;
        if ( $crop ) {
        $cmp_x = $orig_width / $dest_width;
        $cmp_y = $orig_height / $dest_height;
        // Calculate x or y coordinate, and width or height of source
        if ( $cmp_x > $cmp_y ) {
        $src_w = round( $orig_width / $cmp_x * $cmp_y );
        $src_x = round( ( $orig_width - ( $orig_width / $cmp_x * $cmp_y ) ) / 2 );
        }
        else if ( $cmp_y > $cmp_x ) {
        $src_h = round( $orig_height / $cmp_y * $cmp_x );
        $src_y = round( ( $orig_height - ( $orig_height / $cmp_y * $cmp_x ) ) / 2 );
        }
        }
        
        // Time to crop the image!
        $editor->crop( $src_x, $src_y, $src_w, $src_h, $dest_width, $dest_height );
        // Now let's save the image
        $saved = $editor->save( $dest_file_name );
        // Get resized image information
        $resized_url = str_replace( basename( $url ), basename( $saved['path'] ), $url );
        $resized_width = $saved['width'];
        $resized_height = $saved['height'];
        $resized_type = $saved['mime-type'];
        // Add the resized dimensions to original image meta data (so we can delete our resized images when the original image is delete from the Media Library)
        $metadata = wp_get_attachment_metadata( $id );
        if ( isset( $metadata['image_meta'] ) ) {
        $metadata['image_meta']['resized_images'][] = $resized_width .'x'. $resized_height;
        wp_update_attachment_metadata( $id, $metadata );
        }
        // Create the image array
        $image_array = array(
        'url' => $resized_url,
        'width' => $resized_width,
        'height' => $resized_height,
        'type' => $resized_type
        );
        }
        else {
        $image_array = array(
        'url' => str_replace( basename( $url ), basename( $dest_file_name ), $url ),
        'width' => $dest_width,
        'height' => $dest_height,
        'type' => $ext
        );
        }
        // Return image array
        return $image_array;
        }
        
        
        /**
        * Deletes the resized images when the original image is deleted from the WP Media Library.
        *
        * @author Matthew Ruddy
        */
        add_action( 'delete_attachment', 'matthewruddy_delete_resized_images' );
        function matthewruddy_delete_resized_images( $post_id ) {
        // Get attachment image meta data
        $metadata = wp_get_attachment_metadata( $post_id );
        if ( !$metadata )
        return;
        // Do some bailing if we cannot continue
        if ( !isset( $metadata['file'] ) || !isset( $metadata['image_meta']['resized_images'] ) )
        return;
        $pathinfo = pathinfo( $metadata['file'] );
        $resized_images = $metadata['image_meta']['resized_images'];
        // Get WP uploads directory (and bail if it doesn't exist)
        $wp_upload_dir = wp_upload_dir();
        $upload_dir = $wp_upload_dir['basedir'];
        if ( !is_dir( $upload_dir ) )
        return;
        // Delete the resized images
        foreach ( $resized_images as $dims ) {
        // Get the resized images file name
        $file = $upload_dir .'/'. $pathinfo['dirname'] .'/'. $pathinfo['filename'] .'-'. $dims .'.'. $pathinfo['extension'];
        // Delete the resized image
        @unlink( $file );
        }
        } 
    
}

