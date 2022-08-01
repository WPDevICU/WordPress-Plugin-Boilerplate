<?php

namespace TheNameSpace\WordPressPluginBoilerplate\Core\Cache;

use TheNameSpace\WordPressPluginBoilerplate\Abstracts\SimpleCache;

/**
 * Object Cache class.
 */
class ObjectCache extends SimpleCache {

	/**
	 * Get the value associated with the given key.
	 *
	 * @param string $key The key for the value to be returned.
	 * @param mixed  $default (optional) The default value to be returned if the key is not found.
	 *
	 * @return mixed The value associated with the given key, or the default value.
	 */
	public function get( $key, $default = null ) {
		$value = wp_cache_get( $key );
		return false === $value ? $default : $value;
	}

	/**
	 * Set the value for the given key.
	 *
	 * @param string $key The key for the value to be set.
	 * @param mixed  $value The value to be set.
	 * @param int    $ttl (optional) The time-to-live in seconds for the value.
	 *
	 * @return bool True if the value was set, false otherwise.
	 */
	public function set( $key, $value, $ttl = null ): bool {
		return wp_cache_set( $key, $value, '', $ttl );
	}

	/**
	 * Delete the value for the given key.
	 *
	 * @param string $key The key for the value to be deleted.
	 *
	 * @return bool True if the value was deleted, false otherwise.
	 */
	public function delete( $key ): bool {
		return wp_cache_delete( $key );
	}

	/**
	 * Delete all values.
	 *
	 * @return bool True if the values were deleted, false otherwise.
	 */
	public function clear(): bool {
		return wp_cache_flush();
	}
}
