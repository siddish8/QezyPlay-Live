<?php

/**

 * The Template for displaying all single video posts with standard layout.

 *

 */



get_header();

$layout = ot_get_option('single_layout_ct_video','right');

$layout_ct_video = get_post_meta($post->ID,'single_ly_ct_video',true);

if($layout_ct_video != 'def') $layout = $layout_ct_video;

global $sidebar_width;

?>

<div id="body">

        <div class="container">

            <div class="row">

  				<div id="content" class="<?php echo $layout!='full'?($sidebar_width?'col-md-9':'col-md-8'):'col-md-12' ?><?php echo ($layout == 'left') ? " revert-layout":"";?>" role="main">

                	<?php

					//content

					if (have_posts()) :

						$get_layout = get_post_meta($post->ID,'page_layout',true);

						if($get_layout=='def' || $get_layout==''){$get_layout = ot_get_option('single_layout_video');}

						if($get_layout=='inbox'){

							get_template_part( 'single', 'inbox' );

						}else{

						while (have_posts()) : the_post();

							$multi_link = get_post_meta(get_the_ID(), 'tm_multi_link', true);

							if(!empty($multi_link)){

								tm_build_multi_link($multi_link, true);

							}

							get_template_part('content','single');

						endwhile;

						}

					endif;

					//author

						$onoff_author = ot_get_option( 'onoff_author');

						if($onoff_author!='0'){

						?>

							<div class="about-author">

								<div class="author-avatar">

									<?php echo tm_author_avatar(); ?>

								</div>

								<div class="author-info">

									<h5><?php echo __('About The Author','cactusthemes'); ?></h5>

									<?php the_author_posts_link(); ?> - 

									<?php the_author_meta('description'); ?>

								</div>

								<div class="clearfix"></div>

							</div><!--/about-author-->



					<?php } 

				$onoff_postnavi = ot_get_option( 'onoff_postnavi');

				if($onoff_postnavi!='0'){

				$auto_load_same_cat= ot_get_option('auto_load_same_cat');

				if($auto_load_same_cat=='1'){

				?>

             <!--   <div class="simple-navigation">

                    <div class="row">

                        <div class="simple-navigation-item col-md-6 col-sm-6 col-xs-6">

                        <?php 

                            $n = get_adjacent_post(true, '', false);

                            if(!empty($n)) echo '<a href="' . get_permalink($n->ID) . '" title="' . $n->post_title . '" class="maincolor2hover">

							<i class="fa fa-angle-left pull-left"></i>

							<div class="simple-navigation-item-content">

								<span>'.__('Next','cactusthemes').'</span>

								<h4>' . apply_filters('the_title', $n->post_title) . '</h4>

							</div>

                            </a>'; 

                            ?>



                        </div>

                        <div class="simple-navigation-item col-md-6 col-sm-6 col-xs-6">

                        <?php 

                            $p = get_adjacent_post(true, '', true);

                            if(!empty($p)){ echo '<a href="' . get_permalink($p->ID) . '" title="' . $p->post_title . '" class="maincolor2hover pull-right">

							<i class="fa fa-angle-right pull-right"></i>

							<div class="simple-navigation-item-content">

								<span>'.__('Previous','cactusthemes').'</span>

								<h4>' . apply_filters('the_title', $p->post_title) . '</h4>

							</div>							

							</a>';} 

                        ?>                        

                        </div>

                    </div>

                </div><!--/simple-nav-->



   



                <?php 

				}elseif($auto_load_same_cat=='0' || $auto_load_same_cat=='' ){?>

                     <?php 

					 	$idp= get_the_ID();	

                        $tags = "";

						$n_tags = "";

                        $post_tags = get_the_tags();

                        if ($post_tags) {

                         foreach($post_tags as $tag) {

                            $n_tags .= ',' . $tag->term_id;

                        }

                        }

                        $n_tags = substr($n_tags, 1);

                     $args = array(

                        'post_type' => 'post',

                        'post_status' => 'publish',

                        'tag__in' => array($n_tags),

                     );

                     $current_key = $next = $previous= '';

                     $tm_query = get_posts($args);

                     //print_r($tm_query);

                     foreach ( $tm_query as $key => $post ) : setup_postdata( $post );

                        if($post->ID == get_the_ID()){$current_key = $key;}

                     endforeach;

					 $current_key = $current_key-1;;

					 $id_pre = ($tm_query[$current_key+1]->ID);

					 $id_nex = ($tm_query[$current_key-1]->ID);

                     if($id_pre!= ''){ $next = get_permalink($tm_query[$current_key+1]->ID); }

                     if($id_nex!= ''){$previous = get_permalink($tm_query[$current_key-1]->ID);}

                     ?>

                    <div class="simple-navigation">

                        <div class="row">

                        	<div class="simple-navigation-item col-md-6 col-sm-6 col-xs-6">

                    		<?php if($tm_query[$current_key-1]->ID!='' && $tm_query[$current_key-1]->ID!=$idp){?>

                       		<a href="<?php echo get_permalink($tm_query[$current_key-1]->ID);?>" class="maincolor2hover" >

                            	<i class="fa fa-angle-left pull-left"></i>

                                <div class="simple-navigation-item-content">

                                	<span><?php echo __('Next','cactusthemes'); ?></span>

                                   	<h4><?php echo get_the_title($tm_query[$current_key-1]->ID)?></h4>

                                </div>

                            </a><?php }?>



                    		</div>

                        	<div class="simple-navigation-item col-md-6 col-sm-6 col-xs-6">

                    		<?php if($tm_query[$current_key+1]->ID!='' && $tm_query[$current_key+1]->ID!=$idp){?>

                    		<a href="<?php echo get_permalink($tm_query[$current_key+1]->ID);?>" class="maincolor2hover pull-right" >

                            	<i class="fa fa-angle-right pull-right"></i>

                                <div class="simple-navigation-item-content">

                                	<span><?php echo __('Previous','cactusthemes'); ?></span>

                                	<h4><?php echo get_the_title($tm_query[$current_key+1]->ID)?></h4>

                                </div>

                            </a><?php }?>



                            </div>

                        </div>

                    </div><!--/simple-nav-->                        

			<?php }

					wp_reset_postdata();

				}?>

					<?php 

						$count='';

						global $post;

						

						if($layout_ct_video=='full'){$count=6;}else if($layout_ct_video=='right'){$count=4;}						

						$tags = '';

						$posttags = get_the_tags();

						if ($posttags) {

							foreach($posttags as $tag) {

								$tags .= ',' . $tag->slug; 

							}

							$tags = substr($tags, 1); 

						}

						if(ot_get_option('related_video_by')){ //by cat

							$tags = '';

							$categories = get_the_category();

							if ($categories) {

								foreach($categories as $tag) {

									$tags .= ',' . $tag->term_id; 

								}

								$tags = substr($tags, 1);

							}

						}

						?>

<?php //echo do_shortcode('[rel_chan]');?>

<?php //echo do_shortcode('[vc_tta_tabs][vc_tta_section title="Deccan free channels" tab_id="1476877157106-ba73c14c-8426"][scb title="Deccan free channels" layout="small_carousel" column="4" row="2" show_excerpt="0" show_rate="0" show_dur="0" show_view="0" show_com="0" show_like="0" show_aut="0" show_date="0" css_animation="left-to-right" categories="Deccan free channels"][/vc_tta_section][/vc_tta_tabs]'); ?>

<?php echo do_shortcode('[vc_row][vc_column width="1/3"][vc_column_text]
[vs_channel ids="26,82,129,514,132" heading="Bengali Channels"]
[/vc_column_text][/vc_column][vc_column width="1/3"][vc_column_text]
[vs_channel ids="578,185,138,135" heading="Bangla Channels"]
[/vc_column_text][/vc_column][vc_column width="1/3"][vc_column_text]
[vs_channel cat="deccan-free-channels" heading="Deccan Free Channels"]
[/vc_column_text][/vc_column][/vc_row]') ?>




                 
                    <div id="comments">                       

					<?php comments_template( '', true ); ?>

                    </div>

                </div><!--#content-->

                <?php if($layout != 'full'){

					get_sidebar();

				}?>

            </div><!--/row-->

        </div><!--/container-->

    </div><!--/body-->

<?php get_footer(); ?>

