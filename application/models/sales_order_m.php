<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales_order_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_sales($pelanggan,$divisi,$alamat_penagihan,$tanggal_transaksi,$no_transaksi,$uraian)
	{
		$sql = "
			INSERT INTO tb_sales_order (
				pelanggan,
				divisi,
				alamat_penagihan,
				tanggal_transaksi,
				no_transaksi,
				uraian
			) VALUES (
				'$pelanggan',
				'$divisi',
				'$alamat_penagihan',
				'$tanggal_transaksi',
				'$no_transaksi',
				'$uraian'
			)";
		$this->db->query($sql);
	}

	function simpan_data_sales_detail($id_sales_baru,$id_produk,$id_akun,$kode_akun,$nama_produk,$kuantitas,$satuan,$harga,$tax,$jumlah)
	{
		$kuantitas = str_replace('', '', $kuantitas);
		$harga 	   = str_replace('', '', $harga);
		$jumlah    = str_replace('', '', $jumlah);

			$sql = "
			INSERT INTO tb_sales_order_detail (
				id_induk,
				id_produk,
				id_akun,
				kode_akun,
				nama_produk,
				kuantitas,
				satuan,
				harga,
				tax,
				jumlah
			) VALUES (
				'$id_sales_baru',
				'$id_produk',
				'$id_akun',
				'$kode_akun',
				'$nama_produk',
				'$kuantitas',
				'$satuan',
				'$harga',
				'$tax',
				'$jumlah'
			)";
		$this->db->query($sql);
	}

	function lihat_data_sales()
	{
		$sql = "
			SELECT * FROM tb_sales_order ";

		return $this->db->query($sql)->result();
	}

	function lihat_kode_akuntansi()
	{
		$sql = "select * from ak_kode_akuntansi ";

		return $this->db->query($sql)->result();
	}

	function hapus_sales($id)
	{
		$sql = "DELETE FROM  tb_sales_order WHERE id_sales = '$id' " ;
		$this->db->query($sql);

		$sql2 = "DELETE FROM  tb_sales_order_detail WHERE id_sales = '$id' " ;
		$this->db->query($sql2);
	}

	function data_sales_id($id)
	{
		$sql = "SELECT * FROM tb_sales_order WHERE id_sales = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function data_sales_detail_id($id)
	{
		$sql = "SELECT * FROM tb_sales_order_detail WHERE id_induk = '$id' ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function ubah_data_sales($id,$pelanggan,$divisi,$alamat_penagihan,$tanggal_transaksi,$no_transaksi,$uraian)
	{
		$sql = "
			UPDATE tb_sales_order SET
				pelanggan  			= '$pelanggan',
				divisi 				= '$divisi',
				alamat_penagihan  	= '$alamat_penagihan',
				tanggal_transaksi  	= '$tanggal_transaksi',
				no_transaksi  		= '$no_transaksi',
				uraian  			= '$uraian'
			WHERE id_sales  = '$id'
		";
		$this->db->query($sql);
	}

	function ubah_data_sales_detail($id,$kode_akun,$nama_produk,$kuantitas,$satuan,$harga,$tax,$jumlah)
	{
		$kuantitas = str_replace('', '', $kuantitas);
		$harga 	   = str_replace('', '', $harga);
		$jumlah    = str_replace('', '', $jumlah);
		
		$sql = "
			UPDATE tb_sales_order_detail SET
				kode_akun  	= '$kode_akun',
				nama_produk = '$nama_produk',
				kuantitas  	= '$kuantitas',
				satuan  	= '$satuan',
				harga  		= '$harga',
				tax  		= '$tax',
				jumlah  	= '$jumlah'
			WHERE id_induk  = '$id'
		";
		$this->db->query($sql);
	}


	function get_pelanggan_detail($id_pelanggan){
        $sql = "
        SELECT * FROM master_pelanggan WHERE id_pelanggan = $id_pelanggan
        ";

        return $this->db->query($sql)->row();
    }

    function get_produk_detail($id_barang){
        $sql = "
        SELECT * FROM master_barang WHERE id_barang = $id_barang
        ";

        return $this->db->query($sql)->row();
    }
}
