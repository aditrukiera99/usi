<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_barang_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_kategori($kode_kategori,$nama_kategori)
	{
		$sql = "
			INSERT INTO master_kategori_barang (
				kode_kategori,
				nama_kategori
			) VALUES (
				'$kode_kategori',
				'$nama_kategori'
			)";
		$this->db->query($sql);
	}

	function lihat_data_kategori()
	{
		$sql = "
			SELECT * FROM master_kategori_barang ";

		return $this->db->query($sql)->result();
	}

	function hapus_kategori($id)
	{
		$sql = "DELETE FROM  master_kategori_barang WHERE id_kategori = '$id' " ;
		$this->db->query($sql);
	}

	function data_kategori_id($id)
	{
		$sql = "SELECT * FROM master_kategori_barang WHERE id_kategori = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_data_kategori($id,$kode_kategori_modal,$nama_kategori_modal)
	{
		$sql = "
			UPDATE master_kategori_barang SET
				kode_kategori  = '$kode_kategori_modal',
				nama_kategori  = '$nama_kategori_modal'
			WHERE id_kategori  = '$id'
		";
		$this->db->query($sql);
	}
}
