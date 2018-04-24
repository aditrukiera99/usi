<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_komparasi_pend_biaya_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_unit(){
        $sql = "SELECT * FROM ak_unit WHERE ID != 17 ORDER BY ID";
        return $this->db->query($sql)->result();
    }

    function get_grup_kode_akun($main_grup){
        $sql = "
        SELECT NAMA_GRUP, KODE_GRUP FROM ak_grup_kode_akun 
        WHERE GRUP = '$main_grup'
        GROUP BY KODE_GRUP
        ORDER BY KODE_GRUP
        ";

        return $this->db->query($sql)->result();
    }

    function get_sub_kode_akun($kode_grup){
        $sql = "
        SELECT NAMA_SUB, KODE_SUB FROM ak_sub_grup_kode_akun 
        WHERE KODE_GRUP = '$kode_grup'
        GROUP BY KODE_SUB
        ORDER BY KODE_SUB
        ";

        return $this->db->query($sql)->result();
    }

    function get_kode_akun($kode_grup, $kode_sub){
        $sql = "
        SELECT KODE_AKUN, NAMA_AKUN FROM ak_kode_akuntansi 
        WHERE KODE_GRUP = '$kode_grup' AND KODE_SUB = '$kode_sub'
        GROUP BY KODE_AKUN
        ORDER BY KODE_AKUN
        ";

        return $this->db->query($sql)->result();
    }

    function get_laba_rugi_sub($kode_grup, $kode_sub, $unit, $bulan, $tahun){
        $sql = "
        SELECT a.KODE_AKUN, IFNULL(a.DEBET, 0) AS DEBET, IFNULL(a.KREDIT, 0) AS KREDIT FROM (
        SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
        FROM ak_input_voucher a
        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
        WHERE a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit' AND b.KODE_AKUN LIKE concat('%','$kode_grup', '.', '$kode_sub', '.','%')
        GROUP BY b.KODE_AKUN 
        ) a
        ";

        return $this->db->query($sql)->row();
    }

    function get_laba_rugi_akun($kode_akun, $unit, $bulan, $tahun){
        $sql = "
        SELECT a.KODE_AKUN, IFNULL(a.DEBET, 0) AS DEBET, IFNULL(a.KREDIT, 0) AS KREDIT FROM (
        SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
        FROM ak_input_voucher a
        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
        WHERE a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit' AND b.KODE_AKUN = '$kode_akun'
        GROUP BY b.KODE_AKUN 
        ) a
        ";

        return $this->db->query($sql)->row();
    }
}

?>