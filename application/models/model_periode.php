<?php
class model_periode extends CI_Model
{
    function __construct()
    {
        $this->table = 'tb_periode';
    }

    public function tahun_periode()
    {
        return $this->db->get('tb_periode');
    }

    public function tahun_periode_id($id_periode)
    {
        $this->db->where('id_periode', $id_periode);
        return $this->db->get('tb_periode');
    }

    public function get_new_periode()
    {
        $this->db->limit(1);
        $this->db->order_by('tanggal_awal', 'DESC');
        return $this->db->get('tb_periode');
    }

    public function get_periode($where)
    {
        return $this->db->get_where($this->table, $where);
    }

    public function delete_periode($where)
    {
        $this->db->delete($this->table, $where);
    }

    public function update_periode($where, $data)
    {
        $this->db->where($where);
        $this->db->update($this->table, $data);
    }


    public function insert_periode($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function get_anggaran_periode()
    {
        return $this->db->query('SELECT nama_periode, anggaran FROM tb_periode');
    }

    public function sum_anggaran()
    {
        $query = $this->db->query("SELECT SUM(anggaran) as jumlah FROM tb_periode")->row_array();
        return $query['jumlah'];
    }
}
