<?php
class model_penduduk extends CI_Model
{

    function __construct()
    {
        // Set tabel name
        $this->table = 'tb_penduduk';
    }

    public function data_penduduk()
    {
        return $this->db->get($this->table);
    }

    public function penduduk_periode($id)
    {
        $where = array('tb_penduduk.id_periode' => $id);
        $this->db->join('tb_periode', 'tb_periode.id_periode = tb_penduduk.id_periode');
        return $this->db->get_where('tb_penduduk', $where);
    }

    public function tambah_penduduk($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function get_penduduk($id)
    {
        return $this->db->get_where($this->table, $id);
    }

    public function update_penduduk($where, $data)
    {
        $this->db->where($where);
        $this->db->update($this->table, $data);
        return $this->db->error();
    }

    public function delete_penduduk($where)
    {
        $this->db->delete($this->table, $where);
    }
}
