<?php

/*
Plugin Name: 	Zlider
Plugin URI: 	http://github.com/gizburdt
Description: 	Bare slider plugin
Version: 		0.1
Author: 		Gizburdt
Author URI: 	http://gizburdt.com
License: 		GPL2
*/

if( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'Zlider' ) ) :

/**
 * Aqs
 */
class Zlider
{
	private static $instance;

	public static function instance()
	{
		if ( ! isset( self::$instance ) ) 
		{
			self::$instance = new Zlider;
			self::$instance->setup_constants();
			self::$instance->includes();
			self::$instance->add_hooks();
			self::$instance->execute();
		}
		
		return self::$instance;
	}

	function setup_constants()
	{
		if( ! defined( 'ZLIDER_VERSION' ) ) 
			define( 'ZLIDER_VERSION', '0.1' );

		if( ! defined( 'ZLIDER_DIR' ) ) 
			define( 'ZLIDER_DIR', plugin_dir_path( __FILE__ ) );

		if( ! defined( 'ZLIDER_URL' ) ) 
			define( 'ZLIDER_URL', plugin_dir_url( __FILE__ ) );
	}

	function includes()
	{
		include( ZLIDER_DIR . 'classes/class-content-types.php' );
		include( ZLIDER_DIR . 'classes/class-shortcodes.php' );
	}

	function add_hooks()
	{
		// Styles
		add_action( 'wp_enqueue_scripts',	array( &$this, 'register_styles' ) );
		add_action( 'wp_enqueue_scripts', 	array( &$this, 'enqueue_styles' ) );
		
		// Scripts
		add_action( 'wp_enqueue_scripts', 	array( &$this, 'register_scripts' ) );
		add_action( 'wp_enqueue_scripts', 	array( &$this, 'enqueue_scripts' ) );
	}

	function execute()
	{
		self::$instance->content_types 		= new Zlider_Content_Types;
		self::$instance->shortcodes 		= new Zlider_Shortcodes;
	}

	function register_styles()
	{		
		wp_register_style( 'zlider', ZLIDER_URL . 'assets/css/zlider.css', false, ZLIDER_VERSION, 'screen' );
	}

	function enqueue_styles()
	{
		wp_enqueue_style( 'zlider' );
	}

	function register_scripts()
	{
		wp_register_script( 'zlider', ZLIDER_URL . 'assets/js/zlider.js', null, ZLIDER_VERSION );
	}
	
	function enqueue_scripts()
	{
		wp_enqueue_script( 'zlider' );
		
		self::localize_scripts();
	}

	function localize_scripts()
	{
		wp_localize_script( 'zlider', 'Zlider', array(
			'home_url'			=> get_home_url(),
			'ajax_url'			=> admin_url( 'admin-ajax.php' ),
			'wp_version'		=> get_bloginfo( 'version' )
		) );
	}
}

endif; // End class_exists check

Zlider::instance();