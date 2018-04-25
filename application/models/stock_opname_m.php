<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_opname_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_opname($unit){
        $sql = "
        SELECT a.*, b.NAMA_AKUN FROM ak_stock_opname a
        LEFT JOIN ak_kode_akuntansi b ON a.KODE_AKUN = b.KODE_AKUN AND a.UNIT = b.UNIT
        WHERE a.UNIT = '$unit' 
        ORDER BY a. ID DESC 
        ";
        return $this->db->query($sql)->result();
    }

    function get_lap_data_opname($unit, $bulan, $tahun){
        $sql = "
        SELECT a.* FROM ak_stock_opname a
        WHERE a.UNIT = '$unit' AND a.TGL LIKE '%-$bulan-$tahun%'
        ORDER BY a. ID DESC 
        ";
        return $this->db->query($sql)->result();
    }

    function get_data_produk($keyword, $id_klien){

        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);
        $where_unit = "1=1";
        if($user->LEVEL == "ADMIN"){
            $where_unit = "1=1";
        } else {
            $where_unit = "UNIT = ".$user->UNIT;
        }

        $where = "1=1";
        if($keyword != "" || $keyword != null){
            $where = $where." AND (NAMA_PRODUK LIKE '%$keyword%' OR KODE_PRODUK LIKE '%$keyword%' ) ";
        }

        $sql = "
        SELECT * FROM ak_produk
        WHERE $where AND ID_KLIEN = $id_klien AND $where_unit
        ORDER BY APPROVE ASC, ID DESC
        ";

        return $this->db->query($sql)->result();
    }

    function cari_produk_by_id($id){
        $sql = "
        SELECT * FROM ak_produk WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }


    function get_no_opname(){
        $sql = "
        SELECT * FROM ak_nomor WHERE TIPE = 'Stock Opname'
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_stock_opname($no_stock_opname, $tipe, $tgl_trx, $no_ref, $catatan, $unit, $kode_akun){
        $sql = "
        INSERT INTO ak_stock_opname
        (NO_OPNAME, TIPE, TGL, NO_REF, CATATAN, UNIT, KODE_AKUN)
        VALUES 
        ('$no_stock_opname', '$tipe', '$tgl_trx', '$no_ref', '$catatan', '$unit', '$kode_akun')
        ";

        $this->db->query($sql);
    }

    function simpan_stock_opname_detail($id_opname, $id_produk, $qty, $harga_satuan, $qty_fisik, $harga_satuan_fisik, $qty_selisih, $harga_satuan_selisih, $unit, $kode_akun_det){
        $qty                    = str_replace(',', '', $qty);
        $harga_satuan           = str_replace(',', '', $harga_satuan);
        $qty_fisik              = str_replace(',', '', $qty_fisik);
        $harga_satuan_fisik     = str_replace(',', '', $harga_satuan_fisik);
        $qty_selisih            = str_replace(',', '', $qty_selisih);
        $harga_satuan_selisih   = str_replace(',', '', $harga_satuan_selisih);

        $sql = "
        INSERT INTO ak_stock_opname_detail
        (ID_OPNAME, ID_PRODUK, QTY_HAND, HARGA_HAND, QTY_FISIK, HARGA_FISIK, SELISIH_QTY, SELISIH_HARGA, UNIT, KODE_AKUN)
        VALUES 
        ('$id_opname', '$id_produk', '$qty', '$harga_satuan', '$qty_fisik', '$harga_satuan_fisik', '$qty_selisih', '$harga_satuan_selisih', '$unit', '$kode_akun_det')
        ";

        $this->db->query($sql);

    }

    function save_next_nomor($tipe, $no_trx){
        $sql_del = "
        DELETE FROM ak_nomor WHERE TIPE = '$tipe'
        ";

        $this->db->query($sql_del);

        $sql = "
        INSERT INTO ak_nomor 
        (ID_KLIEN, TIPE, NEXT)
        VALUES 
        ('13', '$tipe', $no_trx)
        ";

        $this->db->query($sql);
    }

    function update_produk($id_produk, $qty_fisik, $harga_satuan_fisik){
        $qty_fisik              = str_replace(',', '', $qty_fisik);
        $harga_satuan_fisik     = str_replace(',', '', $harga_satuan_fisik);

        $sql = "
        UPDATE ak_produk SET 
        STOK = '$qty_fisik',
        HARGA_JUAL = '$harga_satuan_fisik'
        WHERE ID = '$id_produk'
        ";

        $this->db->query($sql);
    }

    function get_data_opname_id($id){
        $sql = "
        SELECT * FROM ak_stock_opname WHERE ID = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_opname_detail_id($id){
        $sql = "
        SELECT a.*, b.STOK, b.HARGA_JUAL, b.NAMA_PRODUK FROM ak_stock_opname_detail a
        JOIN ak_produk b ON a.ID_PRODUK = b.ID
        WHERE a.ID_OPNAME = '$id'
        ";

        return $this->db->query($sql)->result();
    }

    function ubah_stock_opname($id_opname, $no_stock_opname, $tipe, $tgl_trx, $no_ref, $catatan, $kode_akun){
        $sql = "
        UPDATE ak_stock_opname SET 
            NO_OPNAME = '$no_stock_opname',
            TIPE = '$tipe',
            TGL = '$tgl_trx',
            NO_REF = '$no_ref',
            CATATAN = '$catatan',
            KODE_AKUN = '$kode_akun'
        WHERE ID = '$id_opname'
        ";

        $this->db->query($sql);
    }

}

?>