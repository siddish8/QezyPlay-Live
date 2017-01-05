<?php 
    /*
    Plugin Name: Home Channel Post Slider
    Plugin URI: 
    Description: Posts based on different categories slider
    Author: IB
    Version: 1.0
    Author URI: ib
    */

add_shortcode('home-cat-post','home_cat_post');

function home_cat_post($atts){
global $post;
$cat_post_atts = shortcode_atts( array(
        'cat' => '',
        'posts_per_page' => 10,
    ), $atts );

$args = array( 'posts_per_page' => $cat_post_atts['posts_per_page'], 'category_name' => $cat_post_atts['cat'] );

$myposts = get_posts( $args );
$i=1;
?>

<div id="<?php echo $cat_post_atts['cat'];?>"> 

<marquee style="position: relative; left: 120px;width:70%;" behavior="scroll" onmouseover="this.stop()" onmouseout="this.start()">
<div class="cat-post-cont <?php echo $cat_post_atts['cat'];?>" style="display:inline-flex;">
<?php

foreach ( $myposts as $post ) : setup_postdata( $post );

?>
<div style="width:100px;margin:auto 5px;" class="my img<?php echo $i; ?>"> <a onclick="myAlert(this.name)" name="<?php the_permalink(); ?>" href="#"> <?php echo the_post_thumbnail(); ?></a></div>
<?php
$i=$i+1;
endforeach; 
?>
</div></marquee></div>

<!-- 

<div id="demo4" class="scroll-img" align="center"> 


<ul class="cat-post-cont <?php echo $cat_post_atts['cat'];?>" style="">
<?php
foreach ( $myposts as $post ) : setup_postdata( $post );
?>
<li style="width:100px;margin:auto 5px;" class="my img<?php echo $i; ?>"> <a onclick="myAlert(this.name)" name="<?php the_permalink(); ?>" href="#"> <?php echo the_post_thumbnail(); ?></a></li>
<?php
$i=$i+1;
endforeach; 
?>
</ul>
</div>



<script>


 jQuery(function () {

$('#demo4').scrollbox({
 infiniteLoop: true,
    direction: 'h',
    switchItems: 5,
    distance: 660
  });

jQuery('#BanglaBouquet').scrollbox({
    direction: 'h',
    switchItems: 5,
    distance: 670
  }); });
</script>

-->
<script>

function myAlert(link)
{
<?php if(!is_user_logged_in())
{ ?>
jQuery(function(){
			jQuery.jAlert({
				'title': 'Alert',
				'content': 'Please Log-in to view this channel',
				'closeOnEsc': false,
				'closeOnClick': false
			});});
<?php }else {
?>
window.location.href=link;
<?php } ?>



}</script>
<?php
wp_reset_postdata();
}
?>
<?php
