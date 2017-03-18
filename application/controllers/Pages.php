<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function index()
	{	
		$query = $this->db->select()
				->join('artists', 'artists.artist_id = library.artist_id')
				->order_by('library.created_at DESC')
                ->limit(5)
                ->get('library');

        $data['recently_added'] = $query->result();

		$data['title'] = "CD Library | Home";
        $data['main_content'] = 'home';
        $this->load->view('includes/template', $data);
	}
}
