<?php

class ArtistModel extends CI_Model
{

	public $user_id;

    function __construct()
    {
        parent::__construct();
        $this->user_id = ($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0;
    }

	public function addArtist($artist_name, $artist_az) {
		$data = array(
		   	'artist_name' => $artist_name,
		   	'artist_az_name' => $artist_az,
		   	'user_id' => $this->user_id,
		);

		$this->db->insert('artist', $data);
	}

	public function getSimilarArtists($artistName) {
		$url = 'http://ws.audioscrobbler.com/2.0/?method=artist.getsimilar&artist='. urlencode($artistName) .'&limit=4&api_key=797d57115973701485bcb92ebb8ea847&format=json';

		$response = json_decode(file_get_contents($url));

		return $response;
	}

	public function getArtists($text) {
		$query = $this->db->select()
				->like('artist_name', $text)
				->get('artist');

		return $query->result();

	}

	public function getArtist($identifier) {
		if(is_numeric($identifier)) {
			// ID
			$column = 'artist_id';
		} else {
			// Name
			$column = 'artist_name';
		}

		$query = $this->db->select()
				->where($column, $identifier)
				->get('artist');

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
	        'artist_az_name' => $az,
	        'user_id' => $this->user_id,
		);

		$query = $this->db->insert('artist', $data);

		return $this->db->insert_id();
	}

	public function addUserArtist($artistId) {
		$data = array(
			'user_id' => $this->session->userdata('user_id'),
			'artist_id' => $artistId,
		);

		$query = $this->db->insert('user_artist', $data);

		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function getArtistAlbums($id) {
		$query = $this->db->select()
				->where('artist_id', $id)
				->where('item.user_id', $this->user_id)
				->get('item');

		return $query->result();
	}

public function getArtistInfo($id) {
		$query = $this->db->select()
			->where('artist_id', $id)
			->get('artist');

		return $query->result();
	}

	public function getAllArtists() {
		$sql = "
			SELECT a.artist_id, a.artist_name, a.artist_az_name, (
				SELECT COUNT(item_id) FROM item WHERE artist_id = a.artist_id
			) AS cd_count
			FROM artist a
			LEFT JOIN user_artist ua
			ON ua.user_id = '$this->user_id'
			WHERE ua.user_id = '$this->user_id'
			GROUP BY a.artist_id
			ORDER BY artist_id DESC
		";

		// echo "SELECT a.artist_id, a.artist_name, a.artist_az_name, (
		// 		SELECT COUNT(item_id) FROM item WHERE artist_id = a.artist_id
		// 	) AS cd_count
		// 	FROM artist a
		// 	ORDER BY artist_id DESC";
		// 	die();

		$query = $this->db->query($sql);

		return $query->result();
	}

	public function addView($id) {
		$data = array(
	        'artist_id' => $id,
	        'user_id' => $this->session->userdata('user_id'),
		);

		$query = $this->db->insert('artist_view', $data);

		if($query) {
			return true;
		} else {
			return false;
		}
	}

	public function getFavArtists() {
		$user_id = $this->session->userdata('user_id');

        $sql = "
            SELECT COUNT(view_id) as views, artist_view.artist_id, artist_name
            FROM artist_view
            LEFT JOIN artists
            ON artists.artist_id = artist_view.artist_id
            WHERE artists.user_id = '$user_id'
            GROUP BY artist_view.artist_id
            ORDER BY COUNT(view_id) DESC,
            timestamp DESC
            LIMIT 5
        ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function getSummary($id) {
    	$query = $this->db->select()
			->where('artist_id', $id)
			->get('artist');

		return $query->result();
    }

    public function addSummary($id, $summary) {
    	$data = array(
        	'artist_summary' => $summary
		);

		$this->db->where('artist_id', $id);
		$this->db->update('artist', $data);

    }

    public function editSummary($id, $summary) {
    	$data = array(
        	'artist_summary' => $summary
		);

		$this->db->where('artist_id', $id);
		$this->db->update('artist', $data);
    	
    }

    public function getArtistTags($id) {
    	$query = $this->db->select()
    		->where('artist_id', $id)
    		->limit(4)
    		->get('artist_tag');

    	if ($query->num_rows() > 0) {
    		return $query->result();
    	} else {
    		return false;
    	}
    }
}	

?>