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

		foreach( $this->data->data as $index => $item ){

			new QuotesDataMarkup( [ $index, $item ] );
			new QuotesAddTrend( [ $index, $item ] );

		}

		return $this->set_formatted_data(
			$this->data
		);


	}
}