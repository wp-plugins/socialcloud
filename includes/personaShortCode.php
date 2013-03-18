<?php
function PersonaFollowingWidgetShortCode( ){
    $personaApiKey = get_option("_PERSONA_API_KEY");
      return $widget = '<div id="engage_followingWidget">
            <script type="text/javascript">
                engage.followingWidget.followingWidgetLoad("' . $personaApiKey . '");
            </script>
        </div>';
}
add_shortcode( 'personaFollowing', 'PersonaFollowingWidgetShortCode' );

function PersonaFollowerWidgetShortCode(  ){
     $personaApiKey = get_option("_PERSONA_API_KEY");
      return $widget = '<div id="engage_followersWidget">
            <script type="text/javascript">
                engage.followersWidget.followersWidgetLoad("' . $personaApiKey . '");
            </script>
        </div>';
}
add_shortcode( 'personaFollower', 'PersonaFollowerWidgetShortCode' );

function PersonaFriendActivityWidgetShortCode(){
      $personaApiKey = get_option("_PERSONA_API_KEY");
      return $widget = '<div id="engage_friendsActivityWidget">
                    <script type="text/javascript">
                       engage.friendsActivityWidget.friendsActivityWidgetLoad("'.$personaApiKey.'");
                    </script>
                    </div>';
}
add_shortcode( 'personaFriendsActivity', 'PersonaFriendActivityWidgetShortCode' );

function PersonaLatestActivityWidgetShortCode( ){
      $personaApiKey = get_option("_PERSONA_API_KEY");
      return $widget = '<div id="engage_latestActivityWidget">
                    <script type="text/javascript">
                       engage.latestActivityWidget.latestActivityWidgetLoad("'.$personaApiKey.'");
                    </script>
                    </div>';
}
add_shortcode( 'personaLatestActivity', 'PersonaLatestActivityWidgetShortCode' );

function PersonaLeaderboardWidgetShortCode(){
      $personaApiKey = get_option("_PERSONA_API_KEY");
           return $widget ='<div id="engage_LeaderBoardWidget">
                    <script type="text/javascript">
                       engage.LeaderBoardWidget.LeaderBoardWidgetLoad("' . $personaApiKey . '");
                    </script>
                    </div>';
}
add_shortcode( 'personaLeaderboard', 'PersonaLeaderboardWidgetShortCode' );

function PersonaLikeDislikeWidgetShortCode(){
     $personaApiKey = get_option("_PERSONA_API_KEY");
     global $wpdb;
     $post_id = get_the_ID();
     $contentUrl=get_permalink();
        return  $widget = '<div engage-post_Id="'.$post_id.'" engage-contentUrl="'.$contentUrl.'" engage-type="wordpress" class="engage_likedislikeCommon engage_inlineBlock"></div>
        <script type="text/javascript">
            engage.likedislikeWidget.likedislikeWidgetLoad("' . $personaApiKey . '");
        </script>';

}
add_shortcode( 'personaLikeDislike', 'PersonaLikeDislikeWidgetShortCode' );

function PersonaRatingWidgetShortCode(){
      $personaApiKey = get_option("_PERSONA_API_KEY");
      global $wpdb;
     $post_id = get_the_ID();
     $contentUrl=get_permalink();
            return $widget = '<div class="engage_ratingDiv" engage-ratingData-post_Id="'.$post_id.'" engage-ratingData-contentUrl="'.$contentUrl.'" engage-ratingData-type="wordpress"></div>
            <script type="text/javascript">
               engage.ratingWidget.ratingWidgetLoad("'.$personaApiKey.'");
            </script>';
}
add_shortcode( 'personaRating', 'PersonaRatingWidgetShortCode' );

function PersonaRecentBadgesWidgetShortCode( ){
     $personaApiKey = get_option("_PERSONA_API_KEY");
     return $widget = ' <div id="engage_RecentBadgeWidget">
                    <script type="text/javascript">
                       engage.RecentBadgeWidget.RecentBadgeWidgetLoad("'.$personaApiKey.'");
                    </script>
                    </div>';
}
add_shortcode( 'personaRecentBadges', 'PersonaRecentBadgesWidgetShortCode' );

