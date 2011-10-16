<?php
/*
Plugin Name: SEO Meta Description
Plugin URI: http://programming-review.com/seo-meta-description
Description: Creates extra meta description write panel for posts and pages
Version: 1.0
Author: Dejan Batanjac
Author URI: http://programming-review.com
License: GPL2
*/


/*  Copyright 2011  Dejan Batanjac 

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



define( 'WP_SEO_META_DESCRIPTION_VERSION', '1.0' );
define( 'WP_SEO_META_DESCRIPTION_URL', plugin_dir_url(__FILE__) );
define( 'WP_SEO_META_DESCRIPTION_PATH', plugin_dir_path(__FILE__) );
define( 'WP_SEO_META_DESCRIPTION_BASENAME', plugin_basename( __FILE__ ) );

require WP_SEO_META_DESCRIPTION_PATH . 'layout.php';
require WP_SEO_META_DESCRIPTION_PATH . 'helper.php';

if ( class_exists('WP_SEO_Meta_Description_Layout') ) :
$layout = new WP_SEO_Meta_Description_Layout();
endif;

if (isset($layout)) {
  // initialize the layout
  $layout->init();
}

?>
