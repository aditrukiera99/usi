<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftar_kode_akun_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_grup($keyword, $unit){
        $sql = "
        SELECT * FROM ak_grup_kode_akun
        WHERE UNIT = '$unit'
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }

    function cari_sub_by_id($kode_grup, $unit){
        $sql = "
        SELECT * FROM ak_sub_grup_kode_akun
        WHERE UNIT = '$unit' AND KODE_GRUP = '$kode_grup'
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }

    function get_no_akun($keyword, $id_klien, $unit){
        $where = "1=1";
        if($keyword != "" || $keyword != null){
            $where = $where." AND ( (KODE_AKUN LIKE '%$keyword%') OR (NAMA_AKUN LIKE '%$keyword%') OR (KATEGORI LIKE '%$keyword%')) ";
        }

        $sql = "
        SELECT * FROM ak_kode_akuntansi
        WHERE $where AND ID_KLIEN = $id_klien AND UNIT = '$unit'
        ORDER BY APPROVE ASC, ID DESC
        ";

        return $this->db->query($sql)->result();
    }

    function simpan_akun($id_klien, $nama_akun, $nomor_akun, $kode_grup, $kode_sub, $tipe){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);
        $unit = $user->UNIT;

        $approve = 3;
        if($user->LEVEL == 'USER'){
            $approve = 0;
        }

        $sql = "
            INSERT INTO ak_kode_akuntansi
            (ID_KLIEN, KODE_AKUN, NAMA_AKUN, KODE_GRUP, KODE_SUB, APPROVE, UNIT, KATEGORI)
            VALUES 
            ($id_klien, '$nomor_akun', '$nama_akun', '$kode_grup', '$kode_sub', '$approve', '$unit', '$tipe')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function hapus_akun($id){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        if($user->LEVEL == 'USER'){
            $sql = "UPDATE ak_kode_akuntansi SET APPROVE = 2 WHERE ID = '$id'";
            $this->db->query($sql);
        } else {
            $sql = " DELETE FROM ak_kode_akuntansi WHERE ID = '$id'"; 
            $this->db->query($sql);
        }
    }

    function cari_kode_by_id($id){
        $sql = "
        SELECT * FROM ak_kode_akuntansi WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }

    function edit_akun($id_akun_ed, $nama_akun_ed, $nomor_akun_ed, $deskripsi_ed, $kategori_ed){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $approve = 3;
        if($user->LEVEL == 'USER'){
            $approve = 1;
        }

        $sql = "
            UPDATE ak_kode_akuntansi SET 
            NAMA_AKUN = '$nama_akun_ed', DESKRIPSI = '$deskripsi_ed', KATEGORI = '$kategori_ed', APPROVE = '$approve'
            WHERE ID = $id_akun_ed
        ";

        $this->db->query($sql);
    }

}

?>