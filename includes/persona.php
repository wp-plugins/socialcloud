<?php
/**
 * Add the Css and Js files to the <head> of WordPress pages
 *
 * @return none
 *adds HTML to the document <head>
 */

class persona_plugin {

    function persona_comment_template() {
        if (file_exists(dirname(__FILE__) . '/persona-comment-template.php'))
            return dirname(__FILE__) . '/persona-comment-template.php';
        else
            echo 'comment template file doesnot exist';
    }

    public static function my_jquery_enqueue() {
        
    }

    public static function persona_addFiles() {

        $src = plugins_url('css/common.css', dirname(__FILE__));
        wp_register_style('commonCss', $src);
        wp_enqueue_style('commonCss');
        wp_enqueue_script('persona_widget', 'http://persona.to/assets/public/js/personawidgetapi.js', array('jquery'), '', false);
        wp_localize_script('persona_widget', 'personaL10n', array(
            'plugin_url' => plugins_url('persona'),
            'ajax_url' => admin_url('admin-ajax.php', (is_ssl() ? 'https' : 'http')),
        ));
    }

    public static function persona() {
        try {

            if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'changekey') {
                require_once('html/configuration.php');
            } else {
                $betaoutApiKey = get_option("_PERSONA_API_KEY");
                $betaoutApiSecret = get_option("_PERSONA_API_SECRET");
                $wordpressVersion = get_bloginfo('version');
                $wordpressBoPluginUrl = plugins_url() . "/persona";



                if (!empty($betaoutApiKey) && !empty($betaoutApiSecret)) {
                    $parameters = array('wordpressVersion' => $wordpressVersion, 'wordpressBoPluginUrl' => $wordpressBoPluginUrl);
                    try {

                        $IPPHPSDKObj = new PERSONASDK($betaoutApiKey, $betaoutApiSecret, ACCESS_API_URL);
                        $curlResponse = $IPPHPSDKObj->validatePublication($parameters);
                    } catch (Exception $ex) {
                        $curlResponse = '{ "error": "' . $ex->getMessage() . '", "responseCode": 500 }';
                    }
                    $curlResponse = json_decode($curlResponse, true);
                }
                if (isset($curlResponse['responseCode']) && $curlResponse['responseCode'] == 200) {
                    $clientAccountName = $curlResponse['clientAccountName'];
                    $facebookEnable = isset($curlResponse['facebookConnected']) ? $curlResponse['facebookConnected'] : "N";
                    $twitterEnable = isset($curlResponse['twitterConnected']) ? $curlResponse['twitterConnected'] : "N";
                    $googleEnable = isset($curlResponse['googleConnected']) ? $curlResponse['googleConnected'] : "N";
                    require_once('html/configuredSuccess.php');
                }
                else
                    require_once('html/configuration.php');
            }
        } catch (Exception $ex) {
            print_r($ex);
        }
    }

    public static function personaPluginMenu() {

        add_menu_page('Persona', 'Persona', 'manage_options', 'persona', 'persona_plugin::persona', plugins_url('images/icon.png', dirname(__FILE__)));
    }

     function persona_login_form() {
      
        if (is_user_logged_in()) {
            return true;
        }


        if (strstr(wp_login_url(), 'wp-login.php') !== false) {
            //rpx_wp_footer();
        }

        $betaoutApiKey = get_option("_PERSONA_API_KEY");
        echo $widget = '<p id="engage_loginWidget" style="margin-bottom:80px">
                   <script type="text/javascript">
                       engage.loginModule.loginWidgetLoad("' . $betaoutApiKey . '");
                   </script>
                   </p>';
    }

   
    public function personalogout() {
        do_action('clear_auth_cookie');

        setcookie(AUTH_COOKIE, ' ', time() - 31536000, ADMIN_COOKIE_PATH, COOKIE_DOMAIN);

        setcookie(SECURE_AUTH_COOKIE, ' ', time() - 31536000, ADMIN_COOKIE_PATH, COOKIE_DOMAIN);

        setcookie(AUTH_COOKIE, ' ', time() - 31536000, PLUGINS_COOKIE_PATH, COOKIE_DOMAIN);

        setcookie(SECURE_AUTH_COOKIE, ' ', time() - 31536000, PLUGINS_COOKIE_PATH, COOKIE_DOMAIN);

        setcookie(LOGGED_IN_COOKIE, ' ', time() - 31536000, COOKIEPATH, COOKIE_DOMAIN);

        setcookie(LOGGED_IN_COOKIE, ' ', time() - 31536000, SITECOOKIEPATH, COOKIE_DOMAIN);



        // Old cookies

        setcookie(AUTH_COOKIE, ' ', time() - 31536000, COOKIEPATH, COOKIE_DOMAIN);

        setcookie(AUTH_COOKIE, ' ', time() - 31536000, SITECOOKIEPATH, COOKIE_DOMAIN);

        setcookie(SECURE_AUTH_COOKIE, ' ', time() - 31536000, COOKIEPATH, COOKIE_DOMAIN);

        setcookie(SECURE_AUTH_COOKIE, ' ', time() - 31536000, SITECOOKIEPATH, COOKIE_DOMAIN);



        // Even older cookies

        setcookie(USER_COOKIE, ' ', time() - 31536000, COOKIEPATH, COOKIE_DOMAIN);

        setcookie(PASS_COOKIE, ' ', time() - 31536000, COOKIEPATH, COOKIE_DOMAIN);

        setcookie(USER_COOKIE, ' ', time() - 31536000, SITECOOKIEPATH, COOKIE_DOMAIN);

        setcookie(PASS_COOKIE, ' ', time() - 31536000, SITECOOKIEPATH, COOKIE_DOMAIN);
        setcookie("personasessionid", ' ', time() - 31536000, SITECOOKIEPATH, COOKIE_DOMAIN);
    }

    public static function clearcookies() {

        setcookie(AUTH_COOKIE, ' ', time() - 31536000, ADMIN_COOKIE_PATH, COOKIE_DOMAIN);

        setcookie(SECURE_AUTH_COOKIE, ' ', time() - 31536000, ADMIN_COOKIE_PATH, COOKIE_DOMAIN);

        setcookie(AUTH_COOKIE, ' ', time() - 31536000, PLUGINS_COOKIE_PATH, COOKIE_DOMAIN);

        setcookie(SECURE_AUTH_COOKIE, ' ', time() - 31536000, PLUGINS_COOKIE_PATH, COOKIE_DOMAIN);

        setcookie(LOGGED_IN_COOKIE, ' ', time() - 31536000, COOKIEPATH, COOKIE_DOMAIN);

        setcookie(LOGGED_IN_COOKIE, ' ', time() - 31536000, SITECOOKIEPATH, COOKIE_DOMAIN);



        // Old cookies

        setcookie(AUTH_COOKIE, ' ', time() - 31536000, COOKIEPATH, COOKIE_DOMAIN);

        setcookie(AUTH_COOKIE, ' ', time() - 31536000, SITECOOKIEPATH, COOKIE_DOMAIN);

        setcookie(SECURE_AUTH_COOKIE, ' ', time() - 31536000, COOKIEPATH, COOKIE_DOMAIN);

        setcookie(SECURE_AUTH_COOKIE, ' ', time() - 31536000, SITECOOKIEPATH, COOKIE_DOMAIN);



        // Even older cookies

        setcookie(USER_COOKIE, ' ', time() - 31536000, COOKIEPATH, COOKIE_DOMAIN);

        setcookie(PASS_COOKIE, ' ', time() - 31536000, COOKIEPATH, COOKIE_DOMAIN);

        setcookie(USER_COOKIE, ' ', time() - 31536000, SITECOOKIEPATH, COOKIE_DOMAIN);

        setcookie(PASS_COOKIE, ' ', time() - 31536000, SITECOOKIEPATH, COOKIE_DOMAIN);
    }


    public function persona_get_data() {

       if ($_COOKIE['personasessionid']) {
            $betaoutApiKey = get_option("_PERSONA_API_KEY");
            $betaoutApiSecret = get_option("_PERSONA_API_SECRET");
            $url = 'http://' . get_option("_PERSONA_CLIENT_NAME") . "." . PERSONA_PROFILE_URL;
            try{
            $IPPHPSDKObj = new PERSONASDK($betaoutApiKey, $betaoutApiSecret, $url);
            $parameters = array("personasessionid" => $_COOKIE['personasessionid']);
            $curlResponse = $IPPHPSDKObj->getProfileSnap($parameters);
            $UserProfile = json_decode($curlResponse, true);
            if (isset($UserProfile['responseCode']) && $UserProfile['responseCode'] == 200) {

                return $UserProfile;
            } else {
                if (get_option('_PERSONA_LOGIN') == "Y") {
                    update_option('_PERSONA_LOGIN', "N");
                    persona_plugin::clearcookies();
                    add_filter('show_admin_bar', '__return_false');
                }
                return false;
            }

            return false;
       }catch(Exception $e){
         return false;
       }
       }
    }

    function connect() {
        global $wpdb;

        $betaoutApiKey = get_option("_PERSONA_API_KEY");
        $betaoutApiSecret = get_option("_PERSONA_API_SECRET");

        $userprofile = self::persona_get_data();
        $userId = $userprofile['userId'];
        if (!empty($userId) && !is_user_logged_in() && !is_admin()) {
            update_option("_PERSONA_LOGIN", "Y");
            if (!empty($userprofile['userEmail'])) {

                $wp_user_id = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM $wpdb->usermeta WHERE meta_key='personaid' AND meta_value = %d", $userId));



                if (empty($wp_user_id)) {

                    $wp_user_obj = get_user_by('email', $userprofile['userEmail']);

                    $wp_user_id = $wp_user_obj->ID;
                }


                if (!empty($wp_user_id)) {
                    $loginRadiusUserInfo = get_userdata($wp_user_id);
                    $wp_user_id_tmp = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM $wpdb->usermeta WHERE user_id = %d and meta_key='personaid'", $wp_user_id));
                    if (empty($wp_user_id_tmp)) {
                        update_user_meta($wp_user_id, 'personaid', $userId);
                        update_user_meta($wp_user_id, 'thumbnail', $userprofile['userImage']);
                    }


                    self::set_cookies($wp_user_id);

                    $redirect = site_url() . $_SERVER['REQUEST_URI'];
                    wp_redirect($redirect);
                } else {

                    if (!get_option('users_can_register')) {
                        wp_redirect('wp-login.php?registration=disabled');
                        exit();
                    }

                    self::add_new_wpuser($userprofile);
                }
            } // check verification status of the email ends.
        }
    }

    function personaajexlogin() {
        global $wpdb;

        $betaoutApiKey = get_option("_PERSONA_API_KEY");
        $betaoutApiSecret = get_option("_PERSONA_API_SECRET");

        $userprofile = self::persona_get_data();
        $userId = $userprofile['userId'];
        if (!empty($userId)) {
            update_option("_PERSONA_LOGIN", "Y");
            if (!empty($userprofile['userEmail'])) {

                $wp_user_id = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM $wpdb->usermeta WHERE meta_key='personaid' AND meta_value = %d", $userId));



                if (empty($wp_user_id)) {

                    $wp_user_obj = get_user_by('email', $userprofile['userEmail']);

                    $wp_user_id = $wp_user_obj->ID;
                }


                if (!empty($wp_user_id)) {
                    $loginRadiusUserInfo = get_userdata($wp_user_id);
                    $wp_user_id_tmp = $wpdb->get_var($wpdb->prepare("SELECT user_id FROM $wpdb->usermeta WHERE user_id = %d and meta_key='personaid'", $wp_user_id));
                    if (empty($wp_user_id_tmp)) {
                        update_user_meta($wp_user_id, 'personaid', $userId);
                        update_user_meta($wp_user_id, 'thumbnail', $userprofile['userImage']);
                    }


                    self::set_cookies($wp_user_id);
                      exit();
                } else {

                    if (!get_option('users_can_register')) {
                        wp_redirect('wp-login.php?registration=disabled');
                        exit();
                    }

                    self::add_new_wpuser($userprofile);
                }
            } // check verification status of the email ends.
        }
    }
    // Autantication ends


    private static function add_new_wpuser($userprofile) {

        global $wpdb;
        $user_pass = wp_generate_password();

        $personaid = $userprofile['userId'];
        $thumbnail = $userprofile['userImage'];



        if (isset($personaid) && !empty($personaid)) {
            if (!empty($userprofile['userEmail'])) {
                $email = $userprofile['userEmail'];
            }


            if (!empty($userprofile['userLogin'])) {
                $username = $userprofile['userLogin'];
            } else {
                $username = explode('@', $email);
            }
            if (!empty($userprofile['userFirstName'])) {
                $fname = $userprofile['userFirstName'];
            } else {
                $user_name = explode('@', $email);
                $fname = str_replace("_", " ", $user_name[0]);
            }
            if (!empty($userprofile['userLastName'])) {
                $lname = $userprofile['userFirstName'];
            }




            $role = get_option('default_role');
            $nameexists = true;
            $index = 0;
            $username = str_replace(' ', '-', $username);

            $userName = $username;
            while ($nameexists == true) {
                if (username_exists($userName) != 0) {
                    $index++;
                    $userName = $username . $index;
                } else {
                    $nameexists = false;
                }
            }



            $username = $userName;



            $userdata = array(
                'user_login' => $username,
                'user_pass' => $user_pass,
                'user_nicename' => sanitize_title($fname),
                'user_email' => $email,
                'display_name' => $fname,
                'nickname' => $fname,
                'first_name' => $fname,
                'last_name' => $lname,
                'role' => $role
            );

            $user_id = wp_insert_user($userdata);
            if (!empty($user_id)) {
                wp_new_user_notification($user_id, $user_pass);
            }



            if (!is_wp_error($user_id)) {

                if (!empty($email)) {
                    update_user_meta($user_id, 'email', $email);
                }
                if (!empty($personaid)) {
                    update_user_meta($user_id, 'personaid', $personaid);
                }

                if (!empty($thumbnail)) {
                    update_user_meta($user_id, 'thumbnail', $thumbnail);
                }
                wp_clear_auth_cookie();
                wp_set_auth_cookie($user_id);
                wp_set_current_user($user_id);
                $redirect = site_url() . $_SERVER['REQUEST_URI'];
                ;
                wp_redirect($redirect);
            } else {
                wp_redirect($redirect);
            }
        }
    }

    private static function set_cookies($user_id = 0, $remember = true) {
       if (!function_exists('wp_set_auth_cookie')) {

            return false;
        }

        if (!$user_id) {

            return false;
        }

        if (!$user = get_userdata($user_id)) {

            return false;
        }

        wp_clear_auth_cookie();



        wp_set_auth_cookie($user_id, $remember);



        wp_set_current_user($user_id);



        return true;
    }

    public static function footerWidget() {
        $betaoutApiKey = get_option("_PERSONA_API_KEY");
        $betaoutApiSecret = get_option("_PERSONA_API_SECRET");
        echo $widget = '<div id="engage_socialFooterBarWidget">
                   <script type="text/javascript">
                       engage.socialFooterBarWidget.socialFooterBarWidgetLoad("' . $betaoutApiKey . '");
                   </script>
                   </div>';
    }

}



