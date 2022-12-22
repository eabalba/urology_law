<?php
/**
 * Block Name: Button
 *
 * Button block
 */

$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'block single-button-wrapper';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['textColor']) ) {
    $className .= ' has-text-color has-' . $block['textColor'] . '-color';
}
if( !empty($block['backgroundColor']) ) {
    $className .= ' has-background has-' . $block['backgroundColor'] . '-background-color';
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}



$link = get_field('button');
if( $link ): 
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
?>
<div class="<?php echo($className);?>">
    <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><span><?php echo esc_html( $link_title ); ?></span>
        <svg class="button-arrow" xmlns="http://www.w3.org/2000/svg" width="9.914" height="9.913" viewBox="0 0 9.914 9.913">
        <g id="Group_47" data-name="Group 47" transform="translate(-1134.77 718.703) rotate(-45)">
            <path id="Path_28" data-name="Path 28" d="M-17795.164-23149.789v8h8" transform="translate(5097.541 -28645.58) rotate(-135)" fill="none" stroke="#2d2c2c" stroke-width="1"/>
            <path id="Path_29" data-name="Path 29" d="M-17784.227-23144.789h-12.812" transform="translate(19101.133 23446)" fill="none" stroke="#2d2c2c" stroke-width="1"/>
        </g>
        </svg>
    </a>
</div>
<?php endif; ?>