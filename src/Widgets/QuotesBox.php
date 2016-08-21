<?php # -*- coding: utf-8 -*-

namespace wallstreetonline\stockquotes\Widgets;

use wallstreetonline\stockquotes\Service;
use wallstreetonline\stockquotes\Query;

/**
 * Class QuotesBox Widget
 *
 * @package wallstreetonline\stockquotes\Widgets
 */
class QuotesBox extends \WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {

		$widget_ops = array(
			'classname'   => 'quotesbox',
			'description' => 'Displays a realtime quotes table wallstreet:online'
		);

		parent::__construct(
			'wallstreetonline-quotesbox-widget',
			'wallstreet:online Quotes',
			$widget_ops
		);

	}

	/**
	 * Rendet the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		$quotes = new Query\Quotes();

		$args[ 'data' ] = $quotes->get_items();

		new Service\RenderView(
			array(
				$args,
				$instance
			)
		);

	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 *
	 * @return void
	 */
	public function form( $instance ) {

		$defaults = array(
			'title' => __('Börse Kurse', 'wso-quotebox'),
			'new_window' => __(true, 'wso-quotebox')
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'wso-quotebox'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<input class="checkbox" value="1" type="checkbox" <?php checked( $instance['new_window'], true ); ?> id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open Links in new Window?</label>
		</p>
		<?php

	}


	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return mixed
	 */
	public function update( $new_instance, $old_instance ) {

		$instance[ 'title' ]    = esc_html( $new_instance[ 'title' ] );
		$instance[ 'new_window' ] = $new_instance[ 'new_window' ];

		return $instance;

	}

}