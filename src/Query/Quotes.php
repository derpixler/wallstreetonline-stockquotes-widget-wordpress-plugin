<?php # -*- coding: utf-8 -*-

namespace wallstreetonline\stockquotes\Query;

use wallstreetonline\stockquotes\Service;

/**
 * Use abstract Query() method to set items for Ibes
 *
 * @package Wildcat\SearchApi\Query
 */
class Quotes extends Query{

	public function __construct(){

		$this->set_items();

	}

	/**
	 * Set the IBEs
	 */
	public function set_items() {

		$this->items = $this->get_items(
			[
			    'option_name' => 'wo_realtime_quotes',
				'endpoint'    => '_rpc/json/instrument/quotes/getWordPressRealtime'
			]
		);

	}


}