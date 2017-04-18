<?php

class Lastfmmodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	public function getArtistTags($artistName, $id) {
		$name = urlencode($artistName);

		$url = "http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=". $name ."&api_key=797d57115973701485bcb92ebb8ea847&format=json";

		$response = json_decode(file_get_contents($url));

		if (!isset($response->error)) {
			if (isset($response->artist->tags)) {
				foreach ($response->artist->tags->tag as $tag) {

					$data = array(
				        'artist_id' => $id,
				        'tag_name' => $tag->name,
				        'tag_url' => $tag->url,
					);

					$this->db->insert('artist_tags', $data);

				}
			}
		}
	}

}	

