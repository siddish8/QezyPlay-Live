<?php 
    /*
    Plugin Name: Category-Posts Slider
    Plugin URI: 
    Description: Posts based on different categories slider
    Author: IB
    Version: 1.0
    Author URI: ib
    */

add_shortcode('cat-post','cat_post');

function cat_post($atts){
global $post;
$cat_post_atts = shortcode_atts( array(
        'cat' => '',
        'posts_per_page' => 4,
    ), $atts );

$args = array( 'posts_per_page' => $cat_post_atts['posts_per_page'], 'category_name' => $cat_post_atts['cat'] );

$myposts = get_posts( $args );
$i=1;
?>
<div id="<?php echo $cat_post_atts['cat'];?>"> <button style="position: absolute;top:5px; left: 0px;z-index: 999;
width: 135px;" onclick="location.href='../<?php echo strtolower($cat_post_atts['cat']);?>'"> <?php echo $cat_post_atts['cat'];?></button>
<marquee style="position: relative; left: 120px;width:70%;">
<div class="cat-post-cont <?php echo $cat_post_atts['cat'];?>" style="display:inline-flex;">
<?php

foreach ( $myposts as $post ) : setup_postdata( $post );

?>
<div style="width:100px;margin:auto 5px;" class="my img<?php echo $i; ?>"> <a href="<?php the_permalink(); ?>"> <?php echo the_post_thumbnail(); ?></a></div>
<?php
$i=$i+1;
endforeach; 
?>
</div></marquee></div>
<?php
wp_reset_postdata();
}
?>
<?php
