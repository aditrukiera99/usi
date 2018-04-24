<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bon_gudang_final_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_barang($no_spb,$tanggal,$uraian,$nama,$departemen)
	{
		$sql = "
			INSERT INTO tb_bon_gudang_final (
				no_bon,
				tanggal,
				uraian,
				user,
				status,
				divisi
			) VALUES (
				'$no_spb',
				'$tanggal',
				'$uraian',
				'$nama',
				'0',
				'$departemen'
			)";
		$this->db->query($sql);
	}

	function simpan_data_barang_detail($id_bon_gudang_final_baru,$id_produk, $nama_produk,$keterangan,$kuantitas,$satuan,$reff_no,$tgl_pemakaian)
	{
		$kuantitas 	= str_replace(',', '', $kuantitas);
		$harga 		= str_replace(',', '', $harga);
		$jumlah 	= str_replace(',', '', $jumlah);

		$sql = "
			INSERT INTO tb_bon_gudang_final_detail (
				id_induk,
				id_produk,
				nama_produk,
				keterangan,
				kuantitas,
				satuan,
				reff_no,
				tgl_pemakaian,
				sisa_jumlah
			) VALUES (
				'$id_bon_gudang_final_baru',
				'$id_produk',
				'$nama_produk',
				'$keterangan',
				'$kuantitas',
				'$satuan',
				'$reff_no',
				'$tgl_pemakaian',
				'$kuantitas'
			)";
		$this->db->query($sql);
	}

	function lihat_data_bon_gudang_final()
	{
		$sql = "
			SELECT pb.* , md.nama_divisi as nama_div FROM tb_bon_gudang_final pb , master_divisi md WHERE pb.divisi = md.id_divisi ";

		return $this->db->query($sql)->result();
	}

	function lihat_data_barang()
	{
		$sql = "
			SELECT * FROM master_barang ";

		return $this->db->query($sql)->result();
	}

	function lihat_data_divisi()
	{
		$sql = "
			SELECT * FROM master_divisi ";

		return $this->db->query($sql)->result();
	}


	function hapus_bon_gudang_final($id)
	{	
		$sql = "UPDATE tb_bon_gudang_final SET status = '1' WHERE id_bon_gudang_final = '$id' " ;
		$this->db->query($sql);

	}

	function data_bon_gudang_final_id($id)
	{
		$sql = "SELECT * FROM tb_bon_gudang_final WHERE id_bon_gudang_final = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function data_bon_gudang_final_detail_id($id)
	{
		$sql = "SELECT * FROM tb_bon_gudang_final_detail WHERE id_induk = '$id' ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function ubah_data_bon_gudang_final($id,$no_spb,$tanggal,$uraian)
	{
		$sql = "
			UPDATE tb_bon_gudang_final SET 
				no_spb  	= '$no_spb',
				tanggal 	= '$tanggal',
				uraian  	= '$uraian'
			WHERE id_bon_gudang_final  = '$id'
		";
		$this->db->query($sql);
	}

	function save_next_nomor($tipe)
	{
		$sql = "
			UPDATE ak_nomor SET 
				NEXT_NOMOR  	= NEXT_NOMOR + 1
			WHERE TIPE  = '$tipe'
		";
		$this->db->query($sql);
	}

	function update_selisih_detail($vali,$kuantitas)
	{
		$sql = "
			UPDATE tb_peminjaman_barang_detail SET 
				sisa_jumlah  	= sisa_jumlah - $kuantitas
			WHERE id  = '$vali'
		";
		$this->db->query($sql);
	}

	function ubah_data_bon_gudang_final_detail($id,$nama_produk,$keterangan,$kuantitas,$satuan,$harga,$jumlah)
	{
		$kuantitas 	= str_replace(',', '', $kuantitas);
		$harga 		= str_replace(',', '', $harga);
		$jumlah 	= str_replace(',', '', $jumlah);
		
		$sql = "
			UPDATE tb_bon_gudang_final_detail SET 
				nama_produk = '$nama_produk',
				keterangan  = '$keterangan',
				kuantitas  	= '$kuantitas',
				satuan  	= '$satuan',
				harga  		= '$harga',
				jumlah  	= '$jumlah'
			WHERE id_induk  = '$id'
		";
		$this->db->query($sql);
	}

	function get_produk_detail($id_barang){
        $sql = "
        SELECT * FROM master_barang WHERE id_barang = $id_barang
        ";

        return $this->db->query($sql)->row();
    }

    function get_transaction_info($id_barang){
        $sql = "
        SELECT pbd.id as id_peminjaman_detail,mb.id_barang , mb.nama_barang , pbd.sisa_jumlah , pbd.satuan , pb.no_spb FROM master_barang mb , tb_permintaan_barang pb , tb_permintaan_barang_detail pbd WHERE mb.id_barang = pbd.id_produk AND pb.id_permintaan = pbd.id_induk AND pbd.sisa_jumlah > 0 AND pb.divisi = '$id_barang'
        ";

        return $this->db->query($sql)->result();
    }

    function get_transaction_info_bgs($id_barang){
        $sql = "
        SELECT pbd.id as id_peminjaman_detail,mb.id_barang , mb.nama_barang , pbd.sisa_jumlah , pbd.satuan , pb.no_bon FROM master_barang mb , tb_bon_gudang pb , tb_bon_gudang_detail pbd WHERE mb.id_barang = pbd.id_produk AND pb.id_bon_gudang = pbd.id_induk AND pbd.sisa_jumlah > 0 AND pb.divisi = '$id_barang'
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_trx($id){
    	$sql = "
        SELECT pb.* , md.nama_divisi FROM tb_bon_gudang_final pb , master_divisi md WHERE pb.divisi = md.id_divisi AND pb.id_bon_gudang_final = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx_detail($id){
    	$sql = "
        SELECT * FROM tb_bon_gudang_final_detail WHERE id_induk = '$id'
        ";

        return $this->db->query($sql)->result();
    }
}
