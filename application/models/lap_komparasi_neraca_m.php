<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_komparasi_neraca_m extends CI_Model
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
        WHERE GRUP = '$main_grup' AND KODE_GRUP != '330'
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

    function get_nilai_grup($kode_grup, $unit, $bulan, $tahun){
        $sql = "
        SELECT SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
        FROM ak_input_voucher a
        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
        WHERE a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit' AND b.KODE_AKUN LIKE concat('%','$kode_grup','%')
        ";

        return $this->db->query($sql)->row();
    }

    function get_nilai_sub($kode_grup, $kode_sub, $unit, $bulan, $tahun){
        $sql = "
        SELECT SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
        FROM ak_input_voucher a
        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
        WHERE a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit' AND b.KODE_AKUN LIKE concat('%','$kode_grup', '.', '$kode_sub', '.','%')
        ";

        return $this->db->query($sql)->row();
    }

    function get_nilai_akun($kode_akun, $unit, $bulan, $tahun){
        $sql = "
        SELECT SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
        FROM ak_input_voucher a
        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
        WHERE a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit' AND b.KODE_AKUN = '$kode_akun'
        ";

        return $this->db->query($sql)->row();
    }

    function get_laba_rugi($kode_grup, $unit, $bulan, $tahun){
            $sql = "
            SELECT SUM(TOTAL_PENDAPATAN) AS DEBET,
                   SUM(TOTAL_BIAYA) AS KREDIT
            FROM (
                SELECT (DEBET - KREDIT) AS TOTAL_PENDAPATAN, 0 AS TOTAL_BIAYA
                FROM (
                    SELECT SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT FROM (
                        SELECT 
                        a.KODE_GRUP, a.KODE_AKUN, a.NAMA_AKUN, a.UNIT, 'PENDAPATAN' AS TIPE_AKUN,
                        IFNULL(b.DEBET, 0) AS DEBET, IFNULL(b.KREDIT, 0) AS KREDIT
                        FROM ak_kode_akuntansi a

                        LEFT JOIN (
                                SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
                                FROM ak_input_voucher a
                                JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
                                WHERE a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'
                                GROUP BY b.KODE_AKUN
                        ) b ON a.KODE_AKUN = b.KODE_AKUN
                        JOIN ak_grup_kode_akun d ON a.KODE_GRUP = d.KODE_GRUP AND a.UNIT = d.UNIT
                        WHERE d.GRUP = 'PENDAPATAN' AND a.UNIT = '$unit'
                    ) a
                ) a

                UNION ALL

                SELECT 0 AS TOTAL_PENDAPATAN, (DEBET - KREDIT)  AS TOTAL_BIAYA
                FROM (
                    SELECT SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT FROM (
                        SELECT 
                        a.KODE_GRUP, a.KODE_AKUN, a.NAMA_AKUN, a.UNIT, 'BIAYA' AS TIPE_AKUN,
                        IFNULL(b.DEBET, 0) AS DEBET, IFNULL(b.KREDIT, 0) AS KREDIT
                        FROM ak_kode_akuntansi a
                        LEFT JOIN (
                                SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
                                FROM ak_input_voucher a
                                JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
                                WHERE a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'
                                GROUP BY b.KODE_AKUN
                        ) b ON a.KODE_AKUN = b.KODE_AKUN

                        JOIN ak_grup_kode_akun d ON a.KODE_GRUP = d.KODE_GRUP AND a.UNIT = d.UNIT
                        WHERE d.GRUP = 'BIAYA' AND a.UNIT = '$unit'
                    ) a
                ) a
            )a
            ";

            return $this->db->query($sql)->row();
    } 
}

?>