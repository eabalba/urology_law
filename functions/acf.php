<?php

// Custom gutenberg block category
 function add_custom_gutenberg_category($categories){
    return array_merge($categories, array(
        array(
            'slug' => 'bamboo_nine',
            'title' => __('Bamboo Nine', 'bamboo_nine'),
            'icon' => 'null'
        )
    ));
}
add_filter('block_categories', 'add_custom_gutenberg_category', 10, 2);

// Register ACF fields  
function my_acf_init() {
    // check function exists
    if( function_exists('acf_register_block') ) {
        // register an accordion block

        acf_register_block(array(
            'name'              => 'button',
            'title'             => __('Button'),
            'description'       => __('A button with link.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'bamboo_nine',
            'icon'              => 'button',
            'keywords'          => array( 'button', 'link'),
            'mode'              => 'preview',
            'supports'		=> [
                'align' => true, // full or wide 
                'anchor'=> true,
                'jsx' 			=> true, //allows gutenberg blocks inside the custom acf block
                'color'	=> [
                    'gradients' => false
                ]
            ]
        )); 
        acf_register_block(array(
            'name'              => 'buttons',
            'title'             => __('Button Group'),
            'description'       => __('A group of buttons.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'bamboo_nine',
            'icon'              => 'button',
            'keywords'          => array( 'buttons', 'link', 'button'),
            'mode'              => 'preview',
            'supports'		=> [
                'align' => true, // full or wide 
                'anchor'=> true,
                'jsx' 			=> true, //allows gutenberg blocks inside the custom acf block
                'color'	=> [
                    'gradients' => false
                ]
            ]
        )); 
        acf_register_block(array(
            'name'              => 'columns',
            'title'             => __('Columns'),
            'description'       => __('Add a columns'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'bamboo_nine',
            'icon'              => 'columns',
            'keywords'          => array( 'columns' ),
            'mode'              => 'preview',
            'supports'		=> [
                'align' => false, // full or wide 
                'anchor'=> true,
                'jsx' 			=> true, //allows gutenberg blocks inside the custom acf block
                'color'	=> [
                    'gradients' => false,
                ],          
            ]
           
        )); 
        acf_register_block(array(
            'name'              => 'column',
            'title'             => __('Column'),
            'description'       => __('Add a column inside columns'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'bamboo_nine',
            'icon'              => 'column',
            'keywords'          => array( 'column' ),
            'mode'              => 'preview',
            'supports'		=> [
                'align' => false, // full or wide 
                'alignContent' => true,
                'anchor'=> true,
                'jsx' 			=> true, //allows gutenberg blocks inside the custom acf block
                'color'	=> [
                    'gradients' => false,
                ],          
            ]
           
        )); 
        acf_register_block(array(
            'name'              => 'group',
            'title'             => __('Group'),
            'description'       => __('Group'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'bamboo_nine',
            'icon'              => 'text',
            'keywords'          => array( 'group' ),
            'mode'              => 'preview',
            'supports'		=> [
                'align' => true, // full or wide 
                'anchor'=> true,
                'jsx' 			=> true, //allows gutenberg blocks inside the custom acf block
                'color'	=> [
                    'gradients' => false,
                ],          
            ]
           
        )); 

        acf_register_block(array(
            'name'              => 'accordion',
            'title'             => __('Accordion'),
            'description'       => __('Add an accordion'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'bamboo_nine',
            'icon'              => 'admin-collapse',
            'keywords'          => array( 'accordion' ),
            'mode'              => 'preview',
            'multiple'          => true,
            'supports'		=> [
                'align' => true, // full or wide 
                'anchor'=> true,
                'jsx' 			=> true, //allows gutenberg blocks inside the custom acf block
                'color'	=> [
                    'gradients' => false,
                ],          
            ]
           
        )); 
        acf_register_block(array(
            'name'              => 'accordion-details',
            'title'             => __('Accordion Details'),
            'description'       => __('Enter accordion details'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'bamboo_nine',
            'icon'              => 'admin-collapse',
            'keywords'          => array( 'accordion', 'details'),
            'mode'              => 'preview',
            'supports'		=> [
                'align' => true, // full or wide 
                'anchor'=> true,
                'jsx' 			=> true, //allows gutenberg blocks inside the custom acf block
                'color'	=> [
                    'gradients' => false,
                ],          
            ]
           
        )); 
        acf_register_block(array(
            'name'              => 'accordion-heading',
            'title'             => __('Accordion Heading'),
            'description'       => __('Enter accordion heading'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'bamboo_nine',
            'icon'              => 'admin-collapse',
            'keywords'          => array( 'accordion', 'heading', 'title' ),
            'mode'              => 'preview',
            'supports'		=> [
                'align' => true, // full or wide 
                'anchor'=> true,
                'jsx' 			=> true, //allows gutenberg blocks inside the custom acf block
                'color'	=> [
                    'gradients' => false,
                ],          
            ]
           
        )); 
        acf_register_block(array(
            'name'              => 'accordion-content',
            'title'             => __('Accordion Content'),
            'description'       => __('Enter accordion content'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'bamboo_nine',
            'icon_url'          => 'admin-collapse',
            'keywords'          => array( 'accordion', 'content'),
            'mode'              => 'preview',
            'supports'		=> [
                'align' => true, // full or wide 
                'anchor'=> true,
                'jsx' 			=> true, //allows gutenberg blocks inside the custom acf block
                'color'	=> [
                    'gradients' => false,
                ],          
            ]
           
        )); 
        acf_register_block(array(
            'name'              => 'image',
            'title'             => __('Image'),
            'description'       => __('Upload an Image'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'bamboo_nine',
            'icon_url'          => 'image',
            'keywords'          => array( 'image', 'picture', 'gallery' ),
            'mode'              => 'preview',
            'supports'		=> [
                'align' => true, // full or wide 
                'anchor'=> true,
                'jsx' 			=> true, //allows gutenberg blocks inside the custom acf block
                'color'	=> [
                    'gradients' => false,
                ],          
            ]
           
        )); 
        acf_register_block(array(
            'name'              => 'hero',
            'title'             => __('Hero'),
            'description'       => __('Hero Banner with background image and title'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'bamboo_nine',
            'icon'              => 'image',
            'keywords'          => array( 'cover', 'hero', 'banner' ),
            'mode'              => 'preview',
            'supports'		=> [
                'align' => true, // full or wide 
                'anchor'=> true,
                'jsx' 			=> true, //allows gutenberg blocks inside the custom acf block
                'color'	=> [
                    'gradients' => false,
                ],          
            ]
           
        )); 
        acf_register_block(array(
            'name'              => 'testimonials',
            'title'             => __('Testimonials'),
            'description'       => __('Display testimonials in a slider'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'bamboo_nine',
            'icon'              => 'image',
            'keywords'          => array( 'testimonial', 'review' ),
            'mode'              => 'preview',
            'supports'		=> [
                'align' => true, // full or wide 
                'anchor'=> true,
                'jsx' 			=> true, //allows gutenberg blocks inside the custom acf block
                'color'	=> [
                    'gradients' => false,
                ],          
            ]
           
        )); 
    }
}
add_action('acf/init', 'my_acf_init');  

//render ACF fields
function my_acf_block_render_callback( $block ) {
    // convert name ("acf/testimonials") into path friendly slug ("testimonials")
    $slug = str_replace('acf/', '', $block['name']);
    // include a template part from within the "template-parts/block" folder
    if( file_exists( get_theme_file_path("/blocks/block-{$slug}.php") ) ) {
        include( get_theme_file_path("/blocks/block-{$slug}.php") );
    }
}