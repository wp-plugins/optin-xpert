<?php
/*
Plugin Name: Optin Xpert
Plugin URI: http://themexpert.com/wordpress-plugins/optin-xpert
Version: 1.0
Author: ThemeXpert
Authro URI : http://www.themexpert.com
Description: Optin Xpert turns your site visitors into loyal subscribers, and subscribers to customers. 
License: GPLv2 or later
Text Domain: ox
*/

require_once 'admin-settings.php';
require_once 'helper/view.php';
require_once 'assets/vendor/MailChimp/MCAPI.class.php';


if (isset($_POST["optin_mail"])){ 
    $optin_mail = $_POST["optin_mail"];
}

$api_key = get_option('optin_mailchimp_api'); // Enter your API key

function tx_get_mail_chimp_lists($api_key){
  $api    = new MCAPI($api_key);
  $response = $api->lists();
  
  if ($api->errorCode) {
      return array();
      // die("error occured"); //TODO: handle error
  }

  return $response['data'];
}


function tx_ajax_optin_subscribe_action() {

  if(!isset($_POST['action']) || 
    $_POST['action'] !== "tx_optin_subscribe_action") return false;

  $api_key = get_option('optin_mailchimp_api');
  $list_id = get_option('mc_list'); 
  $email = $_POST["email"];
  
  $sent = tx_mc_subscribe_user($api_key, $list_id, $email);

  wp_send_json(["sent"=> $sent]);

  wp_die(); // this is required to terminate immediately and return a proper response
}


function tx_mc_subscribe_user($api_key, $list_id, $email){
  $api    = new MCAPI($api_key);

  return $api->listSubscribe($list_id, $email);
}

tx_ajax_optin_subscribe_action();


defined('TX_OPTIN_PREFIX') or define('TX_OPTIN_PREFIX', 'tx_optin');

$optinType         = get_option('optin_type');
$optinTimer        = get_option('optin_timer');
$optinText         = get_option('wp_editor_data');
$optinPost         = get_option('post_id');
$optinPage         = get_option('page_id');
$optinHome         = get_option('is_home');
$optinSession      = get_option('optin_session_value');
$optinSessionInput = get_option('optin_session_input');
$MailChimp_content = get_option('optin_mailchimp_content');


define('OPTIN_DATA',  get_option('wp_editor_data'));
define('OPTIN_IMAGE', get_option('optin_upload_media'));
define('OPTIN_TIMER', get_option('optin_timer'));
define('OPTIN_SESSION', get_option('optin_session_value'));
define('OPTIN_SESSION_INPUT', get_option('optin_session_input'));
define('OPTIN_MAILCHIMP_CONTENT', get_option('optin_mailchimp_content'));


final class TX_XpertOptin
{
    /** * Hook WordPress */
    public function __construct() {
      add_action('wp_enqueue_scripts', [$this, 'tx_loaOptinScripts']);
      add_action('admin_enqueue_scripts', [$this, 'tx_loadBackendSiteScripts']);
      add_action('wp_head', [$this, 'tx_inject_optin_cookie']);
      add_action('template_redirect', [$this, 'tx_optin_plugin_is_page']);
    }
    
    /**
     * Load Frontend Scripts
     *
     * @access public
     * @return void
     * @since 0.1
     */
    public function tx_loaOptinScripts() {
      wp_enqueue_script(TX_OPTIN_PREFIX . '-bs-optin-js', plugins_url('assets/vendor/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'));
      wp_enqueue_script(TX_OPTIN_PREFIX . '-waypoint-optin-js', plugins_url('assets/vendor/waypoint/js/jquery.waypoints.min.js', __FILE__), array());
      wp_enqueue_script(TX_OPTIN_PREFIX . '-optin-style-cookie', plugins_url('assets/js/jquery.cookie.js', __FILE__), array());
      wp_enqueue_script(TX_OPTIN_PREFIX . '-optin-frontapp-js', plugins_url('assets/js/frontapp.js', __FILE__), array());
      wp_localize_script(TX_OPTIN_PREFIX . '-optin-frontapp-js', 'lightbox_layout', get_option('lightbox-layout'));
      wp_localize_script(TX_OPTIN_PREFIX . '-optin-frontapp-js', 'flyer_layout', get_option('flyer-layout'));
      wp_localize_script(TX_OPTIN_PREFIX . '-optin-frontapp-js', 'stickytop_layout', get_option('stickytop-layout'));
      wp_enqueue_style(TX_OPTIN_PREFIX . '-bs-optin-css-load', plugins_url('assets/vendor/bootstrap/css/bootstrap.min.css', __FILE__), array());
      wp_enqueue_style(TX_OPTIN_PREFIX . '-optin-style-css', plugins_url('assets/css/styles.css', __FILE__), array());
    }
    
