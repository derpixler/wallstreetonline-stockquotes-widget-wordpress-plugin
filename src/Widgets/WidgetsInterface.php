<?php # -*- coding: utf-8 -*-

namespace wallstreetonline\stockquotes\Widgets;

/**
 * Widgets interface
 *
 * @package wallstreetonline\stockquotes\Widgets
 */
interface WidgetsInterface {

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance );

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance );

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance );

}