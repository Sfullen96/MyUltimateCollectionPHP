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

	function getItemNotes($itemId) {
        $notes = $this->db->select()
                ->where('cd_id', $itemId)
                ->get('notes');

        return $notes->result();
    }
}

?>