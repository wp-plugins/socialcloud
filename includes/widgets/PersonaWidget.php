<?php 
class PersonaWidget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'SocialCloudLoginWidget', // Base ID
                'Social Cloud Login', // Name
                array('description' => __('It facilitates user to login with their social accounts.', 'text_domain'),) // Args
        );
    }

    function widget($args, $instance) {

 extract( $args );
        if (is_user_logged_in() && !is_admin() && empty($_COOKIE['personasessionid']) && get_option('_PERSONA_LOGIN') == "N") {
            global $user_ID;
            $size = '60';

            $user = get_userdata($user_ID);

            echo "<div style='height:80px;width:180px'><div style='width:63px;float:left;'>";

            if (($user_thumbnail = get_user_meta($user_ID, 'thumbnail', true)) !== false) {
                if (strlen(trim($user_thumbnail)) > 0) {

                    echo '<img alt="user social avatar" src="' . $user_thumbnail . '" height = "' . $size . '" width = "' . $size . '" title="' . $user->user_login . '" style="border:2px solid #e7e7e7;"/>';
                } else {

                    echo get_avatar($user_ID, $size, $default, $alt);
                }
            }
            echo "</div><div style='width:110px;float:right;'>";
            $redirect = home_url();
            echo '<a href="' . wp_logout_url($redirect) . '">Persona Logout</a></div></div>';
        } else {
            $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title'], $instance, $this->id_base);

            echo $before_widget;
            if ($title)
                echo $before_title . $title . $after_title;
            $personaApiKey = get_option("_PERSONA_API_KEY");
            echo $widget = '<div id="engage_loginWidget">
                   <script type="text/javascript">
                       engage.loginModule.loginWidgetLoad("' . $personaApiKey . '");
                   </script>
                   </div>';
            echo $after_widget;
        }
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

    public function form($instance) {

        if (isset($instance['title']))
            $title = $instance['title'];
        else
            $title = '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <?php
    }

}
