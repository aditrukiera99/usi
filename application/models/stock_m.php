<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
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
        WHERE $where AND ID_KLIEN = $id_klien AND $where_unit AND TIPE != 'JASA'
        ORDER BY APPROVE ASC, ID DESC
        ";

        return $this->db->query($sql)->result();
    }


    function hapus_produk($id){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        if($user->LEVEL == 'USER'){
            $sql = "UPDATE ak_produk SET APPROVE = 2 WHERE ID = '$id'";
            $this->db->query($sql);
        } else {
            $sql = " DELETE FROM ak_produk WHERE ID = $id"; 
            $this->db->query($sql);
        }
    }

    function cari_produk_by_id($id){
        $sql = "
        SELECT * FROM ak_produk WHERE ID = $id
        ";

        return $this->db->query($sql)->row();
    }


    function simpan_produk($id_klien, $kode_produk, $nama_produk, $satuan, $deskripsi, $harga_jual, $harga_beli, $unit, $ppn, $pph, $service){

        if($satuan == "" || $satuan == null){
            $satuan = "-";
        }

        if($deskripsi == "" || $deskripsi == null){
            $deskripsi = "-";
        }

        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $approve = 3;
        if($user->LEVEL == 'USER'){
            $approve = 0;
        }


        $sql = "
        INSERT INTO ak_produk
        (ID_KLIEN, KODE_PRODUK, NAMA_PRODUK, SATUAN, DESKRIPSI, HARGA_JUAL, HARGA, APPROVE, UNIT, PPH, PPN, SERVICE)
        VALUES 
        ($id_klien, '$kode_produk', '$nama_produk', '$satuan', '$deskripsi', '$harga_jual', '$harga_beli', '$approve', '$unit', '$pph', '$ppn', '$service')
        ";

        $this->db->query($sql);
        return $this->db->insert_id();
    }

    function edit_produk($id_produk, $kode_produk_ed, $nama_produk_ed, $satuan_ed, $deskripsi_ed, $harga_jual, $harga_beli, $ppn_ed, $pph_ed, $service_ed){

        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $approve = 3;
        if($user->LEVEL == 'USER'){
            $approve = 1;
        }

        $sql = "
        UPDATE ak_produk SET 
        KODE_PRODUK = '$kode_produk_ed', NAMA_PRODUK = '$nama_produk_ed', SATUAN = '$satuan_ed', 
        DESKRIPSI = '$deskripsi_ed', HARGA = '$harga_beli', HARGA_JUAL = '$harga_jual', APPROVE = '$approve',
        PPN = '$ppn_ed', PPH = '$pph_ed', SERVICE = '$service_ed'
        WHERE ID = $id_produk
        ";

        $this->db->query($sql);
    }

    function get_penerimaan_item($id, $nama_produk){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $bulan = date('m');
        $tahun = date('Y');

        $sql = "
        SELECT ( IFNULL(a.TOTAL_1, 0) + IFNULL(a.TOTAL_2 ,0) ) AS TOTAL FROM (
        SELECT SUM(a.TOTAL_1) AS TOTAL_1, SUM(a.TOTAL_2) AS TOTAL_2 FROM (
        SELECT SUM(b.QTY) AS TOTAL_1, 0 AS TOTAL_2 FROM ak_pembelian_new a 
        JOIN ak_pembelian_new_detail b ON a.ID = b.ID_PENJUALAN
        WHERE b.NAMA_PRODUK = '$nama_produk' AND a.TGL_TRX LIKE '%-$bulan-$tahun%'

        UNION ALL 

        SELECT 0 AS TOTAL_1, SUM(JML_PRODUKSI) AS TOTAL_2 FROM ak_produksi_barang 
        WHERE ID_ITEM = '$id' AND TGL LIKE '%-$bulan-$tahun%'
        ) a
        ) a
        ";

        return $this->db->query($sql)->row();
    }

    function get_pengeluaran_item($id, $nama_produk){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $bulan = date('m');
        $tahun = date('Y');

        $sql = "
        SELECT IFNULL(TOTAL, 0) AS TOTAL FROM (
        SELECT SUM(b.QTY) AS TOTAL FROM ak_penjualan_new a 
        JOIN ak_penjualan_new_detail b ON a.ID = b.ID_PENJUALAN
        WHERE b.NAMA_PRODUK = '$nama_produk'  AND a.TGL_TRX LIKE '%-$bulan-$tahun%'
        ) a
        ";

        return $this->db->query($sql)->row();
    }

    function get_koreksi_item($id, $nama_produk){
        $sess_user = $this->session->userdata('masuk_akuntansi');
        $id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);

        $bulan = date('m');
        $tahun = date('Y');

        $sql = "
        SELECT ( IFNULL(a.TOTAL_1, 0) + IFNULL(a.TOTAL_2 ,0) ) AS TOTAL FROM (
        SELECT SUM(a.TOTAL_1) AS TOTAL_1, SUM(a.TOTAL_2) AS TOTAL_2 FROM (
        SELECT SUM(b.QTY_KOREKSI) AS TOTAL_1, 0 AS TOTAL_2 FROM ak_koreksi_persediaan a 
        JOIN ak_koreksi_persediaan_detail b ON a.ID = b.ID_KOREKSI
        WHERE b.ID_PRODUK = '$id' AND a.UNIT = '$user->UNIT' AND a.TGL LIKE '%-$bulan-$tahun%'

        UNION ALL 

        SELECT 0 AS TOTAL_1, SUM(b.QTY_FISIK - b.QTY_HAND) AS TOTAL_2 FROM ak_stock_opname a 
        JOIN ak_stock_opname_detail b ON a.ID = b.ID_OPNAME
        WHERE b.ID_PRODUK = '$id' AND a.UNIT = '$user->UNIT' AND a.TGL LIKE '%-$bulan-$tahun%'
        ) a
        ) a
        ";

        return $this->db->query($sql)->row();
    }

    function data_supplier(){
        $sql = "
        SELECT a.*, IFNULL(b.JML_BELI, 0) AS PENERIMAAN, IFNULL(c.JML_JUAL, 0) AS PENGELUARAN FROM ak_supplier a 
        LEFT JOIN (
            SELECT a.ID_PELANGGAN, b.ID_PRODUK, SUM(b.QTY) AS JML_BELI FROM ak_pembelian_new a 
            JOIN ak_pembelian_new_detail b ON a.ID = b.ID_PENJUALAN
            GROUP BY a.ID_PELANGGAN, b.ID_PRODUK
        ) b ON a.ID = b.ID_PELANGGAN

        LEFT JOIN (
            SELECT a.ID_PELANGGAN, b.ID_PRODUK, SUM(b.QTY) AS JML_JUAL FROM ak_penjualan_new a 
                        JOIN ak_penjualan_new_detail b ON a.ID = b.ID_PENJUALAN
            GROUP BY a.ID_PELANGGAN, b.ID_PRODUK
        ) c ON a.ID = c.ID_PELANGGAN

        
        ";
        return $this->db->query($sql)->result();
    }

    function data_supplier2(){
        $sql = "
        SELECT * FROM ak_supplier
        ORDER BY ID ASC        
        ";
        return $this->db->query($sql)->result();
    }

    function get_data_stok($id){
        $sql = "
        SELECT a.NAMA_PRODUK, IFNULL(SUM(JML_BELI),0) AS JML_BELI, IFNULL(SUM(JML_JUAL),0) AS JML_JUAL, SATUAN FROM (
            SELECT a.ID, a.SATUAN, a.NAMA_PRODUK, IFNULL(SUM(b.QTY), 0)  AS JML_BELI, 0 AS JML_JUAL FROM ak_produk a 
            LEFT JOIN ak_pembelian_new_detail b ON b.ID_PRODUK = a.ID
            LEFT JOIN ak_pembelian_new c ON c.ID = b.ID_PENJUALAN 
            WHERE c.ID_PELANGGAN = '$id'
            GROUP BY  a.ID, a.NAMA_PRODUK, a.SATUAN

            UNION ALL

            SELECT a.NAMA_PRODUK, a.ID, a.SATUAN, 0 AS JML_BELI, IFNULL(SUM(b.QTY), 0)  AS JML_JUAL FROM ak_produk a 
            LEFT JOIN ak_penjualan_new_detail b ON b.ID_PRODUK = a.ID 
            LEFT JOIN ak_penjualan_new c ON c.ID = b.ID_PENJUALAN 
            WHERE b.ID_SUPPLIER = '$id'
            GROUP BY  a.ID, a.NAMA_PRODUK, a.SATUAN
        ) a
        
        ";

        return $this->db->query($sql)->row();
    }


}

?>