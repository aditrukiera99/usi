<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_akuntansi_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_lap_neraca_bulanan($bulan, $tahun, $jenis){

		$tgl_akhir = "01-".$bulan."-".$tahun;

		if($jenis == "AKTIVA"){
            $n = "-";
        } else {
            $n = "-";
        }

        $sql = "
        SELECT a.* FROM (
        SELECT SETUP.URUT, KOPER.KODE_AKUN, KOPER.NAMA_AKUN, SETUP.KELOMPOK, SETUP.JUDUL, SETUP.NAMA_KATEGORI, SUM(IFNULL(NERACA.SALDO, 0)) AS SALDO, SUM(IFNULL(NERACA_LALU.SALDO, 0)) AS SALDO_LALU
        FROM ak_kode_akuntansi KOPER
        JOIN ak_grup_kode_akun GRUP ON GRUP.KODE_GRUP = KOPER.KODE_GRUP
        JOIN ak_setup_neraca SETUP ON GRUP.GRUP = SETUP.NAMA_KATEGORI
        LEFT JOIN (
            SELECT a.KODE_AKUN, SUM(a.SALDO) AS SALDO FROM (

                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_input_voucher_detail
                WHERE  TGL LIKE '%-$bulan-$tahun%'
                GROUP BY KODE_AKUN

                UNION ALL 

                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_input_voucher_lainnya
                WHERE  TGL LIKE '%-$bulan-$tahun%'
                GROUP BY KODE_AKUN

            ) a
        GROUP BY a.KODE_AKUN
        ) NERACA ON KOPER.KODE_AKUN = NERACA.KODE_AKUN

        LEFT JOIN (
            SELECT a.KODE_AKUN, SUM(a.SALDO) AS SALDO FROM (
                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_input_voucher_detail
                WHERE STR_TO_DATE(TGL, '%d-%c-%Y') < STR_TO_DATE('$tgl_akhir' , '%d-%c-%Y')
                GROUP BY KODE_AKUN

                UNION ALL 

                SELECT KODE_AKUN, (SUM(DEBET) $n SUM(KREDIT)) AS SALDO FROM ak_input_voucher_lainnya
                WHERE STR_TO_DATE(TGL, '%d-%c-%Y') < STR_TO_DATE('$tgl_akhir' , '%d-%c-%Y')
                GROUP BY KODE_AKUN
            ) a
        GROUP BY a.KODE_AKUN
        ) NERACA_LALU ON KOPER.KODE_AKUN = NERACA_LALU.KODE_AKUN

        GROUP BY SETUP.URUT, KOPER.KODE_AKUN, KOPER.NAMA_AKUN, SETUP.KELOMPOK, SETUP.JUDUL, SETUP.NAMA_KATEGORI
        ) a
        WHERE a.KELOMPOK = '$jenis'
        ORDER BY a.URUT, a.KODE_AKUN
        ";

        return $this->db->query($sql)->result();
	}

	function cetak_laba_rugi_bulanan($bulan, $tahun, $jenis){

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
                                WHEN a.TIPE = 'K' THEN
                                (a.JML * -1) ELSE a.JML
                               END AS JML
                        FROM (
                            SELECT  a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, a.URUT, a.WARNA, (a.DEBET + a.KREDIT) AS JML FROM (
                                SELECT  a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, c.KATEGORI, c.URUT, c.WARNA, IFNULL(SUM(b.DEBET), 0) AS DEBET, IFNULL(SUM(b.KREDIT), 0) AS KREDIT FROM ak_kode_akuntansi a 
                                LEFT JOIN (
                                    SELECT  a.KODE_AKUN, IFNULL(a.DEBET, 0) AS DEBET, IFNULL(a.KREDIT, 0) AS KREDIT FROM(
                                        SELECT DETAIL.KODE_AKUN, SUM(DETAIL.DEBET) AS DEBET, SUM(DETAIL.KREDIT) AS KREDIT
                                        FROM ak_input_voucher VOUCHER
                                        JOIN ak_input_voucher_detail DETAIL ON VOUCHER.ID = DETAIL.ID_VOUCHER 
                                        WHERE  VOUCHER.TGL LIKE '%-$bulan-$tahun%'
                                        GROUP BY DETAIL.KODE_AKUN

                                        UNION ALL 

                                        SELECT KODE_AKUN, SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT
                                        FROM  ak_input_voucher_lainnya
                                        WHERE TGL LIKE '%-$bulan-$tahun%'
                                        GROUP BY KODE_AKUN
                                    ) a
                                ) b ON a.KODE_AKUN = b.KODE_AKUN
                                JOIN ak_grup_kode_akun cc ON a.KODE_GRUP = cc.KODE_GRUP
            					JOIN ak_setup_urut_labarugi c ON c.KATEGORI = cc.TMP_LR
                                GROUP BY a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, c.KATEGORI, c.URUT, c.WARNA
                            ) a 
                            WHERE 1=1 AND (a.KATEGORI = 'Penjualan' OR a.KATEGORI = 'Pendapatan Lain-lain')
                        ) a
                    ) a
                    GROUP BY a.KODE_AKUN
                ) a

                UNION ALL 

                SELECT 0 AS JML1, SUM(a.JML) AS JML2 FROM (
                    SELECT a.KODE_AKUN, SUM(a.JML) AS JML FROM (
                        SELECT a.KODE_AKUN, 
                               CASE 
                                WHEN a.TIPE = 'K' THEN
                                (a.JML * -1) ELSE a.JML
                               END AS JML
                        FROM (
                            SELECT a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, a.KATEGORI, a.URUT, a.WARNA, (a.DEBET + a.KREDIT) AS JML FROM (
                                SELECT a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, c.KATEGORI, c.URUT, c.WARNA, IFNULL(SUM(b.DEBET), 0) AS DEBET, IFNULL(SUM(b.KREDIT), 0) AS KREDIT FROM ak_kode_akuntansi a 
                                LEFT JOIN (
                                    SELECT a.KODE_AKUN, IFNULL(a.DEBET, 0) AS DEBET, IFNULL(a.KREDIT, 0) AS KREDIT FROM(
                                        SELECT DETAIL.KODE_AKUN, SUM(DETAIL.DEBET) AS DEBET, SUM(DETAIL.KREDIT) AS KREDIT
                                        FROM ak_input_voucher VOUCHER
                                        JOIN ak_input_voucher_detail DETAIL ON VOUCHER.ID = DETAIL.ID_VOUCHER
                                        WHERE  VOUCHER.TGL LIKE '%-$bulan-$tahun%'
                                        GROUP BY  DETAIL.KODE_AKUN

                                        UNION ALL 

                                        SELECT KODE_AKUN, SUM(DEBET) AS DEBET, SUM(KREDIT) AS KREDIT
                                        FROM  ak_input_voucher_lainnya
                                        WHERE TGL LIKE '%-$bulan-$tahun%'
                                        GROUP BY KODE_AKUN
                                    ) a
                                ) b ON a.KODE_AKUN = b.KODE_AKUN
                                JOIN ak_grup_kode_akun cc ON a.KODE_GRUP = cc.KODE_GRUP
            					JOIN ak_setup_urut_labarugi c ON c.KATEGORI = cc.TMP_LR
                                GROUP BY a.TIPE, a.KODE_AKUN, a.NAMA_AKUN, c.KATEGORI, c.URUT, c.WARNA
                            ) a 
                            WHERE 1=1 AND (a.KATEGORI = 'Harga Pokok Penjualan' OR a.KATEGORI = 'Beban' OR a.KATEGORI = 'Beban Lain-lain')
                        ) a
                    ) a
                    GROUP BY a.KODE_AKUN
                ) a
            ) a
        ) a
        ";

        return $this->db->query($sql)->row();
    }
}
