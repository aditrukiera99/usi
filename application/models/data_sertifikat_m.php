<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_sertifikat_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_sertifikat(){
        $sql = "
        SELECT * FROM ak_sertifikat
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }


    function hapus_kategori($id){
        
            $sql = " DELETE FROM ak_sertifikat WHERE ID = $id"; 
            $this->db->query($sql);
        
    }

    function cari_sertifikat_by_id($id){
        $sql = "
        SELECT * FROM ak_sertifikat WHERE ID = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_sertifikat($nama_sertifikat){
       

        $sql = "
        INSERT INTO ak_sertifikat
        (NAMA,STATUS)
        VALUES 
        ('$nama_sertifikat','0')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function edit_sertifikat($id_grup, $nama){
        

        $sql = "
        UPDATE ak_sertifikat SET 
            NAMA = '$nama'
        WHERE ID = '$id_grup'
        ";

        $this->db->query($sql);
    }

}

?>