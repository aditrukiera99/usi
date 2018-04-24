<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grub_kode_akuntansi_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_grub_kode_akun($grub,$kode_grub,$nama_grub,$unit,$approve)
	{
		$sql = "
			INSERT INTO ak_grup_kode_akun (
				GRUP,
				KODE_GRUP,
				NAMA_GRUP,
				UNIT,
				APPROVE
			) VALUES (
				'$grub',
				'$kode_grub',
				'$nama_grub',
				'$unit',
				'$approve'
			)";
		$this->db->query($sql);
	}

	function lihat_data_akun()
	{
		$sql = "
			SELECT * FROM ak_grup_kode_akun ";

		return $this->db->query($sql)->result();
	}

	function hapus_grub_kode_akun($id)
	{
		$sql = "DELETE FROM  ak_grup_kode_akun WHERE ID = '$id' " ;
		$this->db->query($sql);
	}

	function data_grub_kode_akun_id($id)
	{
		$sql = "SELECT * FROM ak_grup_kode_akun WHERE ID = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_data_grub_kode_akun($id,$grub_modal,$kode_grub_modal,$nama_grub_modal,$unit_modal,$approve_modal)
	{
		$sql = "
			UPDATE ak_grup_kode_akun SET
				GRUP   	   = '$grub_modal',
				KODE_GRUP  = '$kode_grub_modal',
				NAMA_GRUP  = '$nama_grub_modal',
				UNIT  	   = '$unit_modal',
				APPROVE    = '$approve_modal'
			WHERE ID = '$id'
		";
		$this->db->query($sql);
	}
}
