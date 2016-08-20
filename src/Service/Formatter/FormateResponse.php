<?php

namespace wallstreetonline\stockquotes\Service\Formatter;

/**
 * Data formatter implementation for formatted data.
 *
 * @package wallstreetonline\stockquotes\Service
 */
class FormateResponse implements FormatterInterface {

	/**
	 * Returns a formatted representation of the given data.
	 *
	 * @param array $data       Data to be formatted.
	 * @param array $properties Optional. Properties to be included in the response. Defaults to all properties.
	 *
	 * @return array The formatted representation of the given data.
	 */
	public function format( \stdClass $data ) {

		print_r( $data );
		die();

		return array_intersect_key( $data, array_flip( $properties ) );
	}
}