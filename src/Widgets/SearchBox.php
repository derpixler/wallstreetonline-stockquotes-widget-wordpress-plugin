<?php # -*- coding: utf-8 -*-

namespace wallstreetonline\stockquotes\Widgets;

/**
 * Class SearchBox Widget
 *
 * @package wallstreetonline\stockquotes\Widgets
 */
class SearchBox extends \WP_Widget implements WidgetsInterface {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {

		$widget_ops = array(
			'classname'   => 'widget_search',
			'description' => 'Displays a search form to wallstreet:online'
		);

		parent::__construct(
			'wallstreetonline-searchbox-widget',
			'wallstreet:online Search',
			$widget_ops
		);

	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		$default_input_val = "Name, WKN, ISIN &amp; Enter drücken";

		echo $args[ 'before_widget' ];
		echo $args[ 'before_title' ] . $instance[ 'title' ] . $args[ 'after_title' ];

		?>
		<form id="<?=$args[ 'widget_id' ] ?>" action="http://www.wallstreet-online.de/suche" target="_blank" class="searchform themeform">
			<input type="hidden" name="suche" value="instrumentResult" />
			<div>
				<input type="text" class="search" name="s" onblur="if(this.value=='')this.value='<?=$default_input_val ?>';" onfocus="if(this.value=='<?=$default_input_val ?>')this.value='';" value="<?=$default_input_val ?>">
			</div>
		</form>
		<?php

		echo $args[ 'after_widget' ];

	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {

		$defaults = array(
			'title'      => __( 'Wertpapiersuche', 'wso-searchbox' ),
			'new_window' => __( TRUE, 'wso-searchbox' )
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'wso-searchbox' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance[ 'title' ]; ?>" style="width:100%;" />
		</p>
		<?php

	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {

		$instance[ 'title' ] = esc_html( $new_instance[ 'title' ] );

		return $instance;

	}

}