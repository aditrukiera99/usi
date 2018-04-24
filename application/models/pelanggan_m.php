<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelanggan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_pelanggan($kode_pelanggan,$nama_pelanggan,$alamat_pelanggan,$telp,$email,$npwp)
	{
		$sql = "
			INSERT INTO master_pelanggan (
				kode_pelanggan,
				nama_pelanggan,
				alamat_pelanggan,
				telp,
				email,
				npwp
			) VALUES (
				'$kode_pelanggan',
				'$nama_pelanggan',
				'$alamat_pelanggan',
				'$telp',
				'$email',
				'$npwp'
			)";
		$this->db->query($sql);
	}

	function lihat_data_pelanggan()
	{
		$sql = "
			SELECT * FROM master_pelanggan ";

		return $this->db->query($sql)->result();
	}

	function hapus_pelanggan($id)
	{
		$sql = "DELETE FROM  master_pelanggan WHERE id_pelanggan = '$id' " ;
		$this->db->query($sql);
	}

	function data_pelanggan_id($id)
	{
		$sql = "SELECT * FROM master_pelanggan WHERE id_pelanggan = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_data_pelanggan($id,$kode_pelanggan_modal,$nama_pelanggan_modal,$alamat_pelanggan_modal,$telp_modal,$email_modal,$npwp_modal)
	{
		$sql = "
			UPDATE master_pelanggan SET
				kode_pelanggan 	 = '$kode_pelanggan_modal',
				nama_pelanggan   = '$nama_pelanggan_modal',
				alamat_pelanggan = '$alamat_pelanggan_modal',
				telp  			 = '$telp_modal',
				email 			 = '$email_modal',
				npwp  			 = '$npwp_modal'
			WHERE id_pelanggan = '$id'
		";
		$this->db->query($sql);
	}
}
