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

					$this->db->insert('artist_tag', $data);

				}
			}
		}
	}

	public function getArtistInfo( $name, $id ) {
        $name = urlencode( $name );

        $url = "http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=". $name ."&api_key=797d57115973701485bcb92ebb8ea847&format=json";

        $response = json_decode( file_get_contents( $url ) );

        if ( !isset( $response->error ) ) {
            $data = array();
//            echo "<pre>" . print_r( $response, TRUE ) . "</pre>";
            if ( isset( $response->artist->mbid ) )
                $mbid = $response->artist->mbid;
                $data[ 'mb_id' ] = $mbid;

            if ( isset( $response->artist->image ) )
                $image = $response->artist->image[3]->{'#text'};
                $data[ 'artist_image' ] = $image;

            if ( isset( $response->artist->bio->summary ) )
                $summary = $response->artist->bio->content;
                $data[ 'artist_summary' ] = $summary;

//            echo "<pre>" . print_r( $data, TRUE ) . "</pre>";
            $this->db->where('artist_id', $id);
            $query = $this->db->update( 'artist', $data );

        }

    }

}	

