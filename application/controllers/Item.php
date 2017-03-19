<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('ItemModel');
        $this->load->model('NoteModel');
        $this->load->model('TrackModel');
	}

	public function index()
	{
		// $this->load->view('welcome_message');
	}

	public function showIndividualItem($itemId) {

     	
     	$data['item_info'] = $this->ItemModel->getItemInfo($itemId);
     	$data['notes'] = $this->NoteModel->getItemNotes($itemId);
     	$data['tracks'] = $this->TrackModel->getItemTracks($itemId);

     	$title = $data['item_info'][0]->title;
     	$artist = $data['item_info'][0]->artist_name;

		$data['title'] = $title . ' | ' . $artist;
        $data['main_content'] = 'individual-item';
        $this->load->view('includes/template', $data);
	}

	public function rating($itemId) {
		$rating = $this->ItemModel->getItemRating($itemId);

		$rating = $rating[0]->rating;

		return $rating;
	}

	public function updateRating($newRating, $itemId) {
		if($this->ItemModel->updateRating($newRating, $itemId)) {
			return true; 
		} else {
			return false;
		}

	}
}
