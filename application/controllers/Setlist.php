<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setlist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ItemModel');
        $this->load->model('NoteModel');
        $this->load->model('TrackModel');
        $this->load->model('ArtistModel');
        $this->load->model('ReviewModel');
        $this->load->model('GigModel');
        $this->load->model('SetlistModel');
	}

    public function showSetlistView($id) {
        
        $data['tracks'] = $this->SetlistModel->getSetList($id);
        $data['title'] = 'Setlist';
        $data['main_content'] = 'setlist';
        $this->load->view('includes/template', $data);

    }
	
}
