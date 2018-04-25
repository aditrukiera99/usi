<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_realisasi_pendapatan_biaya_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_rkap_tahun($tipe, $unit, $tahun){
        $sql = "
        SELECT IFNULL(TOTAL, 0) AS TOTAL FROM (
            SELECT SUM(a.TOTAL) AS TOTAL FROM (
                SELECT b.TOTAL FROM ak_grup_kode_akun a
                JOIN ak_rkap b ON b.KODE_AKUN LIKE concat('%',a.KODE_GRUP,'%')
                WHERE a.GRUP = '$tipe' AND a.UNIT = '$unit' AND b.TAHUN = '$tahun' AND b.UNIT = '$unit'
            ) a 
        ) a 
        ";

        return $this->db->query($sql)->row();
    }

    function get_rkap_bulan($tipe, $unit, $bln, $tahun){
        $bln = strtoupper($bln);
        $sql = "
        SELECT IFNULL(TOTAL, 0) AS TOTAL FROM (
            SELECT SUM($bln) AS TOTAL FROM (
                SELECT $bln FROM ak_grup_kode_akun a
                JOIN ak_rkap b ON b.KODE_AKUN LIKE concat('%',a.KODE_GRUP,'%')
                WHERE a.GRUP = '$tipe' AND a.UNIT = '$unit' AND b.TAHUN = '$tahun' AND b.UNIT = '$unit'
            ) a 
        ) a 
        ";

        return $this->db->query($sql)->row();
    }

    function get_real_bulan($tipe, $unit, $bulan, $tahun){
        $sql = "
        SELECT SUM(TOTAL_1 + TOTAL_2) AS TOTAL FROM (
        SELECT IFNULL(TOTAL, 0) AS TOTAL_1, 0 AS TOTAL_2 FROM(
            SELECT (DEBET - KREDIT) AS TOTAL FROM (
                SELECT SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT FROM (
                    SELECT b.DEBET, b.KREDIT FROM ak_input_voucher a 
                    JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
                    JOIN ak_grup_kode_akun c ON b.KODE_AKUN LIKE concat('%',c.KODE_GRUP,'%')
                    WHERE a.UNIT = '$unit' AND c.UNIT = '$unit' AND c.GRUP = '$tipe' AND a.TGL LIKE '%-$bulan-$tahun%'
                ) a
            ) a
        ) a

        UNION ALL 

        SELECT 0 AS TOTAL_1, IFNULL(TOTAL, 0) AS TOTAL_2 FROM(
            SELECT (DEBET - KREDIT) AS TOTAL FROM (
                SELECT SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT FROM (
                    SELECT b.DEBET, b.KREDIT FROM ak_jurnal_penye a 
                    JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
                    JOIN ak_grup_kode_akun c ON b.KODE_AKUN LIKE concat('%',c.KODE_GRUP,'%')
                    WHERE a.UNIT = '$unit' AND c.UNIT = '$unit' AND c.GRUP = '$tipe' AND a.TGL LIKE '%-$bulan-$tahun%'
                ) a
            ) a
        ) a
        ) a
        ";

        return $this->db->query($sql)->row();
    }

    function get_real_sd_bulan($tipe, $unit, $bulan, $tahun){
        $tgl_awal = '01-01-'.$tahun;
        $tgl_akhir = '01-'.$bulan.'-'.$tahun;
        $sql = "
        SELECT SUM(TOTAL_1 + TOTAL_2) AS TOTAL FROM (
        SELECT IFNULL(TOTAL, 0) AS TOTAL_1, 0 AS TOTAL_2 FROM(
            SELECT (DEBET - KREDIT) AS TOTAL FROM (
                SELECT SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT FROM (
                    SELECT b.DEBET, b.KREDIT FROM ak_input_voucher a 
                    JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
                    JOIN ak_grup_kode_akun c ON b.KODE_AKUN LIKE concat('%',c.KODE_GRUP,'%')
                    WHERE a.UNIT = '$unit' AND c.UNIT = '$unit' AND c.GRUP = '$tipe'
                    AND STR_TO_DATE(a.TGL,'%d-%m-%Y') >= STR_TO_DATE('$tgl_awal','%d-%m-%Y')  AND STR_TO_DATE(a.TGL,'%d-%m-%Y') < STR_TO_DATE('$tgl_akhir','%d-%m-%Y')
                ) a
            ) a
        ) a

        UNION ALL 

        SELECT 0 AS TOTAL_1, IFNULL(TOTAL, 0) AS TOTAL_2 FROM(
            SELECT (DEBET - KREDIT) AS TOTAL FROM (
                SELECT SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT FROM (
                    SELECT b.DEBET, b.KREDIT FROM ak_jurnal_penye a 
                    JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
                    JOIN ak_grup_kode_akun c ON b.KODE_AKUN LIKE concat('%',c.KODE_GRUP,'%')
                    WHERE a.UNIT = '$unit' AND c.UNIT = '$unit' AND c.GRUP = '$tipe'
                    AND STR_TO_DATE(a.TGL,'%d-%m-%Y') >= STR_TO_DATE('$tgl_awal','%d-%m-%Y')  AND STR_TO_DATE(a.TGL,'%d-%m-%Y') < STR_TO_DATE('$tgl_akhir','%d-%m-%Y')
                ) a
            ) a
        ) a
        ) a
        ";

        return $this->db->query($sql)->row();
    }
}

?>