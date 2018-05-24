<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_kendaraan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_service_kendaraan(){
        $sql = "
        SELECT * FROM ak_service_kendaraan
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

    function simpan_service_kendaraan($kendaraan_pol, $tahun, $keterangan, $biaya){
       

        $sql = "
        INSERT INTO ak_service_kendaraan
        (ID_KENDARAAN,TANGGAL ,SERVICE ,BIAYA )
        VALUES 
        ('$kendaraan_pol', '$tahun', '$keterangan', '$biaya')
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