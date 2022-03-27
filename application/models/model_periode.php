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
}
