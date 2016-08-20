<?php # -*- coding: utf-8 -*-

namespace wallstreetonline\stockquotes\Widgets;


class Register {

	private $widgets;

	function __construct( $widgets ){

		$this->widgets = $widgets;

		$this->register();

	}

	private function register(){

		foreach( $this->widgets as $widget ){
			register_widget( __NAMESPACE__ . "\\" . $widget );
		}

	}

}