<?php
class model_ir extends CI_Model
{

    function __construct()
    {
        // Set tabel name
        $this->table = 'tb_index_random_cons';
    }

    public function get_ir($n)
    {
        $this->db->select('nilai_ir');
        $this->db->from($this->table);
        $this->db->where('ukuran_matrix', $n);
        return $this->db->get();
    }
}
