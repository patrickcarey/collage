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
	
	/**
	*
	*collage() 
	*The function to create and display the image collage
	* @param int $number , number of images to return, -1 returns all, default is -1
	* @param string $size , 'thumbnail', 'medium', 'large', default is medium
	* @param string $layout accepts either 'overlap' or 'block' for how collage displays, default is 'overlap.
	*
	**/
	
	
	function collage($number = -1, $size = 'medium', $layout = 'overlap') {
		
		#
		# Set a random width
		#
		
		$rand_width = rand(40,450);
		
		
		#
		# Arguments for get_posts()
		#
		
		$args = array(
			
			'post_type' => 'attachment',
			
			'numberposts' => $number,
			
			'orderby' => rand,
			
			);
			
		
		
		print '<div id="collage">';
		
		print '<div class="entrycat" style="width:'. $rand_width .'px; float:left; "> <div class="img-container" style="float:left;  ">';
		
		$c_posts = get_posts($args);
		
		
		
		#
		# If the layout is 'overlap'
		#
		
		if($layout == 'overlap'){
		
			foreach($c_posts as $post){
		
				print '<div class="img-frame">';
	
				$rand_margin = rand(0,50);
	
				$collage_image = wp_get_attachment_image_src($post->ID, $b);
	
				print '<img src="' . $collage_image[0] . '" alt="collaged images" style="margin:'. $rand_margin .'px;" /></div>';
			
			}
		
		}
		
		
		
		#
		# If the layout is 'block'
		#
		
		
		elseif($layout == 'block'){
		
			
			foreach($c_posts as $post){
				
				$collage_image = wp_get_attachment_image_src($post->ID, $size);
				
				print '<div class="img-frame-bg" style="background:url('. $collage_image[0]  .')"></div>';

			}
		
		
		}
		
		
	
		print '</div> </div> </div>';
		
		
		
		
		
		
		
		
		
		
		
	}
	
	

   /*
    * Enqueue style-file, if it exists.
    */

   function collage_stylesheet() {
       
	   $myStyleUrl = WP_PLUGIN_URL . '/collage/collage.css';
       
	   $myStyleFile = WP_PLUGIN_DIR . '/collage/collage.css';
       	

		if (file_exists($myStyleFile) ) {
	        
			wp_register_style('myStyleSheets', $myStyleUrl);
	          
			wp_enqueue_style( 'myStyleSheets');
	      }
   
	}
	
	
/**
* make_collage()
* fucntion that returns the collage() function from above, prepared to be a shortcode.
* 
* @param $atts takes attributes , which are sent as parameters from the collage() function
* 
* @return the collage() as a shortcode
**/


function make_collage($atts){
	
	extract(shortcode_atts(array(
			
			'number' => '',
			
			'size' => '',
			
			'type' => '',
		
		), $atts)); 
	
	return collage($atts['number'], $atts['size'], $atts['type']);
	
}

add_action('wp_print_styles', 'collage_stylesheet');

add_shortcode('makecollage', 'make_collage');


?>