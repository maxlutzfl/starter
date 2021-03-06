<?php
/**
 * Gravity Forms
 * @package bcore
 */

# New from email and title
add_filter('wp_mail_from', 'new_mail_from');
add_filter('wp_mail_from_name', 'new_mail_from_name');
 
function new_mail_from($old) {
	return get_option('admin_email');
}

function new_mail_from_name($old) {
	return get_option('blogname');
}

# Gravity forms signature
add_filter('gform_notification', 'gform_notification_signature', 10, 3);
function gform_notification_signature($notification, $form, $entry) {
	$email = get_option('admin_email');
	$title = get_option('blogname');
    $notification['message'] .= "<br><br> Message sent from " . $title . " @ " . $email;
    return $notification;
}

# Error message
add_filter('gform_validation_message', 'gravity_forms_error_message', 10, 2);
function gravity_forms_error_message($message, $form) {
    return "<div class='validation_error'>There was a problem, please fill in the required fields.</div>";
}

add_filter('gform_tabindex', 'gform_tabindexer', 10, 2);
function gform_tabindexer($tab_index, $form = false) {
    $starting_index = 1000;
    if ($form) {
        add_filter( 'gform_tabindex_' . $form['id'], 'gform_tabindexer' );
    }
    
    return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
}