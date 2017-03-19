<?php

class TrackModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	function getItemTracks($itemId) {
        $tracks = $this->db->select()
                ->where('album_id', $itemId)
                ->get('tracks');

        return $tracks->result();
    }
}

?>