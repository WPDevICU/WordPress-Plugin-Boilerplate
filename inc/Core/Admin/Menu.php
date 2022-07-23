<?php

namespace TheNameSpace\WordPressPluginBoilerplate\Core\Admin;

/**
 * Dokan Driver Admin Menu class.
 *
 * We are setting admin page and submenu from here.
 */
class Menu {
	/**
	 * Dokan Driver Admin menu Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_menu', array( $this, 'add_admin_submenu' ) );
		add_action( 'admin_head', array( $this, 'cleanup_admin_notices' ), 1 );
	}

	/**
	 * Add menu to Admin Dashboard.
	 *
	 * @since WPB_SINCE
	 *
	 * @return void
	 */
	public function add_admin_menu() {
		add_menu_page(
			__( 'Dokan Driver Dashboard', 'wpb' ),
			__( 'Driver', 'wpb' ),
			'manage_options',
			'wpb',
			array( $this, 'display_dashboard' ),
			'dashicons-location-alt',
			40
		);
	}

	/**
	 * Add submenu to Admin Dashboard.
	 *
	 * @since WPB_SINCE
	 *
	 * @return void
	 */
	public function add_admin_submenu() {
		global $submenu;
		$base = admin_url( 'admin.php?page=wpb' );

		$all_submenus = array(
			array(
				__( 'Dashboard', 'wpb' ),
				'manage_options',
				$base . '#/dashboard',
			),
			array(
				__( 'Delivery', 'wpb' ),
				'manage_options',
				$base . '#/delivery',
			),
			array(
				__( 'Drivers', 'wpb' ),
				'manage_options',
				$base . '#/drivers',
			),
			array(
				__( 'Verification', 'wpb' ),
				'manage_options',
				$base . '#/verification',
			),
			array(
				__( 'Withdraw', 'wpb' ),
				'manage_options',
				$base . '#/withdraw',
			),
			array(
				__( 'Reports', 'wpb' ),
				'manage_options',
				$base . '#/reports',
			),
			array(
				__( 'Document Types', 'wpb' ),
				'manage_options',
				$base . '#/document-types',
			),
			array(
				__( 'Settings', 'wpb' ),
				'manage_options',
				$base . '#/settings',
			),
		);

		$all_submenus = apply_filters( 'WPB_dashboard_submenu', $all_submenus );

		if ( empty( $submenu['wpb'] ) ) {
			$submenu['wpb'] = array(); // phpcs:ignore.
		}

		array_push(
			$submenu['wpb'],
			...$all_submenus
		);
	}

	/**
	 * Display Dokan Driver Dashboard.
	 *
	 * @since WPB_SINCE
	 *
	 * @return void
	 */
	public function display_dashboard() {
		ob_start();
		include WPB_DIR . '/templates/admin/dashboard.php';
		echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Cleans admin notice.
	 *
	 * @since WPB_SINCE
	 *
	 * @return void
	 */
	public function cleanup_admin_notices(): void {
		if ( 'toplevel_page_wpb' === get_current_screen()->id ) {
			remove_all_actions( 'admin_notices' );
		}
	}
}
