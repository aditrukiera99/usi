<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_penerimaan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_laporan($no_lpb,$tanggal,$no_po,$diterima)
	{
		$sql = "
			INSERT INTO tb_laporan_penerimaan (
				no_lpb,
				tanggal,
				no_po,
				diterima,
				status
			) VALUES (
				'$no_lpb',
				'$tanggal',
				'$no_po',
				'$diterima',
				'0'
			)";
		$this->db->query($sql);
	}

	function simpan_data_laporan_detail($id_laporan_baru,$id_produk,$nama_produk,$keterangan,$kuantitas,$harga,$total,$no_opb)
	{
		$kuantitas 	= str_replace(',', '', $kuantitas);
		$harga 		= str_replace(',', '', $harga);
		$total 		= str_replace(',', '', $total);

		$sql = "
			INSERT INTO tb_laporan_penerimaan_detail (
				id_induk,
				id_produk,
				nama_produk,
				keterangan,
				kuantitas,
				harga,
				total,
				no_po
			)	VALUES (
				'$id_laporan_baru',
				'$id_produk',
				'$nama_produk',
				'$keterangan',
				'$kuantitas',
				'$harga',
				'$total',
				'$no_opb'
		)";
		$this->db->query($sql);
	}

	function lihat_data_laporan()
	{
		$sql = "
			SELECT * FROM tb_laporan_penerimaan ";

		return $this->db->query($sql)->result();
	}

	function lihat_data_divisi()
	{
		$sql = "
			SELECT * FROM master_divisi ";

		return $this->db->query($sql)->result();
	}


	function hapus_laporan($id)
	{
		$sql = "UPDATE tb_laporan_penerimaan SET status = '1' WHERE id_laporan = '$id' " ;
		$this->db->query($sql);
		
		// $sql = "DELETE FROM  tb_laporan_penerimaan WHERE id_laporan = '$id' " ;
		// $this->db->query($sql);
	}

	function data_laporan_id($id)
	{
		$sql = "SELECT * FROM tb_laporan_penerimaan WHERE id_laporan = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_data_laporan($id,$no_lpb,$tanggal,$no_po,$diterima)
	{
		$sql = "
			UPDATE tb_laporan_penerimaan SET
				no_lpb  	  = '$no_lpb',
				tanggal 	  = '$tanggal',
				no_po  		  = '$no_po',
				diterima  	  = '$diterima'
			WHERE id_laporan  = '$id'
		";
		$this->db->query($sql);
	}

	function ubah_data_laporan_detail($id,$id_produk,$nama_produk,$keterangan,$kuantitas,$harga,$total,$no_opb)
	{
		$kuantitas 	= str_replace(',', '', $kuantitas);
		$harga 		= str_replace(',', '', $harga);
		$total 		= str_replace(',', '', $total);
		
		$sql = "
			UPDATE tb_laporan_penerimaan_detail SET
				id_produk 	  = '$id_produk',
				nama_produk   = '$nama_produk',
				keterangan    = '$keterangan',
				kuantitas  	  = '$kuantitas',
				harga  	  	  = '$harga',
				total  	  	  = '$total',
				no_opb  	  = '$no_opb'
			WHERE id_laporan  = '$id'
		";
		$this->db->query($sql);
	}

	function get_po_detail($id_purchase)
	{
		$sql = "SELECT * FROM tb_purchase_order WHERE id_purchase = $id_purchase";

		return $this->db->query($sql)->row();
	}

	function get_produk_detail($id_barang){
		
        $sql = " SELECT * FROM master_barang WHERE id_barang = $id_barang  ";

        return $this->db->query($sql)->row();
    }

    function get_transaction_info($id_barang){
        $sql = "
        SELECT pbd.id as id_peminjaman_detail, pbd.nama_produk , pb.no_po , pbd.kuantitas , pbd.penerimaan , pbd.harga , pbd.id_produk FROM tb_purchase_order pb , tb_purchase_order_detail pbd WHERE pb.id_purchase = pbd.id_induk AND pb.divisi = '$id_barang'
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_trx($id){
    	$sql = "
        SELECT * FROM tb_laporan_penerimaan WHERE id_laporan = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx_detail($id){
    	$sql = "
        SELECT lp.* , mb.nama_satuan , mb.kode_barang FROM tb_laporan_penerimaan_detail lp , master_barang mb WHERE mb.id_barang = lp.id_produk AND lp.id_induk = '$id'
        ";

        return $this->db->query($sql)->result();
    }
}
