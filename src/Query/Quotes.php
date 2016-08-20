<?php # -*- coding: utf-8 -*-

namespace wallstreetonline\stockquotes\Query;

use wallstreetonline\stockquotes\Service;

/**
 * Use abstract Query() method to set items for Ibes
 *
 * @package wallstreetonline\stockquotes\Query
 */
class Quotes extends Query{

	private $arguments;

	public function __construct(){

		$this->arguments = [
				'option_name' => 'wo_realtime_quotes',
				'endpoint'    => '_rpc/json/instrument/quotes/getWordPressRealtime'
			];

		$this->transient = new Service\TransientHandler( $this->arguments[ 'option_name'] );

		$this->set_items();

	}

	/**
	 * Set the IBEs
	 */
	public function set_items() {

		$this->items = $this->get_items( $this->arguments, $this->transient );

	}


}