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

	public function getArtists($text) {
		$query = $this->db->select()
				->like('artist_name', $text)
				->get('artists');

		return $query->result();

	}

	public function getArtist($name) {
		$query = $this->db->select()
				->where('artist_name', $name)
				->get('artists');

		if($query->num_rows() > 0) {
			$results = $query->result();
			return $results[0]->artist_id;
		} else {
			return 0;
		}

	}

	public function createNewArtist($name, $az) {
		$data = array(
	        'artist_name' => $name,
	        'artist_az_name' => $az
		);

		$query = $this->db->insert('artists', $data);

		return $this->db->insert_id();
	}

}

?>