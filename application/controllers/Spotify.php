<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0); 
ini_set('memory_limit','2048M');
class Spotify extends CI_Controller {

	public function __construct() {
		parent::__construct();
		require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
	}

	public function index()
	{

		$url = 'http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=797d57115973701485bcb92ebb8ea847&artist=Cher&album=Believe&format=json';
			
			$response = json_decode(file_get_contents($url));

			die();

		$session = new SpotifyWebAPI\Session('87eb878e22764c9386a3232af94dbab5', '7c4176049f0847a0b6c0399e495c829f', 'http://cd.app/spotify-auth.php');

		$scopes = array(
		    'playlist-read-private',
		    'user-read-private',
		    'playlist-read-collaborative',
		    'playlist-modify-public',
		    'playlist-modify-private',
		    'user-follow-modify',
		    'user-follow-read',
		    'user-library-read',
		    'user-library-modify',
		    'user-read-private',
		    'user-read-birthdate',
		    'user-read-email',
		    'user-top-read'
		);

		$authorizeUrl = $session->getAuthorizeUrl(array(
		    'scope' => $scopes
		));

		header('Location: ' . $authorizeUrl);
		die();
	}

	function auth($code) {
        $session = new SpotifyWebAPI\Session('87eb878e22764c9386a3232af94dbab5', '7c4176049f0847a0b6c0399e495c829f', 'http://cd.app/spotify-auth.php');
		$api = new SpotifyWebAPI\SpotifyWebAPI();

		// Request a access token using the code from Spotify
		$session->requestAccessToken($code);
		$accessToken = $session->getAccessToken();

		// Set the access token on the API wrapper
		$api->setAccessToken($accessToken);

		// Start using the API!

		$query = $this->db->select()
				->join('items', 'items.artist_id = artists.artist_id')
				->get('artists');

		$found = 0;
		$notFound = 0;

		foreach ($query->result() as $row) {

			$album = urlencode($row->title);
			$artist = urlencode($row->artist_name);

			// $url = 'https://api.spotify.com/v1/search?q=album:'. $album .'artist:'. $artist;
			$url = 'http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=797d57115973701485bcb92ebb8ea847&artist=Cher&album=Believe&format=json';

			$response = json_decode(file_get_contents($url));

			// echo "<pre>" . print_r($response, TRUE) . "</pre><br>";

			foreach ($response as $data) {
				if(empty($data->items)) {
					$notFound++;
				} else {
					$found++;
				}
			}
		}

		echo "Found: " . $found . "<br>";
		echo "Not Found: " . $notFound;


		
		die();

	}
}
