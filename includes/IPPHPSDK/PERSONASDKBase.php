<?php

/**
 * Copyright 2011 Instapress, Inc.
 * @author Jitendra Singh Bhadouria
 */
if (!function_exists('curl_init')) {
    throw new Exception('SocialAxis needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
    throw new Exception('SocialAxis needs the JSON PHP extension.');
}

abstract class PERSONASDKBase {

    protected $apiKey;
    protected $apiSecret;
    protected $publicationUrl;
    protected $requestUrl;
    protected $params;
    protected $signatureMethod = 'HMAC-SHA1';
    protected $hash;
    protected $timeStamp;
    protected $functionUrlMap = array(
        'getTopContributors' => 'publication/topcontributors/',
        'getContentLikes' => 'publication/contentlikes/',
        'likeContent' => 'user/likecontent/',
        'getRecentBadges' => 'publication/recentbadges/',
        'getUserFollowers' => 'user/followers/',
        'getUserFollowing' => 'user/following/',
        'getLatestActivities' => 'publication/latestactivities/',
        'getUserFriendsActivityStream' => 'user/friendsactivitystream/',
        'getUserActivities' => 'user/activities/',
        'getUserNotifications' => 'user/notifications/',
        'postContentRating' => 'user/contentrating/',
        'getContentRating' => 'publication/contentrating/',
        'getUserAchievements' => 'user/achievements/',
        'getCurrentOnlineUser' => 'client/currentonlineuser/',
        'getUserStalkers' => 'user/stalkers/',
        'getProfileSnap' => 'user/profilesnap/',
        'loginUser' => 'user/login/',
        'logoutUser' => 'user/logout/',
        'requestGamification' => 'user/requestgamification/',
        'getUserProfile' => 'user/profile/',
        'reactOnContent' => 'user/reactiononcontent/',
        'validatePublication' => 'publicationadmin/validatepersonapublication/',
        'registerWordpressUser' => 'publication/registerwordpressuser/',
        'editWordpressUser' => 'publication/editwordpressuser/',
        'sendPersonaUserToWordpress' => 'xmlrpc.php',
        'deactivatePersonaPlugin' => 'publicationadmin/deactivatepersonaplugin/',
        'uninstallPersonaPlugin' => 'publicationadmin/uninstallpersonaplugin/',
        'sendPreviousUser' => 'publication/sendprevioususer/',
        'isWpSync' => 'publicationadmin/iswpsync/',
        'loginWidget' => 'publicationadmin/personawidgetcode/'
    );

    public function __construct($apiKey, $apiSecret, $publicationUrl) {
        $this->setPersonaApiKey($apiKey);
        $this->setPersonaApiSecret($apiSecret);
        $this->setPersonaPublicationUrl($publicationUrl);
        $this->setPersonaTimeStamp(time());
    }

    public static $CURL_OPTS = array(
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_USERAGENT => 'instapress-engageapi-php-1.0',
    );

    public function setPersonaApiKey($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function getPersonaApiKey() {
        return $this->apiKey;
    }

    public function setPersonaPublicationUrl($publicationUrl) {
        $this->publicationUrl = trim($publicationUrl, "/") . "/";
    }

    public function getPersonaPublicationUrl() {
        return $this->publicationUrl;
    }

    public function setPersonaHash($hash) {
        $this->hash = $hash;
        return $this;
    }

    public function getPersonaHash() {
        return $this->hash;
    }

    public function setPersonaParams($params) {
        $this->params = $params;
        return $this;
    }

    public function getPersonaParams() {
        return $this->params;
    }

    public function setPersonaApiSecret($apiSecret) {
        $this->apiSecret = $apiSecret;
        return $this;
    }

    public function getPersonaApiSecret() {
        return $this->apiSecret;
    }

    public function getPersonaRequestUrl() {
        return $this->requestUrl;
    }

    public function setPersonaRequestUrl($requestUrl) {
        $this->requestUrl = $requestUrl;
        return $this;
    }

    public function setPersonaTimeStamp($timeStamp) {
        $this->timeStamp = $timeStamp;
    }

    public function getPersonaTimeStamp() {
        $timeStamp = $this->timeStamp;
        if (empty($timeStamp))
            $this->setPersonaTimeStamp(time());
        return $this->timeStamp;
    }

    public function makePersonaParams($params=false) {
        if (!is_array($params) && !empty($params))
            throw new Exception("paramter should be associative array!");
        try {
            if (!isset($params['publicationKey']))
                $params['publicationKey'] = $this->getPersonaApiKey();
            if (!isset($params['timestamp']))
                $params['timestamp'] = $this->getPersonaTimeStamp();
            ksort($params);
            $paramUrl = http_build_query($params, null, "&");
            $this->setPersonaParams($paramUrl);
        } catch (Exception $ex) {
            throw new Exception($ex->getCode() . ":" . $ex->getMessage());
        }
    }

    function __call($functionName, $argumentsArray) {
        $apiKey = $this->getPersonaApiKey();
        $apiSecret = $this->getPersonaApiSecret();
        if (empty($apiKey))
            throw new Exception("Invalid Api call, Api key must be provided!");
        if (empty($apiSecret))
            throw new Exception("Invalid Api call, Api Secret must be provided!");
        if (!isset($this->functionUrlMap[$functionName]))
            throw new Exception("Invalid Function call!");
        try {
            $requestUrl = $this->getPersonaPublicationUrl() . $this->functionUrlMap[$functionName]; //there should be error handling to make sure function name exist
            if (isset($argumentsArray[0]) && is_array($argumentsArray[0]) && count($argumentsArray[0]) > 0)
                $this->makePersonaParams($argumentsArray[0]);
            else
                $this->makePersonaParams();
            $requestUrl.="?" . $this->getPersonaParams();
            $this->setPersonaRequestUrl($requestUrl);
            $this->personaSignString();
            $requestUrl = $this->getPersonaRequestUrl() . "&hash=" . $this->getPersonaHash();
            return $this->makePersonaRequest($requestUrl);
        } catch (Exception $ex) {
            throw new Exception($ex->getCode() . ":" . $ex->getMessage());
        }
    }

    protected function personaSignString() {
        switch ($this->signatureMethod) {
            case 'HMAC-SHA1':
                $key = $this->persona_encode_rfc3986($this->apiSecret);
                $params = $this->getPersonaParams();
                $hash = urlencode(base64_encode(hash_hmac('sha1', $params, $key, true)));
                $this->setPersonaHash($hash);
                break;
            default :
                throw new Exception("Signature method is not valid");
                break;
        }
    }

    protected function persona_encode_rfc3986($string) {
        return str_replace('+', ' ', str_replace('%7E', '~', rawurlencode(($string))));
    }

    protected function makePersonaRequest($requestUrl, $ch=null) {
        if (!$ch) {
            $ch = curl_init();
        }
        $options = self::$CURL_OPTS;
        $options[CURLOPT_URL] = $requestUrl;
// disable the 'Expect: 100-continue' behaviour. This causes CURL to wait
// for 2 seconds if the server does not support this header.
        if (isset($options[CURLOPT_HTTPHEADER])) {
            $existing_headers = $options[CURLOPT_HTTPHEADER];
            $existing_headers[] = 'Expect:';
            $options[CURLOPT_HTTPHEADER] = $existing_headers;
        } else {
            $options[CURLOPT_HTTPHEADER] = array('Expect:');
        }

        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);

        if ($result === false) {
            throw new Exception('Curl error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

}


