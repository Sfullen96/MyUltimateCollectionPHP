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
            SELECT i.title, a.artist_name, i.artist_id, i.item_id, iv.timestamp AS timestamp
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

        $adds = "
            SELECT i.title, a.artist_name, i.artist_id, i.item_id, created_at AS timestamp
            FROM item i 
            LEFT JOIN artist a 
            ON a.artist_id = i.artist_id
            WHERE i.user_id = '$userId'
            ORDER BY created_at DESC 
            LIMIT 3
        ";

        $addsQuery = $this->db->query( $adds );

        $activity = array_merge( $viewsQuery->result(), $addsQuery->result() );

        return $activity;

    }

}