<?php
/**
 * Block Name: Accorion Heading
 *
 * Accordion Heading
 */

$allowed_blocks = array( 'core/paragraph','core/list');
$template = array(
	array('core/paragraph', array(
        'placeholder' => 'Enter Heading here.',
        'text-align' => 'left',
    )),
);

 // Create id attribute allowing for custom "anchor" value.
$id = $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'accordion-heading';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}


?>
<summary id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <?php echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />'; ?>

    <svg class="accordion-arrow" xmlns="http://www.w3.org/2000/svg" width="15.956" height="15.956" viewBox="0 0 15.956 15.956">
    <g id="Group_153" data-name="Group 153" transform="translate(0.707 15.956) rotate(-90)">
        <path id="Path_28" data-name="Path 28" d="M0,0V10.283H10.283" transform="translate(7.271 14.542) rotate(-135)" fill="none" stroke="#2d2c2c" stroke-width="2"/>
    </g>
    </svg>


</summary>
