<?php

class UserModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getUserInfo( $userId ) {

        $query = $this->db->select()
            ->where( 'user_id', $userId )
            ->get( 'user' );

        if ( $query->num_rows() > 0 ) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updateAccount( $params, $userId ) {
        $this->db->where( 'user_id', $userId );
        $query = $this->db->update('user', $params);

        if ( $query ) {
            return true;
        } else {
            return false;
        }
    }

    public function getRecentActivity( $userId ) {
        $activity = array();

//        $activity['recentlyAdded']['content'] = 'Yep';
//        $activity['recentlyAdded']['timestamp'] = 'Today';
//
//        $activity['recentlyListened']['content'] = 'Uhu';
//        $activity['recentlyListened']['timestamp'] = 'Today';
//
//        $activity['recentlyViewed']['content'] = 'Viewed';
//        $activity['recentlyViewed']['timestamp'] = 'Yesterday';

        $views = "
            SELECT i.title, a.artist_name, i.artist_id, i.item_id, iv.timestamp AS timestamp, i.image
            FROM item_view iv 
            LEFT JOIN item i 
            ON i.item_id = iv.item_id
            LEFT JOIN artist a 
            ON a.artist_id = i.artist_id
            WHERE iv.user_id = '$userId'
            ORDER BY `timestamp` DESC 
            LIMIT 3
        ";

        $viewsQuery = $this->db->query( $views );
        $viewsResult = $viewsQuery->result();

        foreach( $viewsResult as $view ) {
            $activity[ $view->timestamp ]['title'] = $view->title;
            $activity[ $view->timestamp ]['itemId'] = $view->item_id;
            $activity[ $view->timestamp ]['artistId'] = $view->artist_id;
            $activity[ $view->timestamp ]['typeWord'] = 'viewed';
            $activity[ $view->timestamp ]['artist'] = $view->artist_name;
            $activity[ $view->timestamp ]['image'] = $view->image;
            $activity[ $view->timestamp ]['type'] = 'view';
        }

        $adds = "
            SELECT i.title, a.artist_name, i.artist_id, i.item_id, created_at AS timestamp, i.image
            FROM item i 
            LEFT JOIN artist a 
            ON a.artist_id = i.artist_id
            WHERE i.user_id = '$userId'
            ORDER BY created_at DESC 
            LIMIT 3
        ";

        $addsQuery = $this->db->query( $adds );
        $addsResults = $addsQuery->result();

        foreach( $addsResults as $add ) {
            $activity[ $add->timestamp ]['title'] = $add->title;
            $activity[ $add->timestamp ]['itemId'] = $add->item_id;
            $activity[ $add->timestamp ]['artistId'] = $add->artist_id;
            $activity[ $add->timestamp ]['artist'] = $add->artist_name;
            $activity[ $add->timestamp ]['typeWord'] = 'added';
            $activity[ $add->timestamp ]['image'] = $add->image;
            $activity[ $add->timestamp ]['type'] = 'add';
        }

        $listens = "
            SELECT i.title, a.artist_name, i.artist_id, i.item_id, timestamp AS timestamp, i.image
            FROM item_listen il 
            LEFT JOIN item i 
            ON i.item_id = il.item_id
            LEFT JOIN artist a 
            ON a.artist_id = i.artist_id
            WHERE i.user_id = '$userId'
            ORDER BY timestamp DESC 
            LIMIT 3
        ";

        $listensQuery = $this->db->query( $listens );
        $listensResults = $listensQuery->result();

        foreach( $listensResults as $listen ) {
            $activity[ $listen->timestamp ]['title'] = $listen->title;
            $activity[ $listen->timestamp ]['itemId'] = $listen->item_id;
            $activity[ $listen->timestamp ]['artistId'] = $listen->artist_id;
            $activity[ $listen->timestamp ]['artist'] = $listen->artist_name;
            $activity[ $listen->timestamp ]['typeWord'] = 'listened';
            $activity[ $listen->timestamp ]['image'] = $listen->image;
            $activity[ $listen->timestamp ]['type'] = 'listen';
        }

        krsort( $activity );

        return $activity;

    }

}