<?php

class SearchModel extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    function searchItems($keyword) {
        $resultsItem = array();

        $keywords = explode(' ', $keyword);

        $markedWords = array();

        foreach ($keywords as $keyword) {
            $sqlItem = "
                SELECT library.item_id, library.title, artists.artist_name, library.album_image, formats.format_name, library.artist_id
                FROM library
                LEFT JOIN artists
                ON artists.artist_id = library.artist_id
                LEFT JOIN formats
                ON formats.format_id = library.format_id
                WHERE library.title LIKE '%$keyword%'
            ";
            
            $item = $this->db->query($sqlItem);

            if ($item->num_rows() > 0) {
                $resultsItem[] = $item->result();
            }
        }

        return $resultsItem;
           
    }


    function searchArtists($keyword) {
        $resultsArtist = array();

        $keywords = explode(' ', $keyword);

        foreach ($keywords as $keyword) {
            $sqlArtist = "
                SELECT artist_name, artist_id
                FROM artists
                WHERE artist_name LIKE '%$keyword%'
            ";

            $artists = $this->db->query($sqlArtist);

            if ($artists->num_rows() > 0) {
                $resultsArtist[] = $artists->result();
            }
        }

        return $resultsArtist;
           
    }
}
 

