<?php
/**
 * Block Name: Column
 */
$allowed_blocks = array( 'core/paragraph');
$template = array(
	array('core/paragraph'),
);

// Create id attribute allowing for custom "anchor" value.
$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'block block-inner block-column';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['textColor']) ) {
    $className .= ' has-text-color has-' . $block['textColor'] . '-color';
}
if( !empty($block['backgroundColor']) ) {
    $className .= ' has-background has-' . $block['backgroundColor'] . '-background-color';
}
if( !empty($block['alignContent']) ) {
    $className .= ' alignContent' . $block['alignContent'];
}

$colWidth = get_field('column_width');
if( $colWidth ) : ;?>
<?php
    $className .= ' custom-width-' . $colWidth;
?>
<?php endif ;?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="flex-basis: <?php echo($colWidth) ;?>%">
    <?php echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $template ) ) . '" />'; ?>
</div>