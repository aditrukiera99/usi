<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_akun_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_kategori($id_klien,$nama_kategori,$deskripsi,$approve,$user_input,$tgl_input)
	{
		$sql = "
			INSERT INTO ak_kategori_akun (
				ID_KLIEN,
				NAMA_KATEGORI,
				DESKRIPSI,
				APPROVE,
				USER_INPUT,
				TGL_INPUT
			) VALUES (
				'$id_klien',
				'$nama_kategori',
				'$deskripsi',
				'$aprove',
				'$user_input',
				'$tgl_input'
			)";
		$this->db->query($sql);
	}

	function lihat_data_kategori()
	{
		$sql = "
			SELECT * FROM ak_kategori_akun ";

		return $this->db->query($sql)->result();
	}

	function hapus_kategori($id)
	{
		$sql = "DELETE FROM  ak_kategori_akun WHERE ID = '$id' " ;
		$this->db->query($sql);
	}

	function data_kategori_id($id)
	{
		$sql = "SELECT * FROM ak_kategori_akun WHERE ID = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_kategori_akun($id,$id_klien_modal,$nama_kategori_modal,$deskripsi_modal,$approve_modal,$user_input_modal,$tgl_input_modal)
	{
		$sql = "
			UPDATE ak_kategori_akun SET
				ID_KLIEN  	   = '$id_klien_modal',
				NAMA_KATEGORI  = '$nama_kategori_modal',
				DESKRIPSI  	   = '$deskripsi_modal',
				APPROVE  	   = '$approve_modal',
				USER_INPUT     = '$user_input_modal',
				TGL_INPUT 	   = '$tgl_input_modal'
			WHERE ID = '$id'
		";
		$this->db->query($sql);
	}
}
