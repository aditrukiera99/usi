<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Beranda_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function penjualan_bulan_ini($id_klien){
        $bulan = date('m');
        $thn   = date('Y');

        $sql = "
        SELECT SUM(TOTAL) AS TOTAL FROM ak_penjualan WHERE ID_KLIEN = $id_klien AND TGL_TRX LIKE '%-$bulan-$thn%'
        ";

        return $this->db->query($sql)->row();
    }

    function penjualan_grafik_harian($id_klien, $tgl_1){

        $newDate = date("d M", strtotime($tgl_1));

        $sql = "
        SELECT '$newDate' AS TGL, IFNULL(a.TOTAL, 0) AS TOTAL FROM (
            SELECT SUM(TOTAL) AS TOTAL FROM ak_penjualan WHERE ID_KLIEN = $id_klien AND TGL_TRX = '$tgl_1'
        )a
        ";

        return $this->db->query($sql)->row();
    }

    function pembelian_bulan_ini($id_klien){
        $bulan = date('m');
        $thn   = date('Y');

        $sql = "
        SELECT SUM(TOTAL) AS TOTAL FROM ak_pembelian WHERE ID_KLIEN = $id_klien AND TGL_TRX LIKE '%-$bulan-$thn%'
        ";

        return $this->db->query($sql)->row();
    }

    function pembelian_grafik_harian($id_klien, $tgl_1){
        $newDate = date("d M", strtotime($tgl_1));

        $sql = "
        SELECT '$newDate' AS TGL, IFNULL(a.TOTAL, 0) AS TOTAL FROM (
            SELECT SUM(TOTAL) AS TOTAL FROM ak_pembelian WHERE ID_KLIEN = $id_klien AND TGL_TRX = '$tgl_1'
        )a
        ";

        return $this->db->query($sql)->row();
    }

    function cetak_laba_rugi_bulanan($id_klien){

        $bulan = date('m');
        $tahun   = date('Y');

        $sql = "
        SELECT (a.JML1 - a.JML2) AS JML FROM (
            SELECT SUM(a.JML1) AS JML1, SUM(a.JML2) AS JML2 FROM (
                SELECT SUM(a.JML) AS JML1, 0 AS JML2 FROM (
                    SELECT a.KODE_AKUN, SUM(a.JML) AS JML FROM (
                        SELECT a.KODE_AKUN, 
                               CASE 
                                WHEN a.TIPE = 'MINUS' THEN
                                (a.JML * -1) ELSE a.JML
                               END AS JML
                        FROM (
                            SELECT a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, a.URUT, a.WARNA, (a.DEBET + a.KREDIT) AS JML FROM (
                                SELECT a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, c.URUT, c.WARNA, IFNULL(SUM(b.DEBET), 0) AS DEBET, IFNULL(SUM(b.KREDIT), 0) AS KREDIT FROM ak_kode_akuntansi a 
                                LEFT JOIN (
                                    SELECT a.ID_KLIEN, a.KODE_AKUN, IFNULL(a.DEBET, 0) AS DEBET, IFNULL(a.KREDIT, 0) AS KREDIT FROM(
                                        SELECT VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN, SUM(DETAIL.DEBET) AS DEBET, SUM(DETAIL.KREDIT) AS KREDIT
                                        FROM ak_input_voucher VOUCHER
                                        JOIN ak_input_voucher_detail DETAIL ON VOUCHER.NO_VOUCHER = DETAIL.NO_VOUCHER_DETAIL AND VOUCHER.ID_KLIEN = DETAIL.ID_KLIEN
                                        WHERE VOUCHER.ID_KLIEN = $id_klien
                                        AND VOUCHER.TGL LIKE '%-$bulan-$tahun%'
                                        GROUP BY VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN

                                        UNION ALL 

                                        SELECT a.ID_KLIEN, b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT FROM ak_jurnal_penye a 
                                        JOIN ak_jurnal_penye_detail b ON a.NO_BUKTI = b.NO_BUKTI AND a.ID_KLIEN = b.ID_KLIEN
                                        WHERE a.ID_KLIEN = $id_klien AND a.TGL LIKE '%-$bulan-$tahun%'
                                        GROUP BY a.ID_KLIEN, b.KODE_AKUN
                                    ) a
                                ) b ON a.KODE_AKUN = b.KODE_AKUN
                                JOIN ak_setup_urut_labarugi c ON a.KATEGORI = c.KATEGORI
                                GROUP BY a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, c.URUT, c.WARNA
                            ) a 
                            WHERE a.ID_KLIEN = $id_klien AND (a.KATEGORI = 'Pendapatan' OR a.KATEGORI = 'Pendapatan Lainnya')
                        ) a
                    ) a
                    GROUP BY a.KODE_AKUN
                ) a

                UNION ALL 

                SELECT 0 AS JML1, SUM(a.JML) AS JML2 FROM (
                    SELECT a.KODE_AKUN, SUM(a.JML) AS JML FROM (
                        SELECT a.KODE_AKUN, 
                               CASE 
                                WHEN a.TIPE = 'MINUS' THEN
                                (a.JML * -1) ELSE a.JML
                               END AS JML
                        FROM (
                            SELECT a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, a.URUT, a.WARNA, (a.DEBET + a.KREDIT) AS JML FROM (
                                SELECT a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, c.URUT, c.WARNA, IFNULL(SUM(b.DEBET), 0) AS DEBET, IFNULL(SUM(b.KREDIT), 0) AS KREDIT FROM ak_kode_akuntansi a 
                                LEFT JOIN (
                                    SELECT a.ID_KLIEN, a.KODE_AKUN, IFNULL(a.DEBET, 0) AS DEBET, IFNULL(a.KREDIT, 0) AS KREDIT FROM(
                                        SELECT VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN, SUM(DETAIL.DEBET) AS DEBET, SUM(DETAIL.KREDIT) AS KREDIT
                                        FROM ak_input_voucher VOUCHER
                                        JOIN ak_input_voucher_detail DETAIL ON VOUCHER.NO_VOUCHER = DETAIL.NO_VOUCHER_DETAIL AND VOUCHER.ID_KLIEN = DETAIL.ID_KLIEN
                                        WHERE VOUCHER.ID_KLIEN = $id_klien
                                        AND VOUCHER.TGL LIKE '%-$bulan-$tahun%'
                                        GROUP BY VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN

                                        UNION ALL 

                                        SELECT a.ID_KLIEN, b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT FROM ak_jurnal_penye a 
                                        JOIN ak_jurnal_penye_detail b ON a.NO_BUKTI = b.NO_BUKTI AND a.ID_KLIEN = b.ID_KLIEN
                                        WHERE a.ID_KLIEN = $id_klien AND a.TGL LIKE '%-$bulan-$tahun%'
                                        GROUP BY a.ID_KLIEN, b.KODE_AKUN
                                    ) a
                                ) b ON a.KODE_AKUN = b.KODE_AKUN
                                JOIN ak_setup_urut_labarugi c ON a.KATEGORI = c.KATEGORI
                                GROUP BY a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, c.URUT, c.WARNA
                            ) a 
                            WHERE a.ID_KLIEN = $id_klien AND (a.KATEGORI = 'Harga Pokok Penjualan' OR a.KATEGORI = 'Beban' OR a.KATEGORI = 'Beban Lainnya')
                        ) a
                    ) a
                    GROUP BY a.KODE_AKUN
                ) a
            ) a
        ) a
        ";

        return $this->db->query($sql)->row();
    }

    function grafik_laba_rugi_harian($id_klien, $tgl_1){

        $newDate = date("d M", strtotime($tgl_1));

        $sql = "
        SELECT '$newDate' AS TGL, IFNULL(a.JML, 0) AS TOTAL FROM (
            SELECT (a.JML1 - a.JML2) AS JML FROM (
                SELECT SUM(a.JML1) AS JML1, SUM(a.JML2) AS JML2 FROM (
                    SELECT SUM(a.JML) AS JML1, 0 AS JML2 FROM (
                        SELECT a.KODE_AKUN, SUM(a.JML) AS JML FROM (
                            SELECT a.KODE_AKUN, 
                                   CASE 
                                    WHEN a.TIPE = 'MINUS' THEN
                                    (a.JML * -1) ELSE a.JML
                                   END AS JML
                            FROM (
                                SELECT a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, a.URUT, a.WARNA, (a.DEBET + a.KREDIT) AS JML FROM (
                                    SELECT a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, c.URUT, c.WARNA, IFNULL(SUM(b.DEBET), 0) AS DEBET, IFNULL(SUM(b.KREDIT), 0) AS KREDIT FROM ak_kode_akuntansi a 
                                    LEFT JOIN (
                                        SELECT a.ID_KLIEN, a.KODE_AKUN, IFNULL(a.DEBET, 0) AS DEBET, IFNULL(a.KREDIT, 0) AS KREDIT FROM(
                                            SELECT VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN, SUM(DETAIL.DEBET) AS DEBET, SUM(DETAIL.KREDIT) AS KREDIT
                                            FROM ak_input_voucher VOUCHER
                                            JOIN ak_input_voucher_detail DETAIL ON VOUCHER.NO_VOUCHER = DETAIL.NO_VOUCHER_DETAIL AND VOUCHER.ID_KLIEN = DETAIL.ID_KLIEN
                                            WHERE VOUCHER.ID_KLIEN = $id_klien
                                            AND VOUCHER.TGL = '$tgl_1'
                                            GROUP BY VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN

                                            UNION ALL 

                                            SELECT a.ID_KLIEN, b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT FROM ak_jurnal_penye a 
                                            JOIN ak_jurnal_penye_detail b ON a.NO_BUKTI = b.NO_BUKTI AND a.ID_KLIEN = b.ID_KLIEN
                                            WHERE a.ID_KLIEN = $id_klien AND a.TGL = '$tgl_1'
                                            GROUP BY a.ID_KLIEN, b.KODE_AKUN
                                        ) a
                                    ) b ON a.KODE_AKUN = b.KODE_AKUN
                                    JOIN ak_setup_urut_labarugi c ON a.KATEGORI = c.KATEGORI
                                    GROUP BY a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, c.URUT, c.WARNA
                                ) a 
                                WHERE a.ID_KLIEN = $id_klien AND (a.KATEGORI = 'Pendapatan' OR a.KATEGORI = 'Pendapatan Lainnya')
                            ) a
                        ) a
                        GROUP BY a.KODE_AKUN
                    ) a

                    UNION ALL 

                    SELECT 0 AS JML1, SUM(a.JML) AS JML2 FROM (
                        SELECT a.KODE_AKUN, SUM(a.JML) AS JML FROM (
                            SELECT a.KODE_AKUN, 
                                   CASE 
                                    WHEN a.TIPE = 'MINUS' THEN
                                    (a.JML * -1) ELSE a.JML
                                   END AS JML
                            FROM (
                                SELECT a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, a.URUT, a.WARNA, (a.DEBET + a.KREDIT) AS JML FROM (
                                    SELECT a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, c.URUT, c.WARNA, IFNULL(SUM(b.DEBET), 0) AS DEBET, IFNULL(SUM(b.KREDIT), 0) AS KREDIT FROM ak_kode_akuntansi a 
                                    LEFT JOIN (
                                        SELECT a.ID_KLIEN, a.KODE_AKUN, IFNULL(a.DEBET, 0) AS DEBET, IFNULL(a.KREDIT, 0) AS KREDIT FROM(
                                            SELECT VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN, SUM(DETAIL.DEBET) AS DEBET, SUM(DETAIL.KREDIT) AS KREDIT
                                            FROM ak_input_voucher VOUCHER
                                            JOIN ak_input_voucher_detail DETAIL ON VOUCHER.NO_VOUCHER = DETAIL.NO_VOUCHER_DETAIL AND VOUCHER.ID_KLIEN = DETAIL.ID_KLIEN
                                            WHERE VOUCHER.ID_KLIEN = $id_klien
                                            AND VOUCHER.TGL = '$tgl_1'
                                            GROUP BY VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN

                                            UNION ALL 

                                            SELECT a.ID_KLIEN, b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT FROM ak_jurnal_penye a 
                                            JOIN ak_jurnal_penye_detail b ON a.NO_BUKTI = b.NO_BUKTI AND a.ID_KLIEN = b.ID_KLIEN
                                            WHERE a.ID_KLIEN = $id_klien AND a.TGL = '$tgl_1'
                                            GROUP BY a.ID_KLIEN, b.KODE_AKUN
                                        ) a
                                    ) b ON a.KODE_AKUN = b.KODE_AKUN
                                    JOIN ak_setup_urut_labarugi c ON a.KATEGORI = c.KATEGORI
                                    GROUP BY a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, c.URUT, c.WARNA
                                ) a 
                                WHERE a.ID_KLIEN = $id_klien AND (a.KATEGORI = 'Harga Pokok Penjualan' OR a.KATEGORI = 'Beban' OR a.KATEGORI = 'Beban Lainnya')
                            ) a
                        ) a
                        GROUP BY a.KODE_AKUN
                    ) a
                ) a
            ) a
        ) a
        ";

        return $this->db->query($sql)->row();
    }

    function grafik_laba_rugi_bulanan($id_klien, $tgl_1){

        $tgl_ori = "01-".$tgl_1;
        
        $newDate = date("M y", strtotime($tgl_ori));

        $sql = "
        SELECT '$newDate' AS TGL, IFNULL(a.JML, 0) AS TOTAL FROM (
            SELECT (a.JML1 - a.JML2) AS JML FROM (
                SELECT SUM(a.JML1) AS JML1, SUM(a.JML2) AS JML2 FROM (
                    SELECT SUM(a.JML) AS JML1, 0 AS JML2 FROM (
                        SELECT a.KODE_AKUN, SUM(a.JML) AS JML FROM (
                            SELECT a.KODE_AKUN, 
                                   CASE 
                                    WHEN a.TIPE = 'MINUS' THEN
                                    (a.JML * -1) ELSE a.JML
                                   END AS JML
                            FROM (
                                SELECT a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, a.URUT, a.WARNA, (a.DEBET + a.KREDIT) AS JML FROM (
                                    SELECT a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, c.URUT, c.WARNA, IFNULL(SUM(b.DEBET), 0) AS DEBET, IFNULL(SUM(b.KREDIT), 0) AS KREDIT FROM ak_kode_akuntansi a 
                                    LEFT JOIN (
                                        SELECT a.ID_KLIEN, a.KODE_AKUN, IFNULL(a.DEBET, 0) AS DEBET, IFNULL(a.KREDIT, 0) AS KREDIT FROM(
                                            SELECT VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN, SUM(DETAIL.DEBET) AS DEBET, SUM(DETAIL.KREDIT) AS KREDIT
                                            FROM ak_input_voucher VOUCHER
                                            JOIN ak_input_voucher_detail DETAIL ON VOUCHER.NO_VOUCHER = DETAIL.NO_VOUCHER_DETAIL AND VOUCHER.ID_KLIEN = DETAIL.ID_KLIEN
                                            WHERE VOUCHER.ID_KLIEN = $id_klien
                                            AND VOUCHER.TGL LIKE '%-$tgl_1%'
                                            GROUP BY VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN

                                            UNION ALL 

                                            SELECT a.ID_KLIEN, b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT FROM ak_jurnal_penye a 
                                            JOIN ak_jurnal_penye_detail b ON a.NO_BUKTI = b.NO_BUKTI AND a.ID_KLIEN = b.ID_KLIEN
                                            WHERE a.ID_KLIEN = $id_klien AND a.TGL LIKE '%-$tgl_1%'
                                            GROUP BY a.ID_KLIEN, b.KODE_AKUN
                                        ) a
                                    ) b ON a.KODE_AKUN = b.KODE_AKUN
                                    JOIN ak_setup_urut_labarugi c ON a.KATEGORI = c.KATEGORI
                                    GROUP BY a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, c.URUT, c.WARNA
                                ) a 
                                WHERE a.ID_KLIEN = $id_klien AND (a.KATEGORI = 'Pendapatan' OR a.KATEGORI = 'Pendapatan Lainnya')
                            ) a
                        ) a
                        GROUP BY a.KODE_AKUN
                    ) a

                    UNION ALL 

                    SELECT 0 AS JML1, SUM(a.JML) AS JML2 FROM (
                        SELECT a.KODE_AKUN, SUM(a.JML) AS JML FROM (
                            SELECT a.KODE_AKUN, 
                                   CASE 
                                    WHEN a.TIPE = 'MINUS' THEN
                                    (a.JML * -1) ELSE a.JML
                                   END AS JML
                            FROM (
                                SELECT a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, a.URUT, a.WARNA, (a.DEBET + a.KREDIT) AS JML FROM (
                                    SELECT a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, c.URUT, c.WARNA, IFNULL(SUM(b.DEBET), 0) AS DEBET, IFNULL(SUM(b.KREDIT), 0) AS KREDIT FROM ak_kode_akuntansi a 
                                    LEFT JOIN (
                                        SELECT a.ID_KLIEN, a.KODE_AKUN, IFNULL(a.DEBET, 0) AS DEBET, IFNULL(a.KREDIT, 0) AS KREDIT FROM(
                                            SELECT VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN, SUM(DETAIL.DEBET) AS DEBET, SUM(DETAIL.KREDIT) AS KREDIT
                                            FROM ak_input_voucher VOUCHER
                                            JOIN ak_input_voucher_detail DETAIL ON VOUCHER.NO_VOUCHER = DETAIL.NO_VOUCHER_DETAIL AND VOUCHER.ID_KLIEN = DETAIL.ID_KLIEN
                                            WHERE VOUCHER.ID_KLIEN = $id_klien
                                            AND VOUCHER.TGL LIKE '%-$tgl_1%'
                                            GROUP BY VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN

                                            UNION ALL 

                                            SELECT a.ID_KLIEN, b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT FROM ak_jurnal_penye a 
                                            JOIN ak_jurnal_penye_detail b ON a.NO_BUKTI = b.NO_BUKTI AND a.ID_KLIEN = b.ID_KLIEN
                                            WHERE a.ID_KLIEN = $id_klien AND a.TGL LIKE '%-$tgl_1%'
                                            GROUP BY a.ID_KLIEN, b.KODE_AKUN
                                        ) a
                                    ) b ON a.KODE_AKUN = b.KODE_AKUN
                                    JOIN ak_setup_urut_labarugi c ON a.KATEGORI = c.KATEGORI
                                    GROUP BY a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, c.URUT, c.WARNA
                                ) a 
                                WHERE a.ID_KLIEN = $id_klien AND (a.KATEGORI = 'Harga Pokok Penjualan' OR a.KATEGORI = 'Beban' OR a.KATEGORI = 'Beban Lainnya')
                            ) a
                        ) a
                        GROUP BY a.KODE_AKUN
                    ) a
                ) a
            ) a
        ) a
        ";

        return $this->db->query($sql)->row();
    }

    function get_lap_buku_besar_bulanan($id_klien, $bulan, $tahun, $unit){
        $tgl_awal = "01-".$bulan."-".$tahun;
        $sql = "      
        SELECT a.*, b.NAMA_AKUN FROM (

            SELECT ID_KLIEN, 'SALDO AWAL' AS NO_BUKTI, '-' AS TGL, 'Saldo Awal' AS URAIAN, '' AS KONTAK, KODE_AKUN, SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT
            FROM ak_saldo_buku_besar_vw 
            WHERE STR_TO_DATE(TGL, '%d-%c-%Y') <= STR_TO_DATE('$tgl_awal' , '%d-%c-%Y') AND UNIT = '$unit'
            GROUP BY ID_KLIEN,  KODE_AKUN

            UNION ALL

            SELECT a.ID_KLIEN, a.NO_VOUCHER_DETAIL AS NO_BUKTI, b.TGL, b.URAIAN, b.KONTAK, a.KODE_AKUN, SUM(a.DEBET) AS DEBET, SUM(a.KREDIT) AS KREDIT
            FROM ak_input_voucher_detail a
            JOIN ak_input_voucher b ON a.NO_VOUCHER_DETAIL = b.NO_VOUCHER AND a.ID_KLIEN = b.ID_KLIEN
            WHERE b.TGL LIKE '%-$bulan-$tahun%'  AND b.NO_JP IS NULL AND b.UNIT = '$unit'
            GROUP BY a.NO_VOUCHER_DETAIL, b.TGL, a.KODE_AKUN, b.URAIAN, b.KONTAK, a.ID_KLIEN

            UNION ALL 

            SELECT ID_KLIEN, NO_VOUCHER AS NO_BUKTI, TGL_CEK AS TGL, URAIAN, KONTAK, KODE_AKUN, SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT
            FROM ak_jurnal_kas_bank
            WHERE TGL_CEK LIKE '%-$bulan-$tahun%' AND UNIT = '$unit'
            GROUP BY NO_VOUCHER, TGL_CEK, KODE_AKUN, URAIAN, KONTAK, ID_KLIEN
            
            UNION ALL 

            SELECT ID_KLIEN, NO_BUKTI, TGL, DESKRIPSI AS URAIAN, '' AS KONTAK, KODE_AKUN, SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT
            FROM ak_penerimaan_kas_bank
            WHERE TGL LIKE '%-$bulan-$tahun%' AND UNIT = '$unit' 
            GROUP BY NO_BUKTI, TGL, KODE_AKUN, DESKRIPSI, ID_KLIEN

            UNION ALL

            SELECT a.ID_KLIEN, a.NO_BUKTI AS NO_BUKTI, b.TGL, b.URAIAN, '' AS KONTAK, a.KODE_AKUN, SUM(a.DEBET) AS DEBET, SUM(a.KREDIT) AS KREDIT
            FROM ak_jurnal_penye_detail a
            JOIN ak_jurnal_penye b ON a.NO_BUKTI = b.NO_BUKTI AND a.ID_KLIEN = b.ID_KLIEN
            WHERE b.TGL LIKE '%-$bulan-$tahun%' AND b.UNIT = '$unit'
            GROUP BY a.NO_BUKTI, b.TGL, a.KODE_AKUN, b.URAIAN, a.ID_KLIEN

        ) a JOIN ak_kode_akuntansi b ON a.KODE_AKUN = b.KODE_AKUN 
        
        WHERE a.ID_KLIEN = $id_klien
        ORDER BY a.KODE_AKUN ASC, a.TGL,  a.DEBET DESC
        ";

        return $this->db->query($sql)->result();
    }

    function cetak_laba_rugi_bulanan_laporan($id_klien, $bulan, $tahun, $unit){
        $sql = "
        SELECT a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, a.URUT, a.WARNA, (a.DEBET + a.KREDIT) AS JML FROM (
            SELECT a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, c.URUT, c.WARNA, IFNULL(SUM(b.DEBET), 0) AS DEBET, IFNULL(SUM(b.KREDIT), 0) AS KREDIT FROM ak_kode_akuntansi a 
            LEFT JOIN (
                SELECT a.ID_KLIEN, a.KODE_AKUN, IFNULL(a.DEBET, 0) AS DEBET, IFNULL(a.KREDIT, 0) AS KREDIT FROM(
                    SELECT VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN, SUM(DETAIL.DEBET) AS DEBET, SUM(DETAIL.KREDIT) AS KREDIT
                    FROM ak_input_voucher VOUCHER
                    JOIN ak_input_voucher_detail DETAIL ON VOUCHER.NO_VOUCHER = DETAIL.NO_VOUCHER_DETAIL AND VOUCHER.ID_KLIEN = DETAIL.ID_KLIEN
                    WHERE VOUCHER.ID_KLIEN = $id_klien
                    AND VOUCHER.TGL LIKE '%-$bulan-$tahun%'
                    AND VOUCHER.UNIT = '$unit'
                    GROUP BY VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN

                    UNION ALL 

                    SELECT a.ID_KLIEN, b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT FROM ak_jurnal_penye a 
                    JOIN ak_jurnal_penye_detail b ON a.NO_BUKTI = b.NO_BUKTI AND a.ID_KLIEN = b.ID_KLIEN
                    WHERE a.ID_KLIEN = $id_klien AND a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'
                    GROUP BY a.ID_KLIEN, b.KODE_AKUN
                ) a
            ) b ON a.KODE_AKUN = b.KODE_AKUN
            JOIN ak_setup_urut_labarugi c ON a.KATEGORI = c.KATEGORI
            GROUP BY a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, c.URUT, c.WARNA
        ) a 
        WHERE a.ID_KLIEN = $id_klien
        ORDER BY a.URUT, a.KODE_AKUN
        ";

        return $this->db->query($sql)->result();
    }

    function get_detail_laba_rugi_bulanan($kode_akun, $bulan, $tahun, $unit){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_klien = $sess_user['id_klien'];

        $sql = "
        SELECT a.KODE_AKUN, b.NAMA_PRODUK, SUM(b.QTY) AS QTY, b.HARGA_SATUAN, b.SATUAN FROM ak_input_voucher_detail a 
        JOIN (
          SELECT a.NO_BUKTI, a.TGL_TRX, b.NAMA_PRODUK, b.QTY, b.HARGA_SATUAN, b.SATUAN FROM ak_penjualan a
          JOIN ak_penjualan_detail b ON a.ID = b.ID_PENJUALAN AND a.ID_KLIEN = b.ID_KLIEN
          WHERE a.ID_KLIEN = $id_klien AND a.TGL_TRX LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'
            
          UNION ALL
            
          SELECT a.NO_BUKTI, a.TGL_TRX, b.NAMA_PRODUK, b.QTY, b.HARGA_SATUAN, b.SATUAN FROM ak_pembelian a
          JOIN ak_pembelian_detail b ON a.ID = b.ID_PENJUALAN AND a.ID_KLIEN = b.ID_KLIEN
          WHERE a.ID_KLIEN = $id_klien AND a.TGL_TRX LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'

        )b ON a.NO_BUKTI = b.NO_BUKTI

        JOIN ak_input_voucher c ON a.NO_VOUCHER_DETAIL = c.NO_VOUCHER AND a.ID_KLIEN = c.ID_KLIEN
        WHERE a.KODE_AKUN = '$kode_akun' AND c.UNIT = '$unit'
        GROUP BY a.KODE_AKUN, b.NAMA_PRODUK, b.HARGA_SATUAN, b.SATUAN
        ";

        return $this->db->query($sql)->result();
    }

    function get_lap_jurnal_umum_bulanan($id_klien, $bulan, $tahun, $unit){
        $sql = "      
        SELECT a.NO_VOUCHER, a.URAIAN, a.TGL, a.NO_JP, b.KODE_AKUN, b.DEBET, b.KREDIT, c.NAMA_AKUN FROM ak_input_voucher a 
        JOIN ak_input_voucher_detail b ON a.ID_KLIEN = b.ID_KLIEN AND a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
        JOIN ak_kode_akuntansi c ON b.KODE_AKUN = c.KODE_AKUN AND c.ID_KLIEN = a.ID_KLIEN
        WHERE a.ID_KLIEN = $id_klien AND a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'
        ORDER BY a.NO_VOUCHER ASC, b.DEBET DESC
        ";

        return $this->db->query($sql)->result();
    }

    function get_sa_bulanan_lalu($id_klien, $bulan, $tahun, $unit){
        $sql = "
        SELECT IFNULL(a.TOTAL_SA, 0) AS TOTAL_SA FROM (
            SELECT ((a.SALDO_AWAL_1 - a.SALDO_AWAL_2) + a.SALDO_AWAL_3) AS TOTAL_SA FROM (
                SELECT IFNULL(SUM(a.JML_1), 0) AS SALDO_AWAL_1, IFNULL(SUM(a.JML_2), 0) AS SALDO_AWAL_2, IFNULL(SUM(a.JML_3), 0) AS SALDO_AWAL_3 FROM (
                    SELECT a.ID_KLIEN, a.KODE_AKUN, a.NAMA_AKUN, a.TIPE, SUM(a.JML_1) AS JML_1, SUM(a.JML_2) AS JML_2, SUM(a.JML_3) AS JML_3 FROM (
                        SELECT a.ID_KLIEN, b.KODE_AKUN, c.NAMA_AKUN, c.TIPE, 
                        CASE
                            WHEN c.TIPE = 'MINUS' THEN
                            ((b.DEBET + b.KREDIT) * -1) ELSE (b.DEBET + b.KREDIT) 
                        END AS JML_1, 0 AS JML_2, 0 AS JML_3
                        FROM ak_input_voucher a 
                        JOIN (
                            SELECT ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN, SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT FROM ak_input_voucher_detail
                            GROUP BY ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN
                        ) b ON a.ID_KLIEN = b.ID_KLIEN AND a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
                        JOIN ak_kode_akuntansi c ON a.ID_KLIEN = c.ID_KLIEN AND b.KODE_AKUN = c.KODE_AKUN
                        WHERE (c.KATEGORI = 'Pendapatan' OR c.KATEGORI = 'Pendapatan Lainnya') AND a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'

                        UNION ALL 

                        SELECT a.ID_KLIEN, b.KODE_AKUN, c.NAMA_AKUN, c.TIPE, 0 AS JML_1,
                        CASE
                            WHEN c.TIPE = 'MINUS' THEN
                            ((b.DEBET + b.KREDIT) * -1) ELSE (b.DEBET + b.KREDIT) 
                        END AS JML_2, 0 AS JML_3
                        FROM ak_input_voucher a 
                        JOIN (
                            SELECT ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN, SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT FROM ak_input_voucher_detail
                            GROUP BY ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN
                        ) b ON a.ID_KLIEN = b.ID_KLIEN AND a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
                        JOIN ak_kode_akuntansi c ON a.ID_KLIEN = c.ID_KLIEN AND b.KODE_AKUN = c.KODE_AKUN
                        WHERE (c.KATEGORI = 'Beban' OR c.KATEGORI = 'Beban Lainnya' OR c.KATEGORI = 'Harga Pokok Penjualan') AND a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'

                        UNION ALL 

                        SELECT a.ID_KLIEN, b.KODE_AKUN, c.NAMA_AKUN, c.TIPE, 0 AS JML_1, 0 AS JML_2,
                        CASE
                            WHEN c.TIPE = 'MINUS' THEN
                            ((b.DEBET + b.KREDIT) * -1) ELSE (b.DEBET + b.KREDIT) 
                        END AS JML_3
                        FROM ak_input_voucher a 
                        JOIN (
                            SELECT ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN, SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT FROM ak_input_voucher_detail
                            GROUP BY ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN
                        ) b ON a.ID_KLIEN = b.ID_KLIEN AND a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
                        JOIN ak_kode_akuntansi c ON a.ID_KLIEN = c.ID_KLIEN AND b.KODE_AKUN = c.KODE_AKUN
                        WHERE (c.KATEGORI != 'Beban' AND c.KATEGORI != 'Beban Lainnya' AND c.KATEGORI != 'Harga Pokok Penjualan'
                        AND c.KATEGORI != 'Pendapatan' AND c.KATEGORI != 'Pendapatan Lainnya' AND c.KATEGORI != 'Kas & Bank') AND a.TGL LIKE '%-$bulan-$tahun%'
                        AND a.UNIT = '$unit'
                        

                        UNION ALL 

                        SELECT a.ID_KLIEN, a.KODE_AKUN, b.NAMA_AKUN, b.TIPE, 0 AS JML_1, 0 AS JML_2, (a.DEBET + a.KREDIT) AS JML_3 FROM ak_penerimaan_kas_bank a 
                        JOIN ak_kode_akuntansi b ON a.ID_KLIEN = b.ID_KLIEN AND a.KODE_AKUN = b.KODE_AKUN
                        WHERE a.TIPE = 'EK' AND a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'
                        ) a
                        WHERE a.ID_KLIEN = $id_klien
                        GROUP BY a.ID_KLIEN, a.KODE_AKUN, a.NAMA_AKUN, a.TIPE
                ) a
            ) a
        ) a

        ";

        return $this->db->query($sql)->row();
    }

    function get_sa_bulanan_skrg($id_klien, $bulan, $tahun, $unit){
        $sql = "
        SELECT IFNULL(a.TOTAL_SA, 0) AS TOTAL_SA FROM (
            SELECT ((a.SALDO_AWAL_1 - a.SALDO_AWAL_2) + a.SALDO_AWAL_3) AS TOTAL_SA FROM (
                SELECT IFNULL(SUM(a.JML_1), 0) AS SALDO_AWAL_1, IFNULL(SUM(a.JML_2), 0) AS SALDO_AWAL_2, IFNULL(SUM(a.JML_3), 0) AS SALDO_AWAL_3 FROM (
                    SELECT a.ID_KLIEN, a.KODE_AKUN, a.NAMA_AKUN, a.TIPE, SUM(a.JML_1) AS JML_1, SUM(a.JML_2) AS JML_2, SUM(a.JML_3) AS JML_3 FROM (
                        SELECT a.ID_KLIEN, b.KODE_AKUN, c.NAMA_AKUN, c.TIPE, 
                        CASE
                            WHEN c.TIPE = 'MINUS' THEN
                            ((b.DEBET + b.KREDIT) * -1) ELSE (b.DEBET + b.KREDIT) 
                        END AS JML_1, 0 AS JML_2, 0 AS JML_3
                        FROM ak_input_voucher a 
                        JOIN (
                            SELECT ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN, SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT FROM ak_input_voucher_detail
                            GROUP BY ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN
                        ) b ON a.ID_KLIEN = b.ID_KLIEN AND a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
                        JOIN ak_kode_akuntansi c ON a.ID_KLIEN = c.ID_KLIEN AND b.KODE_AKUN = c.KODE_AKUN
                        WHERE (c.KATEGORI = 'Pendapatan' OR c.KATEGORI = 'Pendapatan Lainnya') AND a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'

                        UNION ALL 

                        SELECT a.ID_KLIEN, b.KODE_AKUN, c.NAMA_AKUN, c.TIPE, 0 AS JML_1,
                        CASE
                            WHEN c.TIPE = 'MINUS' THEN
                            ((b.DEBET + b.KREDIT) * -1) ELSE (b.DEBET + b.KREDIT) 
                        END AS JML_2, 0 AS JML_3
                        FROM ak_input_voucher a 
                        JOIN (
                            SELECT ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN, SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT FROM ak_input_voucher_detail
                            GROUP BY ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN
                        ) b ON a.ID_KLIEN = b.ID_KLIEN AND a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
                        JOIN ak_kode_akuntansi c ON a.ID_KLIEN = c.ID_KLIEN AND b.KODE_AKUN = c.KODE_AKUN
                        WHERE (c.KATEGORI = 'Beban' OR c.KATEGORI = 'Beban Lainnya' OR c.KATEGORI = 'Harga Pokok Penjualan') AND a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'

                        UNION ALL 

                        SELECT a.ID_KLIEN, b.KODE_AKUN, c.NAMA_AKUN, c.TIPE, 0 AS JML_1, 0 AS JML_2,
                        CASE
                            WHEN c.TIPE = 'MINUS' THEN
                            ((b.DEBET + b.KREDIT) * -1) ELSE (b.DEBET + b.KREDIT) 
                        END AS JML_3
                        FROM ak_input_voucher a 
                        JOIN (
                            SELECT ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN, SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT FROM ak_input_voucher_detail
                            GROUP BY ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN
                        ) b ON a.ID_KLIEN = b.ID_KLIEN AND a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
                        JOIN ak_kode_akuntansi c ON a.ID_KLIEN = c.ID_KLIEN AND b.KODE_AKUN = c.KODE_AKUN
                        WHERE (c.KATEGORI != 'Beban' AND c.KATEGORI != 'Beban Lainnya' AND c.KATEGORI != 'Harga Pokok Penjualan'
                        AND c.KATEGORI != 'Pendapatan' AND c.KATEGORI != 'Pendapatan Lainnya' AND c.KATEGORI != 'Kas & Bank') AND a.TGL LIKE '%-$bulan-$tahun%'
                        AND a.UNIT = '$unit'

                        UNION ALL 

                        SELECT a.ID_KLIEN, a.KODE_AKUN, b.NAMA_AKUN, b.TIPE, 0 AS JML_1, 0 AS JML_2, (a.DEBET + a.KREDIT) AS JML_3 FROM ak_penerimaan_kas_bank a 
                        JOIN ak_kode_akuntansi b ON a.ID_KLIEN = b.ID_KLIEN AND a.KODE_AKUN = b.KODE_AKUN
                        WHERE a.TIPE = 'EK' AND a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'
                        ) a
                        WHERE a.ID_KLIEN = $id_klien
                        GROUP BY a.ID_KLIEN, a.KODE_AKUN, a.NAMA_AKUN, a.TIPE
                ) a
            ) a
        ) a

        ";

        return $this->db->query($sql)->row();
    }

    function cek_saldo_awal_bulan_lalu($id_klien, $bulan, $tahun, $unit){
        $sql = "
        SELECT * FROM ak_saldo_awal_arus_kas WHERE ID_KLIEN = $id_klien AND BULAN = $bulan AND TAHUN = $tahun AND TIPE = 'BULANAN' AND UNIT = '$unit'
        ";

        return $this->db->query($sql)->result();
    }

    function simpan_saldo_awal_arus_kas($id_klien, $bulan, $tahun, $nilai, $tipe, $unit){
        $sql = "
        INSERT INTO ak_saldo_awal_arus_kas 
        (ID_KLIEN, BULAN, TAHUN, NILAI, TIPE, UNIT)
        VALUES 
        ($id_klien, $bulan, $tahun, $nilai, '$tipe', '$unit')
        ";

        $this->db->query($sql);
    }

    function get_saldo_awal_sebelumnya($id_klien, $bulan, $tahun, $tipe, $unit){
        $sql = "
        SELECT * FROM ak_saldo_awal_arus_kas WHERE ID_KLIEN = $id_klien AND BULAN = $bulan AND TAHUN = $tahun AND TIPE = '$tipe' AND UNIT = '$unit'
        ";

        return $this->db->query($sql)->row();
    }

    function update_saldo_skrg($id_klien, $bulan, $tahun, $nilai_saldo_skrg, $tipe, $unit){
        $sql_del = "
            DELETE FROM ak_saldo_awal_arus_kas WHERE ID_KLIEN = $id_klien AND BULAN = $bulan AND TAHUN = $tahun AND TIPE = '$tipe' AND UNIT = '$unit'
        ";
        $this->db->query($sql_del);

        $sql = "
        INSERT INTO ak_saldo_awal_arus_kas 
        (ID_KLIEN, BULAN, TAHUN, NILAI, TIPE, UNIT)
        VALUES 
        ($id_klien, $bulan, $tahun, $nilai_saldo_skrg, '$tipe', '$unit')
        ";

        $this->db->query($sql);
    }

    function cetak_arus_kas_bulanan($id_klien, $bulan, $tahun, $unit){
        $sql = "
        SELECT a.ID_KLIEN, a.KODE_AKUN, a.NAMA_AKUN, a.TIPE, SUM(a.JML) AS JML, a.JENIS, a.URUT FROM (
            SELECT a.ID_KLIEN, b.KODE_AKUN, c.NAMA_AKUN, c.TIPE, (b.DEBET + b.KREDIT) AS JML, 'Pendapatan Operasional' AS JENIS, 1 AS URUT FROM ak_input_voucher a 
            JOIN (
                SELECT ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN, SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT FROM ak_input_voucher_detail
                GROUP BY ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN
            ) b ON a.ID_KLIEN = b.ID_KLIEN AND a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
            JOIN ak_kode_akuntansi c ON a.ID_KLIEN = c.ID_KLIEN AND b.KODE_AKUN = c.KODE_AKUN
            WHERE (c.KATEGORI = 'Pendapatan' OR c.KATEGORI = 'Pendapatan Lainnya') AND a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'

            UNION ALL 

            SELECT a.ID_KLIEN, b.KODE_AKUN, c.NAMA_AKUN, c.TIPE, (b.DEBET + b.KREDIT) AS JML, 'Biaya Operasional' AS JENIS, 2 AS URUT FROM ak_input_voucher a 
            JOIN (
                SELECT ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN, SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT FROM ak_input_voucher_detail
                GROUP BY ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN
            ) b ON a.ID_KLIEN = b.ID_KLIEN AND a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
            JOIN ak_kode_akuntansi c ON a.ID_KLIEN = c.ID_KLIEN AND b.KODE_AKUN = c.KODE_AKUN
            WHERE (c.KATEGORI = 'Beban' OR c.KATEGORI = 'Beban Lainnya' OR c.KATEGORI = 'Harga Pokok Penjualan') AND a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'

            UNION ALL 

            SELECT a.ID_KLIEN, b.KODE_AKUN, c.NAMA_AKUN, c.TIPE, (b.DEBET + b.KREDIT) AS JML, 'Aktivitas Non Operasional' AS JENIS, 3 AS URUT FROM ak_input_voucher a 
            JOIN (
                SELECT ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN, SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT FROM ak_input_voucher_detail
                GROUP BY ID_KLIEN, NO_VOUCHER_DETAIL, KODE_AKUN
            ) b ON a.ID_KLIEN = b.ID_KLIEN AND a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
            JOIN ak_kode_akuntansi c ON a.ID_KLIEN = c.ID_KLIEN AND b.KODE_AKUN = c.KODE_AKUN
            WHERE (c.KATEGORI != 'Beban' AND c.KATEGORI != 'Beban Lainnya' AND c.KATEGORI != 'Harga Pokok Penjualan'
            AND c.KATEGORI != 'Pendapatan' AND c.KATEGORI != 'Pendapatan Lainnya' AND c.KATEGORI != 'Kas & Bank')
            AND a.TGL LIKE '%-$bulan-$tahun%'
            AND a.UNIT = '$unit'

            UNION ALL 

            SELECT a.ID_KLIEN, a.KODE_AKUN, b.NAMA_AKUN, b.TIPE, (a.DEBET + a.KREDIT) AS JML, 'Aktivitas Non Operasional' AS JENIS, 3 AS URUT FROM ak_penerimaan_kas_bank a 
            JOIN ak_kode_akuntansi b ON a.ID_KLIEN = b.ID_KLIEN AND a.KODE_AKUN = b.KODE_AKUN
            WHERE a.TIPE = 'EK' AND a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'
            ) a
            WHERE a.ID_KLIEN = $id_klien
            GROUP BY a.ID_KLIEN, a.KODE_AKUN, a.NAMA_AKUN, a.TIPE, a.JENIS, a.URUT
        ORDER BY a.URUT

        ";

        return $this->db->query($sql)->result();
    }
    function cetak_kas_bank_bulanan($id_klien, $bulan, $tahun, $unit){
        $sql = "
        SELECT a.*, b.TGL AS TGL_VOUCHER, b.DEBET AS DEBET_VOUCHER FROM (
            SELECT a.ID_KLIEN, a.NO_VOUCHER, a.CEK_GIRO, MAX(a.KODE_AKUN) AS KODE_AKUN, a.TGL_CEK, a.URAIAN, MAX(a.DEBET) AS DEBET, MAX(a.KREDIT) AS KREDIT, MAX(a.SISA_HUTANG) AS SISA_HUTANG FROM (
                SELECT ID_KLIEN, NO_VOUCHER, CEK_GIRO, '' AS KODE_AKUN, TGL_CEK, URAIAN, 0 AS DEBET, KREDIT, 0 AS SISA_HUTANG
                FROM ak_jurnal_kas_bank a 
                WHERE ID_KLIEN = $id_klien AND KREDIT > 0 AND UNIT = '$unit'

                UNION ALL 

                SELECT ID_KLIEN, NO_VOUCHER, CEK_GIRO, KODE_AKUN, TGL_CEK, URAIAN, DEBET, 0 AS KREDIT, SISA_HUTANG
                FROM ak_jurnal_kas_bank a 
                WHERE ID_KLIEN = $id_klien AND DEBET > 0 AND UNIT = '$unit'
            ) a
            GROUP BY a.ID_KLIEN, a.NO_VOUCHER, a.CEK_GIRO, a.TGL_CEK, a.URAIAN
        ) a JOIN ak_input_voucher b ON a.ID_KLIEN = b.ID_KLIEN AND a.NO_VOUCHER = b.NO_VOUCHER
        WHERE a.TGL_CEK LIKE '%-$bulan-$tahun%' AND b.UNIT = '$unit'
        ORDER BY a.TGL_CEK, b.TGL
        ";

        return $this->db->query($sql)->result();
    }

    function get_lap_jurnal_penyesuaian_bulanan($id_klien, $bulan, $tahun, $unit){
        $sql = "      
        SELECT a.NO_VOUCHER, a.NO_BUKTI, a.URAIAN, a.TGL, b.KODE_AKUN, b.DEBET, b.KREDIT, c.NAMA_AKUN FROM ak_jurnal_penye a 
        JOIN ak_jurnal_penye_detail b ON a.ID_KLIEN = b.ID_KLIEN AND a.NO_BUKTI = b.NO_BUKTI
        JOIN ak_kode_akuntansi c ON b.KODE_AKUN = c.KODE_AKUN AND c.ID_KLIEN = a.ID_KLIEN
        WHERE a.ID_KLIEN = $id_klien AND a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'
        ORDER BY a.NO_BUKTI
        ";

        return $this->db->query($sql)->result();
    }

    function get_lap_neraca_bulanan($id_klien, $bulan, $tahun, $jenis, $unit){

        $tgl_awal = "01-".$bulan."-".$tahun;

        $bulan_lalu = $bulan - 1;
        $tahun_lalu = $tahun;

        if($bulan_lalu == 0){
            $bulan_lalu = 12;
            $tahun_lalu = $tahun_lalu - 1;
        }

        $bulan_lalu = str_pad($bulan_lalu, 2, '0', STR_PAD_LEFT);

        if($jenis == "AKTIVA"){
            $n = "-";
        } else {
            $n = "-";
        }

        $tgl_awal_lalu = "01-".$bulan_lalu."-".$tahun_lalu;

        $sql = "
        SELECT a.* FROM (
        SELECT SETUP.URUT, KOPER.KODE_AKUN, KOPER.NAMA_AKUN, SETUP.KELOMPOK, SETUP.JUDUL, SETUP.NAMA_KATEGORI, SUM(IFNULL(NERACA.SALDO, 0)) AS SALDO, SUM(IFNULL(NERACA_LALU.SALDO, 0)) AS SALDO_LALU FROM ak_kode_akuntansi KOPER
        JOIN ak_setup_neraca SETUP ON KOPER.KATEGORI = SETUP.NAMA_KATEGORI
        LEFT JOIN (
            SELECT a.KODE_AKUN, SUM(a.SALDO) AS SALDO FROM (

                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_jurnal_umum_vw
                WHERE ID_KLIEN = $id_klien AND TGL LIKE '%-$bulan-$tahun%' AND UNIT = '$unit'
                GROUP BY KODE_AKUN

                UNION ALL 

                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_jurnal_penyesuaian_vw
                WHERE ID_KLIEN = $id_klien AND TGL LIKE '%-$bulan-$tahun%' AND UNIT = '$unit'
                GROUP BY KODE_AKUN

                UNION ALL 

                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_jurnal_kas_bank
                WHERE ID_KLIEN = $id_klien AND TGL_CEK LIKE '%-$bulan-$tahun%' AND UNIT = '$unit'
                GROUP BY KODE_AKUN

                UNION ALL 

                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_penerimaan_kas_bank
                WHERE ID_KLIEN = $id_klien AND TGL LIKE '%-$bulan-$tahun%' AND UNIT = '$unit' 
                GROUP BY KODE_AKUN

            ) a
        GROUP BY a.KODE_AKUN
        ) NERACA ON KOPER.KODE_AKUN = NERACA.KODE_AKUN

        LEFT JOIN (
            SELECT a.KODE_AKUN, SUM(a.SALDO) AS SALDO FROM (


                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_jurnal_umum_vw
                WHERE ID_KLIEN = $id_klien AND TGL LIKE '%-$bulan_lalu-$tahun_lalu%' AND UNIT = '$unit'
                GROUP BY KODE_AKUN

                UNION ALL 

                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_jurnal_penyesuaian_vw
                WHERE ID_KLIEN = $id_klien AND TGL LIKE '%-$bulan_lalu-$tahun_lalu%' AND UNIT = '$unit'
                GROUP BY KODE_AKUN

                UNION ALL 

                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_jurnal_kas_bank
                WHERE ID_KLIEN = $id_klien AND TGL_CEK LIKE '%-$bulan_lalu-$tahun_lalu%' AND UNIT = '$unit'
                GROUP BY KODE_AKUN

                UNION ALL 

                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_penerimaan_kas_bank
                WHERE ID_KLIEN = $id_klien AND TGL LIKE '%-$bulan_lalu-$tahun_lalu%' AND UNIT = '$unit'   
                GROUP BY KODE_AKUN

            ) a
        GROUP BY a.KODE_AKUN
        ) NERACA_LALU ON KOPER.KODE_AKUN = NERACA_LALU.KODE_AKUN

        WHERE KOPER.ID_KLIEN = $id_klien
        GROUP BY SETUP.URUT, KOPER.KODE_AKUN, KOPER.NAMA_AKUN, SETUP.KELOMPOK, SETUP.JUDUL, SETUP.NAMA_KATEGORI
        ) a
        WHERE a.KELOMPOK = '$jenis'
        ORDER BY a.URUT, a.KODE_AKUN
        ";

        return $this->db->query($sql)->result();
    }

    function cetak_laba_rugi_bulanan_neraca($id_klien, $bulan, $tahun, $jenis, $unit){

        if($jenis == "LALU"){
            $bulan = $bulan - 1;
            $tahun = $tahun;

            if($bulan == 0){
                $bulan = 12;
                $tahun = $tahun - 1;
            }
        }

        $bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);

        $sql = "
        SELECT (a.JML1 - a.JML2) AS JML FROM (
            SELECT SUM(a.JML1) AS JML1, SUM(a.JML2) AS JML2 FROM (
                SELECT SUM(a.JML) AS JML1, 0 AS JML2 FROM (
                    SELECT a.KODE_AKUN, SUM(a.JML) AS JML FROM (
                        SELECT a.KODE_AKUN, 
                               CASE 
                                WHEN a.TIPE = 'MINUS' THEN
                                (a.JML * -1) ELSE a.JML
                               END AS JML
                        FROM (
                            SELECT a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, a.URUT, a.WARNA, (a.DEBET + a.KREDIT) AS JML FROM (
                                SELECT a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, c.URUT, c.WARNA, IFNULL(SUM(b.DEBET), 0) AS DEBET, IFNULL(SUM(b.KREDIT), 0) AS KREDIT FROM ak_kode_akuntansi a 
                                LEFT JOIN (
                                    SELECT a.ID_KLIEN, a.KODE_AKUN, IFNULL(a.DEBET, 0) AS DEBET, IFNULL(a.KREDIT, 0) AS KREDIT FROM(
                                        SELECT VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN, SUM(DETAIL.DEBET) AS DEBET, SUM(DETAIL.KREDIT) AS KREDIT
                                        FROM ak_input_voucher VOUCHER
                                        JOIN ak_input_voucher_detail DETAIL ON VOUCHER.NO_VOUCHER = DETAIL.NO_VOUCHER_DETAIL AND VOUCHER.ID_KLIEN = DETAIL.ID_KLIEN
                                        WHERE VOUCHER.ID_KLIEN = $id_klien
                                        AND VOUCHER.TGL LIKE '%-$bulan-$tahun%' AND VOUCHER.NO_JP IS NULL
                                        AND VOUCHER.UNIT = '$unit'
                                        GROUP BY VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN

                                        UNION ALL 

                                        SELECT a.ID_KLIEN, b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT FROM ak_jurnal_penye a 
                                        JOIN ak_jurnal_penye_detail b ON a.NO_BUKTI = b.NO_BUKTI AND a.ID_KLIEN = b.ID_KLIEN
                                        WHERE a.ID_KLIEN = $id_klien AND a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'
                                        GROUP BY a.ID_KLIEN, b.KODE_AKUN
                                    ) a
                                ) b ON a.KODE_AKUN = b.KODE_AKUN
                                JOIN ak_setup_urut_labarugi c ON a.KATEGORI = c.KATEGORI
                                GROUP BY a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, c.URUT, c.WARNA
                            ) a 
                            WHERE a.ID_KLIEN = $id_klien AND (a.KATEGORI = 'Pendapatan' OR a.KATEGORI = 'Pendapatan Lainnya')
                        ) a
                    ) a
                    GROUP BY a.KODE_AKUN
                ) a

                UNION ALL 

                SELECT 0 AS JML1, SUM(a.JML) AS JML2 FROM (
                    SELECT a.KODE_AKUN, SUM(a.JML) AS JML FROM (
                        SELECT a.KODE_AKUN, 
                               CASE 
                                WHEN a.TIPE = 'MINUS' THEN
                                (a.JML * -1) ELSE a.JML
                               END AS JML
                        FROM (
                            SELECT a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, a.URUT, a.WARNA, (a.DEBET + a.KREDIT) AS JML FROM (
                                SELECT a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, c.URUT, c.WARNA, IFNULL(SUM(b.DEBET), 0) AS DEBET, IFNULL(SUM(b.KREDIT), 0) AS KREDIT FROM ak_kode_akuntansi a 
                                LEFT JOIN (
                                    SELECT a.ID_KLIEN, a.KODE_AKUN, IFNULL(a.DEBET, 0) AS DEBET, IFNULL(a.KREDIT, 0) AS KREDIT FROM(
                                        SELECT VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN, SUM(DETAIL.DEBET) AS DEBET, SUM(DETAIL.KREDIT) AS KREDIT
                                        FROM ak_input_voucher VOUCHER
                                        JOIN ak_input_voucher_detail DETAIL ON VOUCHER.NO_VOUCHER = DETAIL.NO_VOUCHER_DETAIL AND VOUCHER.ID_KLIEN = DETAIL.ID_KLIEN
                                        WHERE VOUCHER.ID_KLIEN = $id_klien
                                        AND VOUCHER.TGL LIKE '%-$bulan-$tahun%' AND VOUCHER.NO_JP IS NULL
                                        AND VOUCHER.UNIT = '$unit'
                                        GROUP BY VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN

                                        UNION ALL 

                                        SELECT a.ID_KLIEN, b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT FROM ak_jurnal_penye a 
                                        JOIN ak_jurnal_penye_detail b ON a.NO_BUKTI = b.NO_BUKTI AND a.ID_KLIEN = b.ID_KLIEN
                                        WHERE a.ID_KLIEN = $id_klien AND a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'
                                        GROUP BY a.ID_KLIEN, b.KODE_AKUN
                                    ) a
                                ) b ON a.KODE_AKUN = b.KODE_AKUN
                                JOIN ak_setup_urut_labarugi c ON a.KATEGORI = c.KATEGORI
                                GROUP BY a.ID_KLIEN, a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, c.URUT, c.WARNA
                            ) a 
                            WHERE a.ID_KLIEN = $id_klien AND (a.KATEGORI = 'Harga Pokok Penjualan' OR a.KATEGORI = 'Beban' OR a.KATEGORI = 'Beban Lainnya')
                        ) a
                    ) a
                    GROUP BY a.KODE_AKUN
                ) a
            ) a
        ) a
        ";

        return $this->db->query($sql)->row();
    }
    
    function get_data_pengajuan_produk($unit){
        $sql = "
        SELECT a.*, b.USERNAME, b.NAMA, b.FOTO, b.LEVEL, c.NAMA_UNIT
        FROM ak_persetujuan a 
        LEFT JOIN ak_user b ON a.USER_INPUT = b.ID
        LEFT JOIN ak_unit c ON b.UNIT = c.ID
        WHERE a.TINDAKAN = 0 AND a.UNIT = '$unit' AND a.ITEM = 'produk'
        ORDER BY a.ID ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_pengajuan_supplier($unit){
        $sql = "
        SELECT a.*, b.USERNAME, b.NAMA, b.FOTO, b.LEVEL, c.NAMA_UNIT
        FROM ak_persetujuan a 
        LEFT JOIN ak_user b ON a.USER_INPUT = b.ID
        LEFT JOIN ak_unit c ON b.UNIT = c.ID
        WHERE a.TINDAKAN = 0 AND a.UNIT = '$unit' AND a.ITEM = 'supplier'
        ORDER BY a.ID ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_pengajuan_pelanggan($unit){
        $sql = "
        SELECT a.*, b.USERNAME, b.NAMA, b.FOTO, b.LEVEL, c.NAMA_UNIT
        FROM ak_persetujuan a 
        LEFT JOIN ak_user b ON a.USER_INPUT = b.ID
        LEFT JOIN ak_unit c ON b.UNIT = c.ID
        WHERE a.TINDAKAN = 0 AND a.UNIT = '$unit' AND a.ITEM = 'pelanggan'
        ORDER BY a.ID ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_pengajuan_kode_akun($unit){
        $sql = "
        SELECT a.*, b.USERNAME, b.NAMA, b.FOTO, b.LEVEL, c.NAMA_UNIT
        FROM ak_persetujuan a 
        LEFT JOIN ak_user b ON a.USER_INPUT = b.ID
        LEFT JOIN ak_unit c ON b.UNIT = c.ID
        WHERE a.TINDAKAN = 0 AND a.UNIT = '$unit' AND a.ITEM = 'kode_akun'
        ORDER BY a.ID ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_pengajuan_kategori_akun($unit){
        $sql = "
        SELECT a.*, b.USERNAME, b.NAMA, b.FOTO, b.LEVEL, c.NAMA_UNIT
        FROM ak_persetujuan a 
        LEFT JOIN ak_user b ON a.USER_INPUT = b.ID
        LEFT JOIN ak_unit c ON b.UNIT = c.ID
        WHERE a.TINDAKAN = 0 AND a.UNIT = '$unit' AND a.ITEM = 'kategori_akun'
        ORDER BY a.ID ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_log_aktifitas($unit, $level){
        $where = "";
        if($level == "ADMIN"){
            $where = "1=1 AND b.LEVEL != 'TAMBORA' ";
        } else if($level == "TAMBORA"){
            $where = "1=1";
        } else {
            $where = "a.UNIT = ".$unit;
        }

        $sql = "
        SELECT a.*, b.USERNAME, b.NAMA, b.FOTO, b.LEVEL
        FROM ak_log_aktifitas a 
        LEFT JOIN ak_user b ON a.ID_USER = b.ID
        WHERE $where
        ORDER BY a.ID DESC
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_log_aktifitas_saya($id_user){
        $sql = "
        SELECT a.*, b.USERNAME, b.NAMA, b.FOTO, b.LEVEL
        FROM ak_log_aktifitas a 
        LEFT JOIN ak_user b ON a.ID_USER = b.ID
        WHERE a.ID_USER = '$id_user'
        ORDER BY a.ID DESC
        ";

        return $this->db->query($sql)->result();
    }

    function get_log_by_tgl_all($tgl_awal, $tgl_akhir){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $where = "1=1";
        if($user->LEVEL != "ADMIN"){
            $where = "a.UNIT = ".$user->UNIT;
        }

        $sql = "
        SELECT a.*, b.USERNAME, b.NAMA, b.FOTO, b.LEVEL
        FROM ak_log_aktifitas a 
        LEFT JOIN ak_user b ON a.ID_USER = b.ID
        WHERE $where AND STR_TO_DATE(a.TGL,'%d-%m-%Y') >= STR_TO_DATE('$tgl_awal','%d-%m-%Y')  AND STR_TO_DATE(a.TGL,'%d-%m-%Y') <= STR_TO_DATE('$tgl_akhir','%d-%m-%Y')
        ORDER BY a.ID DESC
        ";

        return $this->db->query($sql)->result();
    }

    function get_log_by_tgl_saya($tgl_awal, $tgl_akhir){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];

        $sql = "
        SELECT a.*, b.USERNAME, b.NAMA, b.FOTO, b.LEVEL
        FROM ak_log_aktifitas a 
        LEFT JOIN ak_user b ON a.ID_USER = b.ID
        WHERE a.ID_USER = '$id_user' 
        AND STR_TO_DATE(a.TGL,'%d-%m-%Y') >= STR_TO_DATE('$tgl_awal','%d-%m-%Y')  AND STR_TO_DATE(a.TGL,'%d-%m-%Y') <= STR_TO_DATE('$tgl_akhir','%d-%m-%Y')
        ORDER BY a.ID DESC
        ";

        return $this->db->query($sql)->result();
    }

    function simpan_persetujuan($id_persetujuan, $tindakan, $apr_alasan){
        $sql = "
        UPDATE ak_persetujuan SET 
            TINDAKAN = '$tindakan',
            ALASAN = '$apr_alasan'
        WHERE ID = '$id_persetujuan'
        ";

        $this->db->query($sql);
    }

    function persetujuan_add($item, $id_item){
        $tabel = "";
        if($item == "kategori_akun"){
            $tabel = "ak_kategori_akun";
        } else if($item == "kode_akun"){
            $tabel = "ak_kode_akuntansi";
        } else if($item == "pelanggan"){
            $tabel = "ak_pelanggan";
        } else if($item == "supplier"){
            $tabel = "ak_supplier";
        } else if($item == "produk"){
            $tabel = "ak_produk";
        } else if($item == "kode_grup"){
            $tabel = "ak_grup_kode_akun";
        } else if($item == "kode_sub"){
            $tabel = "ak_sub_grup_kode_akun";
        }

        $sql = "
        UPDATE $tabel SET APPROVE = '3'
        WHERE ID = '$id_item'
        ";
        $this->db->query($sql);
    }

    function persetujuan_delete($item, $id_item){
        $tabel = "";
        if($item == "kategori_akun"){
            $tabel = "ak_kategori_akun";
        } else if($item == "kode_akun"){
            $tabel = "ak_kode_akuntansi";
        } else if($item == "pelanggan"){
            $tabel = "ak_pelanggan";
        } else if($item == "supplier"){
            $tabel = "ak_supplier";
        } else if($item == "produk"){
            $tabel = "ak_produk";
        } else if($item == "kode_grup"){
            $tabel = "ak_grup_kode_akun";
        } else if($item == "kode_sub"){
            $tabel = "ak_sub_grup_kode_akun";
        }

        $sql = "
        DELETE FROM $tabel WHERE ID = '$id_item'
        ";
        $this->db->query($sql);
    }

    function persetujuan_edit($item, $id_item){
        $tabel = "";
        if($item == "kategori_akun"){
            $tabel = "ak_kategori_akun";
        } else if($item == "kode_akun"){
            $tabel = "ak_kode_akuntansi";
        } else if($item == "pelanggan"){
            $tabel = "ak_pelanggan";
        } else if($item == "supplier"){
            $tabel = "ak_supplier";
        } else if($item == "produk"){
            $tabel = "ak_produk";
        } else if($item == "kode_grup"){
            $tabel = "ak_grup_kode_akun";
        } else if($item == "kode_sub"){
            $tabel = "ak_sub_grup_kode_akun";
        }

        $tabel2 = $tabel."_edit";

        $sql = "
        UPDATE $tabel SET APPROVE = '3'
        WHERE ID = '$id_item'
        ";
        $this->db->query($sql);

        $sql2 = "
        DELETE FROM $tabel2 WHERE ID = '$id_item'
        ";
        $this->db->query($sql2);
    }

    function tidak_persetujuan_add($item, $id_item){
        $tabel = "";
        if($item == "kategori_akun"){
            $tabel = "ak_kategori_akun";
        } else if($item == "kode_akun"){
            $tabel = "ak_kode_akuntansi";
        } else if($item == "pelanggan"){
            $tabel = "ak_pelanggan";
        } else if($item == "supplier"){
            $tabel = "ak_supplier";
        } else if($item == "produk"){
            $tabel = "ak_produk";
        } else if($item == "kode_grup"){
            $tabel = "ak_grup_kode_akun";
        } else if($item == "kode_sub"){
            $tabel = "ak_sub_grup_kode_akun";
        }

        $sql = "
        DELETE FROM $tabel WHERE ID = '$id_item'
        ";
        $this->db->query($sql);
    }

    function tidak_persetujuan_delete($item, $id_item){
        $tabel = "";
        if($item == "kategori_akun"){
            $tabel = "ak_kategori_akun";
        } else if($item == "kode_akun"){
            $tabel = "ak_kode_akuntansi";
        } else if($item == "pelanggan"){
            $tabel = "ak_pelanggan";
        } else if($item == "supplier"){
            $tabel = "ak_supplier";
        } else if($item == "produk"){
            $tabel = "ak_produk";
        } else if($item == "kode_grup"){
            $tabel = "ak_grup_kode_akun";
        } else if($item == "kode_sub"){
            $tabel = "ak_sub_grup_kode_akun";
        }

        $sql = "
        UPDATE $tabel SET APPROVE = '3'
        WHERE ID = '$id_item'
        ";
        $this->db->query($sql);
    }

    function tidak_persetujuan_edit($item, $id_item){
        $tabel = "";
        if($item == "kategori_akun"){
            $tabel = "ak_kategori_akun";
        } else if($item == "kode_akun"){
            $tabel = "ak_kode_akuntansi";
        } else if($item == "pelanggan"){
            $tabel = "ak_pelanggan";
        } else if($item == "supplier"){
            $tabel = "ak_supplier";
        } else if($item == "produk"){
            $tabel = "ak_produk";
        } else if($item == "kode_grup"){
            $tabel = "ak_grup_kode_akun";
        } else if($item == "kode_sub"){
            $tabel = "ak_sub_grup_kode_akun";
        }

        $tabel2 = $tabel."_edit";

        $sql = "
        DELETE FROM $tabel WHERE ID = '$id_item'
        ";
        $this->db->query($sql);

        $sql2 = "
        INSERT INTO $tabel SELECT * FROM $tabel2 WHERE ID = '$id_item'
        ";
        $this->db->query($sql2);

        $sql3 = "
        DELETE FROM $tabel2 WHERE ID = '$id_item'
        ";
        $this->db->query($sql3);
    }

    function get_data_unit(){
        $sql = "
        SELECT * FROM ak_unit 
        ORDER BY ID ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_unit_saya($unit){
        $sql = "
        SELECT * FROM ak_unit 
        WHERE ID = '$unit'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_manager_unit($id_unit){
        $sql = "
        SELECT * FROM ak_user WHERE UNIT = '$id_unit' AND LEVEL = 'MANAGER'
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_manager_unit2($id_unit){
        $sql = "
        SELECT * FROM ak_user WHERE UNIT = '$id_unit' AND LEVEL = 'MANAGER'
        ORDER BY ID ASC
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_user_unit($id_unit){
        $sql = "
        SELECT * FROM ak_user WHERE UNIT = '$id_unit'
        ORDER BY ID ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_setting_app(){
        $sql = "
        SELECT * FROM ak_profil_usaha
        ";

        return $this->db->query($sql)->row();
    }

    function get_unit_by_id($id_unit){
        $sql = "
        SELECT * FROM ak_unit WHERE ID = '$id_unit'
        ";

        return $this->db->query($sql)->row();
    }

    function edit_logo_unit($id_unit, $logo){
        $sql = "
        UPDATE ak_unit SET LOGO = '$logo'
        WHERE ID = '$id_unit'
        ";

        $this->db->query($sql);
    }

    function edit_background_unit($id_unit, $background){
        $sql = "
        UPDATE ak_unit SET BACKGROUND = '$background'
        WHERE ID = '$id_unit'
        ";

        $this->db->query($sql);
    }


}

?>