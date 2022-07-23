<?php

namespace TheNameSpace\WordPressPluginBoilerplate\Controllers;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * The class responsible for handling API requests.
 */
class ApiController {
	/**
	 * The constructor.
	 */
	public function __construct() {
		try {
			$this->control();
		} catch ( NotFoundExceptionInterface $e ) {
		} catch ( ContainerExceptionInterface $e ) {
		}
	}

	/**
	 * The method responsible for calling API classes.
	 *
	 * @return void
	 * @throws ContainerExceptionInterface If the container is unable to resolve the requested entry.
	 * @throws NotFoundExceptionInterface If the container does not have an entry for the given identifier.
	 */
	protected function control() {}
}
