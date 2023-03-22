<?php
/**
 * The template for displaying website footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CLEDD MAJU Package
 * @since 1.0.0
 */
// Global variables
global $option_fields;
global $pID;
global $fields;

$pID = get_the_ID();

if ( is_home() ) {
	$pID = get_option( 'page_for_posts' );
}

if ( is_404() || is_archive() || is_category() || is_search() ) {
	$pID = get_option( 'page_on_front' );
}

if ( function_exists( 'get_fields' ) && function_exists( 'get_fields_escaped' ) ) {
	$option_fields = get_fields_escaped( 'option' );
	$fields        = get_fields_escaped( $pID );
}
?> <?php

// Default Footer Options

$footer_scripts = ( isset( $option_fields['footer_scripts'] ) ) ? $option_fields['footer_scripts'] : null;

$cledd_ftrop_topinfo = ( isset( $option_fields['cledd_ftrop_topinfo'] ) ) ? $option_fields['cledd_ftrop_topinfo'] : null;
$cledd_ftrop_logotext = ( isset( $option_fields['cledd_ftrop_logotext'] ) ) ? $option_fields['cledd_ftrop_logotext'] : null;
$cledd_ftrop_menutitle = ( isset( $option_fields['cledd_ftrop_menutitle'] ) ) ? $option_fields['cledd_ftrop_menutitle'] : null;
$cledd_ftrop_contact = ( isset( $option_fields['cledd_ftrop_contact'] ) ) ? $option_fields['cledd_ftrop_contact'] : null;
$cledd_ftrop_locations = ( isset( $option_fields['cledd_ftrop_locations'] ) ) ? $option_fields['cledd_ftrop_locations'] : null;
$cledd_ftrop_copyright = ( isset( $option_fields['cledd_ftrop_copyright'] ) ) ? $option_fields['cledd_ftrop_copyright'] : null;


// Schema Markup - ACF variables.


$cledd_schema_check = $option_fields['cledd_schema_check'];
if ( $cledd_schema_check ) {
	$cledd_schema_business_name       = html_entity_remove( $option_fields['cledd_schema_business_name'] );
	$cledd_schema_business_legal_name = html_entity_remove( $option_fields['cledd_schema_business_legal_name'] );
	$cledd_schema_street_address      = html_entity_remove( $option_fields['cledd_schema_street_address'] );
	$cledd_schema_locality            = html_entity_remove( $option_fields['cledd_schema_locality'] );
	$cledd_schema_region              = html_entity_remove( $option_fields['cledd_schema_region'] );
	$cledd_schema_postal_code         = html_entity_remove( $option_fields['cledd_schema_postal_code'] );
	$cledd_schema_map_short_link      = html_entity_remove( $option_fields['cledd_schema_map_short_link'] );
	$cledd_schema_latitude            = html_entity_remove( $option_fields['cledd_schema_latitude'] );
	$cledd_schema_longitude           = html_entity_remove( $option_fields['cledd_schema_longitude'] );
	$cledd_schema_opening_hours       = html_entity_remove( $option_fields['cledd_schema_opening_hours'] );
	$cledd_schema_telephone           = html_entity_remove( $option_fields['cledd_schema_telephone'] );
	$cledd_schema_business_email      = html_entity_remove( $option_fields['cledd_schema_business_email'] );
	$cledd_schema_business_logo       = html_entity_remove( $option_fields['cledd_schema_business_logo'] );
	$cledd_schema_price_range         = html_entity_remove( $option_fields['cledd_schema_price_range'] );
	$cledd_schema_type                = html_entity_remove( $option_fields['cledd_schema_type'] );
}
// Custom - ACF variables.

$cledd_ftrop_title     = ( isset( $option_fields['cledd_ftrop_title'] ) ) ? $option_fields['cledd_ftrop_title'] : null;
$cledd_ftrop_copyright = html_entity_decode( $option_fields['cledd_ftrop_copyright'] );
$cledd_social_fb       = ( isset( $option_fields['cledd_social_fb'] ) ) ? $option_fields['cledd_social_fb'] : null;
$cledd_social_tw       = ( isset( $option_fields['cledd_social_tw'] ) ) ? $option_fields['cledd_social_tw'] : null;
$cledd_social_li       = ( isset( $option_fields['cledd_social_li'] ) ) ? $option_fields['cledd_social_li'] : null;
$cledd_social_in       = ( isset( $option_fields['cledd_social_in'] ) ) ? $option_fields['cledd_social_in'] : null;

