<?php

class GigModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getArtistGigs($id) {
    	// $query = $this->db->select()
     //            ->join('setlist', 'setlist.gig_id = gig.gig_id', 'left outer')
    	// 		->where('gig_artist_id', $id)
     //            ->group_by('setlist.gig_id')
    	// 		->get('gig');

        $query = "SELECT 
          *,
          (SELECT 
            setlist_id 
          FROM
            setlist 
          WHERE setlist.`gig_id` = gig.`gig_id` LIMIT 1) AS setlistId 
        FROM
          `gig` 
        WHERE `gig_artist_id` = $id 
        ";

    	return $this->db->query($query);
    }

    public function getGigByDate($date, $artistName) {

        $url = 'https://api.setlist.fm/rest/0.1/search/setlists?date='.$date.'&artistName='.$artistName;

        $response = @file_get_contents($url);

        if ($response) {
            $gig = simplexml_load_string($response);

            $setlist = array(); 

            $counter = 0;

            $returnData = array(
                'tour' => (isset($gig->setlist[0]['tour'])?$gig->setlist[0]['tour']:''),
                'venue' => (isset($gig->setlist->venue[0]['name'])?$gig->setlist->venue[0]['name']:''),
                'city' => (isset($gig->setlist->venue->city[0]['name'])?$gig->setlist->venue->city[0]['name']:''),
                'country' => (isset($gig->setlist->venue->city->country[0]['name'])?$gig->setlist->venue->city->country[0]['name']:''),
                'date' => date('Y-m-d h:i:s', strtotime($date)),
                'setlist_id' => $gig->setlist['id'],
            );

            return json_encode($returnData, JSON_FORCE_OBJECT);

        } else {
            return false;
        }
    }

    public function addGig($params) {
        
        $data = array(
            'gig_venue' => $params['venue'],
            'gig_date' => $params['date'],
            'gig_tour' => $params['tour'],
            'gig_city' => $params['city'],
            'gig_country' => $params['country'],
            'gig_artist_id' => $params['artistId'],
            'status' => 1,
            'user_id' => $this->session->userdata('user_id'),
        );

        $query = $this->db->insert('gig', $data);

        return $this->db->insert_id();
    }

    public function getGig($id) {
        $query = $this->db->select()
                ->join('artist', 'gig.gig_artist_id = artist.artist_id')
                ->where('gig_id', $id)
                ->get('gig');

        if($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }

    function getSetlist($gigId) {
        $query = $this->db->select()
                // ->join('')
                ->where('gig_id', $gigId)
                ->get('setlist');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    // function doesGigHaveSetlist($gigId) {
    //     $query = $this->db->select()
    //         ->where('gig_id', $gigId)
    //         ->get('setlist');

    //     if($query->num_rows() > 0) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}	

