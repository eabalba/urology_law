<?php
/* ----- Set up ----- */
function custom_setup()
{

    load_theme_textdomain('custom', get_template_directory() . '/languages'); // Localisation Support

    add_theme_support('title-tag'); //allows Yoast to manage title tags

    //add_theme_support( 'automatic-feed-links' ); // Enables post and comment RSS feed links to head

    add_theme_support( 'custom-logo' );

    add_theme_support('post-thumbnails');
    //add_theme_support( 'post-thumbnails', array( 'post' ) ); // Posts only

    add_image_size('large', 1280, '', true); // Large Thumbnail
    add_image_size('medium_large', 1024, '', true); // Small Thumbnail
    add_image_size('medium', 786, '', true); // Medium Thumbnail
    add_image_size('small', 300, '', true); // Small Thumbnail
    add_image_size('medium-square', 768, 768, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');
    
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script')); //This feature allows the use of HTML5 markup for the search forms, comment forms, comment lists, gallery, and caption.

    // Gutenberg theme support
    //add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
   

    //cleanup header
    remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
    remove_action('wp_head', 'wp_generator'); // remove wordpress version
    remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
    remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
    remove_action('wp_head', 'index_rel_link'); // remove link to index page
    remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
    remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
    remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); // Remove shortlink (google ignores it so it's pointless)

 
}
add_action('after_setup_theme', 'custom_setup');

add_filter('xmlrpc_enabled', '__return_false'); //Disable xmlrpc.php (for security)



//change logo class
function change_logo_class( $html ) {

    $html = str_replace( 'custom-logo', 'logo', $html );
    $html = str_replace( 'custom-logo-link', 'logo__link', $html );

    return $html;
}

/* ----- Disable Emoji mess ----- */
function disable_wp_emojicons()
{
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    //add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
    add_filter('emoji_svg_url', '__return_false');
}
add_action('init', 'disable_wp_emojicons');

/* ----- Remove comments ----- */
// Removes from admin menu
function my_remove_admin_menus()
{
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'my_remove_admin_menus');

// Removes from post and pages
function remove_comment_support()
{
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
}
add_action('init', 'remove_comment_support', 100);

// Removes from admin bar
function mytheme_admin_bar_render()
{
    global $wp_admin_bar;

    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'mytheme_admin_bar_render');

/* ----- Enqueue stylesheet  & js ----- */
function enqueue_scripts_styles()
{
    wp_dequeue_style( 'wc-blocks-style' );
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_register_style('gfonts', 'https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Open+Sans:wght@400;700&display=swap', [], null);
    wp_enqueue_style('gfonts');
    wp_enqueue_style('b9-css', get_template_directory_uri() . '/assets/css/style.min.css');

    wp_deregister_script('jquery');
    wp_enqueue_script('functions-js', get_template_directory_uri() . '/assets/functions.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_scripts_styles');

add_action( 'wp_enqueue_scripts', 'dashicons_front_end' );

function dashicons_front_end() {

   wp_enqueue_style( 'dashicons' );

}

/* ----- Add reusable blocks to dash ----- */
function be_reusable_blocks_admin_menu()
{
    add_menu_page('Reusable Blocks', 'Reusable Blocks', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22);
}
add_action('admin_menu', 'be_reusable_blocks_admin_menu');

/* ----- Add MIME type for SVG uploads. ----- */
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/* -----  Create menus ----- */
function register_my_menu()
{
    register_nav_menu('main-menu', __('Main Menu'));
    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('init', 'register_my_menu');

// Dislay menus with shortcode
function print_menu_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array('name' => null, 'class' => null), $atts));
    return wp_nav_menu(array('menu' => $name, 'echo' => false));
}

add_shortcode('menu', 'print_menu_shortcode');

/* -----  Create widget area (Sidebar) ----- */
function wpdocs_theme_slug_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'post-sidebar', 'textdomain' ),
        'id'            => 'post-sidebar',
        'description'   => __( 'Widgets in this area will be shown on all posts.', 'textdomain' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'wpdocs_theme_slug_widgets_init' );

