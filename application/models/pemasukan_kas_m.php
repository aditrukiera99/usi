<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pemasukan_kas_m extends CI_Model
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
			SELECT a.*, b.nama_pelanggan, c.nama_divisi FROM tb_bukti_kas_masuk a 
			LEFT JOIN master_pelanggan b ON a.ID_PELANGGAN = b.id_pelanggan
			LEFT JOIN master_divisi c ON a.DEPARTEMEN = c.id_divisi
		";

		return $this->db->query($sql)->result();
	}

	function lihat_data_id($id){
		$sql = "
			SELECT a.* FROM tb_bukti_kas_masuk a
			WHERE a.ID = '$id'
		";

		return $this->db->query($sql)->row();
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

	function get_data_trx_detail($id){
    	$sql = "
        SELECT t.* , m.nama_pelanggan FROM tb_bukti_kas_masuk t , master_pelanggan m WHERE t.ID_PELANGGAN = m.id_pelanggan AND t.ID = '$id'
        ";

        return $this->db->query($sql)->row();
    }

}
