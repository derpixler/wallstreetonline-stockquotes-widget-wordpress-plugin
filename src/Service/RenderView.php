<?php # -*- coding: utf-8 -*-

namespace wallstreetonline\stockquotes\Service;

class RenderView{

	public function __construct( array $arguments ){

		global $wso_quotes;

		$wso_quotes = $arguments;

		if ( $overridden_template = locate_template( 'widgets/wallstreetonline-stockquotes-wordpress-widget/QuotesTable.php' ) ) {
			load_template( $overridden_template );
		} else {
			load_template( dirname( __FILE__ ) . '/../view/QuotesTable.php' );
		}

	}

}