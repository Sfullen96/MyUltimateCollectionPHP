<?php

class Registermodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function createAccount($params) {
       
        $this->db->insert('users', $params);

        return $this->db->insert_id();

    }

}	

