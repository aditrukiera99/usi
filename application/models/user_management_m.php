<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_management_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_user_management($tipe_user_management,$nama_user,$username,$password,$departemen)
	{
		$sql = "
			INSERT INTO tb_user (
				level,
				nama_user,
				username,
				password,
				departemen
				
			) VALUES (
				'$tipe_user_management',
				'$nama_user',
				'$username',
				'$password',
				'$departemen'
			)";
		$this->db->query($sql);
	}

	function lihat_data_user_management()
	{
		$sql = "
			SELECT t.* , m.nama_divisi FROM tb_user t , master_divisi m WHERE t.departemen = m.id_divisi ";

		return $this->db->query($sql)->result();
	}

	function lihat_data_nama_user()
	{
		$sql = "
			SELECT * FROM tb_user ";

		return $this->db->query($sql)->result();
	}

	function lihat_data_divisi()
	{
		$sql = "
			SELECT * FROM master_divisi ";

		return $this->db->query($sql)->result();
	}

	function hapus_user_management($id)
	{
		$sql = "DELETE FROM  tb_user WHERE id = '$id' " ;
		$this->db->query($sql);
	}

	function data_user_management_id($id)
	{
		$sql = "SELECT * FROM tb_user WHERE id = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_data_user_management($id,$username_modal,$password_modal)
	{
		$sql = "
			UPDATE tb_user SET
				username  = '$username_modal',
				password  = '$password_modal'
			WHERE id = '$id'
		";
		$this->db->query($sql);
	}
}
