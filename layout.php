<?php
/*
Sat 15 Oct 2011 11:09:26 AM CEST 
This class is responsible for the plugin layout on edit posts and edit pages
*/
if ( !class_exists('WP_SEO_Meta_Description_Layout') ) :
class WP_SEO_Meta_Description_Layout{

function init(){
  
  // initialize actions
  add_action( 'add_meta_boxes', array(&$this, 'init_menu') );
  add_action( 'wp_head' ,       array(&$this, 'add_meta_description'));
  add_action( 'save_post',      array(&$this, 'save_postdata') ); 
}



/*posts and pages are having custom edit panel for Meta Descriptions*/
function init_menu() {

//add meta box to all posts
  add_meta_box(
    'wp_seo_meta_description_box',
    __('Meta Description', 'seo_textdomain' ),
    array(&$this, 'draw_custom_meta_box'),
    'post'
  );

//add meta box to all pages
  add_meta_box(
    'wp_seo_meta_description_box',
    __('Meta Description', 'seo_textdomain' ),
    array(&$this, 'draw_custom_meta_box'),
    'page'
  );
}

function add_meta_description() {
	global $post;
  if ('post' == $post->post_type || 'page' == $post->post_type)
  { 
	  $description = get_post_meta($post->ID, 'seometadescription', true);
    // echo only if not empty
    if(!empty($description)){
      echo '<meta name="description" content="' . $description . '" />';
    }	
  }
}


/* prints the custom meta box */
function draw_custom_meta_box() {
  global $post;
  // get the existing meta description  
  $meta_box_value = get_post_meta($post->ID, 'seometadescription', true);

  // The actual fields for data entry
  echo '<label for="seometadescriptoin">';
  _e('Meta Description', 'seo_textdomain');
  echo '</label>';
  echo '<textarea id="seometadescription" style="width: 100%;" name="seometadescription">';
  echo $meta_box_value;
  echo '</textarea>';
  _e('only 139 chars visible on Google results', 'seo_textdomain');

  // set the nonce
  wp_nonce_field( plugin_basename( __FILE__ ), 'seo_meta_description_box_nonce');
}



// save draft, autosave or publish
// returns 0 on error, else updates metadata and returns 1
function save_postdata($post_id) {
  
  // if not admin we are not on the right page
  if (!is_admin())
  return 0;

  //always check nonce as the first step
  if (isset($_POST['seo_meta_description_box_nonce']) &&
     !wp_verify_nonce($_POST['seo_meta_description_box_nonce'], 
     plugin_basename( __FILE__ )))
  return 0;

  //if this is post or page
  if( isset($_POST) && 
      isset($_POST['post_type']) && 
      (('post' === $_POST['post_type']) || ('page' === $_POST['post_type']))
      
  )
  {
    if( // if usser can edit post
    ('post' === $_POST['post_type'] && current_user_can('edit_post', $post_id ))
    ||  // or if user can edit page
    ('page' === $_POST['post_type'] && current_user_can('edit_page', $post_id ))
    ){
      // find and save the data
      if(isset($_POST['seometadescription'])){
      // tags will be stripped
      $data = strip_tags($_POST['seometadescription']);
      // all extra white space will be trimmed to single white space
      $data = preg_replace('/\s\s+/', ' ', $data);
      // the double quote character will be replaced
      $data = str_replace('"', '`', $data);

      // adding or updating post meta data
      update_post_meta($post_id, 'seometadescription', $data);
      return 1;
      }
    }
  }
  return 0;
}// save_postdata


}// end of a class
endif; 

?>