    function tx_loadBackendSiteScripts(){
      wp_enqueue_media();
      wp_enqueue_script(TX_OPTIN_PREFIX . '-selectize-js', plugins_url('assets/vendor/selectize/js/standalone/selectize.js', __FILE__), array('jquery'));
      wp_enqueue_script(TX_OPTIN_PREFIX . '-image-picker-js', plugins_url('assets/vendor/image-picker/js/image-picker.min.js', __FILE__), array());
      wp_enqueue_script(TX_OPTIN_PREFIX . '-optin-app-js', plugins_url('assets/js/app.js', __FILE__), array());
      wp_localize_script(TX_OPTIN_PREFIX . '-optin-app-js', 'layout_style', get_option('optin_type'));      
      wp_enqueue_style(TX_OPTIN_PREFIX . '-optin-selectize-css', plugins_url('assets/vendor/selectize/css/selectize.css', __FILE__), array());
      wp_enqueue_style(TX_OPTIN_PREFIX . '-image-picker-css', plugins_url('assets/vendor/image-picker/css/image-picker.css', __FILE__), array());
      wp_enqueue_style(TX_OPTIN_PREFIX . '-optin-app-back-css', plugins_url('assets/css/app.css', __FILE__), array());
    }

    function tx_inject_optin_cookie() {
      ?>
      <script>
        jQuery(document).ready(function ($) {


          var setOptinCookie = function(){
      
            var date = new Date();
            var timeVale = '<?php echo OPTIN_SESSION_INPUT; ?>';        
            var totalTime = '<?php echo OPTIN_SESSION; ?>';            
            date.setTime(date.getTime() + (timeVale * totalTime * 1000));
            $.cookie('optinSession',1, { expires: date });
          };



          $('.tx-optin-submit').on('click',function() {
            $.cookie('subscribed', '1year', { expires: 365 });            
          });

          $('.tx-optin-close, #tx-optin-lightbox').on('click', function(){
           
            if($(this).hasClass("flyin") && $(this).hasClass("scrolldown")) return;
            setOptinCookie();
          });

        });
      </script>
      <?php
    }




   function tx_optin_plugin_is_page() {
    global $optinPost;
    global $optinPage;
    global $optinHome;
    global $optinSession;

    $optinFlag = isset($_COOKIE['optinSession']) ? $_COOKIE['optinSession'] : false;
    $subscribed = isset($_COOKIE['subscribed']) ? true : false;
    
    if ($subscribed) return;

    if ($optinFlag) return;
        
    if (is_page($optinPage) || 
      is_single($optinPost) || 
      is_home($optinHome) == $optinHome) {

      add_action('wp_footer', [$this, 'tx_optin_load_template']);
    }
  }

  function tx_optin_load_template(){
    global $optinType;
    global $optinTimer;

    $DATA = array(
      'OPTIN_TIMER' => OPTIN_TIMER ? : false,
      'OPTIN_DATA' => OPTIN_DATA,
      'OPTIN_IMAGE' => OPTIN_IMAGE,
      'optin_mail' => isset($_POST["optin_mail"]) ? $_POST["optin_mail"] : ""
    );

    $templates = array(            
      'flyin' => "flying.tpl.php",
      'stickytop' => "stickytop.tpl.php",
      'lightbox' => "lightbox.tpl.php",
    );

    $template = __DIR__."/views/front/".$templates[$optinType];

    echo tx_view($template, $DATA);
  }
}

// Kickstart the class
new TX_XpertOptin();




