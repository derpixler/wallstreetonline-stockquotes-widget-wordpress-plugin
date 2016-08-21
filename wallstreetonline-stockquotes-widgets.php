<?php # -*- coding: utf-8 -*-
/**
 * Plugin Name: wallstreet:online Stockquotes Widgets
 * Plugin URI:  http://www.wallstreet-online.de/widgets
 * Description: A plugin containing multiple widgets for stockquotes and charts
 * Version:     2.0
 * Author:      Christian Rabe, René Reimann
 * Author URI:  http://www.rene-reimann.de
 * License:     GPLv3+
 * Text Domain: wsoqw
 */
namespace wallstreetonline\stockquotes;

use Requisite\Requisite;
use Requisite\Rule\Psr4;
use Requisite\SPLAutoLoader;

add_action( 'plugins_loaded', __NAMESPACE__ . '\init', 8 );

/**
 * load the plugin
 */
function init() {

	/**
	 * Load the Requisite library. Alternatively you can use composer's
	 */
	require_once __DIR__ . '/src/requisite/src/Requisite/Requisite.php';
	Requisite::init();

	$autoloader = new SPLAutoLoader;

	$autoloader->addRule(
		new Psr4(
			__DIR__ . '/src',       // base directory
			__NAMESPACE__ // base namespace
		)
	);

	add_action( 'widgets_init', function(){

			new Widgets\Register(
				array(
					'SearchBox',
					'QuotesBox',
					#'Chartbox',
					#'Quotebox_Citi',
				)
			);

		}
	);


	#$Quotes = new \wallstreetonline\stockquotes\Query\Quotes();

	#print_r( $Quotes->get_items() );


}