<?php
$showError = false;
if (isset($_POST['savechanges'])) {
    try {
        $personaonboarding = isset($_POST['personaonboarding']) ? trim($_POST['personaonboarding']) : '1';
        $personafooterbar = isset($_POST['personafooterbar']) ? trim($_POST['personafooterbar']) : '1';
        $personacomment = isset($_POST['personacomment']) ? trim($_POST['personacomment']) : '1';
        $personacommentstatus = isset($_POST['commentapprove']) ? trim($_POST['commentapprove']) : '1';
        $personaratingposition = isset($_POST['persona_rating_post_position']) ? trim($_POST['persona_rating_post_position']) : 'top';
        $personalikeposition = isset($_POST['persona_like_post_position']) ? trim($_POST['persona_like_post_position']) : 'top';
        update_option("_PERSONA_COMMENT", $personacomment);
        update_option("_PERSONA_ONBOARDING", $personaonboarding);
        update_option("_PERSONA_FOOTERBAR", $personafooterbar);
        update_option("_PERSONA_COMMENT_APPROVE", $personacommentstatus);
        update_option("persona_rating_post_position", $personaratingposition);
        update_option("persona_like_post_position", $personalikeposition);
    } catch (Exception $ex) {

    }
}
?>

<style type="text/css">
    .headerBar{
        width: 70%;
        float: left;
        border: 1px solid #7B7B7B;
        background-color: #3399CC;
        color: #fff;
        padding: 10px;
        margin-top: 20px;
        font: bold 13px Arial;
    }
</style>

<div style="padding: 20px;width: 80%;">
    <div style="float:left;width:100%;border-bottom: 1px solid #999;padding-bottom: 20px">
        <img src="<?php echo plugins_url('images/personaLogo.png', dirname(dirname(__FILE__))); ?>" alt="" style="float:left;margin-right: 10px;"/>
        <span style="font:normal 24px Arial;color:#333333;float:left;margin-top: 5px;">Persona Settings</span>
    </div>
    <div style="float: left;width: 100%;font: normal 13px Arial;color: #333333;margin-top: 20px;">
        <div style="float: left">
            <img src="<?php echo plugins_url('images/success.png', dirname(dirname(__FILE__))); ?>" alt="" style="float: left;margin-right: 10px;vertical-align: middle;"/>
            <div style="float: left;font: bold 18px Arial;color: #333333;margin-top: 5px;">
                <span>Plugin Successfully Installed</span>
            </div>
        </div>
        <div style="float: right">
            <a href="http://<?php echo str_replace('&action=changekey', '', $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']); ?>&action=changekey">Change Site API Key</a>
        </div>
    </div>
    <div style="float: left;width: 100%;font: normal 13px Arial;color: #333333;margin: 10px 0 10px 10px">
        <span>User Profiles and User Dashboard can be found at <a target="_blank" href="<?php echo "http://" . $clientAccountName . "." . PERSONA_URL; ?>"><?php echo $clientAccountName . "." . PERSONA_URL; ?></a></span>
    </div>

    <div class="headerBar">Social Networks</div>
    <div style="float: left;width: 100%;font: normal 13px Arial;margin: 10px;">
        <div style="display: inline-block;">
            <img src="<?php echo plugins_url('images/facebookIcon.png', dirname(dirname(__FILE__))); ?>" alt="" style="float: left;"/>
            <?php if ($facebookEnable == 'Y') {
            ?>
                <div style="float: left;width: 70px;margin: 10px 0 0 10px;">
                    <img src="<?php echo plugins_url('images/check.png', dirname(dirname(__FILE__))); ?>" alt="" style="float:left"/>
                    <span style="float: left;margin-left: 5px;">Installed</span>
                </div>
            <?php } else {
            ?>
                <a target="_blank" href="<?php echo ACCESS_URL . "socialaccount"; ?>"><div   style="float: left;width: 60px;margin-left: 10px;color: #62C0E0;text-decoration: underline;cursor: pointer">Enable Facebook</div></a>
            <?php } ?>
        </div>
        <div style="display: inline-block">
            <img src="<?php echo plugins_url('images/twitterIcon.png', dirname(dirname(__FILE__))); ?>" alt="" style="float: left;"/>
            <?php if ($twitterEnable == 'Y') {
            ?>
                <div style="float: left;width: 70px;margin: 10px 0 0 10px;">
                    <img src="<?php echo plugins_url('images/check.png', dirname(dirname(__FILE__))); ?>" alt="" style="float:left"/>
                    <span style="float: left;margin-left: 5px;">Installed</span>
                </div>
            <?php } else {
            ?>
                <a target="_blank" href="<?php echo ACCESS_URL . "socialaccount"; ?>"><div  style="float: left;width: 60px;margin-left: 10px;color: #62C0E0;text-decoration: underline;cursor: pointer">Enable Twitter</div></a>
            <?php } ?>
        </div>
        <div style="display: inline-block">
            <img src="<?php echo plugins_url('images/googleIcon.png', dirname(dirname(__FILE__))); ?>" alt="" style="float: left;"/>
            <?php if ($googleEnable == 'Y') {
 ?>
                <div style="float: left;width: 70px;margin: 10px 0 0 10px;">
                    <img src="<?php echo plugins_url('images/check.png', dirname(dirname(__FILE__))); ?>" alt="" style="float:left"/>
                    <span style="float: left;margin-left: 5px;">Installed</span>
                </div>
<?php } else { ?>
                <div style="float: left;width: 60px;margin-left: 10px;color: #62C0E0;text-decoration: underline;cursor: pointer">Enable Google</div>
<?php } ?>
        </div>
        <div style="display: inline-block">
            <img src="<?php echo plugins_url('images/linkedin.png', dirname(dirname(__FILE__))); ?>" alt="" style="float: left;"/>
