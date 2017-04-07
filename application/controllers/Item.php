<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('itemmodel');
        $this->load->model('notemodel');
        $this->load->model('trackmodel');
        $this->load->model('artistmodel');
        $this->load->model('reviewmodel');
	}

	public function index()
	{
		// $this->load->view('welcome_message');
	}

	public function showIndividualItem($itemId) {

		$this->itemmodel->addView($itemId);
     	
     	$data['item_info'] = $this->itemmodel->getItemInfo($itemId);
     	$data['notes'] = $this->notemodel->getItemNotes($itemId);
     	$data['tracks'] = $this->trackmodel->getItemTracks($itemId);
     	$data['similar_artists'] = $this->artistmodel->getSimilarArtists($data['item_info'][0]->artist_name);

     	$title = $data['item_info'][0]->title;
     	$artist = $data['item_info'][0]->artist_name;

     	$data['review'] = $this->reviewmodel->doesItemHaveReview($itemId);

		$data['title'] = $title . ' | ' . $artist;
        $data['main_content'] = 'individual-item';
        $this->load->view('includes/template', $data);
	}

	public function rating($itemId) {
		$rating = $this->itemmodel->getItemRating($itemId);

		$rating = $rating[0]->rating;

		return $rating;
	}

	public function updateRating($newRating, $itemId) {
		if($this->itemmodel->updateRating($newRating, $itemId)) {
			return true; 
		} else {
			return false;
		}

	}

	public function updateItem($field, $value, $table, $itemId) {
		$value = urldecode($value);
		$value = str_replace('-slash-', '/', $value);

		if($this->itemmodel->updateItem($field, $value, $table, $itemId)) {
			return true;
		} else {
			return false;
		}
	}

	public function temp() {
		$query = $this->db->select()
			->get('library');

		foreach ($query->result() as $row) {
			$sql = $this->db->select()
				->where('format_name', $row->format)
				->get('formats');

			$stuff = $sql->result();

			$data = array(
	            'format' => $stuff[0]->format_id
	        );

	        $this->db->where('item_id', $row->item_id);
	        $this->db->update('library', $data);
			// echo "<pre>" . print_r($sql->result(), TRUE) . "</pre><br>";
		}
	}

	public function addCdForm() {

		$data['formats'] = $this->itemmodel->getList('formats');

		$data['title'] = 'Add a CD';
        $data['main_content'] = 'add-cd';
        $this->load->view('includes/template', $data);
	}

	public function addCd() {


		// Deal with artist first, need to check if it is an existing artist or a new one
		$checkArtist = $this->artistmodel->getArtist($_POST['artist']);

		if(!$checkArtist > 0) {
			$artist_id = $this->artistmodel->createNewArtist($_POST['artist'], $_POST['artist_az']);
		} else {
			$artist_id = $checkArtist;

			$checkIfExists = $this->itemmodel->checkIfExists($_POST['title'], $artist_id);

			if($checkIfExists > 0) {
				redirect($_SERVER['HTTP_REFERER'] . '?exists=1&id=' . $checkIfExists);
				exit();
			}
		}

		$title = isset($_POST['title']) ? $_POST['title'] : '';
		$reference = isset($_POST['reference']) ? $_POST['reference'] : '';
		$summary = isset($_POST['summary']) ? $_POST['summary'] : '';
		$format_id = isset($_POST['format']) ? $_POST['format'] : '';
		$cd_count = isset($_POST['cd_count']) ? $_POST['cd_count'] : '';
		$image = isset($_POST['image']) ? $_POST['image'] : '';
		$purchasedFrom = isset($_POST['purchased_from']) ? $_POST['purchased_from'] : '';
		$purchaseDate = isset($_POST['purchase_date']) ? date('Y-m-d H:i:s', strtotime($_POST['purchase_date'])) : '';
		$price = isset($_POST['price']) ? '&pound;' . $_POST['price'] : '';

		$item_id = $this->itemmodel->addNewCd($title, $artist_id, $summary, $format_id, $reference, $cd_count, $image, $purchasedFrom, $purchaseDate, $price);

		$tracksInserted = false;

		// Add track listing
		if (isset($_POST['tracks'])) {
			foreach ($_POST['tracks'] as $track) {

				$name = $track['name'];
				$order = $track['order'];
				$duration = $track['duration'];

				if($this->trackmodel->addTrack($item_id, $artist_id, $name, $order, $duration)) {
					$tracksInserted = true;
				}

			}
		}

		redirect('/item/' . $item_id . '?success=1');

	}

	public function getList($table) {
		echo $this->itemmodel->getList($table);
	}

	public function library() {
		$data['items'] = $this->itemmodel->getAllitems();

		$data['title'] = "Library | CD Library";
        $data['main_content'] = 'library';
        $this->load->view('includes/template', $data);
	}
}