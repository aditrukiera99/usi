<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kendaraan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_kendaraan(){
        $sql = "
        SELECT * FROM ak_kendaraan
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }


    function hapus_kategori($id){
        
            $sql = " DELETE FROM ak_kendaraan WHERE ID = $id"; 
            $this->db->query($sql);
        
    }

    function cari_kendaraan_by_id($id){
        $sql = "
        SELECT * FROM ak_kendaraan WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_kendaraan($no_polisi, $merk, $tahun, $no_rangka, $no_mesin, $kapasitas, $sopir){
       

        $sql = "
        INSERT INTO ak_kendaraan
        (NOPOL,MERK ,TAHUN ,NORANGKA ,NOMESIN , KAPASITAS,SOPIR)
        VALUES 
        ('$no_polisi', '$merk', '$tahun', '$no_rangka', '$no_mesin', '$kapasitas', '$sopir')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function edit_kendaraan($id_grup, $no_polisi, $merk, $tahun, $no_rangka, $no_mesin, $kapasitas, $sopir){
        

        $sql = "
        UPDATE ak_kendaraan SET 
            NOPOL = '$no_polisi', 
            MERK = '$merk',
            TAHUN = '$tahun',
            NORANGKA = '$no_rangka',
            NOMESIN = '$no_mesin',
            KAPASITAS = '$kapasitas',
            SOPIR = '$sopir'
        WHERE ID = '$id_grup'
        ";

        $this->db->query($sql);
    }

}

?>