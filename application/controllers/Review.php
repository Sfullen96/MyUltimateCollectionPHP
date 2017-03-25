<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model('ItemModel');
        $this->load->model('NoteModel');
        $this->load->model('TrackModel');
        $this->load->model('ArtistModel');
        $this->load->model('ReviewModel');
	}

	public function index($id)
    {
        $data['title'] = "CD Library | Review";
        $data['main_content'] = 'review';
        $data['item_id'] = $id;

        $item = $this->ItemModel->getItemInfo($id);
        	

        $this->load->view('includes/template', $data);
    }

	public function addReview() {
		if (isset($_POST)) {
			if (!empty($_POST['review'])) {
				if($this->ReviewModel->addReview($_POST['item_id'], $_POST['review'])) {
					return true;
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}

	public function editReviewView($item_id) {
		$data['title'] = "CD Library | Review";
        $data['main_content'] = 'review';
        $data['item_id'] = $item_id;
        $data['edit'] = true;

        $item = $this->ItemModel->getItemInfo($item_id);
        $review = $this->ReviewModel->getReview($item_id);

        $data['review'] = $review[0]->review;
        	

        $this->load->view('includes/template', $data);
	}

}
