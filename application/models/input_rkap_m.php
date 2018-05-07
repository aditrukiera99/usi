<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_rkap_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_rkap($keyword, $id_klien){

        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);
        $where_unit = "1=1";
        if($user->LEVEL == "ADMIN"){
            $where_unit = "1=1";
        } else {
            $where_unit = "UNIT = ".$user->UNIT;
        }

        $sql = "
        SELECT * FROM ak_rkap WHERE $where_unit
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }



    function get_list_akun($unit){
        $sql = "
        SELECT KODE_GRUP AS KODE_AKUN, NAMA_GRUP AS NAMA_AKUN, '' AS SUB FROM ak_grup_kode_akun
        UNION ALL
        SELECT KODE_AKUN, NAMA_AKUN , '' AS SUB FROM ak_kode_akuntansi
        ";

        return $this->db->query($sql)->result();
    }

    function get_list_akun_all($id_klien){
        $sql = "
        SELECT * FROM ak_kode_akuntansi WHERE ID_KLIEN = $id_klien
        ";

        return $this->db->query($sql)->result();
    }

    function get_nama_akun($kode_akun, $tipe){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);
        $unit = $user->UNIT;

        if($tipe == "grup"){
            $sql = "SELECT * FROM ak_grup_kode_akun WHERE KODE_GRUP = '$kode_akun' AND UNIT = '$unit' ";
        } else if($tipe == "sub"){
            $kode_grup = substr($kode_akun, 0, 3);
            $kode_sub = substr($kode_akun, 4, 2);
            $sql = "SELECT * FROM ak_sub_grup_kode_akun WHERE KODE_GRUP = '$kode_grup' AND KODE_SUB = '$kode_sub' AND UNIT = '$unit' ";
        } else if($tipe == "akun"){
            $sql = "SELECT * FROM ak_kode_akuntansi WHERE KODE_AKUN = '$kode_akun' AND UNIT = '$unit' ";
        }

        return $this->db->query($sql)->row();
    }

    function get_rkap_by_id($id){
        $sql = "
        SELECT * FROM ak_rkap WHERE ID = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_rkap($unit, $kode_akun, $tahun, $januari, $februari, $maret, $april, $mei, $juni, $juli, $agustus, $september, $oktober, $november, $desember, $total_rkap){
        $januari = str_replace(',', '', $januari);
        $februari = str_replace(',', '', $februari);
        $maret = str_replace(',', '', $maret);
        $april = str_replace(',', '', $april);
        $mei = str_replace(',', '', $mei);
        $juni = str_replace(',', '', $juni);
        $juli = str_replace(',', '', $juli);
        $agustus = str_replace(',', '', $agustus);
        $september = str_replace(',', '', $september);
        $oktober = str_replace(',', '', $oktober);
        $november = str_replace(',', '', $november);
        $desember = str_replace(',', '', $desember);
        $total_rkap = str_replace(',', '', $total_rkap);

        $sql = "
        INSERT INTO ak_rkap
        (KODE_AKUN, UNIT, JANUARI, FEBRUARI, MARET, APRIL, MEI, JUNI, JULI, AGUSTUS, SEPTEMBER, OKTOBER, NOVEMBER, DESEMBER, TOTAL, TAHUN)
        VALUES 
        ('$kode_akun', '$unit', '$januari', '$februari', '$maret', '$april', '$mei', '$juni', '$juli', '$agustus', '$september', '$oktober', '$november', '$desember', '$total_rkap', '$tahun')
        ";

        $this->db->query($sql);
    }

    function hapus_rkap($id){
        $sql = "DELETE FROM ak_rkap WHERE ID = '$id' ";
        $this->db->query($sql);
    }

}

?>