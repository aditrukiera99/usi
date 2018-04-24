<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_departemen_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_depart($kode_depart,$nama_depart,$ass_depart)
	{
		$sql = "
			INSERT INTO master_departemen (
				kode_depart,
				nama_depart,
				ass_depart
			) VALUES (
				'$kode_depart',
				'$nama_depart',
				'$ass_depart'
			)";
		$this->db->query($sql);
	}

	function lihat_data_depart()
	{
		$sql = "
			SELECT * FROM master_departemen ";

		return $this->db->query($sql)->result();
	}

	function hapus_depart($id)
	{
		$sql = "DELETE FROM  master_departemen WHERE id_depart = '$id' " ;
		$this->db->query($sql);
	}

	function data_depart_id($id)
	{
		$sql = "SELECT * FROM master_departemen WHERE id_depart = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_data_depart($id,$kode_depart_modal,$nama_depart_modal,$ass_depart_modal)
	{
		$sql = "
			UPDATE master_departemen SET
				kode_depart  = '$kode_depart_modal',
				nama_depart  = '$nama_depart_modal',
				ass_depart  = '$ass_depart_modal'
			WHERE id_depart = '$id'
		";
		$this->db->query($sql);
	}
}
