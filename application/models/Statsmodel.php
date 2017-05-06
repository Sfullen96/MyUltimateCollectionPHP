<?php

class StatsModel extends CI_Model
{

    public $user_id;

    function __construct()
    {
        parent::__construct();
        $this->user_id = ($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0;
    }

    public function cdStats($timeframe) {
        switch ($timeframe) {
            case 'week':
                $day = date('w');

                if ($day == 1) {
                    // Monday
                    $from = strtotime('today 12am');
                } else {
                    $from = strtotime('last monday midnight') + 1;
                }

                if ($day == 7) {
                    $to = strtotime('today 23:59:59');
                } else {
                    $to = strtotime('next sunday 23:59:59');
                }
                break;
            case 'month':
                $from = strtotime(date('Y-m-01'));
                $to = strtotime(date('Y-m-t'));
                break;
            case 'year':
                $year = date('Y');
                $from = mktime(0, 0, 0, 1, 1, $year);
                $to = mktime(0, 0, 0, 12, 31, $year);
                break;
            default:

                break;
        }

        $sql = "
            SELECT 
              * 
            FROM
              item 
            WHERE created_at BETWEEN FROM_UNIXTIME($from) 
            AND FROM_UNIXTIME($to)
            AND user_id = '$this->user_id'
        ";

        $query = $this->db->query($sql);


        return $query->num_rows();
    }

    function getCDcount() {
        $query = $this->db->select()
            ->where('user_id',$this->user_id)
            ->get('item');

        return $query->num_rows();
    }

    function getCDListenedCount() {
        $query = $this->db->select()
            ->where('listened', 1)
            ->where('user_id',$this->user_id)
            ->get('item');

        return $query->num_rows();
    }

}