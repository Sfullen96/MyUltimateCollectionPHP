<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setlist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('itemmodel');
        $this->load->model('notemodel');
        $this->load->model('trackmodel');
        $this->load->model('artistmodel');
        $this->load->model('reviewmodel');
        $this->load->model('gigmodel');
        $this->load->model('setlistmodel');
	}

    public function index() {
        
    }

    public function showSetlistView($id) {
        
        if (is_numeric($id)) {
            // gig ID 
            $data['gig'] = $this->gigmodel->getGig($id);
            $data['setlist'] = $this->gigmodel->getSetlist($id);
        } else {
            // Setlist ID
            $data['fm_tracks'] = $this->setlistmodel->getSetList($id);
        }

               

        // if($tracks = $this->setlistmodel->getSetList($id) !== false) {
        //     // Found setlist on setlist.fm
        //     $data['fm_tracks'] = $tracks;
        // } else {
        //     // Couldn't find on setlist.fm, but still need gig info (venue etc), so get that from our DB
        //     $data['db_tracks'] = $this->gigmodel->getGig($id);
        // }

        $data['title'] = 'Setlist | My Ultimate Collection';
        $data['main_content'] = 'setlist';
        $this->load->view('includes/template', $data);

    }

    public function addSetlistTracks() {
        print_r($_POST);
        die();
    }
	
}
