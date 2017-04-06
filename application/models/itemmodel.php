<?php

class ItemModel extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    function getItemInfo($itemId) {

        $query = $this->db->select()
                ->join('artists', 'artists.artist_id = library.artist_id')
                ->join('formats', 'formats.format_id = library.format_id')
                ->where('item_id', $itemId)
                ->get('library');

       return $query->result();

    }

    function getItemRating($itemId) {
        $rating = $this->db->select('rating')
                ->where('item_id', $itemId)
                ->get('library');

        return $rating->result();
    }

    function updateRating($rating, $itemId) {
        $data = array(
            'rating' => $rating
        );

        $this->db->where('item_id', $itemId);
        $this->db->update('library', $data);
    }

    function updateItem($field, $value, $table, $itemId) {
        $data = array(
            $field => $value
        );

        $this->db->where('item_id', $itemId);
        $query = $this->db->update($table, $data);

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function getList($table) {
        $query = $this->db->get($table);

        return $query;
    }

    function addNewCd($title, $artist_id, $summary, $format_id, $reference, $cd_count, $image, $purchasedFrom, $purchaseDate, $price) {

        $data = array(
            'artist_id' => $artist_id,
            'format_id' => $format_id,
            'cd_count' => $cd_count,
            'title' => $title,
            'reference' => $reference,
            'purchase_date' => $purchaseDate,
            'purchased_from' => $purchasedFrom,
            'price' => $price,
            'summary' => $summary,
            'album_image' => $image
        );

        $query = $this->db->insert('library', $data);

        return $this->db->insert_id();

    }

    function checkIfExists($name, $artist) {
        $query = $this->db->select()
                ->where('title', $name)
                ->where('artist_id', $artist)
                ->get('library');

        if($query->num_rows() > 0) {
            return $query->result()[0]->item_id;
        } else {
            return 0;
        }
    }

    function getAllitems() {
        $query = $this->db->select()
                ->join('artists', 'artists.artist_id = library.artist_id')
                ->join('formats', 'formats.format_id = library.format_id')
                ->get('library');

       return $query->result();
    }

    function getItemByTrackName($name) {
        $query = $this->db->select('item_id')
                ->where('track_name', $name)
                ->get('tracks');

        if ($query->num_rows() > 0) {
            return $query->result()[0]->item_id;
        } else {
            return false;
        }

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
              library 
            WHERE created_at BETWEEN FROM_UNIXTIME($from) 
            AND FROM_UNIXTIME($to)
        ";

        $query = $this->db->query($sql);
       

        return $query->num_rows();
    }

    function getCDcount() {
        $query = $this->db->select()
                    ->get('library');

        return $query->num_rows();
    }

    function getCDListenedCount() {
        $query = $this->db->select()
                ->where('listened', 1)
                ->get('library');

        return $query->num_rows();
    }

    public function addView($id) {
        $data = array(
            'item_id' => $id,
        );

        $query = $this->db->insert('item_views', $data);

        if($query) {
            return true;
        } else {
            return false;
        }
    }

    public function getFavAlbums() {
        $sql = "
            SELECT COUNT(view_id) as views, item_views.item_id, title
            FROM item_views
            LEFT JOIN library 
            ON library.item_id = item_views.item_id
            GROUP BY item_views.item_id
            ORDER BY COuNT(view_id) DESC,
            timestamp DESC
            LIMIT 5
        ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function getRecentlyViewed() {
        $sql = "
            SELECT *
            FROM item_views v
            LEFT JOIN library l
            ON l.item_id = v.item_id
            LEFT JOIN artists a
            ON a.artist_id = l.artist_id
            ORDER BY timestamp DESC
            LIMIT 5
        ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}
 

