<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('ItemModel');
        $this->load->model('NoteModel');
        $this->load->model('TrackModel');
        $this->load->model('ArtistModel');
        $this->load->model('ReviewModel');
	}

	public function index()
	{	
		$this->load->model('ItemModel');

		$query = $this->db->select()
				->join('artists', 'artists.artist_id = library.artist_id')
				->order_by('library.created_at DESC')
                ->limit(5)
                ->get('library');

        $data['recently_added'] = $query->result();

        $data['cd_week'] = $this->ItemModel->cdStats('week');
        $data['cd_month'] = $this->ItemModel->cdStats('month');
        $data['cd_year'] = $this->ItemModel->cdStats('year');

     

		$data['title'] = "CD Library | Home";
        $data['main_content'] = 'home';
        $this->load->view('includes/template', $data);
	}
}
