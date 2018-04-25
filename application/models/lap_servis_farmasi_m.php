<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_servis_farmasi_m extends CI_Model
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

    function get_lap_penjualan2($id_klien, $tgl_awal, $tgl_akhir, $unit){
        $sql = "      
        SELECT a.*, IFNULL(b.TOTAL_QTY,0) AS TOTAL_QTY FROM ak_produk a 
        LEFT JOIN (
            SELECT SUM(b.QTY) AS TOTAL_QTY, b.NAMA_PRODUK FROM ak_penjualan a 
            JOIN ak_penjualan_detail b ON a.ID = b.ID_PENJUALAN
            WHERE STR_TO_DATE(a.TGL_TRX, '%d-%c-%Y') <= STR_TO_DATE('$tgl_akhir' , '%d-%c-%Y') AND STR_TO_DATE(a.TGL_TRX, '%d-%c-%Y') >= STR_TO_DATE('$tgl_awal' , '%d-%c-%Y') 
            GROUP BY b.NAMA_PRODUK
        ) b ON a.NAMA_PRODUK = b.NAMA_PRODUK
        WHERE a.TIPE = 'JASA' AND a.UNIT = '$unit'
        ";

        return $this->db->query($sql)->result();
    }

    function get_lap_penjualan($id_klien, $tgl_awal, $tgl_akhir, $unit){
        $sql = "      
        SELECT a.TGL_TRX, a.JATUH_TEMPO, a.NO_BUKTI, a.NO_DO, a.NO_POL, a.BROKER, a.PELANGGAN, a.ALAMAT_TUJUAN, SUM(b.QTY) AS QTY, b.MODAL, b.HARGA_JUAL, b.HARGA_INVOICE, b.PAJAK, b.CASHBACK, b.PROFIT, c.SATUAN
        FROM ak_penjualan_new a 
        JOIN ak_penjualan_new_detail b ON a.ID = b.ID_PENJUALAN
        JOIN ak_produk c ON b.ID_PRODUK = c.ID
        WHERE STR_TO_DATE(a.TGL_TRX, '%d-%c-%Y') <= STR_TO_DATE('$tgl_akhir' , '%d-%c-%Y') AND STR_TO_DATE(a.TGL_TRX, '%d-%c-%Y') >= STR_TO_DATE('$tgl_awal' , '%d-%c-%Y') 
        GROUP BY a.TGL_TRX, a.JATUH_TEMPO, a.NO_BUKTI, a.NO_DO, a.NO_POL, a.BROKER, a.PELANGGAN, a.ALAMAT_TUJUAN, b.MODAL, b.HARGA_JUAL, b.HARGA_INVOICE, b.PAJAK, b.CASHBACK, b.PROFIT, c.SATUAN
        ";

        return $this->db->query($sql)->result();
    }

    function get_lap_penjualan_bulanan($id_klien, $bulan, $tahun, $unit){

        $sql = "      
        SELECT a.TGL_TRX, a.JATUH_TEMPO, a.NO_BUKTI, a.NO_DO, a.NO_POL, a.BROKER, a.PELANGGAN, a.ALAMAT_TUJUAN, SUM(b.QTY) AS QTY, b.MODAL, b.HARGA_JUAL, b.HARGA_INVOICE, b.PAJAK, b.CASHBACK, b.PROFIT, c.SATUAN
        FROM ak_penjualan_new a 
        JOIN ak_penjualan_new_detail b ON a.ID = b.ID_PENJUALAN
        JOIN ak_produk c ON b.ID_PRODUK = c.ID
        WHERE a.TGL_TRX LIKE '%-$bulan-$tahun%' 
        GROUP BY a.TGL_TRX, a.JATUH_TEMPO, a.NO_BUKTI, a.NO_DO, a.NO_POL, a.BROKER, a.PELANGGAN, a.ALAMAT_TUJUAN, b.MODAL, b.HARGA_JUAL, b.HARGA_INVOICE, b.PAJAK, b.CASHBACK, b.PROFIT, c.SATUAN
        ";

        return $this->db->query($sql)->result();
    }
}

?>