<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permintaan_barang_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_barang($no_spb,$tanggal,$uraian,$departemen)
	{
		$sql = "
			INSERT INTO tb_permintaan_barang (
				no_spb,
				tanggal,
				uraian,
				divisi,
				status
			) VALUES (
				'$no_spb',
				'$tanggal',
				'$uraian',
				'$departemen',
				'0'
			)";
		$this->db->query($sql);
	}

	function simpan_data_barang_detail($id_permintaan_baru,$id_produk, $nama_produk,$keterangan,$kuantitas,$satuan)
	{
		$kuantitas 	= str_replace(',', '', $kuantitas);
		$harga 		= str_replace(',', '', $harga);
		$jumlah 	= str_replace(',', '', $jumlah);

		$sql = "
			INSERT INTO tb_permintaan_barang_detail (
				id_induk,
				id_produk,
				nama_produk,
				keterangan,
				kuantitas,
				satuan,
				sisa_jumlah,
				sisa_order_pembelian
			) VALUES (
				'$id_permintaan_baru',
				'$id_produk',
				'$nama_produk',
				'$keterangan',
				'$kuantitas',
				'$satuan',
				'$kuantitas',
				'$kuantitas'

			)";
		$this->db->query($sql);
	}

	function lihat_data_permintaan()
	{
		$sql = "
			SELECT * FROM tb_permintaan_barang ";

		return $this->db->query($sql)->result();
	}

	function lihat_data_barang()
	{
		$sql = "
			SELECT * FROM master_barang ";

		return $this->db->query($sql)->result();
	}

	function hapus_permintaan($id)
	{
		$sql = "UPDATE tb_permintaan_barang SET status = '1' WHERE id_permintaan = '$id' " ;
		$this->db->query($sql);

		// $sql2 = "DELETE FROM  tb_permintaan_barang_detail WHERE id_induk = '$id' " ;
		// $this->db->query($sql2);
	}

	function data_permintaan_id($id)
	{
		$sql = "SELECT * FROM tb_permintaan_barang WHERE id_permintaan = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function data_permintaan_detail_id($id)
	{
		$sql = "SELECT * FROM tb_permintaan_barang_detail WHERE id_induk = '$id' ";
		$query = $this->db->query($sql);
		return $query->result();
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

	function ubah_data_permintaan($id,$no_spb,$tanggal,$uraian)
	{
		$sql = "
			UPDATE tb_permintaan_barang SET 
				no_spb  	= '$no_spb',
				tanggal 	= '$tanggal',
				uraian  	= '$uraian'
			WHERE id_permintaan  = '$id'
		";
		$this->db->query($sql);
	}

	function ubah_data_permintaan_detail($id,$nama_produk,$keterangan,$kuantitas,$satuan,$harga,$jumlah)
	{
		$kuantitas 	= str_replace(',', '', $kuantitas);
		$harga 		= str_replace(',', '', $harga);
		$jumlah 	= str_replace(',', '', $jumlah);
		
		$sql = "
			UPDATE tb_permintaan_barang_detail SET 
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

    function get_data_trx($id){
    	$sql = "
        SELECT pb.* , md.nama_divisi FROM tb_permintaan_barang pb , master_divisi md WHERE pb.divisi = md.id_divisi AND pb.id_permintaan = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx_detail($id){
    	$sql = "
        SELECT * FROM tb_permintaan_barang_detail WHERE id_induk = '$id'
        ";

        return $this->db->query($sql)->result();
    }
}
