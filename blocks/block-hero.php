<?php
/**
 * Block Name: Hero
 */


// Create id attribute allowing for custom "anchor" value.
$id = 'block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'block block-hero';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['backgroundColor']) ) {
    $className .= ' has-background has-' . $block['backgroundColor'] . '-background-color';
}
;?>

<?php 
// Varibles
$bgImage = get_field('background_image');
$titleImage = get_field('title_image');
$pageTitle = get_field('page_title');
$subtitle = get_field('subtitle');
$contentType = get_field('content_type');
$txtContent = get_field('text_content');
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    
    <div class="hero-wrapper">
        <div class="hero-content">
            <h1 class="hero-title"><?php echo esc_html($pageTitle) ;?></h1>
            <p class="hero-subtitle"><?php echo esc_html($subtitle) ;?></p>
        </div>

        <div class="hero-image">
            <?php if( !empty( $titleImage ) ): ?>
            <img src="<?php echo esc_url($titleImage['url']); ?>" alt="<?php echo esc_attr($titleImage['alt']); ?>" />
        </div>
    </div>

    <div class="hero-background">
        <?php if( !empty( $bgImage ) ): ?>
        <img src="<?php echo esc_url($bgImage['url']); ?>" alt="<?php echo esc_attr($bgImage['alt']); ?>" />
    </div>
</div>