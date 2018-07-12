<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_lowongan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_transportir(){
        $sql = "
        SELECT * FROM ak_lowongan
        ";

        return $this->db->query($sql)->result();
    }


    function hapus_lowongan_sertifikat($id){
        
            $sql = " DELETE FROM ak_lowongan_sertifikat WHERE ID_LOWONGAN = $id"; 
            $this->db->query($sql);
        
    }

    function hapus_lowongan($id){
        
            $sql = " DELETE FROM ak_lowongan WHERE ID = $id"; 
            $this->db->query($sql);
        
    }

    function cari_lowongan_by_id($id){
        $sql = "
        SELECT * FROM ak_lowongan WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_lowongan($nama,$tgl_awal,$tgl_akhir,$keterangan,$maksimal){
       

        $sql = "
        INSERT INTO ak_lowongan
        (NAMA,TGL_AWAL,TGL_AKHIR,KETERANGAN,MAKSIMAL_UMUR)
        VALUES 
        ('$nama','$tgl_awal','$tgl_akhir','$keterangan','$maksimal')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function simpan_lowongan_sertifikat($id_lowongan,$id_lowongan_sertifikat){
       

        $sql = "
        INSERT INTO ak_lowongan_sertifikat
        (ID_LOWONGAN,ID_SERTIFIKAT)
        VALUES 
        ('$id_lowongan','$id_lowongan_sertifikat')
        ";

        $this->db->query($sql);
    }

    function edit_data_lowongan($id_grup,$nama,$tgl_awal,$tgl_akhir,$keterangan,$maksimal){
        

        $sql = "
        UPDATE ak_lowongan SET 
            NAMA = '$nama' , 
            TGL_AWAL = '$tgl_awal' ,
            TGL_AKHIR = '$tgl_akhir' ,
            KETERANGAN = '$keterangan' ,
            MAKSIMAL_UMUR = '$maksimal' 
        WHERE ID = '$id_grup'
        ";

        $this->db->query($sql);
    }

}

?>