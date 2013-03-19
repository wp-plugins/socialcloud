<?php
/*
  Plugin Name: Social Cloud
  Plugin URI: http://www.betaout.com
  Description: Manage all your Wordpress sites and Editorial team from a single interface
  Version: 1.0
  Author: BetaOut (support@betaout.com)
  Author URI: http://www.betaout.com
  License: GPLv2 or later
 */


if (isset($_COOKIE['personasessionid']))
    $personaSessionId = $_COOKIE['personasessionid'];

defined('ACCESS_API_URL')
        || define('ACCESS_API_URL', 'http://access.betaout.com/api/');

defined('ACCESS_URL')
        || define('ACCESS_URL', 'http://access.betaout.com/');

defined('PERSONA_URL')
        || define('PERSONA_URL', 'persona.to');

defined('PERSONA_API_URL')
        || define('PERSONA_API_URL', 'http://'.PERSONA_URL.'/clientapi/');

defined('PERSONA_PROFILE_URL')
                ||define('PERSONA_PROFILE_URL', PERSONA_URL.'/clientapi/');



include_once 'includes/IPPHPSDK/PERSONASDK.php';
include_once 'includes/persona.php';
include_once 'includes/PersonaUserDataManagement.php';
include_once 'includes/widget.php';
include_once 'includes/personaShortCode.php';



//------------------------------------------------------------------------------
//the plugin will work function if cURL and add_function exist and the appropriate version of PHP is available.
$adminErrorMessage = "";

if (version_compare(PHP_VERSION, '5.2.0', '<')) {
    $adminErrorMessage .= "PHP 5.2 or newer not found!<br/>";
}

if (!function_exists("curl_init")) {
    $adminErrorMessage .= "cURL library was not found!<br/>";
}

if (!function_exists("session_start")) {
    $adminErrorMessage .= "Sessions are not enabled!<br/>";
}

if (!function_exists("json_decode")) {
    $adminErrorMessage .= "JSON was not enabled!<br/>";
}

if (function_exists('add_action') && function_exists('add_filter')) {
    try {
        if (empty($adminErrorMessage)) {
           
            add_action('init', 'persona_plugin::persona_addFiles');
  
            if (!empty($personaSessionId)) {
                try {
                    update_option('_PERSONA_LOGIN',"Y");
                    setcookie("personasessionid", $personaSessionId, time() + 60 * 60 * 24 * 30, '/');
                   
                } catch (Exception $e) {
                    
                }
            }
            else{
               
                if(get_option('_PERSONA_LOGIN')=="Y")
                {  update_option('_PERSONA_LOGIN', "N");
                   persona_plugin::clearcookies();
                   
                  
                }
            }

        
            add_action('admin_menu', 'persona_plugin::personaPluginMenu');

        }
    } catch (Exception $ex) {
        print_r($ex);
    }
}
add_action('parse_request',array('persona_plugin','connect'));
register_activation_hook(__FILE__, 'Persona_UserDataManagement::myplugin_activate');
add_action('wp_ajax_personalogout', array('persona_plugin','personalogout'));
add_action('wp_ajax_nopriv_personalogin',array('persona_plugin','personaajexlogin'));

 add_filter('login_form', array('persona_plugin','persona_login_form'));
 add_action('register_form', array('persona_plugin','persona_login_form'));
 //add_action('widgets_init', 'persona_plugin::persona_register_widget');
  
register_deactivation_hook(__FILE__, 'Persona_UserDataManagement::myplugin_deactivate');
register_uninstall_hook(__FILE__, 'Persona_UserDataManagement::myplugin_uninstall');

if(get_option("_PERSONA_COMMENT")){
add_filter('comments_template', array('persona_plugin','persona_comment_template'));
}




//add_action('admin_bar_init', 'myfunction');


