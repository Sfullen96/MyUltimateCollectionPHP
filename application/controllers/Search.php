<?php

class Search extends CI_Controller
{
    public function index()
    {
        $keyword = $_POST['keyword'];

        $this->load->model('SearchModel');

        $data['item_results'] = $this->SearchModel->searchItems($keyword);
        $data['artist_results'] = $this->SearchModel->searchArtists($keyword);
        $data['keyword'] = $keyword;
        $data['title'] = "Search | " . $keyword;
        $data['main_content'] = 'results';
        $this->load->view('includes/template', $data);
    }
}

?>