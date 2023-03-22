<?php
/**
 * Template part for footer cta
 *
 * @link https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/
 *
 * @package CLEDD MAJU Package
 * @since 1.0.0
 */

$cledd_page_cta_pagevisibility = ( isset( $fields['cledd_page_cta_pagevisibility'] ) ) ? $fields['cledd_page_cta_pagevisibility'] : null;


 $cledd_to_cta_headline = ( isset( $fields['cledd_to_cta_headline'] ) ) ? $option_fields['cledd_to_cta_headline'] : null;
$cledd_ftrcta_headline  = ( isset( $fields['cledd_page_cta_headline'] ) ) ? $fields['cledd_page_cta_headline'] : $cledd_to_cta_headline;
?>

<section id="cta-section" class="cta-section">
	<!-- cta Start -->
	<div class="cta-single">
		<div class="wrapper">
			<h4><?php echo $cledd_ftrcta_headline; ?></h4>
		</div>
	</div>
	<!-- cta End -->
</section>
