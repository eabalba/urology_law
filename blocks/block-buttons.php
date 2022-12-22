<?php

$allowed_blocks = array('acf/button', 'core/paragraph');
$template = array(
	array('acf/button'),
    array('acf/button'),
);

 // Create id attribute allowing for custom "anchor" value.
$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'block buttons';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
if( !empty($block['textColor']) ) {
    $className .= ' has-text-color has-' . $block['textColor'] . '-color';
}
if( !empty($block['backgroundColor']) ) {
    $className .= ' has-background has-' . $block['backgroundColor'] . '-background-color';
}

$grpWidth = get_field('block_width');
?>
<div class="button-wrapper <?php echo($className);?>" style = "<?php if($grpWidth) : ;?>max-width: calc(<?php echo($grpWidth);?>% + var(--space-gap))<?php endif;?>">
    <?php echo '<InnerBlocks allowedBlocks="' . esc_attr( wp_json_encode( $allowed_blocks ) ) . '" template="' . esc_attr( wp_json_encode( $template ) ) . '" />'; ?>
</div>