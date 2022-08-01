<?php

namespace TheNameSpace\WordPressPluginBoilerplate\Abstracts;

use Psr\SimpleCache\CacheInterface;
use \InvalidArgumentException;

/**
 * Abstract Simple Cache class.
 *
 * @since WPB_SINCE
 *
 * @abstract
 *
 * @package TheNameSpace\WordPressPluginBoilerplate\Abstracts
 */
abstract class SimpleCache implements CacheInterface {

	protected $defaultTtl = 0;

	/**
	 * Get the value associated with the given key.
	 *
	 * @param string $key The key for the value to be returned.
	 * @param mixed  $default (optional) The default value to be returned if the key is not found.
	 *
	 * @return mixed The value associated with the given key, or the default value.
	 */
	abstract public function get( $key, $default = null );

	/**
	 * Set the value for the given key.
	 *
	 * @param string $key The key for the value to be set.
	 * @param mixed  $value The value to be set.
	 * @param int    $ttl (optional) The time-to-live in seconds for the value.
	 *
	 * @return bool True if the value was set, false otherwise.
	 */
	abstract public function set( $key, $value, $ttl = null ): bool;

	/**
	 * Delete the value for the given key.
	 *
	 * @param string $key The key for the value to be deleted.
	 *
	 * @return bool True if the value was deleted, false otherwise.
	 */
	abstract public function delete( $key ): bool;

	/**
	 * Delete all values.
	 *
	 * @return bool True if the values were deleted, false otherwise.
	 */
	abstract public function clear();

	/**
	 * Delete data of the multiple keys.
	 *
	 * @param array $keys The keys for the values to be deleted.
	 *
	 * @return bool True if the values were deleted, false otherwise.
	 * @throws InvalidArgumentException If keys are not traversable.
	 */
	public function deleteMultiple( $keys ): bool {
		if ( ! is_array( $keys ) && ! $keys instanceof \Traversable ) {
			throw new InvalidArgumentException(
				sprintf(
					// translators: %s is keys type.
					__( 'Cache keys must be array or traversable, %s given', 'wpb' ),
					gettype( $keys )
				)
			);
		}

		$success = true;

		foreach ( $keys as $key ) {
			$success = $success && $this->delete( $key );
		}

		return $success;
	}

	/**
	 * Get the multiple values for the given keys at once.
	 *
	 * @param array $keys The keys for the values to be returned.
	 * @param mixed $default (optional) The default value to be returned if the key is not found.
	 *
	 * @return array
	 * @throws InvalidArgumentException If keys are not traversable.
	 */
	public function getMultiple( $keys, $default = null ): array {
		if ( ! is_array( $keys ) && ! $keys instanceof \Traversable ) {
			throw new InvalidArgumentException(
				sprintf(
					// translators: %s is keys type.
					__( 'Cache keys must be array or traversable, %s given', 'wpb' ),
					gettype( $keys )
				)
			);
		}

		$results = array();

		foreach ( $keys as $key ) {
			$results[ $key ] = $this->get( $key, $default );
		}

		return $results;
	}

	/**
	 * Check if the given key exists.
	 *
	 * @param string $key The key for the value to be checked.
	 *
	 * @return bool True if the key exists, false otherwise.
	 */
	public function has( $key ): bool {
		return ! is_null( $this->get( $key ) );
	}

	/**
	 * Set the value for the given key if the key does not exist.
	 *
	 * @param array $values The key value pare to be set.
	 * @param int   $ttl (optional) The time-to-live in seconds for the value.
	 *
	 * @return bool True if the value was set, false otherwise.
	 * @throws InvalidArgumentException If keys are not traversable.
	 */
	public function setMultiple( $values, $ttl = null ): bool {
		if ( ! is_array( $values ) && ! $values instanceof \Traversable ) {
			throw new InvalidArgumentException(
				sprintf(
					'Cache values must be array or traversable, %s given',
					gettype( $values )
				)
			);
		}

		$success = true;

		foreach ( $values as $key => $value ) {
			if ( is_int( $key ) ) {
				$key = strval( $key );
			}

			$success = $success && $this->set( $key, $value, $ttl );
		}

		return $success;
	}

	/**
	 * Item Time To Live.
	 *
	 * @param mixed $ttl (optional) The time-to-live in seconds for the value.
	 *
	 * @return int
	 */
	protected function itemTtl( $ttl ): int {
		if ( is_null( $ttl ) ) {
			return $this->defaultTtl;
		}

		if ( $ttl instanceof \DateInterval ) {
			$ttl = intval(
				\DateTime::createFromFormat( 'U', 0 )->add( $ttl )->format( 'U' )
			);
		}

		if ( is_int( $ttl ) ) {
			return 0 < $ttl ? $ttl : -1;
		}

		throw new InvalidArgumentException(
			sprintf(
				// translators: %s is ttl type.
				__( 'TTL must be integer, DateInterval or null, %s given', 'wpb' ),
				gettype( $ttl )
			)
		);
	}

	/**
	 * Validate the key.
	 *
	 * @param mixed $key The key to be validated.
	 *
	 * @return void
	 * @throws InvalidArgumentException If key is not a string.
	 */
	protected function validateItemKey( $key ) {
		if ( ! is_string( $key ) ) {
			throw new InvalidArgumentException(
				sprintf(
					// translators: %s is key type.
					__( 'Cache key must be string, %s given', 'wpb' ),
					gettype( $key )
				)
			);
		}

		if ( ! isset( $key[0] ) ) {
			throw new InvalidArgumentException(
				__( 'Cache key length must be greater than zero', 'wpb' )
			);
		}

		if ( false !== strpbrk( $key, '{}()/\\@:' ) ) {
			throw new InvalidArgumentException(
				sprintf(
					// translators: %s is key.
					__( 'Cache key [%s] contains one or more reserved characters {}()/\\@:', 'wpb' ),
					$key
				)
			);
		}
	}
}
