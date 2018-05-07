<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_pegawai(){
        $sql = "
        SELECT * FROM ak_pegawai
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }


    function hapus_kategori($id){
        
            $sql = " DELETE FROM ak_pegawai WHERE ID = $id"; 
            $this->db->query($sql);
        
    }

    function cari_pegawai_by_id($id){
        $sql = "
        SELECT * FROM ak_pegawai WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_pegawai($nik,$nama,$alamat,$jabatan,$departemen){
       

        $sql = "
        INSERT INTO ak_pegawai
        (NIK,NAMA_PEGAWAI ,ALAMAT ,JABATAN ,DEPARTEMEN )
        VALUES 
        ('$nik', '$nama', '$alamat', '$jabatan', '$departemen')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function edit_pegawai($id_grup, $no_polisi, $merk, $tahun, $no_rangka, $no_mesin, $kapasitas, $sopir){
        

        $sql = "
        UPDATE ak_pegawai SET 
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