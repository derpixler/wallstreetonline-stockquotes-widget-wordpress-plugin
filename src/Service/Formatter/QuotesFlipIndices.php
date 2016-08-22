<?php

namespace wallstreetonline\stockquotes\Service\Formatter;


/**
 * Data formatter implementation for formatted data.
 *
 * @package wallstreetonline\stockquotes\Service
 */
class QuotesFlipIndices extends AbstractFormatter {

	/**
	 * Returns a formatted representation of the given data.
	 *
	 * @param array $data       Data to be formatted.
	 *
	 * @return array The formatted representation of the given data.
	 */
	public function format( $data ) {

		foreach( $data->data as $item ){

			$key = $item->url;
			$this->data->$key = $item;

		}

		return $this->set_formatted_data(
			$this->data
		);

	}

}