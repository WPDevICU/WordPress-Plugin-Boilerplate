<?php

namespace TheNameSpace\WordPressPluginBoilerplate;

use Psr\Container\ContainerInterface;
use TheNameSpace\WordPressPluginBoilerplate\Controllers\AdminController;
use TheNameSpace\WordPressPluginBoilerplate\Controllers\ApiController;
use TheNameSpace\WordPressPluginBoilerplate\Controllers\InstallController;
use TheNameSpace\WordPressPluginBoilerplate\Providers\AdminServiceProvider;
use TheNameSpace\WordPressPluginBoilerplate\Providers\ApiServiceProvider;
use TheNameSpace\WordPressPluginBoilerplate\Providers\ControllerServiceProvider;
use TheNameSpace\WordPressPluginBoilerplate\Providers\InstallServiceProvider;

/**
 * WordPress Plugin Boilerplate Class.
 *
 * @since WPB_SINCE
 */
final class WordPressPluginBoilerplate {

	/**
	 * The single instance of the class
	 *
	 * @since WPB_SINCE
	 *
	 * @var WordPressPluginBoilerplate
	 */
	private static $instance;

	/**
	 * Plugin version
	 *
	 * @since WPB_SINCE
	 *
	 * @var string
	 */
	public const VERSION = '1.0.0';

	/**
	 * Plugin version
	 *
	 * @since WPB_SINCE
	 *
	 * @var ContainerInterface
	 */
	private $container;


	/**
	 * Get the single instance of the class
	 *
	 * @since WPB_SINCE
	 *
	 * @return WordPressPluginBoilerplate
	 */
	public static function get_instance(): WordPressPluginBoilerplate {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @since WPB_SINCE
	 *
	 * @access private
	 */
	private function __construct() {
		$this->container = new Container();
		$this->add_service_providers();
		register_activation_hook( WPB_FILE, array( $this->container()->get( InstallController::class ), 'run' ) );

		add_action( 'plugins_loaded', array( $this, 'set_controllers' ) );
	}

	/**
	 * Add service providers.
	 *
	 * @since WPB_SINCE
	 *
	 * @return void
	 */
	protected function add_service_providers() {
		$this->container->addServiceProvider( new ControllerServiceProvider() );
		$this->container->addServiceProvider( new InstallServiceProvider() );
		$this->container->addServiceProvider( new AdminServiceProvider() );
		$this->container->addServiceProvider( new ApiServiceProvider() );
	}

	/**
	 * Delivery Driver Container.
	 *
	 * @return ContainerInterface
	 */
	public function container(): ContainerInterface {
		return $this->container;
	}

	/**
	 * Set controllers.
	 *
	 * @since WPB_SINCE
	 *
	 * @return void
	 */
	public function set_controllers() {
		$this->container()->get( AdminController::class );
		$this->container()->get( ApiController::class );
	}
}