/* ----- Gutenberg ----- */
// Add custom editor font sizes
add_theme_support(
    'editor-font-sizes',
    array(
        array(
            'name'      => esc_html__('Small', 'bamboonine'),
            'shortName' => esc_html_x('S', 'Font size', 'bamboonine'),
            'size'      => 12,
            'slug'      => 's',
        ),
        array(
            'name'      => esc_html__('Normal', 'bamboonine'),
            'shortName' => esc_html_x('N', 'Font size', 'bamboonine'),
            'size'      => 16,
            'slug'      => 'default',
        ),
        array(
            'name'      => esc_html__('Large', 'bamboonine'),
            'shortName' => esc_html_x('L', 'Font size', 'bamboonine'),
            'size'      => 24,
            'slug'      => 'l',
        ),
        array(
            'name'      => esc_html__('Extra Large', 'bamboonine'),
            'shortName' => esc_html_x('XL', 'Font size', 'bamboonine'),
            'size'      => 32,
            'slug'      => 'xl',
        ),
        array(
            'name'      => esc_html__('XXL', 'bamboonine'),
            'shortName' => esc_html_x('XXL', 'Font size', 'bamboonine'),
            'size'      => 40,
            'slug'      => 'xxl',
        ),
        array(
            'name'      => esc_html__('XXXL', 'bamboonine'),
            'shortName' => esc_html_x('XXXL', 'Font size', 'bamboonine'),
            'size'      => 48,
            'slug'      => 'xxxl',
        ),
    )
);

/* Customiser modifications */
function customize_additional_settings($wp_customize) {
    /* Add settings for the site colours */
    $wp_customize->add_setting('bn_primary_color', array(
      'default' => '#009ca6',
    ));
    $wp_customize->add_setting('bn_secondary_color', array(
      'default' => '#003e42',
    ));
    $wp_customize->add_setting('bn_tertiary_color', array(
      'default' => '#003e42',
    ));
    $wp_customize->add_setting('bn_text_color', array(
      'default' => '#474747',
    ));
    $wp_customize->add_setting('bn_light_grey', array(
      'default' => '#f3f3f6',
    ));
    $wp_customize->add_setting('bn_dark_grey', array(
      'default' => '#474747',
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bn_primary_color', array(
        'label' => 'Primary Color',
        'section' => 'title_tagline',
        'settings' => 'bn_primary_color',
  
    )));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bn_secondary_color', array(
        'label' => 'Secondary Color',
        'section' => 'title_tagline',
        'settings' => 'bn_secondary_color',
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bn_text_color', array(
      'label' => 'Text Color',
      'section' => 'title_tagline',
      'settings' => 'bn_text_color',
  )));
      $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bn_light_grey', array(
          'label' => 'Light Grey',
          'section' => 'title_tagline',
          'settings' => 'bn_light_grey',
      )));
      $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bn_dark_grey', array(
          'label' => 'Dark Grey',
          'section' => 'title_tagline',
          'settings' => 'bn_dark_grey',
      )));
  }
  
  add_action('customize_register', 'customize_additional_settings');
  
  /* Create a custom colour object */
  $colours = (object) [
      "primary" => get_theme_mod('bn_primary_color', '#009ca6'),
      "secondary" => get_theme_mod('bn_secondary_color', '#003e42'),
      "text" => get_theme_mod('bn_text_color', '#474747'),
      "white" => "#ffffff",
      "lgrey" => get_theme_mod('bn_light_grey', '#f3f3f6'),
      "dgrey" => get_theme_mod('bn_dark_grey', '#474747'),
      "black" => "#000000"
      
  ];
  
  add_action('wp_head', function ($args) use ($colours) {my_custom_styles($colours);}, 1);
  
  /* add css file with colours to the head */
  function my_custom_styles($colours)
  {
    echo "
    <style>
      :root{
        --color-primary:" . $colours->primary . ";
        --color-secondary:" . $colours->secondary . ";
        --color-body:" . $colours->text . ";
        --color-white:" . $colours->white . ";
        --color-lgrey:" . $colours->lgrey . ";
        --color-dgrey:" . $colours->dgrey . ";
        --color-black:" . $colours->black . ";
      }
    </style>
   ";
  }
  
  /* Add custom colours to gutenberg editor */
  add_theme_support('editor-color-palette', array(
      array(
          'name' => esc_html__('Primary', 'bamboonine'),
          'slug' => 'primary',
          'color' => $colours->primary,
      ),
      array(
          'name' => esc_html__('Secondary', 'bamboonine'),
          'slug' => 'secondary',
          'color' => $colours->secondary,
      ),
      array(
          'name'  => esc_html__('White', 'bamboonine'),
          'slug'  => 'white',
          'color' => $colours->white,
      ),
      array(
          'name'  => esc_html__('Light Grey', 'bamboonine'),
          'slug'  => 'lgrey',
          'color' => $colours->lgrey,
      ),
      array(
          'name'  => esc_html__('Dark grey', 'bamboonine'),
          'slug'  => 'dgrey',
          'color' => $colours->dgrey,
      ),
      array(
          'name'  => esc_html__('Black', 'bamboonine'),
          'slug'  => 'black',
          'color' => $colours->black,
      ),
  
    )
  );
  
  
  //Get the colors formatted for use with gutenberg editor palette
  function output_the_colors()
  {
  
      // get the colors
      $color_palette = current((array) get_theme_support('editor-color-palette'));
  
      // bail if there aren't any colors found
      if (!$color_palette) {
          return;
      }
  
      // output begins
      ob_start();
  
      // output the names in a string
      echo '[';
      foreach ($color_palette as $color) {
          echo "'" . $color['color'] . "', ";
      }
      echo ']';
  
      return ob_get_clean();
  
  }
  
  //Add the colors into ACF
  function gutenberg_sections_register_acf_color_palette()
  {
  
      $color_palette = output_the_colors();
      if (!$color_palette) {
          return;
      }
  
      ?>
      <script type="text/javascript">
          (function( $ ) {
              acf.add_filter( 'color_picker_args', function( args, $field ){
  
                  // add the hexadecimal codes here for the colors you want to appear as swatches
                  args.palettes = <?php echo $color_palette; ?>
  
                  // return colors
                  return args;
  
              });
          })(jQuery);
      </script>
      <?php
  }

