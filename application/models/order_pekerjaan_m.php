<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_pekerjaan_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_barang($no_bukti_real,$tanggal,$uraian,$waktu,$tipe_waktu,$proyek_lambat,$departemen)
	{
		$sql = "
			INSERT INTO tb_order_pekerjaan (
				no_opek,
				tanggal,
				uraian,
				lama_hari,
				tipe_waktu,
				limit_proyek,
				refrensi,
				divisi
			) VALUES (
				'$no_bukti_real',
				'$tanggal',
				'$uraian',
				'$waktu',
				'$tipe_waktu',
				'$proyek_lambat',
				'$uraian',
				'$departemen'
			)";
		$this->db->query($sql);
	}

	function simpan_data_barang_detail($id_permintaan_baru,$nama,$keterangan,$divisi)
	{
		$kuantitas 	= str_replace(',', '', $kuantitas);
		$harga 		= str_replace(',', '', $harga);
		$jumlah 	= str_replace(',', '', $jumlah);

		$sql = "
			INSERT INTO tb_order_pekerjaan_detail (
				id_induk,
				nama,
				keterangan,
				status,
				divisi
			) VALUES (
				'$id_permintaan_baru',
				'$nama',
				'$keterangan',
				'0',
				'$divisi'

			)";
		$this->db->query($sql);
	}

	function lihat_data_permintaan()
	{
		$sql = "
			SELECT op.* , md.nama_divisi FROM tb_order_pekerjaan op , master_divisi md WHERE op.divisi = md.id_divisi ";

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
		$sql = "UPDATE tb_order_pekerjaan SET status = '1' WHERE id_opek = '$id' " ;
		$this->db->query($sql);

		// $sql = "DELETE FROM  tb_order_pekerjaan WHERE id_permintaan = '$id' " ;
		// $this->db->query($sql);

		// $sql2 = "DELETE FROM  tb_order_pekerjaan_detail WHERE id_induk = '$id' " ;
		// $this->db->query($sql2);
	}

	function data_permintaan_id($id)
	{
		$sql = "SELECT * FROM tb_order_pekerjaan WHERE id_opek = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
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

	function data_permintaan_detail_id($id)
	{
		$sql = "SELECT * FROM tb_order_pekerjaan_detail WHERE id_induk = '$id' ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function ubah_data_permintaan($id,$no_spb,$tanggal,$uraian)
	{
		$sql = "
			UPDATE tb_order_pekerjaan SET 
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
			UPDATE tb_order_pekerjaan_detail SET 
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
        SELECT pb.* , md.nama_divisi FROM tb_order_pekerjaan pb , master_divisi md WHERE pb.divisi = md.id_divisi AND pb.id_opek = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx_detail($id){
    	$sql = "
        SELECT * FROM tb_order_pekerjaan_detail WHERE id_induk = '$id'
        ";

        return $this->db->query($sql)->result();
    }
}
