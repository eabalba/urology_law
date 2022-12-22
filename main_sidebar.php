<?php
$args = array(
    'post_type' => 'main_sidebar',
    'post_status' => 'publish',
    'posts_per_page' => -1
);
global $mainSidebar = new WP_Query( $args );
if ( $posts -> have_posts() ) {
    while ( $posts -> have_posts() ) {

        the_content();
        // Or your video player code here

    }
}
wp_reset_query();
?>