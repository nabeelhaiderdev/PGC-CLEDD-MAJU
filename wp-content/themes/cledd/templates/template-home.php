<?php
/**
 * Template Name: Homepage
 * Template Post Type: page
 *
 * This template is for displaying home page.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package CLEDD MAJU Package
 * @since 1.0.0
 *
 */

// Include header
get_header();

// Global variables
global $option_fields;
global $pID;
global $fields;

$cledd_thpo_title = (isset($fields['cledd_thpo_title']) && $fields['cledd_thpo_title']!='' ) ? $fields['cledd_thpo_title'] : get_the_title();
$cledd_thpo_sub_title = ( isset( $fields['cledd_thpo_sub_title'] ) ) ? $fields['cledd_thpo_sub_title'] : null;
$cledd_thpo_sub_button = ( isset( $fields['cledd_thpo_sub_button'] ) ) ? $fields['cledd_thpo_sub_button'] : null;

?>
<div class="header-banner">
	<div class="banner-image">
		<?php 
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('full');
			}
			else { ?>
		<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/img-banner.jpg"
			alt="<?php echo get_the_title(); ?>">
		<?php } ?>
	</div>
	<div class="container banner-frame">
		<div class="banner-body">
			<h1><?php echo html_entity_decode($cledd_thpo_title); ?> </h1>
			<?php if($cledd_thpo_sub_title){ ?>
			<div class="tagline">
				<p><?php echo $cledd_thpo_sub_title; ?> </p>
			</div>
			<?php } ?>

			<?php if( $cledd_thpo_sub_button ) { ?>
			<div class="btn-block">
				<?php echo glide_acf_button( $cledd_thpo_sub_button, 'btn btn-primary' ); ?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>

<!-- Main Area Start -->
<main id="main-section" class="main-section main">


	<section id="page-section" class="page-section">
		<!-- Content Start -->
		<?php while ( have_posts() ) { the_post();
			//Include specific template for the content.
			get_template_part( 'partials/content', 'page' );

		} ?>

		<div class="clear"></div>
		<div class="ts-80"></div>
		<!-- Content End -->
	</section> <?php get_footer(); ?>
