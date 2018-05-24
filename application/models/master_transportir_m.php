<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_transportir_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_transportir(){
        $sql = "
        SELECT * FROM ak_master_transportir
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }


    function hapus_kategori($id){
        
            $sql = " DELETE FROM ak_master_transportir WHERE ID = $id"; 
            $this->db->query($sql);
        
    }

    function cari_kendaraan_by_id($id){
        $sql = "
        SELECT * FROM ak_master_transportir WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_master_transportir($nama_master_transportir,$alamat_master_transportir){
       

        $sql = "
        INSERT INTO ak_master_transportir
        (NAMA,ALAMAT)
        VALUES 
        ('$nama_master_transportir','$alamat_master_transportir')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function edit_master_transportir($id_grup, $nama_master_transportir_ed,$alamat_master_transportir_ed){
        

        $sql = "
        UPDATE ak_master_transportir SET 
            NAMA = '$nama_master_transportir_ed' , ALAMAT = '$alamat_master_transportir_ed'
        WHERE ID = '$id_grup'
        ";

        $this->db->query($sql);
    }

}

?>