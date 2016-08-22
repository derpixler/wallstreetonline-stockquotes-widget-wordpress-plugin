<?php # -*- coding: utf-8 -*-

namespace wallstreetonline\stockquotes\Service;

/**
 * Class Render widget view load templates prepare objects etc.
 *
 * @package wallstreetonline\stockquotes\Service
 */
class RenderView{

	/**
	 * @param $widget_arguments
	 */
	public function __construct( $widget_arguments ){

		$this->widget = $widget_arguments;

		$this->load_template( $this->widget['template'] );

	}

	/**
	 * Provide the widget header
	 *
	 * @return string
	 */
	private function get_widget_header(){

		return $this->widget[ 'before_widget' ] .
		       $this->widget[ 'before_title'] .
		       $this->widget[ 'instance' ]['title'] .
		       $this->widget[ 'after_title'];

	}

	/**
	 * rovide the widget footer
	 *
	 * @return mixed
	 */
	private function get_widget_footer(){

		return $this->widget[ 'after_widget' ];

	}

	/**
	 * rovide the widget quotes
	 *
	 * @return mixed
	 */
	private function get_quotes(){

		return $this->widget[ 'data' ]->data;

	}

	/**
	 * Load widget template
	 *
	 * @param $tpl
	 */
	private function load_template( $tpl ){

		global $wso_widget;

		$wso_widget = new \stdClass();
		$wso_widget->header = $this->get_widget_header();
		$wso_widget->footer = $this->get_widget_footer();
		$wso_widget->quotes = $this->get_quotes();
		$wso_widget->assets = str_replace( '/src/' . basename( __DIR__ ), '', plugins_url( 'assets/img', __FILE__ ) );

		if ( $overridden_template = locate_template( 'widgets/wallstreetonline-stockquotes-wordpress-widget/' . $tpl . '.php' ) ) {
			load_template( $overridden_template );
		} else {
			load_template( dirname( __FILE__ ) . '/../view/' . $tpl . '.php' );
		}

	}

}