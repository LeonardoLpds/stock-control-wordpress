<?php

add_action( 'init', 'create_post_type_product' );
add_action( 'init', 'create_post_type_client' );

/**
* Creating post type Product
*/
function create_post_type_product() {
    register_post_type( 'product',
        array(
            'labels' => array(
                'name' => _x('Products', 'post type general name'),
                'singular_name' => _x('Product', 'post type singular name'),
                'add_new' => _x('Add New', 'product'),
                'add_new_item' => __('Add New Product'),
                'edit_item' => __('Edit Product'),
                'new_item' => __('New Product'),
                'all_items' => __('All Products'),
                'view_item' => __('View Product'),
                'search_items' => __('Search Products'),
                'not_found' =>  __('No Products found'),
                'not_found_in_trash' => __('No Products found in Trash'),
                'parent_item_colon' => '',
                'menu_name' => 'Products'
            ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_icon' => 'dashicons-products',
            'has_archive' => 'products',
            'rewrite' => array(
                'slug' => 'products',
                'with_front' => false,
            ),
            'menu_position' => 5,
            'capability_type' => 'post',
            'supports' => array('title')
        )
    );
}

/**
* Creating post type Client
*/
function create_post_type_client() {
    register_post_type( 'client',
        array(
            'labels' => array(
                'name' => _x('Clients', 'post type general name'),
                'singular_name' => _x('Client', 'post type singular name'),
                'add_new' => _x('Add New', 'client'),
                'add_new_item' => __('Add New Client'),
                'edit_item' => __('Edit Client'),
                'new_item' => __('New Client'),
                'all_items' => __('All Clients'),
                'view_item' => __('View Client'),
                'search_items' => __('Search Clients'),
                'not_found' =>  __('No Clients found'),
                'not_found_in_trash' => __('No Clients found in Trash'),
                'parent_item_colon' => '',
                'menu_name' => 'Clients'
            ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_icon' => 'dashicons-id',
            'has_archive' => 'clients',
            'rewrite' => array(
                'slug' => 'clients',
                'with_front' => false,
            ),
            'menu_position' => 5,
            'capability_type' => 'post',
            'supports' => array('title')
        )
    );
}