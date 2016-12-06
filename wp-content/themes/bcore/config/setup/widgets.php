<?php
/**
 * Widgets
 * @package bcore
 */

# Widgets
add_action('widgets_init', 'bco_widgets');
function bco_widgets() {
	register_sidebar(
		array(
			'name' => esc_html__( 'Sidebar', 'brandco' ),
			'id' => 'sidebar-1',
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		)
	);
}