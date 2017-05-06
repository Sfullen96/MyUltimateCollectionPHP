<?php

class LoginModel extends CI_Model
{
     function __construct()
     {
        parent::__construct();
     }

    /**
     * @param $loginCred
     * @param $password
     * @return mixed
     */
    function checkUser($loginCred, $password) {

         $sql = "
          SELECT * FROM user 
            WHERE (
              username = '$loginCred'
              OR 
              email = '$loginCred'
            )
            AND password = '$password'
          AND deleted_at IS NULL
          ";

         $query = $this->db->query( $sql );

        if($query->num_rows() == 1) {
            return $query->row();
        }

     }
}
 

?>