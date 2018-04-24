<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_klien_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_user($id_user, $unit){

        $sql = "
        SELECT * FROM ak_user
        WHERE LEVEL = 'ADMIN'
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }

    function ubah_nama($id_klien, $nama_lengkap){

        $sql = "
        UPDATE ak_user SET NAMA = '$nama_lengkap' WHERE ID_KLIEN = $id_klien
        ";

        $this->db->query($sql);
    }

    function edit_laporan_header($id_klien, $foto){
        $sql = "
        UPDATE ak_profil_usaha SET HEADER_LAPORAN = '$foto' 
        WHERE ID_KLIEN = $id_klien
        ";

        $this->db->query($sql);
    }

    function ganti_password($id_klien, $password){
        $sql = "
        UPDATE ak_user SET PASSWORD = '$password' WHERE ID = $id_klien
        ";

        $this->db->query($sql);
    }

    function ganti_judul_laporan($id_klien, $nama_laporan){
        $sql = "
        UPDATE ak_profil_usaha SET NAMA_LAPORAN = '$nama_laporan' 
        WHERE ID_KLIEN = $id_klien
        ";

        $this->db->query($sql);
    }

    function get_user_data($id){
        $sql = "
        SELECT * FROM ak_user WHERE ID = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_hak_akses($id, $menu1, $menu2){
        $sql = "
        INSERT INTO ak_hak_akses
        (ID_USER, MENU_1, MENU_2)
        VALUES 
        ('$id', '$menu1', '$menu2')
        ";

        $this->db->query($sql);
    }

    function cek_master($id, $menu){
        $sql = "
        SELECT * FROM ak_hak_akses WHERE ID_USER = '$id' AND MENU_1 = '$menu'
        ";

        $jml = count($this->db->query($sql)->result());

        if($jml > 0){
            return true;
        } else {
            return false;
        }
    }

    function cek_anak($id, $menu){
        $sql = "
        SELECT * FROM ak_hak_akses WHERE ID_USER = '$id' AND MENU_2 = '$menu'
        ";

        $jml = count($this->db->query($sql)->result());

        if($jml > 0){
            return true;
        } else {
            return false;
        }
    }

    function hapus_user($id_hapus){
        $sql = "DELETE FROM ak_user WHERE ID = '$id_hapus'";
        $this->db->query($sql);
    }

    function get_data_user_by_id($id){
        $sql = "SELECT * FROM ak_user WHERE ID = '$id' ";
        return $this->db->query($sql)->row();
    }

    function edit_user($id_edit, $nama_lengkap, $username, $password){
        if($password == ""){
            $sql = "
            UPDATE ak_user SET 
                NAMA = '$nama_lengkap'
            WHERE ID = '$id_edit'
            ";        
            $this->db->query($sql);

        } else {
            $password = md5(md5($password));
            $sql = "
            UPDATE ak_user SET 
                NAMA = '$nama_lengkap',
                PASSWORD = '$password'
            WHERE ID = '$id_edit'
            ";        
            $this->db->query($sql);
        }        
    }

}

?>