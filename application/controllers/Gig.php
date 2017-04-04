<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gig extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('ItemModel');
        $this->load->model('NoteModel');
        $this->load->model('TrackModel');
        $this->load->model('ArtistModel');
        $this->load->model('ReviewModel');
        $this->load->model('GigModel');
	}

	public function getGigByDate($date, $artistName) {
		echo $this->GigModel->getGigByDate($date, $artistName);
	} 
}
