<?php
/* Author:Rohit Tyagi
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'widgets/PersonaWidget.php';
include_once 'widgets/OnBoardingWidget.php';
include_once 'widgets/SocialFooterBarWidget.php';
include_once 'widgets/PersonaFollowerWidget.php';
include_once 'widgets/PersonaFollowingWidget.php';
include_once 'widgets/PersonaLatestActivityWidget.php';
include_once 'widgets/PersonaRecentBadgesWidget.php';
include_once 'widgets/PersonaFriendActivityWidget.php';
include_once 'widgets/PersonaMostLikedWidget.php';
include_once 'widgets/PersonaMostRatedWidget.php';
include_once 'widgets/PersonaUserActivityWidget.php';
include_once 'widgets/PersonaLeaderboardWidget.php';
include_once 'widgets/PersonaRecentLikedWidget.php';
include_once 'widgets/PersonaRecentRatedWidget.php';

if(get_option("_PERSONA_FOOTERBAR")){
   add_action('widgets_init', create_function('', 'register_widget("SocialFooterBarWidget");'));
    add_action('wp_footer', 'persona_plugin::footerWidget');
    }
 
   if(get_option("_PERSONA_ONBOARDING")){
    add_action('widgets_init', create_function('', 'register_widget("OnBoardingWidget");'));
   }
 add_action('widgets_init', create_function('', 'register_widget("PersonaWidget");'));
 add_action('widgets_init', create_function('', 'register_widget("PersonaFollowingWidget");'));
 add_action('widgets_init', create_function('', 'register_widget("PersonaFollowerWidget");'));
 add_action('widgets_init', create_function('', 'register_widget("PersonaLatestActivityWidget");'));
 add_action('widgets_init', create_function('', 'register_widget("PersonaRecentBadgesWidget");'));
 add_action('widgets_init', create_function('', 'register_widget("PersonaFriendActivityWidget");'));
 add_action('widgets_init', create_function('', 'register_widget("PersonaMostLikedWidget");'));
 add_action('widgets_init', create_function('', 'register_widget("PersonaMostRatedWidget");'));
 add_action('widgets_init', create_function('', 'register_widget("PersonaUserActivityWidget");'));
 add_action('widgets_init', create_function('', 'register_widget("PersonaLeaderboardWidget");'));
 add_action('widgets_init', create_function('', 'register_widget("PersonaRecentLikedWidget");'));
 add_action('widgets_init', create_function('', 'register_widget("PersonaRecentRatedWidget");'));
 
