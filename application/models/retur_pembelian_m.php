<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Retur_pembelian_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_retur($no_retur,$tanggal,$no_po,$diterima)
	{
		$sql = "
			INSERT INTO tb_retur_pembelian (
				no_retur,
				tanggal,
				no_po,
				diterima
			) VALUES (
				'$no_retur',
				'$tanggal',
				'$no_po',
				'$diterima'
			)";
		$this->db->query($sql);
	}

	function simpan_data_retur_detail($id_retur_baru,$id_produk,$nama_produk,$keterangan,$kuantitas,$harga,$total,$no_opb)
	{
		$sql = "
			INSERT INTO tb_retur_pembelian_detail (
				id_induk,
				id_produk,
				nama_produk,
				keterangan,
				kuantitas,
				harga,
				total
			) VALUES (
				'$id_retur_baru',
				'$id_produk',
				'$nama_produk',
				'$keterangan',
				'$kuantitas',
				'$harga',
				'$total'
			)";
		$this->db->query($sql);
	}

	function lihat_data_retur()
	{
		$sql = "
			SELECT * FROM tb_retur_pembelian ";

		return $this->db->query($sql)->result();
	}

	function hapus_retur($id)
	{
		$sql = "DELETE FROM  tb_retur_pembelian WHERE id_retur = '$id' " ;
		$this->db->query($sql);
	}

	function data_retur_id($id)
	{
		$sql = "SELECT * FROM tb_retur_pembelian WHERE id_retur = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_data_retur($id,$no_retur,$tanggal,$no_po,$diterima)
	{
		$sql = "
			UPDATE tb_retur_pembelian SET
				no_retur  	  = '$no_retur',
				tanggal 	  = '$tanggal',
				no_po  		  = '$no_po',
				diterima  	  = '$diterima'
			WHERE id_retur  = '$id'
		";
		$this->db->query($sql);
	}

	function ubah_data_retur_detail($id,$nama_produk,$keterangan,$kuantitas,$harga,$total,$no_opb)
	{
		$sql = "
			UPDATE tb_retur_pembelian SET
				nama_produk = '$nama_produk',
				keterangan 	= '$keterangan',
				kuantitas  	= '$kuantitas',
				harga  	  	= '$harga',
				total  	  	= '$total',
				no_opb  	= '$no_opb'
			WHERE id_induk  = '$id'
		";
		$this->db->query($sql);
	}

	function get_po_detail($id_purchase)
	{
		$sql = "SELECT * FROM tb_purchase_order WHERE id_purchase = $id_purchase";

		return $this->db->query($sql)->row();
	}

	function get_produk_detail($id_permintaan){
        $sql = "
        SELECT * FROM tb_permintaan_barang WHERE id_permintaan = $id_permintaan
        ";

        return $this->db->query($sql)->row();
    }
}
