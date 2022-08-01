<?php

namespace TheNameSpace\WordPressPluginBoilerplate\Abstracts;

use Exception;

/**
 * Abstract Model
 */
abstract class Model {

	/**
	 * The table associated with the model.
	 *
	 *  @since WPB_SINCE
	 *
	 * @var string
	 *
	 * @access protected
	 * @abstract
	 */
	protected static $table;

	/**
	 * @return mixed
	 */
	abstract public function get();

	/**
	 * @return mixed
	 */
	abstract public function create();

	/**
	 * @return mixed
	 */
	abstract public function update();

	/**
	 * @return mixed
	 */
	abstract public function delete();

	/**
	 * Get the table associated with the model.
	 *
	 * @return string The table name.
	 * @throws Exception If the table name is not defined.
	 */
	public function get_table() {
		global $wpdb;
		if ( ! static::$table ) {
			throw new Exception( 'Table name is not defined' );
		}
		return $wpdb->prefix . static::$table;
	}
}
