<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gudang_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_gudang(){
        $sql = "
        SELECT * FROM ak_gudang
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }


    function hapus_kategori($id){
        
            $sql = " DELETE FROM ak_gudang WHERE ID = $id"; 
            $this->db->query($sql);
        
    }

    function cari_gudang_by_id($id){
        $sql = "
        SELECT * FROM ak_gudang WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_gudang($nama,$kapasitas,$penanggung_jawab){
       

        $sql = "
        INSERT INTO ak_gudang
        (NAMA,KAPASITAS ,PENANGGUNG_JAWAB)
        VALUES 
        ('$nama', '$kapasitas', '$penanggung_jawab')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function edit_gudang($id_grup, $no_polisi, $merk, $tahun, $no_rangka, $no_mesin, $kapasitas, $sopir){
        

        $sql = "
        UPDATE ak_gudang SET 
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