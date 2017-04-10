<?php

class Login extends CI_Controller
{
    public function index()
    {
        //This function loads the login page.
        $data['title'] = "Login | CD Library";
        $data['main_content'] = 'login';
        $this->load->view('includes/template', $data);
    }
    
    public function loginUser()
    {
   

        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->form_validation->set_rules('email', 'Email',  'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        //This part of the function validates the users input and if it = false then it will load the index function agin.

        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            //This part of the function loads the login model.

            $this->load->model('loginmodel');

            $email = $this->input->post('email');
            $password = hash('sha256', $this->input->post('password'));
            
            $userInfo = $this->loginmodel->checkUser($email, $password);

            if($userInfo) {
                
                if($userInfo->account_type == 1) {
                    $data = array(
                        'user_id' => $userInfo->user_id,
                        'is_logged_in' => true,
                        'admin' => false,
                    );
                    $this->session->set_userdata($data);
                    redirect(base_url() . 'home');
                } else {
                    $data = array(
                        'user_id' => $userInfo->user_id,
                        'is_logged_in' => true,
                        'admin' => true,
                    );
                    $this->session->set_userdata($data);
                    redirect(base_url() . 'admin');
                }

            }
            else
            {
                redirect(base_url() . 'login', 'Wrong username or password');
            }
        }
    }

    function logout()
    {
        $this->load->helper('url');

        $this->session->sess_destroy();
        redirect(base_url() . 'home');
    }
}

?>