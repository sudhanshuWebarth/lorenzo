<?php
add_action( 'init', 'my_custom_menus' );

function my_custom_menus() {

    register_nav_menus(

        array(

            'primary-menu' => __( 'Primary Menu' ),

            'secondary-menu' => __( 'Secondary Menu' )

        )

    );

}

if( class_exists( 'kdMultipleFeaturedImages' ) ) {



        $args = array(

                'id' => 'featured-image-2',

                'post_type' => 'post',      // Set this to post or page

                'labels' => array(

                    'name'      => 'Featured image 2',

                    'set'       => 'Set featured image 2',

                    'remove'    => 'Remove featured image 2',

                    'use'       => 'Use as featured image 2',

                )

        );



        new kdMultipleFeaturedImages( $args );

}

/* Theme setup */

add_action( 'after_setup_theme', 'wpt_setup' );

    if ( ! function_exists( 'wpt_setup' ) ):

        function wpt_setup() {  

            register_nav_menu( 'primary', __( 'Primary navigation', 'wptuts' ) );

        } endif;
		require_once('wp_bootstrap_navwalker.php');
		function pagination($pages = '', $range = 1)

{  

     $showitems = ($range * 2)+1;  

 

     global $paged;

     if(empty($paged)) $paged = 1;

 

     if($pages == '')

     {

         global $wp_query;

         $pages = $wp_query->max_num_pages;

         if(!$pages)

         {

             $pages = 1;

         }

     }   

 

     if(1 != $pages)

     {

         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";

         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";

         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";

 

         for ($i=1; $i <= $pages; $i++)

         {

             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))

             {

                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";

             }

         }

 

         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  

         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";

         echo "</div>\n";

     }

}



add_editor_style('editor-style.css');

function shape_register_custom_background() {
    $args = array(
        'default-color' => 'e9e0d1',
    );
 
    $args = apply_filters( 'shape_custom_background_args', $args );
 
    if ( function_exists( 'wp_get_theme' ) ) {
        add_theme_support( 'custom-background', $args );
    } else {
        define( 'BACKGROUND_COLOR', $args['default-color'] );
        define( 'BACKGROUND_IMAGE', $args['default-image'] );
        add_custom_background();
    }
}
add_action( 'after_setup_theme', 'shape_register_custom_background' );

add_editor_style( style.css );
$task=new operations();
$call=new callFiles();
function my_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );
add_theme_support( 'post-thumbnails' ); 
function ace_social($args)
{
	$select_social=mysql_query("select * from tbl_acesocial");
	if(mysql_num_rows($select_social)>0){ 
			$result_socail=mysql_fetch_array($select_social);
			return $result_socail[$args];
		}
}
function ace_contact($args)
{
	$select_contact=mysql_query("select * from tbl_acecontact");
	if(mysql_num_rows($select_contact)>0){ 
			$result_contact=mysql_fetch_array($select_contact);
			return $result_contact[$args];
			}
}
// OUR CALSS FOR THE WEBSITE
$con_toemail=$task->queryWhere("wp_users",array('user_email'),array('id'=>1));
define("TO_EMAIL",$con_toemail[0]['user_email']);
?>