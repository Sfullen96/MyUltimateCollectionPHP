<?php

class GigModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getArtistGigs($id) {
    	$query = $this->db->select()
    			->where('gig_artist_id', $id)
    			->get('gigs');

    	return $query;
    }
}	

?>