<?php if ($linkedinEnable == 'Y') { ?>
                <div style="float: left;width: 70px;margin: 10px 0 0 10px;">
                    <img src="<?php echo plugins_url('images/check.png', dirname(dirname(__FILE__))); ?>" alt="" style="float:left"/>
                    <span style="float: left;margin-left: 5px;">Installed</span>
                </div>
<?php } else { ?>
                <div style="float: left;width: 60px;margin-left: 10px;color: #62C0E0;text-decoration: underline;cursor: pointer">Enable LinkedIn</div>
<?php } ?>
        </div>
    </div>
    <form action="" method="post">

        <div class="headerBar">persona OnBoarding</div>
        <div style="float: left;width: 100%;font: normal 13px Arial;margin: 10px;">
<?php if (get_option("_PERSONA_ONBOARDING")) { ?>
                <div style="margin: 10px 0">
                    <input type="radio" name="personaonboarding" checked="checked" value="1"/>
                    <span>  Yes <span style="font-weight: bold;">(Default)</span></span>
                </div>
                <div>
                    <input type="radio" name="personaonboarding" value="0"/>
                    <span>  No</span>
                </div>
<?php } else { ?>
                <div style="margin: 10px 0">
                    <input type="radio" name="personaonboarding" value="1"/>
                    <span>  Yes <span style="font-weight: bold;">(Default)</span></span>
                </div>
                <div>
                    <input type="radio" name="personaonboarding" checked="checked" value="0"/>
                    <span>  No</span>
                </div>
<?php } ?>
        </div>
        <div class="headerBar">Persona FooterBar</div>
        <div style="float: left;width: 100%;font: normal 13px Arial;margin: 10px;">
<?php if (get_option("_PERSONA_FOOTERBAR")) { ?>
                <div style="margin: 10px 0">
                    <input type="radio" name="personafooterbar" checked="checked" value="1"/>
                    <span> Yes, <span style="font-weight: bold;">(Default)</span></span>
                </div>
                <div>
                    <input type="radio" name="personafooterbar" value="0"/>
                    <span>  No</span>
                </div>
<?php } else { ?>
                <div style="margin: 10px 0">
                    <input type="radio" name="personafooterbar" value="1"/>
                    <span> Yes, <span style="font-weight: bold;">(Default)</span></span>
                </div>
                <div>
                    <input type="radio" name="personafooterbar" checked="checked" value="0"/>
                    <span>  No</span>
                </div>
<?php } ?>
        </div>
        <div class="headerBar"> Persona Comment</div>
        <div style="float: left;width: 100%;font: normal 13px Arial;margin: 10px;">
