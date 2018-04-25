<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftar_kategori_akun_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_kategori($keyword, $id_klien){
        $where = "1=1";
        if($keyword != "" || $keyword != null){
            $where = $where." AND (NAMA_KATEGORI LIKE '%$keyword%') ";
        }

        $sql = "
        SELECT * FROM ak_kategori_akun
        WHERE $where AND ID_KLIEN = $id_klien
        ORDER BY ID ASC
        ";

        return $this->db->query($sql)->result();
    }


    function hapus_kategori($id){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        if($user->LEVEL == 'USER'){
            $sql = "UPDATE ak_kategori_akun SET APPROVE = 2 WHERE ID = '$id'";
            $this->db->query($sql);
        } else {
            $sql = " DELETE FROM ak_kategori_akun WHERE ID = $id"; 
            $this->db->query($sql);
        }
    }

    function cari_kat_by_id($id){
        $sql = "
        SELECT * FROM ak_kategori_akun WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }


    function simpan_kat($id_klien, $nama_kat, $deskripsi, $id_user){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $approve = 3;
        if($user->LEVEL == 'USER'){
            $approve = 0;
        }

        $tgl = date('d-m-Y, H:i');
        $sql = "
        INSERT INTO ak_kategori_akun
        (ID_KLIEN, NAMA_KATEGORI, DESKRIPSI, APPROVE, USER_INPUT, TGL_INPUT)
        VALUES 
        ($id_klien, '$nama_kat', '$deskripsi', '$approve', '$id_user', '$tgl')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function edit_kat($id_kat, $nama_kat_ed, $deskripsi_ed){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $approve = 3;
        if($user->LEVEL == 'USER'){
            $approve = 1;
        }

        $sql = "
        UPDATE ak_kategori_akun SET 
        NAMA_KATEGORI = '$nama_kat_ed', DESKRIPSI = '$deskripsi_ed', APPROVE = '$approve'
        WHERE ID = $id_kat
        ";

        $this->db->query($sql);
    }

}

?>