<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

function custom_post_type() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Resources', 'Post Type General Name', 'twentytwenty' ),
        'singular_name'       => _x( 'Resource', 'Post Type Singular Name', 'twentytwenty' ),
        'menu_name'           => __( 'Resources', 'twentytwenty' ),
        'parent_item_colon'   => __( 'Parent Resources', 'twentytwenty' ),
        'all_items'           => __( 'All Resources', 'twentytwenty' ),
        'view_item'           => __( 'View', 'twentytwenty' ),
        'add_new_item'        => __( 'Add New', 'twentytwenty' ),
        'add_new'             => __( 'Add New', 'twentytwenty' ),
        'edit_item'           => __( 'Edit', 'twentytwenty' ),
        'update_item'         => __( 'Update', 'twentytwenty' ),
        'search_items'        => __( 'Search', 'twentytwenty' ),
        'not_found'           => __( 'Not Found', 'twentytwenty' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwenty' ),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'Resources', 'twentytwenty' ),
        'description'         => __('We have the resources that will help you expand your business.', 'twentytwenty'),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'category' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
 
    );  
     
    // Registering your Custom Post Type
    register_post_type( 'resources', $args );
 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
add_action( 'init', 'custom_post_type', 0 );

add_action( 'pre_get_posts', 'add_my_post_types_to_query' );
 
function add_my_post_types_to_query( $query ) {
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'post' ) );
    return $query;
}

flush_rewrite_rules( false );

function register_custom_widget_area() {
    register_sidebar(
        array(
        'id' => 'resources',
        'name' => esc_html__( 'Resources', 'twentytwenty' ),
        'description' => esc_html__( 'A new widget area made for resources page', 'twentytwenty' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget-title-holder"><h3 class="widget-title">',
        'after_title' => '</h3></div>'
        )
    );
}
add_action( 'widgets_init', 'register_custom_widget_area' );

// Changing excerpt more
function new_excerpt_more($more) {
    global $post;
        return '… <a href="'. get_permalink($post->ID) . '"' . 'class="btn btn-warning read-more">' . 'Read More &raquo;' . '</a>';
    }

add_filter('excerpt_more', 'new_excerpt_more');
