<?php 
/*
Fri 30 Sep 2011 10:39:32 PM CEST 
This class contains valuable helper methods
Will be used in future plugin updates

*/
if ( !class_exists('WP_SEO_Meta_Description_Helper') ) :
class WP_SEO_Meta_Description_Helper{

function insertspecialchars($str) {
  $strarr = str2arr($str);
    $str = implode("<!---->", $strarr);
    return $str;
}

function removespecialchars($str) {
  $strarr = explode("<!---->", $str);
    $str = implode("", $strarr);
  $str = stripslashes($str);
    return $str;
}

function str2arr($str) {
    $chararray = array();
    for($i=0; $i < strlen($str); $i++){
        array_push($chararray,$str{$i});
    }
    return $chararray;
}

function flush_rewrites() {
 global $wp_rewrite;
 $wp_rewrite->flush_rules();
}

function add_rewrites() {
 global $wp_rewrite;
 $ftc_new_non_wp_rules = array(  'find/(perl_string_becomming_$1)' => '/addit.php?here=$1',
 );
 $wp_rewrite->non_wp_rules = $ftc_new_non_wp_rules + $wp_rewrite->non_wp_rules;
}

}// end of a class
endif; 

?>
