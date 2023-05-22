<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BaseTheme Package
 * @since 1.0.0
 *
 */

 // Global variables
global $option_fields;
global $pID;
global $fields;

// Theme Options - Social Links

$cledd_tcuo_map       = ( isset( $fields['cledd_tcuo_map'] ) ) ? $fields['cledd_tcuo_map'] : null;
$cledd_tcuo_contact_details       = ( isset( $fields['cledd_tcuo_contact_details'] ) ) ? $fields['cledd_tcuo_contact_details'] : null;
$cledd_tcuo_form_section       = ( isset( $fields['cledd_tcuo_form_section'] ) ) ? $fields['cledd_tcuo_form_section'] : null;

$ucp_contact_address = isset($cledd_tcuo_contact_details['address'])? $cledd_tcuo_contact_details['address'] : null;
$ucp_contact_telephones = isset($cledd_tcuo_contact_details['telephones'])? $cledd_tcuo_contact_details['telephones'] : null;
$ucp_contact_email = isset($cledd_tcuo_contact_details['email'])? $cledd_tcuo_contact_details['email'] : null;

$ucp_form_title = isset($cledd_tcuo_form_section['title'])? $cledd_tcuo_form_section['title'] : null;
$ucp_form_form = isset($cledd_tcuo_form_section['form'])? $cledd_tcuo_form_section['form'] : null;


?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<section class="contact-block">
		<div class="container">
			<?php if($cledd_tcuo_map){ ?>
			<div class="map-block">
				<?php echo html_entity_decode($cledd_tcuo_map); ?>
			</div>
			<?php } ?>
			<div class="row-block flex-direction-reverse">
				<div class="col-block col-block-7">
					<?php if($ucp_form_title){ ?>
					<h4><?php echo $ucp_form_title; ?></h4>
					<?php } ?>
					<!-- Contact Form -->
					<?php 
						if($ucp_form_form){
							echo html_entity_decode($ucp_form_form);
						}
					?>
				</div>
				<div class="col-block col-block-5">
					<h4>Contact Details</h4>
					<ul class="contact-information">
						<?php if($ucp_contact_address){ ?>
						<li>
							<strong class="title">Address</strong>
							<div class="textbox">
								<address><?php echo $ucp_contact_address; ?></address>
							</div>
						</li>
						<?php } ?>
						<?php if($ucp_contact_telephones){ ?>
						<li>
							<strong class="title">Telephone</strong>
							<div class="textbox">
								<?php foreach ($ucp_contact_telephones as $telephone ) {
									$telephone_name = $telephone['name'];
									$telephone_number = $telephone['number']; ?>
								<span class="text"><?php echo $telephone_name; ?> (<a
										href="tel:+<?php echo preg_replace( '/[^0-9]/', '', $telephone_number ); ?>"><?php echo $telephone_number; ?></a>)</span>
								<?php } ?>
							</div>
						</li>
						<?php } ?>
						<?php if($ucp_contact_email){ ?>
						<li>
							<strong class="title">E-mail</strong>
							<div class="textbox">
								<span class="text email"><a
										href="mailto:<?php echo $ucp_contact_email; ?>"><?php echo $ucp_contact_email; ?></a></span>
							</div>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</section>


</div>
