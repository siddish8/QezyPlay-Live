<?php 

global $current_user;	

get_currentuserinfo();

$user_id = get_current_user_id();

?>

<div class="slide-image">

	

		<?php the_post_thumbnail('url'); ?>	

		<div class="slider-content">

			<!-- <h1 class="slide-title"><?php the_title(); ?></h1> -->

			

				<div class="slider-short-content">

					<?php the_content(); ?>			

				</div>

			<?php  

			

			$sliderurl = get_post_meta( get_the_ID(),'rsris_slide_link', true );

				if($sliderurl != '') { ?>

						

			<div class="readmore"><a href="<?php echo $sliderurl; ?>" class="slider-readmore"><?php esc_html_e( $text, 'responsive-header-image-slider' ); ?></a></div>

				<?php } 

				

				else {



				if(!is_user_logged_in())

				{

				$text="Register for Free"; $sliderurl="/register/";
				echo '<div ><a href="'.site_url($sliderurl).'" class=""><button style="color:white !important">'.$text.'</button></a></div>';

						echo "<style>.read-more{display:none}<style>";

				}

				else

				{	

					//echo "<script>console.log('subscribed_".$user_id.":".get_option("subscribed_".$user_id,"")."')</script>";

					$chk=get_option("subscribed_".$user_id,"");//get_option("subscribed_".$userid)

					if($chk == "")

					{

						//echo "<script>console.log('subscribed".$chk."')</script>";

						$chk="false";

					}

					if($chk == "false"){

						//echo "<script>console.log('subscribed".$chk."')</script>";

						$text="Subscribe"; $sliderurl="subscription";

						

						echo '<div ><a href="'.site_url($sliderurl).'" class=""><button style="color:white !important">'.$text.'</button></a></div>';

						echo "<style>.read-more{display:none}<style>";

						}

					else

						{//echo "<script>console.log('subscribed:".$chk."')</script>";

						echo "<style>.read-more{display:none}<style>";}

				}

			?>

			

			<div class="read-more"><a href="<?php echo site_url($sliderurl); ?>" class="slider-readmore"><button class="hdr-btn"><?php echo $text ?></button></a></div>

<?php

}

?>

			</div>

	



</div>