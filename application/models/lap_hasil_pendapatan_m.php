<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_hasil_pendapatan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    
    function get_grup_kode_akun($main_grup, $unit, $bulan, $tahun, $bulan_depan, $tahun_depan){

        $bulan_lalu = $bulan - 1;
        $tahun_lalu = $tahun;

        if($bulan_lalu == 0){
            $bulan_lalu = 1;
        }

        $sum_rkap_lalu = $this->get_sum_rkap($bulan_lalu);
        $sum_rkap = $this->get_sum_rkap_skrg($bulan);
        $sum_rkap_sd_ini = $this->get_sum_rkap($bulan);

        $sql = "
        SELECT a.*, 
        IFNULL(IFNULL(b.DEBET, 0) + IFNULL(bb.DEBET,0), 0) AS DEBET,
        IFNULL(IFNULL(b.KREDIT, 0) + IFNULL(bb.KREDIT,0), 0) AS KREDIT,

        IFNULL(IFNULL(c.DEBET, 0) + IFNULL(cc.DEBET,0), 0) AS DEBET_LALU,
        IFNULL(IFNULL(c.KREDIT, 0) + IFNULL(cc.KREDIT,0), 0) AS KREDIT_LALU,

        IFNULL(IFNULL(d.DEBET, 0) + IFNULL(dd.DEBET,0), 0) AS DEBET_SD_INI,
        IFNULL(IFNULL(d.KREDIT, 0) + IFNULL(dd.KREDIT,0), 0) AS KREDIT_SD_INI,

        IFNULL(e.TOTAL, 0) AS TARGET,
        IFNULL(f.RKAP_LALU, 0) AS RKAP_LALU,
        IFNULL(g.RKAP_SKRG, 0) AS RKAP_SKRG,
        IFNULL(h.RKAP_SD_INI, 0) AS RKAP_SD_INI
        FROM ak_grup_kode_akun a
        LEFT JOIN (
            SELECT c.KODE_GRUP, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_input_voucher a
            JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP
        ) b ON b.KODE_GRUP = a.KODE_GRUP

        LEFT JOIN (
            SELECT c.KODE_GRUP, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_input_voucher a
            JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE STR_TO_DATE(a.TGL,'%d-%m-%Y') >= STR_TO_DATE('01-01-$tahun','%d-%m-%Y')  AND STR_TO_DATE(a.TGL,'%d-%m-%Y') < STR_TO_DATE('01-$bulan-$tahun','%d-%m-%Y') AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP
        ) c ON c.KODE_GRUP = a.KODE_GRUP

        LEFT JOIN (
            SELECT c.KODE_GRUP, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_input_voucher a
            JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE STR_TO_DATE(a.TGL,'%d-%m-%Y') >= STR_TO_DATE('01-01-$tahun','%d-%m-%Y')  
            AND STR_TO_DATE(a.TGL,'%d-%m-%Y') < STR_TO_DATE('01-$bulan_depan-$tahun_depan','%d-%m-%Y') AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP
        ) d ON d.KODE_GRUP = a.KODE_GRUP

        LEFT JOIN (
            SELECT c.KODE_GRUP, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_jurnal_penye a
            JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP
        ) bb ON bb.KODE_GRUP = a.KODE_GRUP

        LEFT JOIN (
            SELECT c.KODE_GRUP, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_jurnal_penye a
            JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE STR_TO_DATE(a.TGL,'%d-%m-%Y') >= STR_TO_DATE('01-01-$tahun','%d-%m-%Y')  AND STR_TO_DATE(a.TGL,'%d-%m-%Y') < STR_TO_DATE('01-$bulan-$tahun','%d-%m-%Y') AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP
        ) cc ON cc.KODE_GRUP = a.KODE_GRUP

        LEFT JOIN (
            SELECT c.KODE_GRUP, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_jurnal_penye a
            JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE STR_TO_DATE(a.TGL,'%d-%m-%Y') >= STR_TO_DATE('01-01-$tahun','%d-%m-%Y')  
            AND STR_TO_DATE(a.TGL,'%d-%m-%Y') < STR_TO_DATE('01-$bulan_depan-$tahun_depan','%d-%m-%Y') AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP
        ) dd ON dd.KODE_GRUP = a.KODE_GRUP

        LEFT JOIN (
            SELECT KODE_AKUN, TOTAL FROM ak_rkap
            WHERE TAHUN = '$tahun' AND UNIT = '$unit'
        ) e ON e.KODE_AKUN LIKE concat('%',a.KODE_GRUP,'%')

        LEFT JOIN (
            SELECT KODE_AKUN, $sum_rkap_lalu AS RKAP_LALU FROM ak_rkap
            WHERE TAHUN = '$tahun_lalu' AND UNIT = '$unit'
        ) f ON f.KODE_AKUN LIKE concat('%',a.KODE_GRUP,'%')

        LEFT JOIN (
            SELECT KODE_AKUN, $sum_rkap AS RKAP_SKRG FROM ak_rkap
            WHERE TAHUN = '$tahun' AND UNIT = '$unit'
        ) g ON g.KODE_AKUN LIKE concat('%',a.KODE_GRUP,'%')

        LEFT JOIN (
            SELECT KODE_AKUN, $sum_rkap_sd_ini AS RKAP_SD_INI FROM ak_rkap
            WHERE TAHUN = '$tahun' AND UNIT = '$unit'
        ) h ON h.KODE_AKUN LIKE concat('%',a.KODE_GRUP,'%')


        WHERE a.GRUP = '$main_grup' AND a.UNIT = '$unit'
        ORDER BY a.ID
        ";

        return $this->db->query($sql)->result();
    }

    function get_sub_kode_akun($kode_grup, $unit, $bulan, $tahun, $bulan_depan, $tahun_depan){

        $bulan_lalu = $bulan - 1;
        $tahun_lalu = $tahun;

        if($bulan_lalu == 0){
            $bulan_lalu = 1;
        }

        $sum_rkap_lalu = $this->get_sum_rkap($bulan_lalu);
        $sum_rkap = $this->get_sum_rkap_skrg($bulan);
        $sum_rkap_sd_ini = $this->get_sum_rkap($bulan);


        $sql = "
        SELECT a.*, 
        IFNULL(IFNULL(b.DEBET, 0) + IFNULL(bb.DEBET,0), 0) AS DEBET,
        IFNULL(IFNULL(b.KREDIT, 0) + IFNULL(bb.KREDIT,0), 0) AS KREDIT,

        IFNULL(IFNULL(c.DEBET, 0) + IFNULL(cc.DEBET,0), 0) AS DEBET_LALU,
        IFNULL(IFNULL(c.KREDIT, 0) + IFNULL(cc.KREDIT,0), 0) AS KREDIT_LALU,

        IFNULL(IFNULL(d.DEBET, 0) + IFNULL(dd.DEBET,0), 0) AS DEBET_SD_INI,
        IFNULL(IFNULL(d.KREDIT, 0) + IFNULL(dd.KREDIT,0), 0) AS KREDIT_SD_INI,

        IFNULL(e.TOTAL, 0) AS TARGET,
        IFNULL(f.RKAP_LALU, 0) AS RKAP_LALU,
        IFNULL(g.RKAP_SKRG, 0) AS RKAP_SKRG,
        IFNULL(h.RKAP_SD_INI, 0) AS RKAP_SD_INI
        FROM ak_sub_grup_kode_akun a
        LEFT JOIN (
            SELECT c.KODE_GRUP, c.KODE_SUB, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_input_voucher a
            JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP, c.KODE_SUB
        ) b ON b.KODE_GRUP = a.KODE_GRUP AND b.KODE_SUB = a.KODE_SUB

        LEFT JOIN (
            SELECT c.KODE_GRUP, c.KODE_SUB, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_input_voucher a
            JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE STR_TO_DATE(a.TGL,'%d-%m-%Y') >= STR_TO_DATE('01-01-$tahun','%d-%m-%Y')  AND STR_TO_DATE(a.TGL,'%d-%m-%Y') < STR_TO_DATE('01-$bulan-$tahun','%d-%m-%Y') AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP, c.KODE_SUB
        ) c ON c.KODE_GRUP = a.KODE_GRUP AND c.KODE_SUB = a.KODE_SUB

        LEFT JOIN (
            SELECT c.KODE_GRUP, c.KODE_SUB,  SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_input_voucher a
            JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE STR_TO_DATE(a.TGL,'%d-%m-%Y') >= STR_TO_DATE('01-01-$tahun','%d-%m-%Y')  
            AND STR_TO_DATE(a.TGL,'%d-%m-%Y') < STR_TO_DATE('01-$bulan_depan-$tahun_depan','%d-%m-%Y') AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP, c.KODE_SUB
        ) d ON d.KODE_GRUP = a.KODE_GRUP AND d.KODE_SUB = a.KODE_SUB

        LEFT JOIN (
            SELECT c.KODE_GRUP, c.KODE_SUB,  SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_jurnal_penye a
            JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP, c.KODE_SUB
        ) bb ON bb.KODE_GRUP = a.KODE_GRUP AND bb.KODE_SUB = a.KODE_SUB

        LEFT JOIN (
            SELECT c.KODE_GRUP, c.KODE_SUB,  SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_jurnal_penye a
            JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE STR_TO_DATE(a.TGL,'%d-%m-%Y') >= STR_TO_DATE('01-01-$tahun','%d-%m-%Y')  AND STR_TO_DATE(a.TGL,'%d-%m-%Y') < STR_TO_DATE('01-$bulan-$tahun','%d-%m-%Y') AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP, c.KODE_SUB
        ) cc ON cc.KODE_GRUP = a.KODE_GRUP AND cc.KODE_SUB = a.KODE_SUB

        LEFT JOIN (
            SELECT c.KODE_GRUP, c.KODE_SUB,  SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_jurnal_penye a
            JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
            JOIN ak_kode_akuntansi c ON c.KODE_AKUN = b.KODE_AKUN AND a.UNIT = c.UNIT
            WHERE STR_TO_DATE(a.TGL,'%d-%m-%Y') >= STR_TO_DATE('01-01-$tahun','%d-%m-%Y')  
            AND STR_TO_DATE(a.TGL,'%d-%m-%Y') < STR_TO_DATE('01-$bulan_depan-$tahun_depan','%d-%m-%Y') AND a.UNIT = '$unit'
            GROUP BY c.KODE_GRUP, c.KODE_SUB
        ) dd ON dd.KODE_GRUP = a.KODE_GRUP AND dd.KODE_SUB = a.KODE_SUB

        LEFT JOIN (
            SELECT KODE_AKUN, TOTAL FROM ak_rkap
            WHERE TAHUN = '$tahun' AND UNIT = '$unit'
        ) e ON e.KODE_AKUN LIKE concat('%',a.KODE_GRUP, '.', a.KODE_SUB, '.','%')

        LEFT JOIN (
            SELECT KODE_AKUN, $sum_rkap_lalu AS RKAP_LALU FROM ak_rkap
            WHERE TAHUN = '$tahun_lalu' AND UNIT = '$unit'
        ) f ON f.KODE_AKUN LIKE concat('%',a.KODE_GRUP, '.', a.KODE_SUB, '.','%')

        LEFT JOIN (
            SELECT KODE_AKUN, $sum_rkap AS RKAP_SKRG FROM ak_rkap
            WHERE TAHUN = '$tahun' AND UNIT = '$unit'
        ) g ON g.KODE_AKUN LIKE concat('%',a.KODE_GRUP, '.', a.KODE_SUB, '.','%')

        LEFT JOIN (
            SELECT KODE_AKUN, $sum_rkap_sd_ini AS RKAP_SD_INI FROM ak_rkap
            WHERE TAHUN = '$tahun' AND UNIT = '$unit'
        ) h ON h.KODE_AKUN LIKE concat('%',a.KODE_GRUP, '.', a.KODE_SUB, '.','%')


        WHERE a.KODE_GRUP = '$kode_grup' AND a.UNIT = '$unit'
        ORDER BY a.ID
        ";

        return $this->db->query($sql)->result();
    }

    function get_kode_akun($kode_grup, $kode_sub, $unit, $bulan, $tahun, $bulan_depan, $tahun_depan){

        $bulan_lalu = $bulan - 1;
        $tahun_lalu = $tahun;

        if($bulan_lalu == 0){
            $bulan_lalu = 1;
        }

        $sum_rkap_lalu = $this->get_sum_rkap($bulan_lalu);
        $sum_rkap = $this->get_sum_rkap_skrg($bulan);
        $sum_rkap_sd_ini = $this->get_sum_rkap($bulan);


        $sql = "
        SELECT a.*, 
        IFNULL(IFNULL(b.DEBET, 0) + IFNULL(bb.DEBET,0), 0) AS DEBET,
        IFNULL(IFNULL(b.KREDIT, 0) + IFNULL(bb.KREDIT,0), 0) AS KREDIT,

        IFNULL(IFNULL(c.DEBET, 0) + IFNULL(cc.DEBET,0), 0) AS DEBET_LALU,
        IFNULL(IFNULL(c.KREDIT, 0) + IFNULL(cc.KREDIT,0), 0) AS KREDIT_LALU,

        IFNULL(IFNULL(d.DEBET, 0) + IFNULL(dd.DEBET,0), 0) AS DEBET_SD_INI,
        IFNULL(IFNULL(d.KREDIT, 0) + IFNULL(dd.KREDIT,0), 0) AS KREDIT_SD_INI,

        IFNULL(e.TOTAL, 0) AS TARGET,
        IFNULL(f.RKAP_LALU, 0) AS RKAP_LALU,
        IFNULL(g.RKAP_SKRG, 0) AS RKAP_SKRG,
        IFNULL(h.RKAP_SD_INI, 0) AS RKAP_SD_INI
        FROM ak_kode_akuntansi a
        LEFT JOIN (
            SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_input_voucher a
            JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
            WHERE a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'
            GROUP BY b.KODE_AKUN
        ) b ON b.KODE_AKUN = a.KODE_AKUN

        LEFT JOIN (
            SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_input_voucher a
            JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
            WHERE STR_TO_DATE(a.TGL,'%d-%m-%Y') >= STR_TO_DATE('01-01-$tahun','%d-%m-%Y')  AND STR_TO_DATE(a.TGL,'%d-%m-%Y') < STR_TO_DATE('01-$bulan-$tahun','%d-%m-%Y') AND a.UNIT = '$unit'
            GROUP BY b.KODE_AKUN
        ) c ON c.KODE_AKUN = a.KODE_AKUN

        LEFT JOIN (
            SELECT b.KODE_AKUN,  SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_input_voucher a
            JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
            WHERE STR_TO_DATE(a.TGL,'%d-%m-%Y') >= STR_TO_DATE('01-01-$tahun','%d-%m-%Y')  
            AND STR_TO_DATE(a.TGL,'%d-%m-%Y') < STR_TO_DATE('01-$bulan_depan-$tahun_depan','%d-%m-%Y') AND a.UNIT = '$unit'
            GROUP BY b.KODE_AKUN
        ) d ON d.KODE_AKUN = a.KODE_AKUN

        LEFT JOIN (
            SELECT b.KODE_AKUN,  SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_jurnal_penye a
            JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
            WHERE a.TGL LIKE '%-$bulan-$tahun%' AND a.UNIT = '$unit'
            GROUP BY b.KODE_AKUN
        ) bb ON bb.KODE_AKUN = a.KODE_AKUN

        LEFT JOIN (
            SELECT b.KODE_AKUN,  SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_jurnal_penye a
            JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
            WHERE STR_TO_DATE(a.TGL,'%d-%m-%Y') >= STR_TO_DATE('01-01-$tahun','%d-%m-%Y')  AND STR_TO_DATE(a.TGL,'%d-%m-%Y') < STR_TO_DATE('01-$bulan-$tahun','%d-%m-%Y') AND a.UNIT = '$unit'
            GROUP BY b.KODE_AKUN
        ) cc ON cc.KODE_AKUN = a.KODE_AKUN

        LEFT JOIN (
            SELECT b.KODE_AKUN,  SUM(b.DEBET) AS DEBET, SUM(b.KREDIT) AS KREDIT 
            FROM ak_jurnal_penye a
            JOIN ak_jurnal_penye_detail b ON a.NO_VOUCHER = b.NO_VOUCHER
            WHERE STR_TO_DATE(a.TGL,'%d-%m-%Y') >= STR_TO_DATE('01-01-$tahun','%d-%m-%Y')  
            AND STR_TO_DATE(a.TGL,'%d-%m-%Y') < STR_TO_DATE('01-$bulan_depan-$tahun_depan','%d-%m-%Y') AND a.UNIT = '$unit'
            GROUP BY b.KODE_AKUN
        ) dd ON dd.KODE_AKUN = a.KODE_AKUN

        LEFT JOIN (
            SELECT KODE_AKUN, TOTAL FROM ak_rkap
            WHERE TAHUN = '$tahun' AND UNIT = '$unit'
        ) e ON e.KODE_AKUN = a.KODE_AKUN

        LEFT JOIN (
            SELECT KODE_AKUN, $sum_rkap_lalu AS RKAP_LALU FROM ak_rkap
            WHERE TAHUN = '$tahun_lalu' AND UNIT = '$unit'
        ) f ON f.KODE_AKUN = a.KODE_AKUN

        LEFT JOIN (
            SELECT KODE_AKUN, $sum_rkap AS RKAP_SKRG FROM ak_rkap
            WHERE TAHUN = '$tahun' AND UNIT = '$unit'
        ) g ON g.KODE_AKUN = a.KODE_AKUN

        LEFT JOIN (
            SELECT KODE_AKUN, $sum_rkap_sd_ini AS RKAP_SD_INI FROM ak_rkap
            WHERE TAHUN = '$tahun' AND UNIT = '$unit'
        ) h ON h.KODE_AKUN = a.KODE_AKUN

        WHERE a.KODE_GRUP = '$kode_grup' AND a.KODE_SUB = '$kode_sub' AND a.UNIT = '$unit'
        ORDER BY a.ID
        ";

        return $this->db->query($sql)->result();
    }


	function get_list_akun_all($id_klien){
        $sql = "
        SELECT * FROM ak_kode_akuntansi WHERE ID_KLIEN = $id_klien
        ORDER BY KODE_AKUN
        ";

        return $this->db->query($sql)->result();
    }

    function get_sum_rkap($bulan){
        $get_sum = "";
        if($bulan == '01'){
            $get_sum = "(JANUARI)";
        } else if($bulan == '02'){
            $get_sum = "(JANUARI + FEBRUARI)";
        } else if($bulan == '03'){
            $get_sum = "(JANUARI + FEBRUARI + MARET)";
        } else if($bulan == '04'){
            $get_sum = "(JANUARI + FEBRUARI + MARET + APRIL)";
        } else if($bulan == '05'){
            $get_sum = "(JANUARI + FEBRUARI + MARET + APRIL + MEI)";
        } else if($bulan == '06'){
            $get_sum = "(JANUARI + FEBRUARI + MARET + APRIL + MEI + JUNI)";
        } else if($bulan == '07'){
            $get_sum = "(JANUARI + FEBRUARI + MARET + APRIL + MEI + JUNI + JULI)";
        } else if($bulan == '08'){
            $get_sum = "(JANUARI + FEBRUARI + MARET + APRIL + MEI + JUNI + JULI + AGUSTUS)";
        } else if($bulan == '09'){
            $get_sum = "(JANUARI + FEBRUARI + MARET + APRIL + MEI + JUNI + JULI + AGUSTUS + SEPTEMBER)";
        } else if($bulan == '10'){
            $get_sum = "(JANUARI + FEBRUARI + MARET + APRIL + MEI + JUNI + JULI + AGUSTUS + SEPTEMBER + OKTOBER)";
        } else if($bulan == '11'){
            $get_sum = "(JANUARI + FEBRUARI + MARET + APRIL + MEI + JUNI + JULI + AGUSTUS + SEPTEMBER + OKTOBER + NOVEMBER)";
        } else if($bulan == '12'){
            $get_sum = "(JANUARI + FEBRUARI + MARET + APRIL + MEI + JUNI + JULI + AGUSTUS + SEPTEMBER + OKTOBER + NOVEMBER + DESEMBER)";
        }

        return $get_sum;
    }

    function get_sum_rkap_skrg($bulan){
        $get_sum = "";
        if($bulan == '01'){
            $get_sum = "(JANUARI)";
        } else if($bulan == '02'){
            $get_sum = "(FEBRUARI)";
        } else if($bulan == '03'){
            $get_sum = "(MARET)";
        } else if($bulan == '04'){
            $get_sum = "(APRIL)";
        } else if($bulan == '05'){
            $get_sum = "(MEI)";
        } else if($bulan == '06'){
            $get_sum = "(JUNI)";
        } else if($bulan == '07'){
            $get_sum = "(JULI)";
        } else if($bulan == '08'){
            $get_sum = "(AGUSTUS)";
        } else if($bulan == '09'){
            $get_sum = "(SEPTEMBER)";
        } else if($bulan == '10'){
            $get_sum = "(OKTOBER)";
        } else if($bulan == '11'){
            $get_sum = "(NOVEMBER)";
        } else if($bulan == '12'){
            $get_sum = "(DESEMBER)";
        }

        return $get_sum;

    }
}

?>