<?php if (get_option("_PERSONA_COMMENT")) { ?>
                <div style="margin: 10px 0">
                    <input type="radio" name="personacomment" checked="checked" value="1"/>
                    <span> Yes, <span style="font-weight: bold;">(Default)</span></span>
                </div>
                <div>
                    <input type="radio" name="personacomment" value="0"/>
                    <span>  No</span>
                </div>
<?php } else { ?>
                <div style="margin: 10px 0">
                    <input type="radio" name="personacomment" value="1"/>
                    <span> Yes, <span style="font-weight: bold;">(Default)</span></span>
                </div>
                <div>
                    <input type="radio" name="personacomment" checked="checked" value="0"/>
                    <span>  No</span>
                </div>
<?php } ?>
        </div>
        <div class="headerBar">Automatically approve comments left by new users who have linked their Social Networks</div>
        <div style="float: left;width: 100%;font: normal 13px Arial;margin: 10px;">
<?php if (get_option("_PERSONA_COMMENT_APPROVE")) { ?>
                <div style="margin: 10px 0">
                    <input type="radio" name="commentapprove" value="1" checked="checked"/>
                    <span>  Yes, automatically approve comments  <span style="font-weight: bold;">(Default)</span></span>
                </div>
                <div>
                    <input type="radio" name="commentapprove" value="0"/>
                    <span>  No, I will approve them manually</span>
                </div>
<?php } else { ?>
                <div style="margin: 10px 0">
                    <input type="radio" name="commentapprove" value="1"/>
                    <span>  Yes, automatically approve comments  <span style="font-weight: bold;">(Default)</span></span>
                </div>
                <div>
                    <input type="radio" name="commentapprove" value="0" checked="checked"/>
                    <span>  No, I will approve them manually</span>
                </div>
<?php } ?>
        </div>
        <div class="headerBar">Rating position setting</div>
        <div style="margin: 10px 0;width:100%;clear:both">
<?php if (get_option("persona_rating_post_position") == "top") { ?>
                <div style="margin: 10px 0">
                    <input type="radio" name="persona_rating_post_position" value="top" checked="checked"/>
                    <span> Top of Content <span style="font-weight: bold;">(Default)</span></span>
                </div>
                <div>
                    <input type="radio" name="persona_rating_post_position" value="bottom"/>
                    <span>  Bottom of Content</span>
                </div>
                <div>
                    <input type="radio" name="persona_rating_post_position" value="both"/>
                    <span>  Both Top and Bottom of content</span>
                </div>
                <div>
                    <input type="radio" name="persona_rating_post_position" value="disable"/>
                    <span>  Disable</span>
                </div>
<?php } elseif (get_option("persona_rating_post_position") == "bottom") { ?>
                <div style="margin: 10px 0">
                    <input type="radio" name="persona_rating_post_position" value="top"/>
                    <span>  Top of Content  <span style="font-weight: bold;">(Default)</span></span>
                </div>
                <div>
                    <input type="radio" name="persona_rating_post_position" value="bottom" checked="checked"/>
                    <span>  Bottom of Content</span>
                </div>
                <div>
                    <input type="radio" name="persona_rating_post_position" value="both"/>
                    <span>  Both Top and Bottom of content</span>
                </div>
                <div>
                    <input type="radio" name="persona_rating_post_position" value="disable" />
                    <span>  Disable</span>
                </div>

<?php } elseif (get_option("persona_rating_post_position") == "both") { ?>
                <div style="margin: 10px 0">
                    <input type="radio" name="persona_rating_post_position" value="top"/>
                    <span>  Top of Content  <span style="font-weight: bold;">(Default)</span></span>
                </div>
                <div>
                    <input type="radio" name="persona_rating_post_position" value="bottom"/>
                    <span>  Bottom of Content</span>
                </div>
                <div>
                    <input type="radio" name="persona_rating_post_position" value="both" checked="checked"/>
                    <span>  Both Top and Bottom of content</span>
                </div>
                <div>
                    <input type="radio" name="persona_rating_post_position" value="disable" />
                    <span>  Disable</span>
                </div>
<?php } else { ?>
                <div style="margin: 10px 0">
                    <input type="radio" name="persona_rating_post_position" value="top"/>
                    <span>  Top of Content  <span style="font-weight: bold;">(Default)</span></span>
                </div>
                <div>
                    <input type="radio" name="persona_rating_post_position" value="bottom" />
                    <span>  Bottom of Content</span>
                </div>
                <div>
                    <input type="radio" name="persona_rating_post_position" value="both"/>
                    <span>  Both Top and Bottom of content</span>
                </div>
                <div>
                    <input type="radio" name="persona_rating_post_position" value="disable" checked="checked" />
                    <span>  Disable</span>
                </div>
<?php } ?>
        </div>
        <div class="headerBar">Like/Dislike position setting</div>
        <div style="margin: 10px 0;width:100%;clear:both">
