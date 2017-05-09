<?php

class User extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model( 'usermodel' );
        $this->load->model( 'itemmodel' );
        $this->load->model( 'artistmodel' );
    }

    public function profileView( $userId ) {

        if ( $userId === $this->session->userdata( 'user_id' ) ) {
            redirect( '/manage-account' );
        }

        echo "<pre>" . print_r( $data['recentActivity'] = $this->usermodel->getRecentActivity( $userId ), TRUE ) . "</pre>";
        die();
        $data['accountInfo'] = $this->usermodel->getUserInfo( $userId );
        $data['title'] = $data['accountInfo']->username . " | My Ultimate Collection";
        $data['top_items'] = $this->itemmodel->getFavAlbums( $userId );
        $data['top_artists'] = $this->artistmodel->getFavArtists( $userId );
        $data['cd_count'] = $this->itemmodel->getCDcount( $userId );
        $data['cd_listened_count'] = $this->itemmodel->getCDListenedCount( $userId );
        $data['main_content'] = 'profile';

        if ( $data['accountInfo']->public == 0 ) {
            $data['heading'] = 'User not found';
            $data['message'] = 'This user could not be found';

            $this->load->view('errors/html/error_404', $data);
        } else {
            $this->load->view('includes/template', $data);
        }
    }

    public function manageAccountView() {
        $userId = $this->session->userdata( 'user_id' );

        $data['accountInfo'] = $this->usermodel->getUserInfo( $userId );
        $data['title'] = $data['accountInfo']->username . " | My Ultimate Collection";
        $data['top_items'] = $this->itemmodel->getFavAlbums( $userId );
        $data['top_artists'] = $this->artistmodel->getFavArtists( $userId );
        $data['cd_count'] = $this->itemmodel->getCDcount( $userId );
        $data['cd_listened_count'] = $this->itemmodel->getCDListenedCount( $userId );
        $data['main_content'] = 'manage-account';

        $this->load->view('includes/template', $data);

    }

    public function editAccount() {
        $userId = $this->session->userdata( 'user_id' );

        if (!isset($_POST)) {
            die();
        }

        $data['accountInfo'] = $this->usermodel->getUserInfo( $userId );


        $this->form_validation->set_rules('fname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required');

        if ( $_POST['email'] === $data['accountInfo']->email ) {
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
        } else {
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|is_unique[user.email]');
        }

        if ( $_POST['username'] === $data['accountInfo']->username ) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
        } else {
            $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]');
        }

        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $this->form_validation->set_message('is_unique', 'The %s provided is already taken');

        if ($this->form_validation->run() === FALSE) {
            // Form validation failed
            $data['errors'] = validation_errors();
            $data['title'] = $data['accountInfo']->username . " | My Ultimate Collection";
            $data['top_items'] = $this->itemmodel->getFavAlbums( $userId );
            $data['top_artists'] = $this->artistmodel->getFavArtists( $userId );
            $data['cd_count'] = $this->itemmodel->getCDcount( $userId );
            $data['cd_listened_count'] = $this->itemmodel->getCDListenedCount( $userId );
            $data['title'] = "Manage Account | My Ultimate Collection";
            $data['main_content'] = 'manage-account';
            $this->load->view('includes/template', $data);
        } else {
            $params = array(
                'first_name' => $_POST['fname'],
                'last_name' => $_POST['lname'],
                'email' => $_POST['email'],
                'username' => $_POST['username'],
                'public' => $_POST['public'] ? 1 : 0,
            );

            if( $this->usermodel->updateAccount( $params, $userId ) ) {

                redirect( '/manage-account' );

            } else {
                die('We could not add update account at this time, please try again later');
            }
        }

    }

}
