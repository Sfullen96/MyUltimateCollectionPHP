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

}

?>