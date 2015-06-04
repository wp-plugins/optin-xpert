<?php

function tx_wp_optin_menu() {
  //create new top-level menu
  add_menu_page('Xpert Optin Menu', 'Xpert Optin', 'administrator', __FILE__, 'tx_optin_settings_page','dashicons-admin-plugins');
  //call register settings function
  

  add_action( 'admin_init', 'tx_register_optin_mysettings' );
}
// create custom plugin settings menu
add_action('admin_menu', 'tx_wp_optin_menu');

function tx_register_optin_mysettings() {
  //register our settings
    
  register_setting( 'xpert-settings-group', 'optin_timer' );    
  register_setting( 'xpert-settings-group', 'optin_type' );
  register_setting( 'xpert-settings-group', 'lightbox-layout');
  register_setting( 'xpert-settings-group', 'flyer-layout');
  register_setting( 'xpert-settings-group', 'stickytop-layout');
  register_setting( 'xpert-settings-group', 'wp_editor_data' );
  register_setting( 'xpert-settings-group', 'post_id' );
  register_setting( 'xpert-settings-group', 'page_id' );
  register_setting( 'xpert-settings-group', 'optin_session_value' );
  register_setting( 'xpert-settings-group', 'optin_session_input' );
  register_setting( 'xpert-settings-group', 'optin_mailchimp_api' );
  register_setting( 'xpert-settings-group', 'optin_mailchimp_content' );
  register_setting( 'xpert-settings-group', 'optin_upload_media');
  register_setting( 'xpert-settings-group', 'layout_checkbox');
  register_setting( 'xpert-settings-group', 'layout_custom');
  register_setting( 'xpert-settings-group', 'is_home');
  register_setting( 'xpert-settings-group', 'mc_list');
}
 


function tx_optin_settings_page() {
  $mc_api_key = get_option('optin_mailchimp_api');
  $mc_lists = tx_get_mail_chimp_lists($mc_api_key);
  $mc_list = get_option('mc_list', "");
  $posts = (array) get_posts(); 
  $pages = (array) get_pages();
  $selected_post = (array) get_option('post_id', array());
  $selected_page = (array) get_option('page_id', array());

  echo tx_view(__DIR__. "/views/settings.tpl.php", 
  compact('mc_lists', 'mc_api_key', 'mc_list','selected_post','posts','selected_page','pages'));
}

add_filter("mce_buttons", "tx_tinymce_editor_buttons", 99); //targets the first line

function tx_tinymce_editor_buttons($buttons) {
  return array(
    "forecolor",   
    "bold",      
    "italic",
    "alignleft",
    "aligncenter",
    "alignright", 
    "formatselect"
  );
}

