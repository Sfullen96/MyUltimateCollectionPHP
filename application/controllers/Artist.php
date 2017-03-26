<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artist extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('ItemModel');
        $this->load->model('NoteModel');
        $this->load->model('TrackModel');
        $this->load->model('ArtistModel');
        $this->load->model('ReviewModel');
	}

	public function ajaxFindArtist() {
		if ($_POST['text']) {
			$query = $this->ArtistModel->getArtists($_POST['text']);

			if(count($query) > 0) {
				foreach($query as $artist) {
					echo '
						<div class="option" value="'. $artist->artist_id .'">'. $artist->artist_name .'</div>
					';
				}
			} else {
				echo 'no data';
			}
		} else {
			echo 'no data';
		}
	}	

}
