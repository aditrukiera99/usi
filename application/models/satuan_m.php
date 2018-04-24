<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Satuan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_satuan($kode_satuan,$nama_satuan,$konversi,$satuan_utama,$tipe_satuan)
	{
		$sql = "
			INSERT INTO master_satuan (
				kode_satuan,
				nama_satuan,
				konversi,
				satuan_utama,
				tipe_satuan
			) VALUES (
				'$kode_satuan',
				'$nama_satuan',
				'$konversi',
				'$satuan_utama',
				'$tipe_satuan'
			)";
		$this->db->query($sql);
	}

	function lihat_data_satuan()
	{
		$sql = "
			SELECT * FROM master_satuan ";

		return $this->db->query($sql)->result();
	}

	function lihat_data_satuan_utama()
	{
		$sql = "
			SELECT * FROM master_satuan ";

		return $this->db->query($sql)->result();
	}

	function hapus_satuan($id)
	{
		$sql = "DELETE FROM  master_satuan WHERE id_satuan = '$id' " ;
		$this->db->query($sql);
	}

	function data_satuan_id($id)
	{
		$sql = "SELECT * FROM master_satuan WHERE id_satuan = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_data_satuan($id,$kode_satuan_modal,$nama_satuan_modal)
	{
		$sql = "
			UPDATE master_satuan SET
				kode_satuan  = '$kode_satuan_modal',
				nama_satuan  = '$nama_satuan_modal'
			WHERE id_satuan = '$id'
		";
		$this->db->query($sql);
	}
}
