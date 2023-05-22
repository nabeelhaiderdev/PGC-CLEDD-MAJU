<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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


// $cledd_pagetitle = (isset($fields['cledd_pagetitle'])) ? $fields['cledd_pagetitle'] : null;
// if(!$cledd_pagetitle){
// 	$cledd_pagetitle = get_the_title();
// }
$cledd_pagetitle = glide_page_title('cledd_pagetitle');
?>

<div class="header-banner subpage">
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
			<h1><?php the_title(); ?></h1>
		</div>
	</div>
</div>
<main class="main">
	<section id="page-section" class="page-section main-content">
		<!-- Content Start -->

		<?php while ( have_posts() ) { the_post();
		//Include specific template for the content.
		get_template_part( 'partials/content', 'page' );

	} ?>

		<div class="clear"></div>
		<div class="ts-80"></div>

		<!-- Content End -->
	</section>

	<?php get_footer(); ?>
