<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jurnal_sementara_m extends CI_Model
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
			SELECT a.*, c.nama_divisi FROM ak_input_voucher a 
			LEFT JOIN master_divisi c ON a.DEPARTEMEN = c.id_divisi
			WHERE a.TIPE = 'JS'
		";

		return $this->db->query($sql)->result();
	}

	function lihat_data_id($id){
		$sql = "
			SELECT a.* FROM ak_input_voucher a
			WHERE a.ID = '$id'
		";

		return $this->db->query($sql)->row();
	}

	function lihat_data_detail_id($id){
		$sql = "
			SELECT a.* FROM ak_input_voucher_detail a
			WHERE a.ID_VOUCHER = '$id'
		";

		return $this->db->query($sql)->result();
	}

	function get_data_bukti($keyword){
		$sql = "
			SELECT a.* FROM tb_perintah_bayar_nota a
			WHERE NO_BUKTI LIKE '%$keyword%'
		";

		return $this->db->query($sql)->result();
	}

	function get_data_bukti_detail($id){
		$sql = "
			SELECT a.* FROM tb_perintah_bayar_nota a
			WHERE a.ID = '$id'
		";

		return $this->db->query($sql)->row();
	}

	function save_akuntansi($id_voucher, $no_bukti, $tgl, $kode_akun, $debet, $kredit, $keterangan){
		$debet = str_replace(',', '', $debet);
		$kredit = str_replace(',', '', $kredit);
		$keterangan = addslashes($keterangan);

		if($debet == ""){
			$debet = 0;
		}

		if($kredit == ""){
			$kredit = 0;
		}

		$sql = "
		INSERT INTO ak_input_voucher_detail
		(ID_VOUCHER, NO_BUKTI, KODE_AKUN, DEBET, KREDIT, TGL, KETERANGAN, TIPE)
		VALUES 
		('$id_voucher', '$no_bukti', '$kode_akun', '$debet', '$kredit', '$tgl', '$keterangan', 'JS')
		";

		 $this->db->query($sql);
	}

}
