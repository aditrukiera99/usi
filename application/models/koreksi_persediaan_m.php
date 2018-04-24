<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Koreksi_persediaan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_koreksi($unit){
        $sql = "
        SELECT a.*, b.NAMA_AKUN FROM ak_koreksi_persediaan a
        LEFT JOIN ak_kode_akuntansi b ON a.KODE_AKUN = b.KODE_AKUN AND a.UNIT = b.UNIT
        WHERE a.UNIT = '$unit' 
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


    function get_no_koreksi(){
        $sql = "
        SELECT * FROM ak_nomor WHERE TIPE = 'Koreksi'
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_koreksi_persediaan($no_koreksi, $tipe, $tgl_trx, $no_ref, $catatan, $unit, $kode_akun){
        $sql = "
        INSERT INTO ak_koreksi_persediaan
        (NO_KOREKSI, TIPE, TGL, NO_REF, CATATAN, UNIT, KODE_AKUN)
        VALUES 
        ('$no_koreksi', '$tipe', '$tgl_trx', '$no_ref', '$catatan', '$unit', '$kode_akun')
        ";

        $this->db->query($sql);
    }

    function simpan_koreksi_persediaan_detail($id_koreksi, $id_produk, $qty, $harga_satuan, $unit){
        $qty                    = str_replace(',', '', $qty);
        $harga_satuan           = str_replace(',', '', $harga_satuan);

        $sql = "
        INSERT INTO ak_koreksi_persediaan_detail
        (ID_KOREKSI, ID_PRODUK, QTY_KOREKSI, HARGA_KOREKSI, UNIT)
        VALUES 
        ('$id_koreksi', '$id_produk', '$qty', '$harga_satuan', '$unit')
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

    function get_data_koreksi_detail($id_koreksi){
        $sql = "SELECT * FROM ak_koreksi_persediaan WHERE ID = '$id_koreksi'";
        return $this->db->query($sql)->row();
    }

    function get_data_koreksi_detail2($id_koreksi){
        $sql = "
        SELECT a.*, b.NAMA_PRODUK, b.DESKRIPSI, b.STOK, b.SATUAN, b.HARGA_JUAL
        FROM ak_koreksi_persediaan_detail a
        JOIN ak_produk b ON a.ID_PRODUK = b.ID
        WHERE a.ID_KOREKSI = '$id_koreksi'
        ";
        return $this->db->query($sql)->result();
    }

    function update_koreksi_persediaan($id_koreksi, $kode_akun, $tipe, $tgl_trx, $no_ref, $catatan){
        $sql = "
        UPDATE ak_koreksi_persediaan SET 
            KODE_AKUN = '$kode_akun',
            TIPE = '$tipe',
            TGL = '$tgl_trx',
            NO_REF = '$no_ref',
            CATATAN = '$catatan'
        WHERE ID = '$id_koreksi'
        ";

        $this->db->query($sql);
    }
}

?>