<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('itemmodel');
        $this->load->model('notemodel');
        $this->load->model('usermodel');
        $this->load->model('trackmodel');
        $this->load->model('artistmodel');
        $this->load->model('reviewmodel');
        $this->load->model('statsmodel');
	}

	public function index() {
		$this->load->model('itemmodel');

        $data['recently_added'] = $this->itemmodel->getRecentlyAdded();

        $data['cd_week'] = $this->itemmodel->cdStats('week');
        $data['cd_month'] = $this->itemmodel->cdStats('month');
        $data['cd_year'] = $this->itemmodel->cdStats('year');
        $data['cd_count'] = $this->itemmodel->getCDcount();
        $data['cd_listened_count'] = $this->itemmodel->getCDListenedCount();
     
    	$data['favourite_albums'] = $this->itemmodel->getFavAlbums();
    	$data['favourite_artists'] = $this->artistmodel->getFavArtists();

    	$data['recently_viewed'] = $this->itemmodel->getRecentlyViewed();

		$data['title'] = "Home | My Ultimate Collection";
        $data['main_content'] = 'home';
        $this->load->view('includes/template', $data);
	}

	public function stats() {
        $data['cd_week'] = $this->statsmodel->cdStats('week');
        $data['cd_month'] = $this->itemmodel->cdStats('month');
        $data['cd_year'] = $this->itemmodel->cdStats('year');
        $data['cd_count'] = $this->itemmodel->getCDcount();
        $data['cd_listened_count'] = $this->itemmodel->getCDListenedCount();
        $this->load->view('stats', $data);
    }
}
