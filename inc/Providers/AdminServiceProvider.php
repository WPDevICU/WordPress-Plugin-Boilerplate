<?php

namespace TheNameSpace\WordPressPluginBoilerplate\Providers;

use TheNameSpace\WordPressPluginBoilerplate\Core\Admin\Menu;
use TheNameSpace\WordPressPluginBoilerplate\Core\Assets\Assets;
use TheNameSpace\WordPressPluginBoilerplate\Dependencies\League\Container\ServiceProvider\AbstractServiceProvider;

class AdminServiceProvider extends AbstractServiceProvider {

	public function provides( string $id ): bool {
		$provides = array(
			Menu::class,
			Assets::class,
		);

		return in_array( $id, $provides, true );
	}

	public function register(): void {
		$this->getContainer()->addShared( Menu::class );
		$this->getContainer()->addShared( Assets::class );
	}
}
