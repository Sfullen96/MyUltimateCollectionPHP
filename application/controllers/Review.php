<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model('itemmodel');
        $this->load->model('notemodel');
        $this->load->model('trackmodel');
        $this->load->model('artistmodel');
        $this->load->model('reviewmodel');
	}

	public function index($id)
    {
        $data['title'] = "CD Library | Review";
        $data['main_content'] = 'review';
        $data['item_id'] = $id;

        $item = $this->itemmodel->getItemInfo($id);
        	

        $this->load->view('includes/template', $data);
    }

	public function addReview() {
		if (isset($_POST)) {
			if (!empty($_POST['review'])) {
				if($this->reviewmodel->addReview($_POST['item_id'], $_POST['review'])) {
					redirect(base_url() . 'item/'.$_POST['item_id']);
					exit();
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}

	public function updateReview() {
		if (isset($_POST)) {
			if (!empty($_POST['review'])) {
				if($this->reviewmodel->updateReview($_POST['item_id'], $_POST['review'])) {
					redirect(base_url() . 'item/'.$_POST['item_id']);
					exit();
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

        $item = $this->itemmodel->getItemInfo($item_id);
        $review = $this->reviewmodel->getReview($item_id);

        $data['review'] = $review[0]->review;
        	

        $this->load->view('includes/template', $data);
	}

}
