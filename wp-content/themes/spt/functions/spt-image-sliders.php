<?php
/**
 * Spt functions and definitions
 *
 * @package Spt
 */

function spt_flex_slider() {
$spt_theme_options = spt_get_options( 'spt_theme_options' );
$slider_cat = $spt_theme_options['image_slider_cat'];
$num_of_slides = $spt_theme_options['slider_num'];
$button_text = $spt_theme_options['caption_button_text'];

$flex_query = new WP_Query(
	array(
		'posts_per_page' => $num_of_slides,
		'cat' 	=> $slider_cat
	)
);?>
<div class="clear"></div>
<div class="flexslider da-slider" >
	<ul class="slides">
	<?php while ( $flex_query->have_posts() ): $flex_query->the_post(); ?>
		<li>
			<?php if ( has_post_thumbnail() ) { ?>
				<?php the_post_thumbnail('full'); ?>
			<?php } else { ?>
				<?php if ($slider_cat !='') { ?>
					<img class="attachment-full wp-post-image rs-slide-image" width="1024" height="500" alt="slide" src="<?php echo get_template_directory_uri() ?>/images/assets/slide.jpg">
				<?php } else { ?>
					<img class="attachment-full wp-post-image rs-slide-image" width="1024" height="500" alt="slide" src="<?php echo get_template_directory_uri() ?>/images/assets/slide1.jpg">
				<?php } ?>
			<?php } ?>
			<?php if ($spt_theme_options['captions_on'] == '1') { ?>
				<div class="posts-featured-details-wrapper">
					<div>
						<a class="post-title" href="<?php the_permalink() ?>"><h2><?php the_title(); ?></h2></a>
						<?php the_excerpt(); ?><br>
						<?php if ($spt_theme_options['captions_button'] == '1') { ?>
							<a href="<?php the_permalink() ?>" class="da-link"><?php echo $button_text ?></a>
						<?php }; ?>
					</div>
				</div>
			<?php }; ?>	
			</li>
		<?php endwhile; wp_reset_query(); ?>
		</ul>
	</div>
	<div class="clear"></div>

<?php 
}

function spt_localize_scripts(){
	wp_enqueue_script( 'slides', get_template_directory_uri() .'/js/slides.js' , array( 'jquery' ), '', true );
	$spt_theme_options = spt_get_options( 'spt_theme_options' );
	$animation_speed = $spt_theme_options['animation_speed'];
	$slideshow_speed = $spt_theme_options['slideshow_speed'];
		$datatoBePassed = array(
        	'slideshowSpeed' => $slideshow_speed,
        	'animationSpeed' => $animation_speed,
    	);
	wp_localize_script( 'slides', 'php_vars', $datatoBePassed );
}

add_action( 'wp_enqueue_scripts', 'spt_localize_scripts' );