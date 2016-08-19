<?php
/*
Plugin Name: wallstreet:online Widgets
Plugin URI: http://www.wallstreet-online.de/widgets
Description: A plugin containing multiple widgets for stockquotes and charts
Author: Christian Rabe
Author URI: http://www.wallstreet-online.de
Version: 0.20141209
Date: 2014-12-09
*/


add_action ('init', 'wallstreetonline_prepare');
function wallstreetonline_prepare() {
    wp_enqueue_script('jquery');
}

add_action ('wp_head', 'wallstreetonline_scriptdeclaration');
function wallstreetonline_scriptdeclaration() {
    echo <<< ENDE
<script type="text/javascript">
    
</script>
ENDE;
}

add_action( 'widgets_init', 'wallstreetonline_load_widgets' );

function wallstreetonline_load_widgets() {
    register_widget( 'WallstreetOnline_Widget_Searchbox' );
    register_widget( 'WallstreetOnline_Widget_Quotebox' );
#    register_widget( 'WallstreetOnline_Widget_Chartbox' );
#    register_widget( 'WallstreetOnline_Widget_Quotebox_Citi' );
}


class WallstreetOnline_Widget_Searchbox extends WP_Widget {
    public function WallstreetOnline_Widget_Searchbox() {
        $widget_ops = array( 'classname' => 'wso-searchbox', 'description' => 'Displays a search form to wallstreet:online' );

        $this->WP_Widget( 'wallstreetonline-searchbox-widget', __('w:o Search', 'wallstreetonline-searchbox'), $widget_ops, $control_ops );
    }

    public function form( $instance ) {
        /* Set up some default widget settings. */
        $defaults = array( 'title' => __('Wertpapiersuche', 'wso-searchbox'), 'new_window' => __(true, 'wso-searchbox') );
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'wso-searchbox'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance['title'] = strip_tags( $new_instance['title'] );

        return $instance;
    }

    public function widget( $args, $instance ) {
        static $count=1;
        extract($args);

        $title = apply_filters('widget_title', $instance['title'] );

        echo $before_widget;
        echo $before_title . $title . $after_title;

        echo '<form id="searchbox-'.($count).'" action="http://www.wallstreet-online.de/suche" target="_blank"><input type="hidden" name="suche" value="instrumentResult" />';
        echo '<input name="q" /><input type="submit" value="Suchen" />';
        echo '</form>';

        echo $after_widget;
        $count++;
    }
}

class WallstreetOnline_Widget_Quotebox extends WP_Widget {
    public function WallstreetOnline_Widget_Quotebox() {
        $widget_ops = array( 'classname' => 'wso-quotebox', 'description' => 'Displays stock quotes' );

        $this->WP_Widget( 'wallstreetonline-quotebox-widget', __('w:o Quotebox', 'wallstreetonline-quotebox'), $widget_ops, $control_ops );
    }

    public function form( $instance ) {
        /* Set up some default widget settings. */
        $defaults = array( 'title' => __('Börse Kurse', 'wso-quotebox'), 'new_window' => __(true, 'wso-quotebox') );
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

    public function update( $new_instance, $old_instance ) {
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['new_window'] = $new_instance['new_window'];

        return $instance;
    }

    public function widget( $args, $instance ) {
        static $count=1;
        extract($args);

        $title = apply_filters('widget_title', $instance['title'] );

        $data = $this->fetchQuotes();
        
        echo $before_widget;
        echo $before_title . $title . $after_title;

        echo '<table style="width:100%" id="quotebox-'.($count).'">';
        echo '<tr><th style="text-align:left">Name</th><th style="text-align:right">Kurs</th><th style="text-align:right">in %</th></tr>';

        $i=0;
        foreach($data['data'] as $row) {
            if($instance['new_window']) {
                $row['linkedName'] = str_replace('href=', 'target="_blank" href=', $row['linkedName']);
            }

            $perf = str_replace(array('+',','),array('','.'),$row['tradePerf1dRel']);
            $perfStyle = $perf == 0 ? '' : ($perf > 0 ? ';color:green' : ';color:red');
            echo '<tr '.$hl.'>'
               . '<td>'.$row['linkedName'].'</td>'
               . '<td style="text-align:right">'.$row['trade'].'</td>'
               . '<td style="text-align:right'.$perfStyle.'">'.$row['tradePerf1dRel'].'</td>'
               . '</tr>'
            ;
        }

        echo '</table>';
        echo $data['footer'];
        echo $after_widget;
        $count++;
    }
    
    public function fetchQuotes() {
        $url = 'http://www.wallstreet-online.de/_rpc/json/instrument/quotes/getWordPressRealtime';
        if (function_exists('curl_init')) {
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Wordpress Plugin - wallstreet:online');
            $raw = curl_exec($ch);
            curl_close($ch);
        } else {
            $raw = file_get_contents($url);
        }

        $result = json_decode($raw, true);

        if(!$result) {
            return array();
        }

        if($result['status']==1) {
            return $result;
        }
    }
}

class WallstreetOnline_Widget_Quotebox_Citi extends WP_Widget {
    public function WallstreetOnline_Widget_Quotebox_Citi() {
        $widget_ops = array( 'classname' => 'wso-quotebox-citi', 'description' => 'Displays certain stock quotes powered by citi' );

        $this->WP_Widget( 'wallstreetonline-quotebox-citi-widget', __('w:o Quotebox Citi', 'wallstreetonline-quotebox'), $widget_ops, $control_ops );
    }

