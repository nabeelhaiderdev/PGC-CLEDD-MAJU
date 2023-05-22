<?php
/**
 * Block Name: Image Alongside Text
 *
 * The template for displaying the custom gutenberg block named Image Alongside Text.
 *
 * @link https://www.advancedcustomfields.com/resources/blocks/
 *
 * @package CLEDD MAJU Package
 * @since 1.0.0
 */

// Get all the fields from ACF for this block ID
// $block_fields = get_fields( $block['id'] );
$block_fields = get_fields_escaped( $block['id'] );
// $block_fields = get_fields_escaped( $block['id'] ,'sanitize_text_field' ); // if want to remove all html

// Set the block name for it's ID & class from it's file name
$block_glide_name = $block['name'];
$block_glide_name = str_replace("acf/" , "" , $block_glide_name);

// Set the preview thumbnail for this block for gutenberg editor view.
if( isset( $block['data']['preview_image_help'] )  ) {    /* rendering in inserter preview  */
	echo '<img src="'. $block['data']['preview_image_help'] .'" style="width:100%; height:auto;">';
}

// create align class ("alignwide") from block setting ("wide").
$align_class = $block['align'] ? 'align' . $block['align'] : '';

// Get the class name for the block to be used for it.
$class_name = (isset($block['className'])) ? $block['className'] : null;

// Making the unique ID for the block.
$id = 'block-' .$block_glide_name . "-" . $block['id'];

// Making the unique ID for the block.
if($block['name']){
	$block_name = $block['name'];
	$block_name = str_replace("/" , "-" , $block_name);
	$name = 'block-' .  $block_name;
}

// Block variables
// $custom_field_of_block = html_entity_decode($block_fields['custom_field_of_block']); // for keeping html from input
// $custom_field_of_block = html_entity_remove($block_fields['custom_field_of_block']); // for removing html from input
$cledd_iat_title = ( isset( $block_fields['cledd_iat_title'] ) ) ? $block_fields['cledd_iat_title'] : null;
$cledd_iat_kicker = ( isset( $block_fields['cledd_iat_kicker'] ) ) ? $block_fields['cledd_iat_kicker'] : null;
$cledd_iat_img_location = ( isset( $block_fields['cledd_iat_img_location'] ) ) ? $block_fields['cledd_iat_img_location'] : null;
if($cledd_iat_img_location == 'right'){
	$image_location_class = ' image-at-right ';
} else {
	$image_location_class = null;
}
$cledd_iat_image = ( isset( $block_fields['cledd_iat_image'] ) ) ? $block_fields['cledd_iat_image'] : null;
$cledd_iat_text = ( isset( $block_fields['cledd_iat_text'] ) ) ? $block_fields['cledd_iat_text'] : null;
$cledd_iat_link = ( isset( $block_fields['cledd_iat_link'] ) ) ? $block_fields['cledd_iat_link'] : null;
if($cledd_iat_link){
	$link_attribute = ' href="'.$cledd_iat_link.'" ';
} else {
	$link_attribute = null;
}

?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name. ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">

	<section class="section-workshops">
		<div class="container">
			<article class="workshop-block <?php echo $image_location_class; ?>">
				<div class="img-holder">
					<a <?php echo $link_attribute; ?>>
						<?php echo wp_get_attachment_image( $cledd_iat_image, 'full' ); ?>
					</a>
				</div>
				<div class="text-box">
					<?php if($cledd_iat_kicker){ ?>
					<h5><?php echo $cledd_iat_kicker; ?></h5>
					<?php } ?>
					<h3><a <?php echo $link_attribute; ?>><?php echo html_entity_decode($cledd_iat_title); ?></a></h3>
					<?php 
						if($cledd_iat_text){
							echo html_entity_decode($cledd_iat_text);
						}
					?>
				</div>
			</article>
		</div>
	</section>

</div>