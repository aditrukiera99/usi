<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_invoice($no_invoice,$tanggal,$sales_order)
	{
		$sql = "
			INSERT INTO tb_invoice (
				no_invoice,
				tanggal,
				sales_order
			) VALUES (
				'$no_invoice',
				'$tanggal',
				'$sales_order'
			)";
		$this->db->query($sql);
	}

	function simpan_data_invoice_detail($id_invoice_baru,$id_produk,$nama_produk,$keterangan,$kuantitas,$harga,$total)
	{

		$kuantitas = str_replace('', '', $kuantitas);
		$harga 	   = str_replace('', '', $harga);
		$total 	   = str_replace('', '', $total);

		$sql = "
			INSERT INTO tb_invoice_detail (
				id_induk,
				id_produk,
				nama_produk,
				keterangan,
				kuantitas,
				harga,
				total
			) VALUES (
				'$id_invoice_baru',
				'$id_produk',
				'$nama_produk',
				'$keterangan',
				'$kuantitas',
				'$harga',
				'$total'
			)";
		$this->db->query($sql);
	}

	function lihat_data_invoice()
	{
		$sql = "
			SELECT * FROM tb_invoice ";

		return $this->db->query($sql)->result();
	}

	function hapus_invoice($id)
	{
		$sql = "DELETE FROM  tb_invoice WHERE id_invoice = '$id' " ;
		$this->db->query($sql);

		$sql2 = "DELETE FROM  tb_invoice_detail WHERE id_invoice = '$id' " ;
		$this->db->query($sql2);
	}

	function data_invoice_id($id)
	{
		$sql = "SELECT * FROM tb_invoice WHERE id_invoice = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function data_invoice_detail_id($id)
	{
		$sql = "SELECT * FROM tb_invoice_detail WHERE id_induk = '$id'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function ubah_data_invoice($id,$no_invoice,$tanggal,$sales_order)
	{
		$sql = "
			UPDATE tb_invoice SET
				no_invoice  	= '$no_invoice',
				tanggal 		= '$tanggal',
				sales_order		= '$sales_order'
			WHERE id_invoice   = '$id'
		";
		$this->db->query($sql);
	}

	function ubah_data_invoice_detail($id,$nama_produk,$keterangan,$kuantitas,$harga,$total)
	{
		$kuantitas = str_replace('', '', $kuantitas);
		$harga 	   = str_replace('', '', $harga);
		$total 	   = str_replace('', '', $total);
		
		$sql = "
			UPDATE tb_invoice_detail SET
				nama_produk = '$nama_produk',
				keterangan 	= '$keterangan',
				kuantitas 	= '$kuantitas',
				harga 		= '$harga',
				total 		= '$total'
			WHERE id_induk = '$id'
		";
		$this->db->query($sql);
	}

	function get_sales_detail($id_sales)
	{
		$sql = "SELECT * FROM tb_permintaan_barang WHERE id_permintaan = $id_sales";

		return $this->db->query($sql)->row();
	}

	function get_produk_detail($id_barang)
	{
		$sql = "SELECT * FROM master_barang WHERE id_barang = $id_barang";

		return $this->db->query($sql)->row();
	}

	function get_opb_detail($id_permintaan)
	{
		$sql = "SELECT * FROM tb_permintaan_barang WHERE id_permintaan = $id_permintaan";

		return $this->db->query($sql)->row();
	}
}
