<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengembalian_barang_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_barang($no_spb,$tanggal,$uraian,$nama,$departemen)
	{
		$sql = "
			INSERT INTO tb_pengembalian_barang (
				no_spb,
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

	function simpan_data_barang_detail($id_pengembalian_baru,$id_produk, $nama_produk,$keterangan,$kuantitas,$satuan,$reff_no)
	{
		$kuantitas 	= str_replace(',', '', $kuantitas);
		$harga 		= str_replace(',', '', $harga);
		$jumlah 	= str_replace(',', '', $jumlah);

		$sql = "
			INSERT INTO tb_pengembalian_barang_detail (
				id_induk,
				id_produk,
				nama_produk,
				keterangan,
				kuantitas,
				satuan,
				reff_no
			) VALUES (
				'$id_pengembalian_baru',
				'$id_produk',
				'$nama_produk',
				'$keterangan',
				'$kuantitas',
				'$satuan',
				'$reff_no'
			)";
		$this->db->query($sql);
	}

	function lihat_data_pengembalian()
	{
		$sql = "
			SELECT pb.* , md.nama_divisi as nama_div FROM tb_pengembalian_barang pb , master_divisi md WHERE pb.divisi = md.id_divisi ";

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


	function hapus_pengembalian($id)
	{
		$sql = "UPDATE tb_pengembalian_barang SET status = '1' WHERE id_pengembalian = '$id' " ;
		$this->db->query($sql);

		// $sql2 = "DELETE FROM  tb_pengembalian_barang_detail WHERE id_induk = '$id' " ;
		// $this->db->query($sql2);
	}

	function data_pengembalian_id($id)
	{
		$sql = "SELECT * FROM tb_pengembalian_barang WHERE id_pengembalian = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function data_pengembalian_detail_id($id)
	{
		$sql = "SELECT * FROM tb_pengembalian_barang_detail WHERE id_induk = '$id' ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function ubah_data_pengembalian($id,$no_spb,$tanggal,$uraian)
	{
		$sql = "
			UPDATE tb_pengembalian_barang SET 
				no_spb  	= '$no_spb',
				tanggal 	= '$tanggal',
				uraian  	= '$uraian'
			WHERE id_pengembalian  = '$id'
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

	function ubah_data_pengembalian_detail($id,$nama_produk,$keterangan,$kuantitas,$satuan,$harga,$jumlah)
	{
		$kuantitas 	= str_replace(',', '', $kuantitas);
		$harga 		= str_replace(',', '', $harga);
		$jumlah 	= str_replace(',', '', $jumlah);
		
		$sql = "
			UPDATE tb_pengembalian_barang_detail SET 
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
        SELECT pbd.id as id_peminjaman_detail,mb.kode_barang , mb.nama_barang , pbd.sisa_jumlah , pbd.satuan , pb.no_spb FROM master_barang mb , tb_peminjaman_barang pb , tb_peminjaman_barang_detail pbd WHERE mb.id_barang = pbd.id_produk AND pb.id_peminjaman = pbd.id_induk AND pbd.sisa_jumlah > 0 AND pb.divisi = '$id_barang' AND pb.status = '0'
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_trx($id){
    	$sql = "
        SELECT pb.* , md.nama_divisi FROM tb_pengembalian_barang pb , master_divisi md WHERE pb.divisi = md.id_divisi AND pb.id_pengembalian = '$id'
        ";

        return $this->db->query($sql)->row(); 
    }

    function get_data_trx_detail($id){
    	$sql = "
        SELECT * FROM tb_pengembalian_barang_detail WHERE id_induk = '$id'
        ";

        return $this->db->query($sql)->result();
    }
}
