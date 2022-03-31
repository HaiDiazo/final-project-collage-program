<?php
class model_alternatif extends CI_Model
{

    function __construct()
    {
        // Set tabel name
        $this->table = 'alternatif';
    }

    public function get_alternatif($id_periode)
    {
        return $this->db->query("SELECT * FROM alternatif WHERE id_penduduk IN (SELECT id_penduduk FROM tb_penduduk WHERE id_periode = $id_periode)");
    }

    public function insert_alternatif($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function exist_alternatif_penduduk($id_periode)
    {
        $query = $this->db->query("SELECT * FROM alternatif WHERE id_penduduk IN (SELECT id_penduduk FROM tb_penduduk WHERE id_periode = $id_periode)");

        return $query;
    }

    public function update_alternatif($where, $data)
    {
        $this->db->where('id_penduduk', $where);
        $this->db->update($this->table, $data);
    }
}
