<?php

namespace wallstreetonline\stockquotes\Service\Formatter;

/**
 * Class QuotesDataMarkup
 * Data formatter implementation to format markup.
 *
 * @package wallstreetonline\stockquotes\Service\Formatter
 */
class QuotesDataMarkup extends AbstractFormatter {

	/**
	 * Returns a formatted representation of the given data.
	 *
	 * @param array $data Data to be formatted.
	 *
	 * @return array The formatted representation of the given data.
	 */
	public function format( $data ) {

		foreach( $data->data as $key => $item ){

			$item->tradePerf1dRel = str_replace(
				array( 'red', 'green', '"><font class="ddd">', '</font></font>' ),
				array( 'ddd', 'ddd', '">', '</font>'),
			    $item->tradePerf1dRel
			);

			$item->linkedName = str_replace( '"   >', '">', $item->linkedName );

			$this->data->$key = $item;

		}

		return $this->set_formatted_data(
			$this->data
		);

	}
}