<?php
/*
Plugin Name: Collage
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Creates an abstract collage of images on your WordPress site.
Version: 0.1
Author: Patrick Carey
Author URI: http://www.immaterial-labour.com
License: GPL2
*/
?><?php
/*  Copyright 2010  Patrick Carey  (email : patrickcar@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?><?php

	function collage($a = -1, $b = 'large') {
		
		
		
		$rand_width = rand(40,450);
		
		$args = array(
			
			
			'post_type' => 'attachment',
			
			//Defines the number of images to return
			
			'numberposts' => $a,
			
			'orderby' => rand,
			
			);
			
		print '<div class="entrycat" style="width:'. $rand_width .'px; float:left; ">  


				<div class="img-container" style="float:left;">';
		
		$c_posts = get_posts($args);
		
		
		
		
		foreach($c_posts as $post){
		
		print '<div class="img-frame">';
		
		$rand_margin = rand(50,400);
		
		$rand_radius = rand(0,1000);
		
		
		$collage_image = wp_get_attachment_image_src($post->ID, $b);
		
		print '<img src="' . $collage_image[0] . '" alt="collaged images" style=" margin-right:'. $rand_margin .'px; margin-left:'. $rand_margin .'px; border-radius:'. $rand_radius .'px;" />';
			
		#print wp_get_attachment_image( $post->ID, $b );
		
			
		
		print '</div>';
			
		}
		
	
		print '</div>
		
				</div>
		';
		
		
		
		
		
		
		
		
		
		
		
	}
	
	
	add_action('wp_print_styles', 'collage_stylesheet');

   /*
    * Enqueue style-file, if it exists.
    */

   function collage_stylesheet() {
       $myStyleUrl = WP_PLUGIN_URL . '/collage/collage.css';
       $myStyleFile = WP_PLUGIN_DIR . '/collage/collage.css';
       if ( file_exists($myStyleFile) ) {
           wp_register_style('myStyleSheets', $myStyleUrl);
           wp_enqueue_style( 'myStyleSheets');
       }
   }


function make_collage($atts){
	
	extract(shortcode_atts(array(
			'number' => '',
			'size' => '',
		), $atts)); 
	
	return collage($atts['number'], $atts['size']);
	
}


add_shortcode('makecollage', 'make_collage');
	?>