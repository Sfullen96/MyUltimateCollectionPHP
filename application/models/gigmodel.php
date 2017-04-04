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

    public function getGigByDate($date, $artistName) {

        $url = 'https://api.setlist.fm/rest/0.1/search/setlists?date='.$date.'&artistName='.$artistName;

        $response = @file_get_contents($url);

        if (isset($response)) {
            $gig = simplexml_load_string($response);

            $setlist = array(); 

            $counter = 0;

            // if (isset($gig->setlist->sets->set)) {
            //     foreach ($gig->setlist->sets->set->song as $key => $value) {   
            //         $setlist[$counter] = $value['name'];
            //         $counter++;
            //     }
            // }

            // print
            // die();

            $returnData = array(
                'tour' => (isset($gig->setlist[0]['tour'])?$gig->setlist[0]['tour']:''),
                'venue' => (isset($gig->setlist->venue[0]['name'])?$gig->setlist->venue[0]['name']:''),
                'city' => (isset($gig->setlist->venue->city[0]['name'])?$gig->setlist->venue->city[0]['name']:''),
                'country' => (isset($gig->setlist->venue->city->country[0]['name'])?$gig->setlist->venue->city->country[0]['name']:''),
                'date' => date('Y-m-d h:i:s', strtotime($date)),
            );

            return json_encode($returnData, JSON_FORCE_OBJECT);

        } else {
            echo 'No data found';
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
        );

        $query = $this->db->insert('gigs', $data);

        return $this->db->insert_id();
    }
}	

