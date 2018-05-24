<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_logistik_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

    function get_data_service_kendaraan(){
        $sql = "
        SELECT * FROM ak_order_logistik
        ORDER BY ID DESC
        ";

        return $this->db->query($sql)->result();
    }


    function hapus_kategori($id){
        
            $sql = " DELETE FROM ak_kendaraan WHERE ID = $id"; 
            $this->db->query($sql);
        
    }

    function cari_kendaraan_by_id($id){
        $sql = "
        SELECT * FROM ak_kendaraan WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx($id){
        $sql = "
        SELECT * FROM ak_order_logistik WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx_detail($id){
        $sql = "
        SELECT * FROM ak_order_logistik_detail WHERE NO_BUKTI = $id
        ";

        return $this->db->query($sql)->result();
    }

    function get_supplier_detail($id_pel){
        $sql = "
        SELECT * FROM ak_gudang WHERE ID = $id_pel
        ";

        return $this->db->query($sql)->row();
    }

    function simpan_order_logistik($id_supply_point, $nama, $tgl_trx, $no_order, $keterangan){
       
        $sql = "
        INSERT INTO ak_order_logistik
        (ID_SUPPLY_POINT,NAMA_POINT ,TGL_TRX ,NO_ORDER, KETERANGAN )
        VALUES 
        ('$id_supply_point', '$nama', '$tgl_trx', '$no_order','$keterangan')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function simpan_order_logistik_detail($id_produk, $nama_produk, $qty, $keterangan,$no_bukti){
        
        $sql = "
        INSERT INTO ak_order_logistik_detail
        (NO_BUKTI , ID_PRODUK , NAMA_PRODUK , QTY , KETERANGAN)
        VALUES 
        ('$no_bukti', '$id_produk', '$nama_produk', '$qty','$keterangan')
        ";

        $this->db->query($sql);
        
    }

    function save_next_nomor($id_klien, $tipe, $no_trx){
        $sql_del = "
        DELETE FROM ak_nomor WHERE TIPE = '$tipe' AND ID_KLIEN = $id_klien
        ";

        $this->db->query($sql_del);

        $sql = "
        INSERT INTO ak_nomor 
        (ID_KLIEN, TIPE, NEXT)
        VALUES 
        ($id_klien, '$tipe', $no_trx)
        ";

        $this->db->query($sql);
    }

    function edit_kendaraan($id_grup, $no_polisi, $merk, $tahun, $no_rangka, $no_mesin, $kapasitas, $sopir){
        

        $sql = "
        UPDATE ak_kendaraan SET 
            NOPOL = '$no_polisi', 
            MERK = '$merk',
            TAHUN = '$tahun',
            NORANGKA = '$no_rangka',
            NOMESIN = '$no_mesin',
            KAPASITAS = '$kapasitas',
            SOPIR = '$sopir'
        WHERE ID = '$id_grup'
        ";

        $this->db->query($sql);
    }

    function get_no_trx($id_klien){
        $sql = "
        SELECT * FROM ak_nomor WHERE ID_KLIEN = $id_klien AND TIPE = 'Order_barang'
        ";

        return $this->db->query($sql)->row();
    }

}

?>