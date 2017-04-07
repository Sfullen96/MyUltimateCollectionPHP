<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artist extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('itemmodel');
        $this->load->model('notemodel');
        $this->load->model('trackmodel');
        $this->load->model('artistmodel');
        $this->load->model('reviewmodel');
        $this->load->model('gigmodel');
	}

	public function index() {
		$data['artists'] = $this->artistmodel->getAllArtists();
		$data['title'] = "CD Library | Artists";
        $data['main_content'] = 'artists';
        
        $this->load->view('includes/template', $data);
	}

	public function showIndividualArtist($id) {

		$this->artistmodel->addView($id);
		
		$data['artist'] = $this->artistmodel->getArtistInfo($id);
		$data['albums'] = $this->artistmodel->getArtistAlbums($id);
		$data['gigs_attended'] = $this->gigmodel->getArtistGigs($id)->result();
		$data['gigs_attended_count'] = $this->gigmodel->getArtistGigs($id)->num_rows();
		$data['title'] = $data['artist'][0]->artist_name . ' | CD Library';
        $data['main_content'] = 'artist';
        
        $this->load->view('includes/template', $data);
	}

	public function ajaxFindArtist() {
		if ($_POST['text']) {
			$query = $this->artistmodel->getArtists($_POST['text']);

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
