<?php

class user extends CI_Model
{

    public function get_data()
    {
        return $this->db->get('user')->result_array();
    }

    public function getNamaTerang($id_user)
    {
        $this->db->select('nama_terang');
        $this->db->where('id_user', $id_user);
        return $this->db->get('user')->row_array();
    }

    public function setNamaTerang($data, $where)
    {
        $this->db->where('id_user', $where);
        $this->db->update('user', $data);
    }
}
