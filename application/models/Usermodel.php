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

}