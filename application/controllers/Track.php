<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Track extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('ItemModel');
        $this->load->model('NoteModel');
        $this->load->model('TrackModel');
        $this->load->model('ArtistModel');
	}

	public function index()
	{
		// $this->load->view('welcome_message');
	}

	public function updateTrack($field, $value, $itemId, $order) {
		$value = urldecode($value);
		$value = str_replace('-slash-', '/', $value);

		if($this->TrackModel->updateTrack($field, $value, $itemId, $order)) {
			return true;
		} else {
			return false;
		}
	}

	public function addNewTrack() {

		$trackName = $_POST['trackName'];
		$duration = $_POST['duration'];
		$itemId = $_POST['itemId'];
		$order = $_POST['order'];
		$artist = $_POST['artist'];

		$duration = explode(':', $_POST['duration']);
		$seconds = $duration[1];
		$minutes =  $duration[0];

		$totalSecs = ($minutes * 60) + $seconds; 

		echo $this->TrackModel->addNewTrack($trackName, $totalSecs, $itemId, $order, $artist);
			
	}

	public function deleteTrack() {
		if ($this->TrackModel->deleteTrack($_POST['id'])) {
			echo '1';
		} else {
			echo '0';
		}
	}
}
