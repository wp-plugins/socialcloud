<?php

/**
 * Copyright 2011 Instapress, Inc.
 * @author Jitendra Singh Bhadouria
 *
 */
require_once 'PERSONASDKBase.php';

class PERSONASDK extends PERSONASDKBase {

    public function __construct($apiKey, $apiSecret, $publicationUrl) {
        parent::__construct($apiKey, $apiSecret, $publicationUrl);
    }

}


