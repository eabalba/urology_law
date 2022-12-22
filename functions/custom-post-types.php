<?php 

// custom post type
function create_post_type_sidebar()
{
    register_post_type('main_sidebar', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Main Sidebar', 'sidebar'), // Rename these to suit
            'singular_name' => __('Sidebar Block', 'sidebar'),
            'add_new' => __('Add New Block', 'sidebar'),
            'add_new_item' => __('Add New Sidebar Blocks', 'sidebar'),
            'edit' => __('Edit', 'sidebar'),
            'edit_item' => __('Edit Sidebar Block', 'sidebar'),
            'new_item' => __('New Sidebar Block', 'sidebar'),
            'view' => __('View Sidebar Blocks', 'sidebar'),
            'view_item' => __('View Sidebar Block', 'sidebar'),
            'search_items' => __('Search Sidebar Blocks', 'sidebar'),
            'not_found' => __('No Sidebar Blocks found', 'sidebar'),
            'not_found_in_trash' => __('No Sidebar Blocks found in Trash', 'sidebar')
        ),
        'public' => true,
        'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => false,
        'supports' => array(
            'title',
            'editor',
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
		'show_in_rest' => true, // Add gutenberg
        'menu_icon'           => 'dashicons-welcome-widgets-menus',
    ));
}
add_action('init', 'create_post_type_sidebar');
