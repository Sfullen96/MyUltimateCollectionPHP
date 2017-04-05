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
        
        if (is_numeric($id)) {
            // gig ID 
            $data['db_tracks'] = $this->GigModel->getGig($id);
        } else {
            // Setlist ID
            $data['fm_tracks'] = $this->SetlistModel->getSetList($id);
        }

        // if($tracks = $this->SetlistModel->getSetList($id) !== false) {
        //     // Found setlist on setlist.fm
        //     $data['fm_tracks'] = $tracks;
        // } else {
        //     // Couldn't find on setlist.fm, but still need gig info (venue etc), so get that from our DB
        //     $data['db_tracks'] = $this->GigModel->getGig($id);
        // }

        $data['title'] = 'Setlist';
        $data['main_content'] = 'setlist';
        $this->load->view('includes/template', $data);

    }
	
}
