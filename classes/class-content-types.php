<?php

if( ! defined( 'ABSPATH' ) ) exit;

class Zlider_Content_Types
{
	function __construct()
	{
		// Init
		add_action( 'init', array( &$this, 'register_post_types' ) );
		add_action( 'init', array( &$this, 'register_taxonomies' ) );
	}

	/**
	 * Add post types for Asq
	 *
	 * @author 	Gijs Jorissen
	 * @since 	0.1
	 */
	function register_post_types() 
	{
		$labels = array(
		    'name' 					=> sprintf( _x( '%s', 'post type general name', 'zlider' ), 'Slides' ),
			'singular_name' 		=> sprintf( _x( '%s', 'post type singular title', 'zlider' ), 'Slide' ),
			'menu_name' 			=> sprintf( __( '%s', 'zlider' ), 'Slides' ),
			'all_items' 			=> sprintf( __( 'All %s', 'zlider' ), 'Slides' ),
			'add_new' 				=> sprintf( _x( 'Add New', '%s', 'zlider' ), 'Slide' ),
			'add_new_item' 			=> sprintf( __( 'Add New %s', 'zlider' ), 'Slide' ),
			'edit_item' 			=> sprintf( __( 'Edit %s', 'zlider' ), 'Slide' ),
			'new_item' 				=> sprintf( __( 'New %s', 'zlider' ), 'Slide' ),
			'view_item' 			=> sprintf( __( 'View %s', 'zlider' ), 'Slide' ),
			'items_archive'			=> sprintf( __( '%s Archive', 'zlider' ), 'Slide' ),
			'search_items' 			=> sprintf( __( 'Search %s', 'zlider' ), 'Slides' ),
			'not_found' 			=> sprintf( __( 'No %s found', 'zlider' ), 'Slides' ),
			'not_found_in_trash' 	=> sprintf( __( 'No %s found in trash', 'zlider' ), 'Slides' ),
			'parent_item_colon'		=> sprintf( __( '%s Parent', 'zlider' ), 'Slide' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => false,
			'rewrite'            => array( 'slug' => 'slide' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'supports'           => apply_filters( 'zlider_slide_supports', array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ) )
		);

		register_post_type( 'zlide', $args );
	}

	function register_taxonomies()
	{
		$labels = array(
			'name' 					=> sprintf( _x( '%s', 'taxonomy general name', 'zlider' ), 'Sliders' ),
			'singular_name' 		=> sprintf( _x( '%s', 'taxonomy singular name', 'zlider' ), 'Slider' ),
		    'search_items' 			=> sprintf( __( 'Search %s', 'zlider' ), 'Sliders' ),
		    'all_items' 			=> sprintf( __( 'All %s', 'zlider' ), 'Sliders' ),
		    'parent_item' 			=> sprintf( __( 'Parent %s', 'zlider' ), 'Slider' ),
		    'parent_item_colon' 	=> sprintf( __( 'Parent %s:', 'zlider' ), 'Slider' ),
		    'edit_item' 			=> sprintf( __( 'Edit %s', 'zlider' ), 'Slider' ), 
		    'update_item' 			=> sprintf( __( 'Update %s', 'zlider' ), 'Slider' ),
		    'add_new_item' 			=> sprintf( __( 'Add New %s', 'zlider' ), 'Slider' ),
		    'new_item_name' 		=> sprintf( __( 'New %s Name', 'zlider' ), 'Slider' ),
		    'menu_name' 			=> sprintf( __( '%s', 'zlider' ), 'Sliders' )
		);

		$args = array(
			'labels'             	=> $labels,
			'public'             	=> false,
			'publicly_queryable' 	=> false,
			'show_ui'            	=> true,
			'show_in_menu'       	=> true,
			'query_var'          	=> false,
			'rewrite'          		=> array( 'slug' => 'slider' ),
			'has_archive'        	=> false,
			'hierarchical'       	=> true,
		);

		register_taxonomy( 'zlider', array( 'zlide' ), $args );
	}
}