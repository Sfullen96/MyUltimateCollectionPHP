<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Note extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model('notemodel');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function addNote($item_id) {
		if($this->notemodel->addNote($item_id, $_POST['note'])) {
			echo Date('d/m/Y H:i:s', time());
		}
	}

}
