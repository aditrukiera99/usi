<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kode_akuntansi_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_kode_akun($kode_akun,$nama_akun,$tipe,$kategori,$deskripsi,$level,$anak_dari,
								   $id_klien,$approve,$user_input,$tgl_input,$kode_grup,$kode_sub,$unit)
	{
		$sql = "
			INSERT INTO ak_kode_akuntansi (
				KODE_AKUN,
				NAMA_AKUN,
				TIPE,
				KATEGORI,
				DESKRIPSI,
				LEVEL,
				ANAK_DARI,
				ID_KLIEN,
				APPROVE,
				USER_INPUT,
				TGL_INPUT,
				KODE_GRUP,
				KODE_SUB,
				UNIT
			) VALUES (
				'$kode_akun',
				'$nama_akun',
				'$tipe',
				'$kategori',
				'$deskripsi',
				'$level',
				'$anak_dari',
				'$id_klien',
				'$approve',
				'$user_input',
				'$tgl_input',
				'$kode_grup',
				'$kode_sub',
				'$unit'
			)";
		$this->db->query($sql);
	}

	function lihat_data_kode_akun()
	{
		$sql = "
			SELECT * FROM ak_kode_akuntansi ";

		return $this->db->query($sql)->result();
	}

	function hapus_kode_akun($id)
	{
		$sql = "DELETE FROM  ak_kode_akuntansi WHERE ID = '$id' " ;
		$this->db->query($sql);
	}

	function data_kode_akun_id($id)
	{
		$sql = "SELECT * FROM ak_kode_akuntansi WHERE ID = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_kode_akun($id,$kode_akun_modal,$nama_akun_modal,$tipe_modal,$kategori_modal,$deskripsi_modal,$level_modal,$anak_dari_modal,
							$id_klien_modal,$approve_modal,$user_input_modal,$tgl_input_modal,$kode_grup_modal,$kode_sub_modal,$unit_modal)
	{
		$sql = "
			UPDATE ak_kode_akuntansi SET
				KODE_AKUN   = '$kode_akun_modal',
				NAMA_AKUN   = '$nama_akun_modal',
				TIPE  		= '$tipe_modal',
				KATEGORI  	= '$kategori_modal',
				DESKRIPSI  	= '$deskripsi_modal',
				LEVEL  		= '$level_modal',
				ANAK_DARI  	= '$anak_dari_modal',
				ID_KLIEN  	= '$id_klien_modal',
				APPROVE  	= '$approve_modal',
				USER_INPUT  = '$user_input_modal',
				TGL_INPUT  	= '$tgl_input_modal',
				KODE_GRUP  	= '$kode_grup_modal',
				KODE_SUB  	= '$kode_sub_modal',
				UNIT  		= '$unit_modal'
			WHERE ID = '$id'
		";
		$this->db->query($sql);
	}

	function lihat_data_grup(){
		$sql = "SELECT * FROM ak_grup_kode_akun";
		$query = $this->db->query($sql);
		return $query->result();
	}
}
