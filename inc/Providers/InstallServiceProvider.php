<?php

namespace TheNameSpace\WordPressPluginBoilerplate\Providers;

use TheNameSpace\WordPressPluginBoilerplate\Core\Install\AddDBTables;
use TheNameSpace\WordPressPluginBoilerplate\Core\Install\AddDriverRole;
use TheNameSpace\WordPressPluginBoilerplate\Dependencies\League\Container\ServiceProvider\AbstractServiceProvider;

/**
 * Class InstallServiceProvider
 *
 * Register all the class with dependency injection container
 * for the plugin installation service.
 *
 * @package TheNameSpace\WordPressPluginBoilerplate
 * @author  TheNameSpace
 */
class InstallServiceProvider extends AbstractServiceProvider {

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
			AddDriverRole::class,
			AddDBTables::class,
		);

		return in_array( $id, $provides, true );
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register(): void {
		$this->getContainer()->add( AddDriverRole::class );
		$this->getContainer()->add( AddDBTables::class );
	}
}
