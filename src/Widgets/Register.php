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

			$widget_class = __NAMESPACE__ . "\\" . $widget;

			if( class_exists( $widget_class ) ) {
				register_widget( $widget_class );
			}

		}

	}

}