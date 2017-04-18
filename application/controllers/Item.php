<?php
defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);


class Item extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('itemmodel');
        $this->load->model('notemodel');
        $this->load->model('trackmodel');
        $this->load->model('artistmodel');
        $this->load->model('reviewmodel');
        $this->load->model('lastfmmodel');
	}

	public function index()
	{
		// $this->load->view('welcome_message');
	}

	public function showIndividualItem($itemId) {

		$this->itemmodel->addView($itemId);

		$user_id = $this->session->userdata('user_id');

		if(!$this->itemmodel->doesBelongToUser($user_id, $itemId)) {
			redirect('/home');
		}

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
				->where('user_id', 1)
				->get('artists');

		foreach ($query->result() as $row) {
			$data = array(
				'user_id' => 1,
				'artist_id' => $row->artist_id,
			);

			$this->db->insert('user_artists', $data);
		}

		// $query = $this->db->select()
		// 		->where('user_id', 1)
		// 		->get('library');

		// foreach ($query->result() as $row) {
		// 	$data = array(
		// 		'user_id' => 1,
		// 		'item_id' => $row->item_id,
		// 	);

		// 	$this->db->insert('user_items', $data);
		// }



		// $query = $this->db->select()
		// 	->where('mb_id IS NULL', null, false)
		// 	->where('mb_id <', 'N/A')
		// 	// ->limit(10)
		// 	->get('artists');
		// $sql = "
		// 	SELECT * 
		// 	FROM artists
		// 	WHERE mb_id IS NULL
		// ";

		// $query = $this->db->query($sql);

		// echo $query->num_rows();
		// $options  = array('http' => array('user_agent' => 'CD Library/1.0.0 ( sam_fullen2@hotmail.co.uk )'));
		// $context  = stream_context_create($options);
		// header('Content-Type: text/xml');

		// foreach ($query->result() as $row) {
		// 	$name = urlencode($row->artist_name);
		// 	$url = "http://musicbrainz.org/ws/2/artist/?query=artist:". $name . "&limit=1";

		// 	$ch = curl_init();
		// 	curl_setopt($ch, CURLOPT_URL, $url);
		// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// 	curl_setopt( $ch, CURLOPT_USERAGENT, "CD Library/1.0.0 ( sam_fullen2@hotmail.co.uk )" );
		// 	$content = curl_exec( $ch );
			

		//  	$resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		// 	if ($resultStatus == 200) {

		// 		// echo '200 - ' . $row->artist_id . "<br>";

		// 		$dom = simplexml_load_string($content);

		// 		if ($dom->{'artist-list'}->artist->attributes()->id) {

		// 			// echo "<pre>" . print_r($dom->{'artist-list'}->artist->attributes()->id, TRUE) . "</pre>";
		// 			$id = $dom->{'artist-list'}->artist->attributes()->id;

		// 			$data = array(
		// 		        'mb_id' => $id,
		// 			);

		// 			$this->db->where('artist_id', $row->artist_id);
		// 			$this->db->update('artists', $data);
		// 		}
		// 	} else if($resultStatus == 400) {

		// 		$data = array(
		// 	        'mb_id' => 'N/A',
		// 		);

		// 		$this->db->where('artist_id', $row->artist_id);
		// 		$this->db->update('artists', $data);
		// 	} else if($resultStatus == 503) {
		// 		// echo 'LOL';
		// 	}

		// 	curl_close ( $ch );

			// echo $dom->artist;
			// echo $dom->{'artist-list'}->artist->{'@attributes'}['id'];

			// $response = file_get_contents($url, false, $context);

			// if ($response) {
				// echo 
				// echo $response;
				// $artist = simplexml_load_string($response);

				// var_dump($artist);
				// echo $obj->metadata->{'artist-list'};
			// }
		// }

		// redirect('/temp');

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
			$this->lastfmmodel->getArtistTags($_POST['artist'], $artist_id);
		} else {
			$artist_id = $checkArtist;

			$checkIfExists = $this->itemmodel->checkIfExists($_POST['title'], $artist_id);

			if($checkIfExists > 0) {
				redirect($_SERVER['HTTP_REFERER'] . '?exists=1&id=' . $checkIfExists);
				exit();
			}
		}

		// Now we need to get the logged in user's ID to put as owner
		$user_id = $this->session->userdata('user_id');

		$title = isset($_POST['title']) ? $_POST['title'] : '';
		$reference = isset($_POST['reference']) ? $_POST['reference'] : '';
		$summary = isset($_POST['summary']) ? $_POST['summary'] : '';
		$format_id = isset($_POST['format']) ? $_POST['format'] : '';
		$cd_count = isset($_POST['cd_count']) ? $_POST['cd_count'] : '';
		$image = isset($_POST['image']) ? $_POST['image'] : '';
		$purchasedFrom = isset($_POST['purchased_from']) ? $_POST['purchased_from'] : '';
		$purchaseDate = isset($_POST['purchase_date']) ? date('Y-m-d H:i:s', strtotime($_POST['purchase_date'])) : '';
		$price = isset($_POST['price']) ? '&pound;' . $_POST['price'] : '';

		$item_id = $this->itemmodel->addNewCd($title, $artist_id, $summary, $format_id, $reference, $cd_count, $image, $purchasedFrom, $purchaseDate, $price, $user_id);

		$tracksInserted = false;

		// Add track listing
		if (isset($_POST['track'])) {
			foreach ($_POST['track'] as $track) {

				$explode = explode(':', $track['duration']);

				$minutes = $explode[0];
				$seconds = $explode[1];
				$duration = ($minutes * 60) + $seconds; 

				$name = $track['name'];
				$order = $track['order'];

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

	public function addListen($itemId) {
		if($this->itemmodel->addListen($itemId)) {
			echo '1';
		} else {
			echo '0';
		}
	}
}