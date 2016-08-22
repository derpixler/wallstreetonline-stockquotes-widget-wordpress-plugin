<?php # -*- coding: utf-8 -*-

namespace wallstreetonline\stockquotes\Service\Formatter;

/**
 * Interface for all formatter implementations.
 *
 * @package Wildcat\SearchApi\Service\Formatter
 */
abstract class AbstractFormatter {

	/**
	 * Quotes data object
	 *
	 * @var array
	 */
	public $data;


	public $index;

	public $item;

	/**
	 * Returns a formatted representation of the given data.
	 *
	 * @param array $data       Data to be formatted.
	 * @param array $properties Properties to be included in the response.
	 *
	 * @return array The formatted representation of the given data.
	 */
	public abstract function format( $data );

	/**
	 * @param $data
	 */
	public function __construct( $data = null ){

		$this->data = new \stdClass();


		if( is_array( $data ) ){

			$this->index = $data[0];
			$this->item = $data[1];

		}


		if( ! empty( $data ) ){
			$this->format( $data );
		}

		unset( $this->index );
		unset( $this->item );

	}

	public function set_formatted_data( $data ){

		unset( $data );

		return $this->data;

	}

}
