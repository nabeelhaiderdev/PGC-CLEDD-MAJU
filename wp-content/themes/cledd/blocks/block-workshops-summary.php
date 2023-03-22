<?php
/**
 * Block Name: Workshops Summary
 *
 * The template for displaying the custom gutenberg block named Workshops Summary.
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
$cledd_blk_ws_title 	= ( isset( $block_fields['cledd_blk_ws_title'] ) ) ? $block_fields['cledd_blk_ws_title'] : null;
$cledd_blk_ws_workshops = ( isset( $block_fields['cledd_blk_ws_workshops'] ) ) ? $block_fields['cledd_blk_ws_workshops'] : null;
$cledd_blk_ws_button 	= ( isset( $block_fields['cledd_blk_ws_button'] ) ) ? $block_fields['cledd_blk_ws_button'] : null;

?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name. ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">

	<section class="section workshop-summary" id="workshops">
		<div class="container">
			<header class="section-header">
				<h3>
					<?php echo html_entity_decode($cledd_blk_ws_title); ?>
				</h3>
			</header>
			<?php if($cledd_blk_ws_workshops){ ?>
			<div class="workshop-grid">
				<?php foreach ($cledd_blk_ws_workshops as $workshop ) { ?>
				<div class="workshop-block">
					<a href="javascript:;" class="workshop-holder">
						<h4><?php echo $workshop['title']; ?></h4>
						<span class="duration"><?php echo $workshop['date']; ?></span>
					</a>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if( $cledd_blk_ws_button ) : ?>
			<div class="btn-block">
				<?php echo glide_acf_button( $cledd_blk_ws_button, 'btn btn-primary' ); ?>
			</div>
			<?php endif; ?>
		</div>
	</section>
</div>
