<?php
/**
 * Block Name: Accorion Content
 *
 * Accordion Content
 */
$allowed_blocks = array( 'core/paragraph', 'core/list');
$template = array(
	array('core/paragraph', array(
        'placeholder' => 'Enter Content here.',
        'text-align' => 'left',
    )),
);

 // Create id attribute allowing for custom "anchor" value.
$id = $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'accordion-content';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $template ) ) . '" />'; ?>
</div>
