<?php

class Admin extends CI_Controller
{
    public function index()
    {
        //This function loads the login page.
        $data['title'] = "Login | My Ultimate Collection";
        $data['main_content'] = 'admin-home';
        $this->load->view('includes/template', $data);
    }
    
    
}

?>