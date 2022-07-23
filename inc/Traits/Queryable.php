<?php

namespace TheNameSpace\WordPressPluginBoilerplate\Traits;

use Exception;

trait Queryable {
	/**
	 * Get the table name.
	 *
	 * @since WPB_SINCE
	 *
	 * @return string
	 * @throws Exception If the class is not queryable.
	 */
	protected function get_table_name(): string {
		if ( ! method_exists( $this, 'get_table' ) ) {
			throw new Exception( 'get_table method is not defined in ' . get_class( $this ) );
		}
		return $this->get_table();
	}

	/**
	 * Query
	 *
	 * @since WPB_SINCE
	 *
	 * @param array $args Query arguments.
	 *
	 * @return array
	 * @throws Exception If Query is not valid.
	 */
	public function query( array $args ): array {
		global $wpdb;

		$table    = $this->get_table_name();
		$primary  = ! empty( $args['primary_key'] ) ? $args['primary_key'] : 'id';
		$select   = ! empty( $args['primary_key'] ) ? $args['primary_key'] : '*';
		$where    = ! empty( $args['where'] ) ? $args['where'] : '';
		$limit    = ! empty( $args['limit'] ) ? 'LIMIT ' . $args['limit'] : '';
		$offset   = ! empty( $args['offset'] ) ? 'OFFSET ' . $args['offset'] : '';
		$order_by = ! empty( $args['order_by'] ) ? 'ORDER BY ' . $args['order_by'] : '';
		$order    = ! empty( $args['order'] ) && ! empty( $args['order_by'] ) ? ' ' . $args['order'] : '';

		// TODO: add cache.
		$results = $wpdb->get_results(
			"
				SELECT {$select} FROM {$table} WHERE 1=1
				{$where} {$order_by} {$order} {$limit} {$offset}
				"
		);

		$models = array();

		foreach ( $results as $result ) {
			$models[] = new self( $result->$primary );
		}

		return $models;
	}


	/**
	 * Count the number of verification requests.
	 *
	 * @since WPB_SINCE
	 *
	 * @param array $args Query arguments.
	 *
	 * @return int
	 * @throws Exception If Query is not valid.
	 */
	public function count( array $args ): int {
		global $wpdb;

		$table = $this->get_table_name();
		$where = ! empty( $args['where'] ) ? $args['where'] : '';

		// TODO: add cache.
		$results = $wpdb->get_var(
			"SELECT count(*) FROM {$table} WHERE 1=1 {$where}"
		);

		return absint( $results );
	}
}
