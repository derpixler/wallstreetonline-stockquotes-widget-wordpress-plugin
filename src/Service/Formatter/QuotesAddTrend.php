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
	public function format( $item ) {

		if( is_int( strpos( $this->item->tradePerf1dRel, '-' ) ) ){
			$trend = 'negativ';
		}else{
			$trend = 'postitiv';
		}

		$this->item->trend = $trend;

	}
}