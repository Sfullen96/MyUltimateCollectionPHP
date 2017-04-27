<?php

class FormatModel extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    function getFormatList( $itemType ) {
        $query = $this->db->select()
            ->where( 'item_type_id', $itemType )
            ->get( 'format' );

        return $query->result();
    }

}

