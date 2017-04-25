<?php

class NoteModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	public function addNote($item_id, $note) {
        $note = urldecode($note);
		$data = array(
		   	'item_id' => $item_id,
            'user_id' => $this->session->userdata('user_id'),
		   	'note' => $note
		);

		$this->db->insert('note', $data);

        return true;
	}

	function getItemNotes($itemId) {
        $notes = $this->db->select()
                ->where('item_id', $itemId)
                ->order_by('note_timestamp DESC')
                ->get('note');

        return $notes->result();
    }
}

?>