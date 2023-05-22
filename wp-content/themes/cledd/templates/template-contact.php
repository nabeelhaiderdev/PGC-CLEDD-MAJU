<?php
/**
 * Template Name: Contact Us
 *
 * This template is for displaying resource page.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package BaseTheme Package
 * @since 1.0.0
 *
 */

// Include header
get_header();
// Global variables
global $option_fields;
global $pID;
global $fields;

$cledd_page_title       = ( isset( $fields['cledd_wpage_title'] ) ) ? $fields['cledd_page_title'] : get_the_title();
$cledd_page_banner_image       = ( isset( $fields['cledd_page_banner_image'] ) ) ? $fields['cledd_page_banner_image'] : esc_url(get_template_directory_uri()).'/assets/images/bg-banner-inner.jpg';


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
			<h1><?php 
				if($cledd_page_title){
					echo $cledd_page_title;
				}
			?></h1>
		</div>
	</div>
</div>
<main class="main">

	<section id="page-section" class="page-section">
		<!-- Content Start --> <?php while ( have_posts() ) { the_post();
        get_template_part( 'partials/content', 'page-contact' );
    } ?> <div class="clear"></div>
		<!-- Content End -->
	</section>

	<?php get_footer();
