<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_neraca_lajur_m extends CI_Model
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

    function cetak_laba_rugi_bulanan($id_klien, $bulan, $tahun, $jenis, $unit){

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

    function get_lap_neraca_tahunan($id_klien, $bulan, $tahun, $jenis, $unit){

        if($jenis == "AKTIVA"){
            $n = "-";
        } else {
            $n = "-";
        }

        $tahun_lalu = $tahun-1;

        $sql = "
        SELECT a.* FROM (
        SELECT SETUP.URUT, KOPER.KODE_AKUN, KOPER.NAMA_AKUN, SETUP.KELOMPOK, SETUP.JUDUL, SETUP.NAMA_KATEGORI, SUM(IFNULL(NERACA.SALDO, 0)) AS SALDO, SUM(IFNULL(NERACA_LALU.SALDO, 0)) AS SALDO_LALU FROM ak_kode_akuntansi KOPER
        JOIN ak_setup_neraca SETUP ON KOPER.KATEGORI = SETUP.NAMA_KATEGORI
        LEFT JOIN (
            SELECT a.KODE_AKUN, SUM(a.SALDO) AS SALDO FROM (
                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_jurnal_umum_vw
                WHERE ID_KLIEN = $id_klien AND TGL LIKE '%-$tahun%' AND UNIT = '$unit'
                GROUP BY KODE_AKUN

                UNION ALL 

                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_jurnal_penyesuaian_vw
                WHERE ID_KLIEN = $id_klien AND TGL LIKE '%-$tahun%' AND UNIT = '$unit'
                GROUP BY KODE_AKUN

                UNION ALL 

                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_jurnal_kas_bank
                WHERE ID_KLIEN = $id_klien AND TGL_CEK LIKE '%-$tahun%' AND UNIT = '$unit'
                GROUP BY KODE_AKUN

                UNION ALL 

                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_penerimaan_kas_bank
                WHERE ID_KLIEN = $id_klien AND TGL LIKE '%-$tahun%'  AND UNIT = '$unit'  
                GROUP BY KODE_AKUN

            ) a
        GROUP BY a.KODE_AKUN
        ) NERACA ON KOPER.KODE_AKUN = NERACA.KODE_AKUN

        LEFT JOIN (
            SELECT a.KODE_AKUN, SUM(a.SALDO) AS SALDO FROM (
                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_jurnal_umum_vw
                WHERE ID_KLIEN = $id_klien AND TGL LIKE '%-$tahun_lalu%' AND UNIT = '$unit'
                GROUP BY KODE_AKUN

                UNION ALL 

                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_jurnal_penyesuaian_vw
                WHERE ID_KLIEN = $id_klien AND TGL LIKE '%-$tahun_lalu%' AND UNIT = '$unit'
                GROUP BY KODE_AKUN

                UNION ALL 

                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_jurnal_kas_bank
                WHERE ID_KLIEN = $id_klien AND TGL_CEK LIKE '%-$tahun_lalu%' AND UNIT = '$unit'
                GROUP BY KODE_AKUN

                UNION ALL 

                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_penerimaan_kas_bank
                WHERE ID_KLIEN = $id_klien AND TGL LIKE '%-$tahun_lalu%'  AND UNIT = '$unit'  
                GROUP BY KODE_AKUN

            ) a
        GROUP BY a.KODE_AKUN
        ) NERACA_LALU ON KOPER.KODE_AKUN = NERACA_LALU.KODE_AKUN

        WHERE KOPER.ID_KLIEN = $id_klien
        GROUP BY SETUP.URUT, KOPER.KODE_AKUN, KOPER.NAMA_AKUN, SETUP.KELOMPOK, SETUP.JUDUL, SETUP.NAMA_KATEGORI
        ) a
        WHERE a.KELOMPOK = '$jenis'
        ORDER BY a.URUT
        ";

        return $this->db->query($sql)->result();
    }

    function cetak_laba_rugi_tahunan($id_klien, $bulan, $tahun, $jenis, $unit){

        if($jenis == "LALU"){
            $tahun = $tahun - 1;
        }

        //$bulan = str_pad($bulan, 2, '0', STR_PAD_LEFT);

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
                                        AND VOUCHER.TGL LIKE '%-$tahun%' AND VOUCHER.NO_JP IS NULL
                                        AND VOUCHER.UNIT = '$unit'
                                        GROUP BY VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN

                                        UNION ALL 

                                        SELECT a.ID_KLIEN, b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT FROM ak_jurnal_penye a 
                                        JOIN ak_jurnal_penye_detail b ON a.NO_BUKTI = b.NO_BUKTI AND a.ID_KLIEN = b.ID_KLIEN
                                        WHERE a.ID_KLIEN = $id_klien AND a.TGL LIKE '%-$tahun%' AND a.UNIT = '$unit'
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
                                        AND VOUCHER.TGL LIKE '%-$tahun%' AND VOUCHER.NO_JP IS NULL
                                        AND VOUCHER.UNIT = '$unit'
                                        GROUP BY VOUCHER.ID_KLIEN, DETAIL.KODE_AKUN

                                        UNION ALL 

                                        SELECT a.ID_KLIEN, b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT FROM ak_jurnal_penye a 
                                        JOIN ak_jurnal_penye_detail b ON a.NO_BUKTI = b.NO_BUKTI AND a.ID_KLIEN = b.ID_KLIEN
                                        WHERE a.ID_KLIEN = $id_klien AND a.TGL LIKE '%-$tahun%' AND a.UNIT = '$unit'
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

    function get_grup_kode_akun($main_grup, $unit, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter){
        $where1 = "";
        $where2 = "";
        if($filter == "Bulanan"){
            $where1 = "a.TGL LIKE '%-$bulan-$tahun%'";
            $where2 = "a.TGL LIKE '%-$bulan_lalu-$tahun_lalu%'";
        } else {
            $where1 = "a.TGL LIKE '%-$tahun%'";
            $where2 = "a.TGL LIKE '%-$tahun_lalu%'";
        }

        $sql = "
        SELECT a.*, 
        IFNULL(IFNULL(b.DEBET, 0) + IFNULL(f.DEBET,0), 0) AS DEBET,
        IFNULL(IFNULL(b.KREDIT, 0) + IFNULL(f.KREDIT,0), 0) AS KREDIT,

        IFNULL(IFNULL(c.DEBET, 0) + IFNULL(e.DEBET,0) + IFNULL(g.DEBET,0), 0) AS DEBET_LALU,
        IFNULL(IFNULL(c.KREDIT, 0) + IFNULL(e.KREDIT,0) + IFNULL(g.KREDIT,0), 0) AS KREDIT_LALU,

        IFNULL(d.DEBET, 0) AS DEBET_MUTASI, 
        IFNULL(d.KREDIT, 0) AS KREDIT_MUTASI
        FROM ak_grup_kode_akun a
        LEFT JOIN (
            SELECT c.KODE_GRUP, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_input_voucher a
            JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE $where1 AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP
        ) b ON b.KODE_GRUP = a.KODE_GRUP

        LEFT JOIN (
            SELECT c.KODE_GRUP, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_input_voucher a
            JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE $where2 AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP
        ) c ON c.KODE_GRUP = a.KODE_GRUP

        LEFT JOIN (
            SELECT c.KODE_GRUP, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_jurnal_penye a
            JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE $where1 AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP
        ) d ON d.KODE_GRUP = a.KODE_GRUP

        LEFT JOIN (
            SELECT c.KODE_GRUP, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_jurnal_penye a
            JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE $where2 AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP
        ) e ON e.KODE_GRUP = a.KODE_GRUP

        LEFT JOIN (
            SELECT c.KODE_GRUP, SUM(a.DEBET) AS DEBET, SUM(a.KREDIT) AS KREDIT 
            FROM ak_penerimaan_kas_bank a
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = a.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE $where1 AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP
        ) f ON f.KODE_GRUP = a.KODE_GRUP

        LEFT JOIN (
            SELECT c.KODE_GRUP, SUM(a.DEBET) AS DEBET, SUM(a.KREDIT) AS KREDIT 
            FROM ak_penerimaan_kas_bank a
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = a.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE $where2 AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP
        ) g ON g.KODE_GRUP = a.KODE_GRUP

        WHERE a.GRUP = '$main_grup' AND a.UNIT = '$unit'
        ORDER BY a.ID
        ";

        return $this->db->query($sql)->result();
    }

    function get_sub_kode_akun($kode_grup, $unit, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter){
        $where1 = "";
        $where2 = "";
        if($filter == "Bulanan"){
            $where1 = "a.TGL LIKE '%-$bulan-$tahun%'";
            $where2 = "a.TGL LIKE '%-$bulan_lalu-$tahun_lalu%'";
        } else {
            $where1 = "a.TGL LIKE '%-$tahun%'";
            $where2 = "a.TGL LIKE '%-$tahun_lalu%'";
        }

        $sql = "
        SELECT a.*,
        IFNULL(IFNULL(b.DEBET, 0) + IFNULL(f.DEBET,0), 0) AS DEBET,
        IFNULL(IFNULL(b.KREDIT, 0) + IFNULL(f.KREDIT,0), 0) AS KREDIT,

        IFNULL(IFNULL(c.DEBET, 0) + IFNULL(e.DEBET,0) + IFNULL(g.DEBET,0), 0) AS DEBET_LALU,
        IFNULL(IFNULL(c.KREDIT, 0) + IFNULL(e.KREDIT,0) + IFNULL(g.KREDIT,0), 0) AS KREDIT_LALU,

        IFNULL(d.DEBET, 0) AS DEBET_MUTASI, 
        IFNULL(d.KREDIT, 0) AS KREDIT_MUTASI
        FROM ak_sub_grup_kode_akun a
        LEFT JOIN (
            SELECT c.KODE_GRUP, c.KODE_SUB, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_input_voucher a
            JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE $where1 AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP, c.KODE_SUB
        ) b ON b.KODE_GRUP = a.KODE_GRUP AND b.KODE_SUB = a.KODE_SUB

        LEFT JOIN (
            SELECT c.KODE_GRUP, c.KODE_SUB, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_input_voucher a
            JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE $where2 AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP, c.KODE_SUB
        ) c ON c.KODE_GRUP = a.KODE_GRUP AND c.KODE_SUB = a.KODE_SUB

        LEFT JOIN (
            SELECT c.KODE_GRUP, c.KODE_SUB, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_jurnal_penye a
            JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE $where1 AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP, c.KODE_SUB
        ) d ON d.KODE_GRUP = a.KODE_GRUP AND d.KODE_SUB = a.KODE_SUB

        LEFT JOIN (
            SELECT c.KODE_GRUP, c.KODE_SUB, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_jurnal_penye a
            JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE $where2 AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP, c.KODE_SUB
        ) e ON e.KODE_GRUP = a.KODE_GRUP AND e.KODE_SUB = a.KODE_SUB

        LEFT JOIN (
            SELECT c.KODE_GRUP, c.KODE_SUB, SUM(a.DEBET) AS DEBET, SUM(a.KREDIT) AS KREDIT 
            FROM ak_penerimaan_kas_bank a
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = a.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE $where1 AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP, c.KODE_SUB
        ) f ON f.KODE_GRUP = a.KODE_GRUP AND f.KODE_SUB = a.KODE_SUB

        LEFT JOIN (
            SELECT c.KODE_GRUP, c.KODE_SUB, SUM(a.DEBET) AS DEBET, SUM(a.KREDIT) AS KREDIT 
            FROM ak_penerimaan_kas_bank a
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = a.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE $where2 AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP, c.KODE_SUB
        ) g ON g.KODE_GRUP = a.KODE_GRUP AND g.KODE_SUB = a.KODE_SUB

        WHERE a.KODE_GRUP = '$kode_grup' AND a.UNIT = '$unit'
        ORDER BY a.ID
        ";

        return $this->db->query($sql)->result();
    }
 
    function get_kode_akun($kode_grup, $kode_sub, $unit, $bulan, $tahun, $bulan_lalu, $tahun_lalu, $filter){
        $where1 = "";
        $where2 = "";
        if($filter == "Bulanan"){
            $where1 = "a.TGL LIKE '%-$bulan-$tahun%'";
            $where2 = "a.TGL LIKE '%-$bulan_lalu-$tahun_lalu%'";
        } else {
            $where1 = "a.TGL LIKE '%-$tahun%'";
            $where2 = "a.TGL LIKE '%-$tahun_lalu%'";
        }


        if($kode_grup == 330){
           $sql = "
           SELECT SUM(TOTAL_PENDAPATAN) AS DEBET,
                   SUM(TOTAL_BIAYA) AS KREDIT,
                   SUM(TOTAL_PENDAPATAN_LALU) AS DEBET_LALU,
                   SUM(TOTAL_BIAYA_LALU) AS KREDIT_LALU
            FROM (
                SELECT (DEBET - KREDIT) AS TOTAL_PENDAPATAN, 0 AS TOTAL_BIAYA,
                       (DEBET_LALU - KREDIT_LALU) AS TOTAL_PENDAPATAN_LALU, 0 AS TOTAL_BIAYA_LALU 
                FROM (
                    SELECT SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT, 
                    SUM(DEBET_LALU) AS DEBET_LALU, SUM(KREDIT_LALU) AS KREDIT_LALU FROM (
                        SELECT 
                        a.KODE_GRUP, a.KODE_AKUN, a.NAMA_AKUN, a.UNIT, 'PENDAPATAN' AS TIPE_AKUN,
                        IFNULL(IFNULL(b.DEBET, 0) + IFNULL(d.DEBET,0) + IFNULL(f.DEBET,0), 0) AS DEBET,
                        IFNULL(IFNULL(b.KREDIT, 0) + IFNULL(d.KREDIT,0) + IFNULL(f.KREDIT,0), 0) AS KREDIT,
                        IFNULL(IFNULL(c.DEBET, 0) + IFNULL(e.DEBET,0) + IFNULL(g.DEBET,0), 0) AS DEBET_LALU,
                        IFNULL(IFNULL(c.KREDIT, 0) + IFNULL(e.KREDIT,0) + IFNULL(g.KREDIT,0), 0) AS KREDIT_LALU
                        FROM ak_kode_akuntansi a

                        LEFT JOIN (
                                SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
                                FROM ak_input_voucher a
                                JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
                                WHERE $where1 AND a.UNIT = '$unit'
                                GROUP BY b.KODE_AKUN
                        ) b ON a.KODE_AKUN = b.KODE_AKUN

                        LEFT JOIN (
                                SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
                                FROM ak_input_voucher a
                                JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
                                WHERE $where2 AND a.UNIT = '$unit'
                                GROUP BY b.KODE_AKUN
                        ) c ON a.KODE_AKUN = c.KODE_AKUN

                        LEFT JOIN (
                            SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
                            FROM ak_jurnal_penye a
                            JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
                            WHERE $where1 AND a.UNIT = '$unit'
                            GROUP BY b.KODE_AKUN
                        ) d ON a.KODE_AKUN = d.KODE_AKUN

                        LEFT JOIN (
                            SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
                            FROM ak_jurnal_penye a
                            JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
                            WHERE $where2 AND a.UNIT = '$unit'
                            GROUP BY b.KODE_AKUN
                        ) e ON a.KODE_AKUN = e.KODE_AKUN

                        LEFT JOIN (
                            SELECT a.KODE_AKUN, SUM(a.DEBET) AS DEBET, SUM(a.KREDIT) AS KREDIT 
                            FROM ak_penerimaan_kas_bank a
                            WHERE $where1 AND a.UNIT = '$unit'
                            GROUP BY a.KODE_AKUN
                        ) f ON a.KODE_AKUN = f.KODE_AKUN

                        LEFT JOIN (
                            SELECT a.KODE_AKUN, SUM(a.DEBET) AS DEBET, SUM(a.KREDIT) AS KREDIT 
                            FROM ak_penerimaan_kas_bank a
                            WHERE $where2 AND a.UNIT = '$unit'
                            GROUP BY a.KODE_AKUN
                        ) g ON a.KODE_AKUN = g.KODE_AKUN

                        JOIN ak_grup_kode_akun h ON a.KODE_GRUP = h.KODE_GRUP AND a.UNIT = h.UNIT
                        WHERE h.GRUP = 'PENDAPATAN' AND a.UNIT = '$unit'
                    ) a
                ) a

                UNION ALL

                SELECT 0 AS TOTAL_PENDAPATAN, (DEBET - KREDIT)  AS TOTAL_BIAYA,
                       0 AS TOTAL_PENDAPATAN_LALU, (DEBET_LALU - KREDIT_LALU) AS TOTAL_BIAYA_LALU 
                FROM (
                    SELECT SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT, 
                    SUM(DEBET_LALU) AS DEBET_LALU, SUM(KREDIT_LALU) AS KREDIT_LALU FROM (
                        SELECT 
                        a.KODE_GRUP, a.KODE_AKUN, a.NAMA_AKUN, a.UNIT, 'BIAYA' AS TIPE_AKUN,
                        IFNULL(IFNULL(b.DEBET, 0) + IFNULL(d.DEBET,0) + IFNULL(f.DEBET,0), 0) AS DEBET,
                        IFNULL(IFNULL(b.KREDIT, 0) + IFNULL(d.KREDIT,0) + IFNULL(f.KREDIT,0), 0) AS KREDIT,
                        IFNULL(IFNULL(c.DEBET, 0) + IFNULL(e.DEBET,0) + IFNULL(g.DEBET,0), 0) AS DEBET_LALU,
                        IFNULL(IFNULL(c.KREDIT, 0) + IFNULL(e.KREDIT,0) + IFNULL(g.KREDIT,0), 0) AS KREDIT_LALU
                        FROM ak_kode_akuntansi a

                        LEFT JOIN (
                                SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
                                FROM ak_input_voucher a
                                JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
                                WHERE $where1 AND a.UNIT = '$unit'
                                GROUP BY b.KODE_AKUN
                        ) b ON a.KODE_AKUN = b.KODE_AKUN

                        LEFT JOIN (
                                SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
                                FROM ak_input_voucher a
                                JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
                                WHERE $where2 AND a.UNIT = '$unit'
                                GROUP BY b.KODE_AKUN
                        ) c ON a.KODE_AKUN = c.KODE_AKUN

                        LEFT JOIN (
                            SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
                            FROM ak_jurnal_penye a
                            JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
                            WHERE $where1 AND a.UNIT = '$unit'
                            GROUP BY b.KODE_AKUN
                        ) d ON a.KODE_AKUN = d.KODE_AKUN

                        LEFT JOIN (
                            SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
                            FROM ak_jurnal_penye a
                            JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
                            WHERE $where2 AND a.UNIT = '$unit'
                            GROUP BY b.KODE_AKUN
                        ) e ON a.KODE_AKUN = e.KODE_AKUN

                        LEFT JOIN (
                            SELECT a.KODE_AKUN, SUM(a.DEBET) AS DEBET, SUM(a.KREDIT) AS KREDIT 
                            FROM ak_penerimaan_kas_bank a
                            WHERE $where1 AND a.UNIT = '$unit'
                            GROUP BY a.KODE_AKUN
                        ) f ON a.KODE_AKUN = f.KODE_AKUN

                        LEFT JOIN (
                            SELECT a.KODE_AKUN, SUM(a.DEBET) AS DEBET, SUM(a.KREDIT) AS KREDIT 
                            FROM ak_penerimaan_kas_bank a
                            WHERE $where2 AND a.UNIT = '$unit'
                            GROUP BY a.KODE_AKUN
                        ) g ON a.KODE_AKUN = g.KODE_AKUN

                        JOIN ak_grup_kode_akun h ON a.KODE_GRUP = h.KODE_GRUP AND a.UNIT = h.UNIT
                        WHERE h.GRUP = 'BIAYA' AND a.UNIT = '$unit'
                    ) a
                ) a
            )a
            ";

            return $this->db->query($sql)->result();
            
        } else {
            $sql = "
            SELECT a.*, 
            IFNULL(IFNULL(b.DEBET, 0) + IFNULL(f.DEBET,0), 0) AS DEBET,
            IFNULL(IFNULL(b.KREDIT, 0) + IFNULL(f.KREDIT,0), 0) AS KREDIT,

            IFNULL(IFNULL(c.DEBET, 0) + IFNULL(e.DEBET,0) + IFNULL(g.DEBET,0), 0) AS DEBET_LALU,
            IFNULL(IFNULL(c.KREDIT, 0) + IFNULL(e.KREDIT,0) + IFNULL(g.KREDIT,0), 0) AS KREDIT_LALU,

            IFNULL(d.DEBET, 0) AS DEBET_MUTASI, 
            IFNULL(d.KREDIT, 0) AS KREDIT_MUTASI
            FROM ak_kode_akuntansi a
            LEFT JOIN (
                SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
                FROM ak_input_voucher a
                JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
                WHERE $where1 AND a.UNIT = '$unit'
                GROUP BY b.KODE_AKUN
            ) b ON a.KODE_AKUN = b.KODE_AKUN

            LEFT JOIN (
                SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
                FROM ak_input_voucher a
                JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
                WHERE $where2 AND a.UNIT = '$unit'
                GROUP BY b.KODE_AKUN
            ) c ON a.KODE_AKUN = c.KODE_AKUN

            LEFT JOIN (
                SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
                FROM ak_jurnal_penye a
                JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
                WHERE $where1 AND a.UNIT = '$unit'
                GROUP BY b.KODE_AKUN
            ) d ON a.KODE_AKUN = d.KODE_AKUN

            LEFT JOIN (
                SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
                FROM ak_jurnal_penye a
                JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
                WHERE $where2 AND a.UNIT = '$unit'
                GROUP BY b.KODE_AKUN
            ) e ON a.KODE_AKUN = e.KODE_AKUN

            LEFT JOIN (
                SELECT a.KODE_AKUN, SUM(a.DEBET) AS DEBET, SUM(a.KREDIT) AS KREDIT 
                FROM ak_penerimaan_kas_bank a
                WHERE $where1 AND a.UNIT = '$unit'
                GROUP BY a.KODE_AKUN
            ) f ON a.KODE_AKUN = f.KODE_AKUN

            LEFT JOIN (
                SELECT a.KODE_AKUN, SUM(a.DEBET) AS DEBET, SUM(a.KREDIT) AS KREDIT 
                FROM ak_penerimaan_kas_bank a
                WHERE $where2 AND a.UNIT = '$unit'
                GROUP BY a.KODE_AKUN
            ) g ON a.KODE_AKUN = g.KODE_AKUN

            WHERE a.KODE_GRUP = '$kode_grup' AND a.KODE_SUB = '$kode_sub' AND a.UNIT = '$unit'
            ORDER BY a.ID
            ";

            return $this->db->query($sql)->result();
        }
    }
}

?>