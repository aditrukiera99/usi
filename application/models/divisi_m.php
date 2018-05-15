<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Divisi_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_kendaraan(){
        $sql = "
        SELECT * FROM ak_unit
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }


    function hapus_kategori($id){
        
            $sql = " DELETE FROM ak_unit WHERE ID = $id"; 
            $this->db->query($sql);
        
    }

    function cari_kendaraan_by_id($id){
        $sql = "
        SELECT * FROM ak_unit WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_divisi($nama_divisi){
       

        $sql = "
        INSERT INTO ak_unit
        (NAMA_UNIT)
        VALUES 
        ('$nama_divisi')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function edit_divisi($id_grup, $nama_divisi_ed){
        

        $sql = "
        UPDATE ak_unit SET 
            NAMA_UNIT = '$nama_divisi_ed'
        WHERE ID = '$id_grup'
        ";

        $this->db->query($sql);
    }

}

?>