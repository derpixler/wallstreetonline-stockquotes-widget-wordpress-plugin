<?php # -*- coding: utf-8 -*-

namespace wallstreetonline\stockquotes\Query;

use wallstreetonline\stockquotes\Service;

/**
 * Use abstract Query() method to set items for Ibes
 *
 * @package wallstreetonline\stockquotes\Query
 */
class Quotes extends Query{

	public $items;

	public  $transient;
	private $formatter;
	private $arguments;

	public function __construct(){

		$this->arguments = [
				'option_name' => 'wo_realtime_quotes',
				'endpoint'    => '_rpc/json/instrument/quotes/getWordPressRealtime'
			];

		$this->transient = new Service\TransientHandler( $this->arguments[ 'option_name'] );
		$this->formatter = new Service\Formatter\QuotesFormatter();

	}

	/**
	 * get the quotes
	 */
	public function get_items() {

		$this->items = $this->formatter->format(
			$this->set_items( $this->arguments, $this->transient )
		);

		return $this->items;

	}


}