<?php if (get_option("persona_like_post_position") == "top") { ?>
                <div style="margin: 10px 0">
                    <input type="radio" name="persona_like_post_position" value="top" checked="checked"/>
                    <span> Top of Content <span style="font-weight: bold;">(Default)</span></span>
                </div>
                <div>
                    <input type="radio" name="persona_like_post_position" value="bottom"/>
                    <span>  Bottom of Content</span>
                </div>
                <div>
                    <input type="radio" name="persona_like_post_position" value="both"/>
                    <span>  Both Top and Bottom of content</span>
                </div>
                <div>
                    <input type="radio" name="persona_like_post_position" value="disable"/>
                    <span>  Disable</span>
                </div>
<?php } elseif (get_option("persona_like_post_position") == "bottom") { ?>
                <div style="margin: 10px 0">
                    <input type="radio" name="persona_like_post_position" value="top"/>
                    <span>  Top of Content <span style="font-weight: bold;">(Default)</span></span>
                </div>
                <div>
                    <input type="radio" name="persona_like_post_position" value="bottom" checked="checked"/>
                    <span>  Bottom of Content</span>
                </div>
                <div>
                    <input type="radio" name="persona_like_post_position" value="both"/>
                    <span>  Both Top and Bottom of content</span>
                </div>
                <div>
                    <input type="radio" name="persona_like_post_position" value="disable"/>
                    <span>  Disable</span>
                </div>

<?php } elseif (get_option("persona_like_post_position") == "both") { ?>
                <div style="margin: 10px 0">
                    <input type="radio" name="persona_like_post_position" value="top"/>
                    <span>  Top of Content <span style="font-weight: bold;">(Default)</span></span>
                </div>
                <div>
                    <input type="radio" name="persona_like_post_position" value="bottom" />
                    <span>  Bottom of Content</span>
                </div>
                <div>
                    <input type="radio" name="persona_like_post_position" value="both" checked="checked"/>
                    <span>  Both Top and Bottom of content</span>
                </div>
                <div>
                    <input type="radio" name="persona_like_post_position" value="disable" />
                    <span>  Disable</span>
                </div>
<?php } else { ?>
                <div style="margin: 10px 0">
                    <input type="radio" name="persona_like_post_position" value="top"/>
                    <span>  Top of Content <span style="font-weight: bold;">(Default)</span></span>
                </div>
                <div>
                    <input type="radio" name="persona_like_post_position" value="bottom" />
                    <span>  Bottom of Content</span>
                </div>
                <div>
                    <input type="radio" name="persona_like_post_position" value="both"/>
                    <span>  Both Top and Bottom of content</span>
                </div>
                <div>
                    <input type="radio" name="persona_like_post_position" value="disable" checked="checked"/>
                    <span>  Disable</span>
                </div>
<?php } ?>
        </div>

        <div style="width:100%;clear:both;margin-top:20px ">
            <input type="hidden" name="savechanges" value="submit"/>
            <button type="button" onclick="javascript:submit();" class="buttonStyle">Save Changes</button>
        </div>

    </form>
    <div style="margin: 10px 0">
        <div> Persona Short Codes </div>
        <div> For Following "[personaFollowing]"</div>
        <div> For Follower "[personaFollower]"</div>
        <div> For Friends Activity "[personaFriendsActivity]"</div>
        <div> For  Latest Activity "[personaLatestActivity]"</div>
        <div> For Leader Board "[personaLeaderboard]"</div>
        <div> For Rating "[personaRating]" </div>
        <div> for Recent Badges "[personaRecentBadges]" </div>
        <div> For User Activity "[personaUserActivity]" </div>
        <div> For Like Dislike "[personaLikeDislike]" </div>

        <div> to  use short code write   echo do_shortcode('[personaFollowing]');</div>
    </div>


</div>
