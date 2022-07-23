<?php

namespace TheNameSpace\WordPressPluginBoilerplate\Core\Assets;

/**
 * Assets Class.
 * to manage static assets.
 */
class Assets {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
	}

	/**
	 * Register plugin assets.
	 *
	 * @since WPB_SINCE
	 *
	 * @return void
	 */
	public function register() {
		$driver_asset = require WPB_DIR . '/build/index.asset.php';
		wp_register_script(
			'wpb-js',
			plugins_url( 'build/index.js', WPB_FILE ),
			$driver_asset['dependencies'],
			$driver_asset['version'],
			true
		);
		wp_register_style(
			'wpb-css',
			plugins_url( 'build/index.css', WPB_FILE ),
			array(),
			$driver_asset['version']
		);
	}

	/**
	 * Enqueue admin scripts.
	 *
	 * @since WPB_SINCE
	 *
	 * @return void
	 */
	public function admin_enqueue() {
		if ( 'toplevel_page_wpb' === get_current_screen()->id ) {
			wp_enqueue_style( 'wpb-css' );
			wp_enqueue_script( 'wpb-js' );
			wp_enqueue_media();
		}
	}
}
