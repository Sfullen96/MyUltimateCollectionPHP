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

            $returnData = array(
                'tour' => (isset($gig->setlist[0]['tour'])?$gig->setlist[0]['tour']:''),
                'venue' => (isset($gig->setlist->venue[0]['name'])?$gig->setlist->venue[0]['name']:''),
                'city' => (isset($gig->setlist->venue->city[0]['name'])?$gig->setlist->venue->city[0]['name']:''),
                'country' => (isset($gig->setlist->venue->city->country[0]['name'])?$gig->setlist->venue->city->country[0]['name']:''),
                'date' => date('Y-m-d h:i:s', strtotime($date))
            );

            return json_encode($returnData, JSON_FORCE_OBJECT);

        } else {
            echo 'No data found';
        }
    }
}	

?>