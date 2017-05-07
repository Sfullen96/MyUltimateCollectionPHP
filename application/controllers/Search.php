<?php

class Search extends CI_Controller
{
    public function index()
    {
        $keyword = $_POST['keyword'];

        $this->load->model('searchmodel');

        $data['item_results'] = $this->searchmodel->searchItems($keyword);
        $data['artist_results'] = $this->searchmodel->searchArtists($keyword);
        $data['profile_results'] = $this->searchmodel->searchUsers($keyword);
        $data['keyword'] = $keyword;
        $data['title'] = "Search | " . $keyword;
        $data['main_content'] = 'results';
        $this->load->view('includes/template', $data);
    }
}

?>