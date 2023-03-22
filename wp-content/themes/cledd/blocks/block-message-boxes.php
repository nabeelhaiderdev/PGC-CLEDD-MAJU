<?php
/**
 * Block Name: Message Boxes
 *
 * The template for displaying the custom gutenberg block named Message Boxes.
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
$cledd_blk_mb_message_boxes = ( isset( $block_fields['cledd_blk_mb_message_boxes'] ) ) ? $block_fields['cledd_blk_mb_message_boxes'] : null;


?>
<div id="<?php echo $id; ?>"
	class="<?php echo $align_class . ' ' . $class_name. ' ' . $name; ?> glide-block-<?php echo $block_glide_name; ?>">

	<?php if($cledd_blk_mb_message_boxes){ ?>
	<section class="section testimonials" id="message">
		<div class="container">
			<div class="testimonial-grid">
				<?php foreach ($cledd_blk_mb_message_boxes as $mbox ) {
					$mbox_designation = $mbox['designation'];
					$mbox_institute = $mbox['institute'];
					$mbox_message = $mbox['message'];
					$mbox_name = $mbox['name'];
					$mbox_email = $mbox['email'];
					?>
				<div class="testimonail-block">
					<div class="block-holder">
						<div class="block-frame">
							<header class="block-header">
								<h5>Message From</h5>
								<h3><?php echo $mbox_designation; ?></h3>
								<h5><?php echo $mbox_institute; ?></h5>
							</header>
							<div class="message-block">
								<?php 
									if($mbox_message){
										echo html_entity_decode($mbox_message);
									}
								?>
							</div>
						</div>
						<div class="btn-block">
							<span class="btn btn-primary"><?php echo $mbox_name; ?>
								<span><?php echo $mbox_email; ?></span>
							</span>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</section>
	<?php } ?>

</div>
