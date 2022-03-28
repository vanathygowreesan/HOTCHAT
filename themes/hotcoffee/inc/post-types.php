<?php
/**
 * Functions which enhance the theme by creating custom post types
 * @package Fresh_Coffee
 */

function hotcoffee_post_types() {
    $labels = array(
        'name'                  => _x( 'Recipes', 'Post type general name', 'hotcoffee'),
        'singular_name'         => _x( 'Recipe', 'Post type singular name', 'hotcoffee'),
        'menu_name'             => _x( 'Recipes', 'Admin Menu text', 'hotcoffee'),
        'name_admin_bar'        => _x( 'Recipe', 'Add New on Toolbar', 'hotcoffee'),
        'add_new'               => __( 'Add New', 'hotcoffee'),
        'add_new_item'          => __( 'Add New recipe', 'hotcoffee'),
        'new_item'              => __( 'New recipe', 'hotcoffee'),
        'edit_item'             => __( 'Edit recipe', 'hotcoffee'),
        'view_item'             => __( 'View recipe', 'hotcoffee'),
        'all_items'             => __( 'All recipes', 'hotcoffee'),
        'search_items'          => __( 'Search recipes', 'hotcoffee'),
        'parent_item_colon'     => __( 'Parent recipes:', 'hotcoffee'),
        'not_found'             => __( 'No recipes found.', 'hotcoffee'),
        'not_found_in_trash'    => __( 'No recipes found in Trash.', 'hotcoffee'),
        'featured_image'        => _x( 'Recipe Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'hotcoffee'),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'hotcoffee'),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'hotcoffee'),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'hotcoffee'),
        'archives'              => _x( 'Recipe archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'hotcoffee'),
        'insert_into_item'      => _x( 'Insert into recipe', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'hotcoffee'),
        'uploaded_to_this_item' => _x( 'Uploaded to this recipe', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'hotcoffee'),
        'filter_items_list'     => _x( 'Filter recipes list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'hotcoffee'),
        'items_list_navigation' => _x( 'Recipes list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'hotcoffee'),
        'items_list'            => _x( 'Recipes list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'hotcoffee'),
    );     
    $args = array(
        'labels'             => $labels,
        'description'        => 'Recipe custom post type.',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'recipe'),
        'capability_type'    => 'post',
        'has_archive'        => 'recipes',
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
        'taxonomies'         => array( 'category', 'post_tag' ),
        'show_in_rest'       => true
    );
      
    register_post_type( 'hotcofee_recipe', $args );
}
add_action( 'init', 'hotcoffee_post_types' );