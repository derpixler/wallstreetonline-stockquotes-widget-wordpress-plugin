<?php # -*- coding: utf-8 -*-

namespace wallstreetonline\stockquotes\Query;

use wallstreetonline\stockquotes\Service;


/**
 * Abstract Query class
 *
 * Provides methods to query data
 *
 * @package wallstreetonline\stockquotes\Query
 */
abstract class Query{

	public $transient;

	abstract public function set_items();

	/**
	 * a abstract items getter
	 *
	 * @return array
	 */
	public function get_items( $args, Service\TransientHandler $transient ) {

		$handle = new Service\OptionStorageHandler( $args[ 'option_name'] );

		$items = $handle->get();

		if( empty( $items ) || $transient->get() == FALSE ){

			new Service\Request( $args );

			$items = $handle->get();

			$transient->set();

		}

		return $items;

	}

}