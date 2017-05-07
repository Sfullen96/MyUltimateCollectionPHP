<?php

class SearchModel extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    function searchItems($keyword) {
        $resultsItem = array();
        $userId = $this->session->userdata('user_id');

        // $keywords = explode(' ', $keyword);

        // foreach ($keywords as $keyword) {
            $sqlItem = "
                SELECT item.item_id, item.title, artist.artist_name, item.image, format.format_name, item.artist_id
                FROM item
                LEFT JOIN artist
                ON artist.artist_id = item.artist_id
                LEFT JOIN format
                ON format.format_id = item.format_id
                WHERE (
                    item.title LIKE '%$keyword%'
                    OR
                    artist.artist_name LIKE '%$keyword%'
                )
                AND item.user_id = '$userId'
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
        $userId = $this->session->userdata('user_id');

        $sqlArtist = "
            SELECT artist_name, artist_id, artist_image
            FROM artist
            WHERE artist_name LIKE '%$keyword%'
            AND artist.user_id = '$userId'
        ";

        $artists = $this->db->query($sqlArtist);

        if ($artists->num_rows() > 0) {
            $resultsArtist[] = $artists->result();
        }

        return $resultsArtist;
           
    }

    public function searchUsers( $keyword ) {
        $resultsUser = array();

        $sqlUser = "
            SELECT first_name, user_id, last_name, username, image
            FROM user
            WHERE CONCAT_WS(' ',first_name, last_name, email, username) LIKE '%$keyword%'
        ";

        $users = $this->db->query($sqlUser);

        if ($users->num_rows() > 0) {
            $resultsUser[] = $users->result();
        }

        return $resultsUser;
    }
}
 