?>
<?php get_template_part( 'partials/cta' ); ?> </main>
<footer id="footer-section" class="footer footer-section">
	<!-- Footer Start -->
	<!-- Footer of the page -->
	<div class="pri-footer">
		<div class="container">
			<strong class="logo">
				<a href="<?php echo home_url(); ?>"><img
						src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo.png"
						alt="Mohammad Ali Jinnah University" width="243" height="78"></a>
			</strong>
			<?php if($cledd_ftrop_topinfo){ ?>
			<ul class="additional-info">
				<?php foreach ($cledd_ftrop_topinfo as $info ) { ?>
				<li>
					<strong class="title"><?php echo $info['title']; ?></strong>
					<span class="text"><?php echo $info['text']; ?></span>
				</li>
				<?php } ?>
			</ul>
			<?php } ?>
		</div>
	</div>
	<div class="sec-footer">
		<div class="container">
			<div class="theme-info">
				<?php if($cledd_ftrop_logotext){ ?>
				<p><?php echo $cledd_ftrop_logotext; ?></p>
				<?php } ?>
			</div>
			<div class="columns-holder">
				<div class="usefull-links">
					<strong class="title"><?php echo $cledd_ftrop_menutitle; ?></strong>
					<div class="links-wrap">
						<?php
							wp_nav_menu(
								array(
								'theme_location' => 'footer-nav',
								'fallback_cb' => 'menu_fallback',
								)
							);
						?>
					</div>
				</div>
				<div class="contact-column">
					<?php if($cledd_ftrop_contact){ ?>
					<strong class="title">Contact Us</strong>
					<ul class="contact-info">
						<?php foreach ($cledd_ftrop_contact as $contact ) {
							$contact_phone = $contact['phone'];
							$just_phone = preg_replace( '/[^0-9]/', '', $contact_phone );
							?>
						<li>
							<a href="tel:<?php echo $just_phone; ?>" class="email"><?php echo $contact_phone; ?>
							</a>
						</li>
						<?php } ?>
					</ul>
					<?php } ?>
				</div>
				<?php if($cledd_ftrop_locations){ ?>
				<div class="contact-column">
					<strong class="title">Location</strong>
					<?php foreach ($cledd_ftrop_locations as $location ) { ?>
					<address style="margin-bottom:20px;"><?php echo $location['address']; ?>
					</address>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="footer-copyrights">
		<div class="container">
			<p>Copyright &copy; <?php echo date('Y'); ?> <a
					href="https://www.jinnah.edu"><?php echo $cledd_ftrop_copyright; ?></a></p>
		</div>
	</div>
	<!-- Footer End -->
	<?php
	if ( $cledd_schema_check ) {
		?>
	<script type="application/ld+json">
	{
		"@context": "http://schema.org",
		"@type": "<?php echo $cledd_schema_type; ?>",
		"address": {
			"@type": "PostalAddress",
			"addressLocality": "<?php echo $cledd_schema_locality; ?>",
			"addressRegion": "<?php echo $cledd_schema_region; ?>",
			"postalCode": "<?php echo $cledd_schema_postal_code; ?>",
			"streetAddress": "<?php echo $cledd_schema_street_address; ?>"
		},
		"hasMap": "<?php echo $cledd_schema_map_short_link; ?>",
		"geo": {
			"@type": "GeoCoordinates",
			"latitude": "<?php echo $cledd_schema_latitude; ?>",
			"longitude": "<?php echo $cledd_schema_longitude; ?>"
		},
		"name": "<?php echo $cledd_schema_business_name; ?>",
		"openingHours": "<?php echo $cledd_schema_opening_hours; ?>",
		"telephone": "<?php echo $cledd_schema_telephone; ?>",
		"email": "<?php echo $cledd_schema_business_email; ?>",
		"url": "<?php echo esc_url( home_url() ); ?>",
		"image": "<?php echo $cledd_schema_business_logo; ?>",
		"legalName": "<?php echo $cledd_schema_business_legal_name; ?>",
		"priceRange": "<?php echo $cledd_schema_price_range; ?>"
	}
	</script> <?php } ?>
</footer> <?php wp_footer(); ?> <?php
if ( $footer_scripts != '' ) {
	?>
<div style="display: none;">
	<?php echo html_entity_decode( $footer_scripts, ENT_QUOTES ); ?> </div> <?php } ?> </body>

</html>
