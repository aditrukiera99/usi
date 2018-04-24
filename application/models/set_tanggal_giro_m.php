<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Set_tanggal_giro_m extends CI_Model
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
			SELECT a.*, c.nama_divisi FROM tb_pengeluaran_giro a 
			LEFT JOIN master_divisi c ON a.DEPARTEMEN = c.id_divisi
		";

		return $this->db->query($sql)->result();
	}

	function lihat_data_id($id){
		$sql = "
			SELECT a.* FROM tb_pengeluaran_giro a
			WHERE a.ID = '$id'
		";

		return $this->db->query($sql)->row();
	}

	function get_data_bukti($keyword){
		$sql = "
			SELECT a.*, b.nama_supplier FROM tb_pengeluaran_giro a
			LEFT JOIN master_supplier b ON a.ID_SUPPLIER = b.id_supplier
			WHERE a.NO_BUKTI LIKE '%$keyword%' AND a.TGL_CAIR IS NULL
		";

		return $this->db->query($sql)->result();
	}

	function get_data_bukti_detail($id){
		$sql = "
			SELECT a.* FROM tb_pengeluaran_giro a
			WHERE a.ID = '$id'
		";

		return $this->db->query($sql)->row();
	}

	function save_akuntansi($no_bukti, $tgl, $kode_akun, $debet, $kredit, $keterangan){
		$debet = str_replace(',', '', $debet);
		$kredit = str_replace(',', '', $kredit);
		$keterangan = addslashes($keterangan);

		$sql = "
		INSERT INTO ak_input_voucher_lainnya
		(NO_BUKTI, KODE_AKUN, DEBET, KREDIT, TGL, KETERANGAN)
		VALUES 
		('$no_bukti', '$kode_akun', '$debet', '$kredit', '$tgl', '$keterangan')
		";

		 $this->db->query($sql);
	}

}
