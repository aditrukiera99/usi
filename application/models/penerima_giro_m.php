<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penerima_giro_m extends CI_Model
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

	function lihat_data()
	{
		$sql = "
			SELECT a.*, b.nama_pelanggan, c.nama_divisi FROM tb_penerimaan_giro_masuk a 
			LEFT JOIN master_pelanggan b ON a.ID_PELANGGAN = b.id_pelanggan 
			LEFT JOIN master_divisi c ON a.DEPARTEMEN = c.id_divisi
		";

		return $this->db->query($sql)->result();
	}

	function lihat_data_id($id){
		$sql = "
			SELECT a.*, b.nama_pelanggan FROM tb_penerimaan_giro_masuk a LEFT JOIN master_pelanggan b ON a.ID_PELANGGAN = b.id_pelanggan 
			WHERE a.ID = '$id'
		";

		return $this->db->query($sql)->row();
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

	function get_data_trx_detail($id){
    	$sql = "
        SELECT t.* , m.nama_pelanggan as NAMA_PELANGGAN  FROM tb_penerimaan_giro_masuk t , master_pelanggan m  WHERE t.ID_PELANGGAN = m.id_pelanggan AND ID = '$id'
        ";

        return $this->db->query($sql)->row();
    }
}
