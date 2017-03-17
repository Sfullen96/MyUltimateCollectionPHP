<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0); 
ini_set('memory_limit','2048M');

class Cd extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('ArtistModel');
        $this->load->model('CdModel');
        $this->load->model('NoteModel');

    }

    public function index()
    {
        $data['title'] = "CD Library | Add CD";
        $data['main_content'] = 'add-cd';
        
        $this->load->view('includes/template', $data);
    }
}
