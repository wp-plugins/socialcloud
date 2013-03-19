<?php
/**
 *  Author: Rohit Tyagi
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Adds PersonaLikeDislikeWidget widget.
 */
class PersonaRecentLikedWidget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
                'SocialCloudRecentLiked', // Base ID
                'Social Cloud RecentLiked', // Name
                array('description' => __('Display recently liked content.', 'text_domain'),) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    function widget($args, $instance) {

 extract( $args );

        $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title'], $instance, $this->id_base);

        echo $before_widget;
        if ($title)
            echo $before_title . $title . $after_title;
        $personaApiKey = get_option("_PERSONA_API_KEY");
         global $wpdb;
         $post_id = get_the_ID();
         $contentUrl=get_permalink();
        echo $widget = '<div id="engage_recentLiked">
        <script type="text/javascript">
            engage.recentLikedWidget.recentLikedWidgetLoad("' . $personaApiKey . '");
        </script></div>';

        echo $after_widget;
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


