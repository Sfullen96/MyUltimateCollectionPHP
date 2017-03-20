<?php

class ArtistModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	public function addArtist($artist_name, $artist_az) {
		$data = array(
		   	'artist_name' => $artist_name,
		   	'artist_az_name' => $artist_az
		);

		$this->db->insert('artists', $data);
	}

	public function getSimilarArtists($artistName) {
		$url = 'http://ws.audioscrobbler.com/2.0/?method=artist.getsimilar&artist='. urlencode($artistName) .'&limit=4&api_key=797d57115973701485bcb92ebb8ea847&format=json';

		$response = json_decode(file_get_contents($url));

		return $response;
	}

}

?>