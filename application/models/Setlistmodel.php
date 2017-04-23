<?php

class SetlistModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getSetList($setListId) {

        $url = 'https://api.setlist.fm/rest/0.1/setlist/' . $setListId . '.json';
        
        $response = json_decode(@file_get_contents($url));

        if ($response) {

            return $response;

        } else {
            return false;
        }
    }

    function findSetList($setlistId, $gigId) {
        $url = 'https://api.setlist.fm/rest/0.1/setlist/' . $setlistId . '.json';

        $response = json_decode(@file_get_contents($url));

        if ($response) {

            // echo "<pre>" . print_r($response, TRUE) . "</pre>";
            // die();
            $songs = array();
           
            foreach ($response->setlist->sets->set->song as $song) {
                $songs[] = $song->{'@name'};
            }

            $this->saveSetlist($songs, $gigId, $setlistId);

            return true;

        } else {
            return false;
        }
    }

    function saveSetlist($params, $gigId, $setlistId) {


        foreach ($params as $key => $value) {
            // echo $key . " -> " . $value . "<br>";

            $query = $this->db->select('item_id')
                ->like('track_name', $value)
                ->get('tracks');

            if($query->num_rows() > 0) {
                $itemId = $query->result()[0]->item_id;
            } else {
                $itemId = 0;
            }

            $data = array(
                'gig_id' => $gigId,
                'track_name' => $value,
                'setlist_order' => $key,
                'setlist_id' => $setlistId,
                'item_id' => $itemId,
            );

            $this->db->insert('setlists', $data);
        }

        return true;
        
    }

}	

