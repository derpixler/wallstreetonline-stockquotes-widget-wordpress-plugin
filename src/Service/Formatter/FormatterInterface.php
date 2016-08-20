<?php # -*- coding: utf-8 -*-

namespace wallstreetonline\stockquotes\Service\Formatter;

/**
 * Interface for all formatter implementations.
 *
 * @package Wildcat\SearchApi\Service\Formatter
 */
interface FormatterInterface {

	/**
	 * Returns a formatted representation of the given data.
	 *
	 * @param array $data       Data to be formatted.
	 * @param array $properties Properties to be included in the response.
	 *
	 * @return array The formatted representation of the given data.
	 */
	public function format( \stdClass $data );
}
