<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_penjualan_m extends CI_Model
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

    function get_lap_penjualan($id_klien, $tgl_awal, $tgl_akhir, $unit){
        $sql = "      
        SELECT a.ID, a.TGL_TRX, a.NO_BUKTI, a.PELANGGAN, b.NAMA_PRODUK, b.QTY, b.MODAL, b.HARGA_JUAL, c.SATUAN,  c.HARGA AS HARGA_BELI FROM ak_penjualan_new a 
        JOIN ak_penjualan_new_detail b ON a.ID = b.ID_PENJUALAN
        JOIN ak_produk c ON b.NAMA_PRODUK = c.NAMA_PRODUK
        WHERE STR_TO_DATE(a.TGL_TRX, '%d-%c-%Y') <= STR_TO_DATE('$tgl_akhir' , '%d-%c-%Y') AND STR_TO_DATE(a.TGL_TRX, '%d-%c-%Y') >= STR_TO_DATE('$tgl_awal' , '%d-%c-%Y') 
        ORDER BY a.ID ASC
        ";

        return $this->db->query($sql)->result();
    }

    function get_lap_penjualan_bulanan($id_klien, $bulan, $tahun, $unit){
        $sql = "
        SELECT a.ID, a.TGL_TRX, a.NO_BUKTI, a.PELANGGAN, b.NAMA_PRODUK, b.QTY, b.MODAL, b.HARGA_JUAL, c.SATUAN,  c.HARGA AS HARGA_BELI FROM ak_penjualan_new a 
        JOIN ak_penjualan_new_detail b ON a.ID = b.ID_PENJUALAN
        JOIN ak_produk c ON b.NAMA_PRODUK = c.NAMA_PRODUK
        WHERE a.TGL_TRX LIKE '%-$bulan-$tahun%' 
        ORDER BY a.ID ASC
        ";

        return $this->db->query($sql)->result();
    }
}

?>