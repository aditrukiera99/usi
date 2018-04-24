<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_barang($kode_barang,$nama_barang,$id_satuan,$nama_satuan,$harga_jual,$harga_beli,$id_supplier,$nama_supplier,								  		$id_kategori,$nama_kategori,$src_image)
	{
		$sql = "
			INSERT INTO master_barang (
				kode_barang,
				nama_barang,
				id_satuan,
				nama_satuan,
				harga_jual,
				harga_beli,
				id_supplier,
				nama_supplier,
				id_kategori,
				nama_kategori,
				foto,
				stok
			) VALUES (
				'$kode_barang',
				'$nama_barang',
				'$id_satuan',
				'$nama_satuan',
				'$harga_jual',
				'$harga_beli',
				'$id_supplier',
				'$nama_supplier',
				'$id_kategori',
				'$nama_kategori',
				'$src_image',
				'0'
			)";
		$this->db->query($sql);
	}

	function lihat_data_barang()
	{
		$sql = "
			SELECT * FROM master_barang ";

		return $this->db->query($sql)->result();
	}

	function lihat_data_satuan()
	{
		$sql = "
			SELECT * FROM master_satuan ";

		return $this->db->query($sql)->result();
	}

	function lihat_data_supplier()
	{
		$sql = "
			SELECT * FROM master_supplier ";

		return $this->db->query($sql)->result();
	}

	function lihat_data_kategori()
	{
		$sql = "
			SELECT * FROM master_kategori_barang ";

		return $this->db->query($sql)->result();
	}

	function hapus_barang($id)
	{
		$sql = "DELETE FROM  master_barang WHERE id_barang = '$id' " ;
		$this->db->query($sql);
	}

	function data_barang_id($id)
	{
		$sql = "SELECT * FROM master_barang WHERE id_barang = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_data_barang($id,$kode_barang_modal,$nama_barang_modal,$id_satuan_modal,$nama_satuan_modal,$harga_jual_modal,
							  $harga_beli_modal,$id_supplier_modal,$nama_supplier_modal,$id_kategori_modal,$nama_kategori_modal)
	{
		$sql = "
			UPDATE master_barang SET
				kode_barang    = '$kode_barang_modal',
				nama_barang    = '$nama_barang_modal',
				id_satuan      = '$id_satuan_modal',
				nama_satuan    = '$nama_satuan_modal',
				harga_jual     = '$harga_jual_modal',
				harga_beli     = '$harga_beli_modal',
				id_supplier    = '$id_supplier_modal',
				nama_supplier  = '$nama_supplier_modal',
				id_kategori    = '$id_kategori_modal',
				nama_kategori  = '$nama_kategori_modal'
			WHERE id_barang  = '$id'
		";
		$this->db->query($sql);
	}
}
