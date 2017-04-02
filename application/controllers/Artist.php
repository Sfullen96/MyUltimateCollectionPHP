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
        $this->load->model('GigModel');
	}

	public function index() {
		$data['artists'] = $this->ArtistModel->getAllArtists();
		$data['title'] = "CD Library | Artists";
        $data['main_content'] = 'artists';
        
        $this->load->view('includes/template', $data);
	}

	public function showIndividualArtist($id) {
		$data['artist'] = $this->ArtistModel->getArtistInfo($id);
		$data['albums'] = $this->ArtistModel->getArtistAlbums($id);
		$data['gigs_attended'] = $this->GigModel->getArtistGigs($id)->result();
		$data['gigs_attended_count'] = $this->GigModel->getArtistGigs($id)->num_rows();
		$data['title'] = "CD Library | Artists";
        $data['main_content'] = 'artist';
        
        $this->load->view('includes/template', $data);
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
