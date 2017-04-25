<?php

class ItemModel extends CI_Model
{
    function __construct() {
        parent::__construct();
        $api = new \Audeio\Spotify\API();
        $api->setAccessToken('BAWSDOJWEO984yt34y35YgdsnhlreGERH56u45htrH54y');

    }

    
}
 

