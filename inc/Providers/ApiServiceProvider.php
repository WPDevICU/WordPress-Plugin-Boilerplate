<?php

namespace TheNameSpace\WordPressPluginBoilerplate\Providers;

use TheNameSpace\WordPressPluginBoilerplate\Core\Api\AuthenticationApi;
use TheNameSpace\WordPressPluginBoilerplate\Core\Api\DeliveryActivityApi;
use TheNameSpace\WordPressPluginBoilerplate\Core\Api\DocumentTypesApi;
use TheNameSpace\WordPressPluginBoilerplate\Core\Api\DriverApi;
use TheNameSpace\WordPressPluginBoilerplate\Core\Api\DeliveryRequestApi;
use TheNameSpace\WordPressPluginBoilerplate\Core\Api\NotificationApi;
use TheNameSpace\WordPressPluginBoilerplate\Core\Api\PusherWebhookApi;
use TheNameSpace\WordPressPluginBoilerplate\Core\Api\TransactionApi;
use TheNameSpace\WordPressPluginBoilerplate\Core\Api\VerificationRequestApi;
use TheNameSpace\WordPressPluginBoilerplate\Core\Api\WithdrawalRequestApi;
use TheNameSpace\WordPressPluginBoilerplate\Core\Documents\Types;
use TheNameSpace\WordPressPluginBoilerplate\Core\Driver\Auth;
use TheNameSpace\WordPressPluginBoilerplate\Dependencies\League\Container\ServiceProvider\AbstractServiceProvider;


/**
 * Class ApiServiceProvider
 *
 * Register all the class with dependency injection container
 * for the plugin installation service.
 *
 * @package TheNameSpace\WordPressPluginBoilerplate
 * @author  TheNameSpace
 */
class ApiServiceProvider extends AbstractServiceProvider {

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
		);

		return in_array( $id, $provides, true );
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register(): void {
	}
}
