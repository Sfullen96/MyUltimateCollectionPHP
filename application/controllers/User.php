<?php

class User extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model( 'usermodel' );
        $this->load->model( 'itemmodel' );
        $this->load->model( 'artistmodel' );
    }

    public function profileView( $userId ) {

        if ( $userId === $this->session->userdata( 'user_id' ) ) {
            redirect( '/manage-account' );
        }

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
        $user_id = $this->session->userdata( 'user_id' );
    }
}