    public function form( $instance ) {
        /* Set up some default widget settings. */
        $defaults = array( 'title' => __('Börse RT-Kurse', 'wso-quotebox-citi'), 'new_window' => __(true, 'wso-quotebox-citi') );
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'wso-quotebox-citi'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>
        <p>
            <input class="checkbox" value="1" type="checkbox" <?php checked( $instance['new_window'], true ); ?> id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open Links in new Window?</label>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['new_window'] = $new_instance['new_window'];

        return $instance;
    }

    public function widget( $args, $instance ) {
        static $count=1;
        extract($args);

        $title = apply_filters('widget_title', $instance['title'] );

        $data = $this->fetchQuotes();
        

        echo $before_widget;
        echo $before_title . $title . $after_title;

        echo '<table style="width:100%" id="quotebox-citi-'.($count).'">';
        echo '<tr><th style="text-align:left">Name</th><th style="text-align:right">Kurs</th><th style="text-align:right">in %</th></tr>';

        $i=0;
        foreach($data as $row) {
            if($instance['new_window']) {
                $row['linkedTitle'] = str_replace('href=', 'target="_blank" href=', $row['linkedTitle']);
            }
            #$hl = ++$i%2==0 ? 'style="background:#EEE"' : '';

            $perf = str_replace(array('+',','),array('','.'),$row['perf_1d_rel']);
            $perfStyle = $perf == 0 ? '' : ($perf > 0 ? ';color:green' : ';color:red');
            echo '<tr '.$hl.'>'
               . '<td>'.$row['linkedTitle'].'</td>'
               . '<td style="text-align:right">'.$row['quote_last'].'</td>'
               . '<td style="text-align:right'.$perfStyle.'">'.$row['perf_1d_rel'].'%</td>'
               . '</tr>'
            ;
        }

        echo '</table>';
        echo 'powered by <img src="/wp-content/plugins/wallstreetonline/citi.png" /> und <img src="/wp-content/plugins/wallstreetonline/wallstreetonline.png" />';
        echo $after_widget;
        $count++;
    }

    public function fetchQuotes() {
        $url = 'http://www.wallstreet-online.de/_rpc/json/instrument/quotes/getCiti';
        if (function_exists('curl_init')) {
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Wordpress Plugin - wallstreet:online');
            $raw = curl_exec($ch);
            curl_close($ch);
        } else {
            $raw = file_get_contents($url);
        }

        $result = json_decode($raw, true);

        if(!$result) {
            return array();
        }

        if($result['status']==1) {
            return $result['data'];
        }
    }
}

class WallstreetOnline_Widget_Chartbox extends WP_Widget {
    public function WallstreetOnline_Widget_Chartbox() {
        $widget_ops = array( 'classname' => 'wso-chartbox', 'description' => 'Displays stock charts powered by boerse stuttgart' );

        $this->WP_Widget( 'wallstreetonline-chartbox-widget', __('w:o Chartbox', 'wallstreetonline-chartbox'), $widget_ops, $control_ops );
    }

    public function form( $instance ) {

    }
    public function widget( $args, $instance ) {
        extract( $args );

        var_dump($argst);
    }
}
