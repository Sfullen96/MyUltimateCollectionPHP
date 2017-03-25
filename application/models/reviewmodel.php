<?php

class ReviewModel extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    function addReview($id, $review) {
        $data = array(
            'item_id' => $id,
            'review' => $review
        );

        $query = $this->db->insert('reviews', $data);

        if($query) {
            return true;
        } else {
            return false;
        }
    }

    function getReview($item_id) {
        $query = $this->db->select()
            ->where('item_id', $item_id)
            ->get('reviews');

        return $query->result();
    }

    function doesItemHaveReview($item_id) {
        $query = $this->db->select()
            ->where('item_id', $item_id)
            ->get('reviews');

        if ($query->num_rows()) {
            return true;
        } else {
            return false;
        }
    }
}
 

