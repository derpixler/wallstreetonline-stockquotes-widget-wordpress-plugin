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
	 * @return void
	 */
	public function format( $data ) {

		$index = $this->index;
		$item = $this->item;

		$item->tradePerf1dRel = str_replace(
			array( 'red', 'green', '"><font class="ddd">', '</font></font>' ),
			array( 'ddd', 'ddd', '">', '</font>'),
		    $item->tradePerf1dRel
		);

		$item->linkedName = str_replace( '"   >', ' - auf wallstreet:online" target="_blank">', $item->linkedName );

		$this->data->$index = $item;

	}
}