function PersonaUserActivityWidgetShortCode( ){
     $personaApiKey = get_option("_PERSONA_API_KEY");

        return $widget = '<div id="engage_userActivityWidget">
            <script type="text/javascript">
                engage.userActivityWidget.userActivityWidgetLoad("' . $personaApiKey . '");
            </script>
        </div>';
}
add_shortcode( 'personaUserActivity', 'PersonaUserActivityWidgetShortCode' );


function PersonaMostLikedWidgetShortCode( ){
    $personaApiKey = get_option("_PERSONA_API_KEY");
      return $widget ='<div id="engage_mostLiked">
        <script type="text/javascript">
            engage.mostLikedWidget.mostLikedWidgetLoad("' . $personaApiKey . '");
        </script>
        </div>';
}
add_shortcode( 'personaMostLiked', 'PersonaMostLikedWidgetShortCode' );

function PersonaRecentLikedWidgetShortCode( ){
    $personaApiKey = get_option("_PERSONA_API_KEY");
      return $widget = '<div id="engage_recentLiked">
        <script type="text/javascript">
            engage.recentLikedWidget.recentLikedWidgetLoad("' . $personaApiKey . '");
        </script>
        </div>';
}
add_shortcode( 'personaRecentLiked', 'PersonaRecentLikedWidgetShortCode' );

function PersonaMostRatedWidgetShortCode( ){
    $personaApiKey = get_option("_PERSONA_API_KEY");
      return $widget = '<div id="engage_mostRated">
            <script type="text/javascript">
               engage.mostRatedWidget.mostRatedWidgetLoad("'.$personaApiKey.'");
            </script>
            </div>';
}
add_shortcode( 'personaMostRated', 'PersonaMostRatedWidgetShortCode' );

function PersonaRecentRatedWidgetShortCode( ){
    $personaApiKey = get_option("_PERSONA_API_KEY");
      return $widget = '<div id="engage_recentRated">
        <script type="text/javascript">
            engage.recentRatedWidget.recentRatedWidgetLoad("' . $personaApiKey . '");
        </script>
        </div>';
}
add_shortcode( 'personaRecentRated', 'PersonaMostRatedWidgetShortCode' );

function PersonaLoginWidgetShortCode(){
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
            echo '<a href="' . wp_logout_url($redirect) . '">Persona Logout</a></div>';
        } else {
            
            $personaApiKey = get_option("_PERSONA_API_KEY");
           
            echo $widget = '<div id="engage_loginWidget">
                   <script type="text/javascript">
                       engage.loginModule.loginWidgetLoad("' . $personaApiKey . '");
                   </script>
                   </div>';
           
        }
}
add_shortcode( 'personaLogin', 'PersonaLoginWidgetShortCode' );

function PersonaLikePost($content) {
     $show_on_pages = true;

     if (!is_feed() && $show_on_pages) {
	  $persoan_like_post_content = PersonaLikeDislikeWidgetShortCode();
	  $persoan_like_post_position = get_option('persona_like_post_position');
              if($persoan_like_post_position=="disable"){
                    return $content;
                }

		if ($persoan_like_post_position == 'top') {
			$content = $persoan_like_post_content . $content;
		} elseif ($persoan_like_post_position == 'bottom') {
			$content = $content . $persoan_like_post_content;
		} else {
			$content = $persoan_like_post_content . $content . $persoan_like_post_content;
		}
     }

     return $content;
}

add_filter('the_content', 'PersonaLikePost');

function PersonaRatingPost($content) {
     $show_on_pages = true;

   if (!is_feed() && $show_on_pages) {
	  $persoan_rating_post_content = PersonaRatingWidgetShortCode();
	  $persoan_rating_post_position = get_option('persona_rating_post_position');

                if($persoan_rating_post_position=="disable"){
                    return $content;
                }
		if ($persoan_rating_post_position == 'top') {
			$content = $persoan_rating_post_content . $content;
		} elseif ($persoan_rating_post_position == 'bottom') {
			$content = $content . $persoan_rating_post_content;
		} else {
			$content = $persoan_rating_post_content . $content . $persoan_rating_post_content;
		}
     }

     return $content;
}

add_filter('the_content', 'PersonaRatingPost');

?>
