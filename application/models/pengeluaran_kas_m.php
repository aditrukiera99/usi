<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengeluaran_kas_m extends CI_Model
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
			SELECT a.*, b.nama_supplier, c.nama_divisi FROM tb_bukti_kas_keluar a 
			LEFT JOIN master_supplier b ON a.ID_SUPPLIER = b.id_supplier
			LEFT JOIN master_divisi c ON a.DEPARTEMEN = c.id_divisi
		";

		return $this->db->query($sql)->result();
	}

	function lihat_data_id($id){
		$sql = "
			SELECT a.* FROM tb_bukti_kas_keluar a
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


	function get_data_trx($id){
    	$sql = "
        SELECT pb.* , md.nama_divisi , ms.nama_supplier , md.nama_divisi FROM tb_bukti_kas_keluar pb , master_divisi md , master_supplier ms WHERE pb.divisi = md.id_divisi AND pb.kode_supplier = ms.id_supplier AND pb.ID = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx_detail($id){
    	$sql = "
        SELECT il.KODE_AKUN , aka.NAMA_AKUN , il.KETERANGAN  FROM ak_input_voucher_lainnya il, ak_kode_akuntansi aka WHERE il.KODE_AKUN = aka.KODE_AKUN AND il.NO_BUKTI = '$id'
        ";

        return $this->db->query($sql)->result();
    }

    function get_lap_pdf($id){
    	$sql = "
        SELECT t.* , m.nama_supplier FROM tb_bukti_kas_keluar t , master_supplier m WHERE t.ID_SUPPLIER = m.id_supplier AND t.ID = '$id'
        ";

        return $this->db->query($sql)->row();
    }


}
