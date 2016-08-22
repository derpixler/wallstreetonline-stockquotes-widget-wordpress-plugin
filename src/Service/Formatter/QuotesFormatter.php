<?php

namespace wallstreetonline\stockquotes\Service\Formatter;


/**
 * Data formatter implementation for formatted data.
 *
 * @package wallstreetonline\stockquotes\Service
 */
class QuotesFormatter extends AbstractFormatter {

	/**
	 * Returns a formatted representation of the given data.
	 *
	 * @param array $data Data to be formatted.
	 *
	 * @return array The formatted representation of the given data.
	 */
	public function format( $data ) {

		$this->data = $data;
		$this->data = new QuotesFlipIndices( $this->data );
		$this->data = new QuotesDataMarkup( $this->data );
		$this->data = new QuotesAddTrend( $this->data );

		return $this->data;

	}
}