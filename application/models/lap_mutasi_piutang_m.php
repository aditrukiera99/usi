<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_mutasi_piutang_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_list_akun_all($id_klien){
        $sql = "
        SELECT * FROM ak_kode_akuntansi WHERE ID_KLIEN = $id_klien
        ORDER BY KODE_AKUN
        ";

        return $this->db->query($sql)->result();
    }

    function get_hutang_bulanan($bulan, $tahun, $unit){
        $bulan_lalu = $bulan - 1;
        $tahun_lalu = $tahun;

        if($bulan_lalu == 0){
            $bulan_lalu = 12;
            $tahun_lalu = $tahun_lalu - 1;
        }

        $sql = "
        SELECT 
        a.NAMA_PELANGGAN,
        IFNULL(b.SALDO_AWAL, 0) AS SALDO_AWAL,
        IFNULL(c.MUTASI, 0) AS MUTASI,
        IFNULL(d.HUTANG_LAGI, 0) AS HUTANG_LAGI
        FROM ak_pelanggan a 
        LEFT JOIN (
            SELECT a.KONTAK, IFNULL(IFNULL(a.HUTANG_LALU, 0) - IFNULL(a.MUTASI_LALU,0), 0) AS SALDO_AWAL FROM (
                SELECT a.KONTAK, SUM(a.HUTANG_LALU) AS HUTANG_LALU, SUM(a.MUTASI_LALU) AS MUTASI_LALU FROM (
                    SELECT a.KONTAK, SUM(b.DEBET + b.KREDIT) AS HUTANG_LALU, 0 AS MUTASI_LALU
                    FROM ak_input_voucher a
                    JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
                    WHERE a.UNIT = '$unit' AND STR_TO_DATE(a.TGL, '%d-%c-%Y') < STR_TO_DATE('01-$bulan-$tahun' , '%d-%c-%Y') AND (b.KODE_AKUN LIKE '%110%' OR b.KODE_AKUN LIKE '%112%')
                    GROUP BY a.KONTAK

                    UNION ALL 

                    SELECT KONTAK, 0 AS HUTANG_LALU, SUM(DEBET + KREDIT) AS MUTASI_LALU
                    FROM ak_jurnal_kas_bank
                    WHERE UNIT = '$unit' 
                    AND STR_TO_DATE(TGL_CEK, '%d-%c-%Y') < STR_TO_DATE('01-$bulan-$tahun' , '%d-%c-%Y') 
                    AND (KODE_AKUN LIKE '%110%' OR KODE_AKUN LIKE '%112%')
                    AND TIPE  = 'PIUTANG'
                    GROUP BY KONTAK
                ) a
                GROUP BY a.KONTAK
            ) a
        ) b ON a.NAMA_PELANGGAN = b.KONTAK

        LEFT JOIN (
            SELECT KONTAK, SUM(DEBET + KREDIT) AS MUTASI FROM ak_jurnal_kas_bank
            WHERE UNIT = '$unit' 
            AND TGL_CEK LIKE '%-$bulan-$tahun%'
            AND (KODE_AKUN LIKE '%110%' OR KODE_AKUN LIKE '%112%')
            AND TIPE  = 'PIUTANG'
            GROUP BY KONTAK
        ) c ON a.NAMA_PELANGGAN = c.KONTAK

        LEFT JOIN (
            SELECT a.KONTAK, SUM(b.DEBET + b.KREDIT) AS HUTANG_LAGI
            FROM ak_input_voucher a
            JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
            WHERE a.UNIT = '$unit'
            AND a.TGL LIKE '%-$bulan-$tahun%'
            AND (b.KODE_AKUN LIKE '%110%' OR b.KODE_AKUN LIKE '%112%')
            GROUP BY a.KONTAK
        ) d ON a.NAMA_PELANGGAN = d.KONTAK
        WHERE a.UNIT = '$unit' AND a.APPROVE = 3
        ";

        return $this->db->query($sql)->result();
    }

    function get_hutang_tahunan($tahun, $unit){
         $sql = "
        SELECT 
        a.NAMA_PELANGGAN,
        IFNULL(b.SALDO_AWAL, 0) AS SALDO_AWAL,
        IFNULL(c.MUTASI, 0) AS MUTASI,
        IFNULL(d.HUTANG_LAGI, 0) AS HUTANG_LAGI
        FROM ak_pelanggan a 
        LEFT JOIN (
            SELECT a.KONTAK, IFNULL(IFNULL(a.HUTANG_LALU, 0) - IFNULL(a.MUTASI_LALU,0), 0) AS SALDO_AWAL FROM (
                SELECT a.KONTAK, SUM(a.HUTANG_LALU) AS HUTANG_LALU, SUM(a.MUTASI_LALU) AS MUTASI_LALU FROM (
                    SELECT a.KONTAK, SUM(b.DEBET + b.KREDIT) AS HUTANG_LALU, 0 AS MUTASI_LALU
                    FROM ak_input_voucher a
                    JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
                    WHERE a.UNIT = '$unit' AND STR_TO_DATE(a.TGL, '%d-%c-%Y') < STR_TO_DATE('01-01-$tahun' , '%d-%c-%Y') AND (b.KODE_AKUN LIKE '%110%' OR b.KODE_AKUN LIKE '%112%')
                    GROUP BY a.KONTAK

                    UNION ALL 

                    SELECT KONTAK, 0 AS HUTANG_LALU, SUM(DEBET + KREDIT) AS MUTASI_LALU
                    FROM ak_jurnal_kas_bank
                    WHERE UNIT = '$unit' 
                    AND STR_TO_DATE(TGL_CEK, '%d-%c-%Y') < STR_TO_DATE('01-01-$tahun' , '%d-%c-%Y') 
                    AND (KODE_AKUN LIKE '%110%' OR KODE_AKUN LIKE '%112%')
                    AND TIPE  = 'PIUTANG'
                    GROUP BY KONTAK
                ) a
                GROUP BY a.KONTAK
            ) a
        ) b ON a.NAMA_PELANGGAN = b.KONTAK

        LEFT JOIN (
            SELECT KONTAK, SUM(DEBET + KREDIT) AS MUTASI FROM ak_jurnal_kas_bank
            WHERE UNIT = '$unit' 
            AND TGL_CEK LIKE '%-$tahun%'
            AND (KODE_AKUN LIKE '%110%' OR KODE_AKUN LIKE '%112%')
            AND TIPE  = 'PIUTANG'
            GROUP BY KONTAK
        ) c ON a.NAMA_PELANGGAN = c.KONTAK

        LEFT JOIN (
            SELECT a.KONTAK, SUM(b.DEBET + b.KREDIT) AS HUTANG_LAGI
            FROM ak_input_voucher a
            JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
            WHERE a.UNIT = '$unit'
            AND a.TGL LIKE '%-$tahun%'
            AND (b.KODE_AKUN LIKE '%110%' OR b.KODE_AKUN LIKE '%112%')
            GROUP BY a.KONTAK
        ) d ON a.NAMA_PELANGGAN = d.KONTAK
        WHERE a.UNIT = '$unit' AND a.APPROVE = 3
        ";

        return $this->db->query($sql)->result();
    }
}

?>