add_action('acf/input/admin_footer', 'gutenberg_sections_register_acf_color_palette');

/* ----- Pagination ----- */
function bnine_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
        'format'    => '?paged=%#%',
        'current'   => max(1, get_query_var('paged')),
        'total'     => $wp_query->max_num_pages,
        'next_text' => '→',
        'prev_text' => '←',
        'mid_size'  => 5,
    ));
}

/* ----- Excerpts ----- */
// create get_excerpt function allowing you to customise excerpt length
function get_excerpt($limit, $source = null)
{

    if ($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = preg_replace(" (\[.*?\])", '', $excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace('/\s+/', ' ', $excerpt));
    $excerpt = $excerpt . '...';
    return $excerpt;
}

// Changing excerpt 'more' (amends gutenberg's 'latest post' excerpt output)
function new_excerpt_more($more)
{
    global $post;
    return '…';
}
add_filter('excerpt_more', 'new_excerpt_more');

/* ----- LOGIN ----- */
//--styles login page
function custom_login_logo()
{
    echo '<style type="text/css">h1 a { background: url(' . get_bloginfo('template_directory') . '/assets/img/logo_bamboo-nine.svg) 50% 50% no-repeat !important; background-size: contain!important; width: auto!important;}</style>';
}
add_action('login_head', 'custom_login_logo');

//--Change link of logo from login page
function loginpage_custom_link()
{
    return 'https://www.bamboonine.co.uk/';
}
add_filter('login_headerurl', 'loginpage_custom_link');

//--Change tooltip of logo from login page
function change_title_on_logo(){
    return 'Built by Bamboo Nine';
}
add_filter('login_headertitle', 'change_title_on_logo');


add_theme_support('editor-column-number', array(
    array(
        'name' => esc_html__('1', 'bamboonine'),
        'slug' => 'one-column',
        'columns' => 1,
    ),
    array(
        'name' => esc_html__('2', 'bamboonine'),
        'slug' => 'two-column',
        'columns' => 2,
    ),
    array(
        'name' => esc_html__('3', 'bamboonine'),
        'slug' => 'three-column',
        'columns' => 3,
    ),
    array(
        'name'  => esc_html__('4', 'bamboonine'),
        'slug'  => 'four-column',
        'columns' => 4,
    ),
  )
);

add_action( 'enqueue_block_editor_assets', function() {
    wp_enqueue_style( 'editor-styles', get_stylesheet_directory_uri() . "/assets/editor.css", false, '1.0', 'all' );
} );



function add_last_nav_item($last, $footer) {
    if ($footer->theme_location == 'footer-menu' ){
        $last .= '<li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item footer-credits made-by-bnine">Website by &nbsp<a href="https://www.bamboonine.co.uk/"><b>Bamboo Nine</b></a></li>';
     }
     return $last;
   
  }
  add_filter('wp_nav_menu_items','add_last_nav_item', 10, 2);

function add_first_nav_item($first, $footer) {
    if ($footer->theme_location == 'footer-menu' ){
       $first = '<li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item footer-credits copyright">© Urology Law 2022</li>'.$first;
    }
    return $first;
}
add_filter('wp_nav_menu_items','add_first_nav_item', 10, 2);

/*Adding Options Testimonials*/
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Testimonials',
        'menu_title'    => 'Testimonials',
        'menu_slug'     => 'testimonials',
        'capability'    => 'edit_posts',
        'icon_url'      => 'dashicons-welcome-write-blog',
        'position'      => 21,
        'redirect'      => false,
    ));
}


