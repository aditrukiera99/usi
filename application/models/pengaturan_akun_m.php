<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengaturan_akun_m extends CI_Model
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


}

?>