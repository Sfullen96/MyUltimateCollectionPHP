<?php

class LoginModel extends CI_Model
{
     function __construct()
     {
        parent::__construct();
     }
     function checkUser($email, $password)
     {

        //This function checks the users details against the database.
        $this->db->where('email', $email);
        $this->db->where('password', $password);

        $query = $this->db->get('user');

        if($query->num_rows() == 1)
        {
            return $query->row();
        }

     }
}
 

?>