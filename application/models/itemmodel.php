<?php

class ItemModel extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    function getItemInfo($itemId) {

        $query = $this->db->select()
                ->join('artists', 'artists.artist_id = library.artist_id')
                ->where('item_id', $itemId)
                ->get('library');

       return $query->result();

    }

    function getItemRating($itemId) {
        $rating = $this->db->select('rating')
                ->where('item_id', $itemId)
                ->get('library');

        return $rating->result();
    }

    function updateRating($rating, $itemId) {
        $data = array(
            'rating' => $rating
        );

        $this->db->where('item_id', $itemId);
        $this->db->update('library', $data);
    }
}
 

