<?php
/**
 * Block Name: Two Column Text
 *
 * The template for displaying the custom gutenberg block named Two Column Text.
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
$cledd_blk_tct_title 			= ( isset( $block_fields['cledd_blk_tct_title'] ) ) ? $block_fields['cledd_blk_tct_title'] : null;
$cledd_blk_tct_heading_location = ( isset( $block_fields['cledd_blk_tct_heading_location'] ) ) ? $block_fields['cledd_blk_tct_heading_location'] : null;
if($cledd_blk_tct_heading_location == 'Right'){
	$heading_location_class = ' two-column-heading-right ';
} else {
	$heading_location_class = ' two-column-heading-left ';
}
$cledd_blk_tct_bgcolor 			= ( isset( $block_fields['cledd_blk_tct_bgcolor'] ) ) ? $block_fields['cledd_blk_tct_bgcolor'] : null;
if($cledd_blk_tct_bgcolor == 'Blue'){
	$heading_bgcolor_class = ' two-column-bgcolor-blue ';
} else {
	$heading_bgcolor_class = ' two-column-bgcolor-red ';
}
$cledd_blk_tct_subheading 		= ( isset( $block_fields['cledd_blk_tct_subheading'] ) ) ? $block_fields['cledd_blk_tct_subheading'] : null;
$cledd_blk_tct_text 			= ( isset( $block_fields['cledd_blk_tct_text'] ) ) ? $block_fields['cledd_blk_tct_text'] : null;



?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name. ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">

	<?php if($cledd_blk_tct_title || $cledd_blk_tct_subheading || $cledd_blk_tct_text){ ?>
	<section class="section-content <?php echo $heading_location_class; ?><?php echo $heading_bgcolor_class; ?>">
		<div class="container">
			<div class="block-frame">
				<div class="block-holder">
					<h2 class="border"><?php echo $cledd_blk_tct_title; ?></h2>
				</div>
				<div class="block-holder">
					<?php if($cledd_blk_tct_subheading){ ?>
					<div class="paragraph-heading">
						<h3><?php echo $cledd_blk_tct_subheading; ?></h3>
					</div>
					<?php } ?>
					<?php 
						if($cledd_blk_tct_text){
							echo html_entity_decode($cledd_blk_tct_text);
						}
					?>
				</div>
			</div>
		</div>
	</section>
	<?php } ?>


</div>
