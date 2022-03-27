<?php
class model_penerima extends CI_Model
{

    public function penduduk($id_periode)
    {
        $where = array('id_periode' => $id_periode);
        return $this->db->query("SELECT * FROM tb_penduduk LEFT JOIN tb_periode USING (id_periode) LEFT JOIN tb_penerima USING (id_penduduk) WHERE id_periode = $id_periode");
    }

    public function penduduk_diterima($id_periode)
    {
        $where = array('id_periode' => $id_periode);
        return $this->db->query("SELECT * FROM tb_penduduk LEFT JOIN tb_periode USING (id_periode) LEFT JOIN tb_penerima USING (id_penduduk) WHERE id_periode = $id_periode AND status = 'Diterima'");
    }

    public function penduduk_wstatus()
    {
        $this->db->join('tb_penerima', 'tb_penerima.id_penduduk = tb_penduduk.id_penduduk');
        return $this->db->get('tb_penduduk');
    }

    public function penduduk_status_periode($id_periode)
    {
        $where = array('tb_periode.id_periode' => $id_periode);
        $this->db->join('tb_periode', 'tb_periode.id_periode = tb_penduduk.id_periode');
        $this->db->join('tb_penerima', 'tb_penerima.id_penduduk = tb_penduduk.id_penduduk');
        return $this->db->get_where('tb_penduduk', $where);
    }

    public function penduduk_cstatus($id)
    {
        $this->db->join('tb_penerima', 'tb_penerima.id_penduduk = tb_penduduk.id_penduduk');
        $this->db->where('tb_penduduk.id_penduduk', $id);
        return $this->db->get('tb_penduduk');
    }

    public function hapus_penerima($id)
    {
        $this->db->where('id_penerima', $id);
        $this->db->delete('tb_penerima');
    }

    public function insert_status($data)
    {
        $this->db->insert('tb_penerima', $data);
    }

    public function update_status($id, $data)
    {
        $this->db->where('id_penduduk', $id);
        $this->db->update('tb_penerima', $data);
    }

    public function getPenerima($dari, $sampai)
    {
        return $this->db->query("SELECT * FROM tb_penerima 
        INNER JOIN tb_penduduk USING (id_penduduk) 
        INNER JOIN tb_periode USING (id_periode) 
        WHERE tanggal_awal >= '$dari' AND tanggal_akhir <= '$sampai'");
    }

    public function getPenerima_diterima($dari, $sampai)
    {
        return $this->db->query("SELECT * FROM tb_penerima 
        INNER JOIN tb_penduduk USING (id_penduduk) 
        INNER JOIN tb_periode USING (id_periode) 
        WHERE tanggal_awal >= '$dari' AND tanggal_akhir <= '$sampai' AND status = 'Diterima'");
    }

    public function cek_status($id)
    {
        $this->db->where('id_penduduk =', $id);
        return $this->db->get('tb_penerima');
    }

    public function update_dana($id, $data)
    {
        $this->db->where('id_penerima', $id);
        $this->db->update('tb_penerima', $data);
    }
}
