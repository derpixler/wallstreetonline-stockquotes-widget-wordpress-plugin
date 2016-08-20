<?php # -*- coding: utf-8 -*-

namespace wallstreetonline\stockquotes\Query;

use wallstreetonline\stockquotes\Service;


/**
 * Abstract Query class
 *
 * Provides methods to query data
 *
 * @package myHotelshop\Ibe_widget\Query
 */
abstract class Query{

	abstract public function set_items();

	/**
	 * a abstract items getter
	 *
	 * @return array
	 */
	public function get_items( $args ) {

		$handle = new Service\Handle( $args[ 'option_name'] );

		$items = $handle->get();

		if( empty( $items ) ){

			new Service\Request( $args );

			$items = $handle->get();

		}

		return $items;

	}

}