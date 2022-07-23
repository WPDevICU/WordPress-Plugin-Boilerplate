<?php

namespace TheNameSpace\WordPressPluginBoilerplate\Providers;

use TheNameSpace\WordPressPluginBoilerplate\Controllers\AdminController;
use TheNameSpace\WordPressPluginBoilerplate\Controllers\ApiController;
use TheNameSpace\WordPressPluginBoilerplate\Controllers\DeliveryController;
use TheNameSpace\WordPressPluginBoilerplate\Controllers\DriverController;
use TheNameSpace\WordPressPluginBoilerplate\Controllers\InstallController;
use TheNameSpace\WordPressPluginBoilerplate\Controllers\SocketController;
use TheNameSpace\WordPressPluginBoilerplate\Controllers\TransactionController;
use TheNameSpace\WordPressPluginBoilerplate\Controllers\VerificationController;
use TheNameSpace\WordPressPluginBoilerplate\Core\Admin\Menu;
use TheNameSpace\WordPressPluginBoilerplate\Core\Assets\Assets;
use TheNameSpace\WordPressPluginBoilerplate\Core\Documents\Types;
use TheNameSpace\WordPressPluginBoilerplate\Core\Socket\PusherSocket;
use TheNameSpace\WordPressPluginBoilerplate\Dependencies\League\Container\ServiceProvider\AbstractServiceProvider;
use TheNameSpace\WordPressPluginBoilerplate\Interfaces\DriverSocketInterface;

/**
 * Class ControllerServiceProvider
 *
 * Register all the class with dependency injection container
 * for the plugin installation service.
 *
 * @package TheNameSpace\WordPressPluginBoilerplate
 * @author  TheNameSpace
 */
class ControllerServiceProvider extends AbstractServiceProvider {

	/**
	 * Register the provides array for the service provider.
	 *
	 * The class names of the provides should match the ones
	 * in the container.
	 *
	 * @since WPB_SINCE
	 *
	 * @param string $id ID of the service to register.
	 *
	 * @return bool
	 */
	public function provides( string $id ): bool {
		$provides = array(
			InstallController::class,
			AdminController::class,
			ApiController::class,
			VerificationController::class,
			DriverController::class,
			DeliveryController::class,
			SocketController::class,
			TransactionController::class,
		);

		return in_array( $id, $provides, true );
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register(): void {
		$this->getContainer()->addShared( InstallController::class );
		$this->getContainer()->addShared( AdminController::class )->addArguments( array( Menu::class, Assets::class ) );
		$this->getContainer()->addShared( ApiController::class );
		$this->getContainer()->addShared( VerificationController::class )->addArgument( Types::class );
		$this->getContainer()->addShared( DriverController::class );
		$this->getContainer()->addShared( DeliveryController::class );
		$this->getContainer()->addShared( SocketController::class )->addArgument( DriverSocketInterface::class );
		$this->getContainer()->add( DriverSocketInterface::class, PusherSocket::class );
		$this->getContainer()->addShared( TransactionController::class );
	}
}
