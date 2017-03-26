<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0); 
ini_set('memory_limit','2048M');

class lastFmApi extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index()
	{

		$query = $this->db->select()
				->join('artists', 'library.artist_id = artists.artist_id')
				->limit(200)
				->get('library');

		$found = 0;
		$notFound = 0;

		$url = 'http://ws.audioscrobbler.com/2.0?method=track.getInfo&api_key=797d57115973701485bcb92ebb8ea847&artist=cher&track=believe&format=json';

			$response = json_decode(file_get_contents($url));

			echo "<pre>" . print_r($response, TRUE) . "</pre><br>";

			die();

		foreach ($query->result() as $row) {

			$album = urlencode($row->title);
			$artist = urlencode($row->artist_name);

			// $url = 'https://api.spotify.com/v1/search?q=album:'. $album .'artist:'. $artist;
			$url = 'http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=797d57115973701485bcb92ebb8ea847&artist=Cher&album=Believe&format=xml';

			$response = json_decode(file_get_contents($url));

			echo "<pre>" . print_r($response, TRUE) . "</pre><br>";

			// if (!isset($response->error)) {

			// 	if (!empty($response->album->tracks->track)) {
			// 		$trackCount = 1;
			// 		foreach ($response->album->tracks->track as $track) {
			// 			// echo "Track number " . $trackCount . " is - " . $track->name . "<br>";
			// 			$data = array(
			// 		        'album_id' => $row->item_id,
			// 		        'artist_id' => $row->artist_id,
			// 		        'track_name' => $track->name,
			// 		        'track_album_number' => $trackCount,
			// 		        'track_duration' => $track->duration,
			// 		        'track_lastfm_url' => $track->url
			// 			);

			// 			$this->db->insert('tracks', $data);
			// 			$trackCount++;
			// 		}
			// 		// echo "<hr>";
			// 	}

				 // echo "<pre>" . print_r($response, TRUE) . "</pre><br>";
				// if(isset($response->album->image)) {
				// 	if($response->album->image[4]->{'#text'} > '') {
				// 		$udpates = array(
				// 		    'album_image' => $response->album->image[4]->{'#text'}
				// 		);

				// 		$this->db->where('item_id', $row->item_id);
				// 		$this->db->update('library', $udpates);
				// 	} else if($response->album->image[3]->{'#text'} > '') {
				// 		$udpates = array(
				// 		    'album_image' => $response->album->image[3]->{'#text'}
				// 		);

				// 		$this->db->where('item_id', $row->item_id);
				// 		$this->db->update('library', $udpates);
				// 	} else if($response->album->image[2]->{'#text'} > '') {
				// 		$udpates = array(
				// 		    'album_image' => $response->album->image[2]->{'#text'}
				// 		);

				// 		$this->db->where('item_id', $row->item_id);
				// 		$this->db->update('library', $udpates);
				// 	}
 
				// 	// foreach ($response->album->image as $data) {
				// 	// 	if ($data->{'#text'} > '') {
				// 	// 		$udpates = array(
				// 	// 		    'album_image' => $data->{'#text'}
				// 	// 		);

				// 	// 		$this->db->where('item_id', $row->item_id);
				// 	// 		$this->db->update('library', $udpates);
				// 	// 	} else {
				// 	// 		echo "Fuck <br>";
				// 	// 	}
				// 	// }

					
				// } else {
				// 	 echo "<pre>" . print_r($response, TRUE) . "</pre><br>";
				// }
			// } else {
			// 		 // echo "<pre>" . print_r($response, TRUE) . "</pre><br>";
			// 	$notFound++;
			// }
			
			// echo "<pre>" . print_r($response, TRUE) . "</pre><br>";

			// foreach ($response as $data) {
			// 	if(empty($data)) {
			// 		$notFound++;
			// 		// echo "Couldn't find album: " . $album . " for artist: " . $artist . "<br>";
			// 	} else {
			// 		$found++;
			// 	}
			// }
		}

		echo "Found: " . $found . "<br>";
		echo "Not Found: " . $notFound;
		
	}

	public function getSimilarArtists($artistName) {
		$url = 'http://ws.audioscrobbler.com/2.0/?method=artist.getsimilar&artist='. urlencode($artistName) .'&api_key=797d57115973701485bcb92ebb8ea847&format=json';

		$response = json_decode(file_get_contents($url));

		echo "<pre>" . print_r($response, TRUE) . "</pre><br>";
	}

	public function getInfo() {
		if (!$_POST) {
			die('Access Denied');
		} else {
			$url = 'http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=797d57115973701485bcb92ebb8ea847&artist='. urlencode($_POST['artist']) .'&album='. urlencode($_POST['album']) .'&format=json';

			$response = file_get_contents($url);

			if (isset($response)) {
				echo $response;
			} else {
				echo 'No Data Found for Album: ' + $_POST['album'] + '. Artist: ' + $_POST['artist'];
			}
		}
	}

}
