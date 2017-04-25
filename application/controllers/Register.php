<?php

class Register extends CI_Controller
{
	public function __construct() {
		parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('registermodel');
	}

    public function index()
    {
        //This function loads the login page.
        $data['title'] = "Register | CD Library";
        $data['main_content'] = 'register';
        $this->load->view('includes/template', $data);
    }
  	
  	public function registerAccount() {
  		if (!isset($_POST)) {
  			die();
  		}

		$this->form_validation->set_rules('fname', 'First Name', 'trim|required');
 	  	$this->form_validation->set_rules('lname', 'Last Name', 'trim|required');
 	  	$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|is_unique[user.email]');
       	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|matches[password_confirm]');
       	$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'trim|required');
       	$this->form_validation->set_error_delimiters('<li>', '</li>');
       	$this->form_validation->set_message('is_unique', 'The %s provided is already taken');

        if ($this->form_validation->run() === FALSE) {
        	// Form validation failed
        	$data['errors'] = validation_errors();
        	$data['fname'] = $_POST['fname'];
            $data['lname'] = $_POST['lname'];
            $data['email'] = $_POST['email'];
            $data['title'] = "Register | CD Library";
            $data['main_content'] = 'register';
            $this->load->view('includes/template', $data);
        } else {
        	$params = array(
        		'first_name' => $_POST['fname'],
        		'last_name' => $_POST['lname'],
        		'email' => $_POST['email'],
        		'password' => hash('sha256', $_POST['password']),
        		'account_type' => 1,
        	);

        	if($newId = $this->registermodel->createAccount($params) > 0) {
        		$data = array(
                    'user_id' => $newId,
                    'is_logged_in' => true,
                    'admin' => false,
                );
                $this->session->set_userdata($data);
                redirect(base_url() . 'home');
        	} else {
        		die('We could not add your account at this time, please try again later');
        	}
        }
    }
}

?>