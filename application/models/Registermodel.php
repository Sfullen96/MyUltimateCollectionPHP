<?php

class Registermodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function createAccount($params) {
       
        $this->db->insert('user', $params);

        return $this->db->insert_id();

    }

    public function checkEmail( $email ) {

        $query = $this->db->select()
            ->where( 'email', $email )
            ->get( 'user' );

        if ( $query->num_rows() > 0 ) {
            return true;
        } else {
            return false;
        }

    }

    public function checkUsername( $username ) {

        $query = $this->db->select()
            ->where( 'username', $username )
            ->get( 'user' );

        if ( $query->num_rows() > 0 ) {
            return true;
        } else {
            return false;
        }

    }

}	

