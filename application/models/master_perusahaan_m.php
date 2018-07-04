<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_perusahaan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_akun($id_klien){

        $sql = "
        SELECT * FROM ak_user WHERE ID = $id_klien
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_bank($nama_bank,$rekening_bank, $atas_nama, $cabang)
    {

        $sql = "
        INSERT INTO tb_rekening_bank
        (
            NAMA_BANK,
            NOMOR_REKENING,
            ATAS_NAMA,
            CABANG

        )
        VALUES 
        (
           '$nama_bank', 
           '$rekening_bank', 
           '$atas_nama',
           '$cabang'
        )
        ";

        $this->db->query($sql);
    }

    function get_data_rekening(){

        $sql = "
        SELECT * FROM tb_rekening_bank
        ";

        return $this->db->query($sql)->result();
    }

    function get_master($id){

        $sql = "
        SELECT * FROM tb_rekening_bank WHERE ID = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function ubah_nama($id_klien, $nama_lengkap, $username){

        $sql = "
        UPDATE ak_user SET NAMA = '$nama_lengkap', USERNAME = '$username' WHERE ID = $id_klien
        ";

        $this->db->query($sql);
    }

    function edit_ava_user($id_klien, $foto){
        $sql = "
        UPDATE ak_user SET FOTO = '$foto' 
        WHERE ID = $id_klien
        ";

        $this->db->query($sql);
    }

    function ganti_password($id_klien, $password){

        $password = md5(md5($password));

        $sql = "
        UPDATE ak_user SET PASSWORD = '$password' WHERE ID = $id_klien
        ";

        $this->db->query($sql);
    }

    function update_bank($id_bank, $nama_bank,$rekening_bank, $atas_nama, $cabang){

        

        $sql = "
        UPDATE tb_rekening_bank SET 
        NAMA_BANK = '$nama_bank',
        NOMOR_REKENING = '$rekening_bank',
        ATAS_NAMA = '$atas_nama',
        CABANG = '$cabang' 
        WHERE ID = $id_bank
        ";

        $this->db->query($sql);
    }


}

?>