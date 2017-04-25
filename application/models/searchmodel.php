<?php

class SearchModel extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    function searchItems($keyword) {
        $resultsItem = array();

        // $keywords = explode(' ', $keyword);

        // foreach ($keywords as $keyword) {
            $sqlItem = "
                SELECT items.item_id, items.title, artists.artist_name, items.image, format.format_name, items.artist_id
                FROM item
                LEFT JOIN artists
                ON artists.artist_id = items.artist_id
                LEFT JOIN format
                ON format.format_id = items.format_id
                WHERE (
                    items.title LIKE '%$keyword%'
                    OR
                    artists.artist_name LIKE '%$keyword%'
                )
            ";
            
            $item = $this->db->query($sqlItem);

            if ($item->num_rows() > 0) {
                $resultsItem[] = $item->result();
            }
        // }

            // echo "<pre>" . print_r($resultsItem, TRUE) . "</pre>";
            // die();
        return $resultsItem;
           
    }


    function searchArtists($keyword) {
        $resultsArtist = array();

        // $keywords = explode(' ', $keyword);

        // foreach ($keywords as $keyword) {
            $sqlArtist = "
                SELECT artist_name, artist_id, artist_image
                FROM artist
                WHERE artist_name LIKE '%$keyword%'
            ";

            $artists = $this->db->query($sqlArtist);

            if ($artists->num_rows() > 0) {
                $resultsArtist[] = $artists->result();
            }
        // }

        return $resultsArtist;
           
    }
}
 

