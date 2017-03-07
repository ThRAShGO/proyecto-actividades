<?php
/*
 Plugin Name: Vibe Calendar Widget
 Plugin URI: http://www.VibeThemes.com
 Description: Simple Calendar Styling Widget
 Version: 1.0
 Author: Mr.Vibe
 Author URI: http://www.VibeThemes.com
 */

add_action('wp_enqueue_scripts', 'vcalendar');

function vcalendar()
{
 wp_register_style( 'vcalendar-style', plugins_url('vcalendar.css', __FILE__) );
 wp_enqueue_style( 'vcalendar-style' );
}

?>