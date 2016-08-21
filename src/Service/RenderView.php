<?php # -*- coding: utf-8 -*-

namespace wallstreetonline\stockquotes\Service;

class RenderView{

	private $item;

	public function __construct( array $arguments ){

		$this->item = $arguments;

		print_r( $this );

	}

}