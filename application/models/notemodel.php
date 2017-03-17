<?php

class NoteModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	public function addNote($cd_id, $note) {
		$data = array(
		   	'cd_id' => $cd_id,
		   	'note' => $note
		);

		$this->db->insert('cd-notes', $data);
	}

}

?>