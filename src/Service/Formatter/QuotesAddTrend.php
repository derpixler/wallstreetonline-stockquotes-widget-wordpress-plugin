<?php

namespace wallstreetonline\stockquotes\Service\Formatter;

/**
 * Class QuotesDataMarkup
 * Data formatter implementation to format markup.
 *
 * @package wallstreetonline\stockquotes\Service\Formatter
 */
class QuotesAddTrend extends AbstractFormatter {

	/**
	 * Returns a formatted representation of the given data.
	 *
	 * @param array $data Data to be formatted.
	 *
	 * @return array The formatted representation of the given data.
	 */
	public function format( $data ) {

		foreach( $data->data as $key => $item ){

			if( is_int( strpos( $item->tradePerf1dRel, '-' ) ) ){
				$trend = 'negativ';
			}else{
				$trend = 'postitiv';
			}

			$item->trend = $trend;

			$this->data->$key = $item;

		}


		return $this->set_formatted_data(
			$this->data
		);

	}
}