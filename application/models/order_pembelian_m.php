<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_pembelian_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_order($no_bukti_real,$tanggal,$uraian,$departemen)
	{
		$sql = "
			INSERT INTO tb_order_pembelian (
				no_opb,
				tanggal,
				uraian,
				status,
				divisi
			) VALUES (
				'$no_bukti_real',
				'$tanggal',
				'$uraian',
				'0',
				'$departemen'
			)";
		$this->db->query($sql);
	}

	function simpan_data_order_detail($id_order_baru,$id_produk,$nama_produk,$keterangan,$kuantitas,$satuan,$no_spb)
	{

		$kuantitas 	= str_replace(',', '', $kuantitas);
		$harga 		= str_replace(',', '', $harga);
		$total 		= str_replace(',', '', $total);	

		$sql = "
			INSERT INTO tb_order_pembelian_detail (
				id_induk,
				id_produk,
				nama_produk,
				keterangan,
				kuantitas,
				satuan,
				no_spb,
				realisasi
			) VALUES (
				'$id_order_baru',
				'$id_produk',
				'$nama_produk',
				'$keterangan',
				'$kuantitas',
				'$satuan',
				'$no_spb',
				'0'
			)";
		$this->db->query($sql);
	}

	function lihat_data_order()
	{
		$sql = "
			SELECT * FROM tb_order_pembelian ";

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

	function hapus_order($id)
	{
		$sql = "UPDATE tb_order_pembelian SET status = '1' WHERE id_order = '$id' " ;
		$this->db->query($sql);
		
		// $sql = "DELETE FROM  tb_order_pembelian WHERE id_order = '$id' " ;
		// $this->db->query($sql);

		// $sql2 = "DELETE FROM  tb_order_pembelian_detail WHERE id_induk = '$id' " ;
		// $this->db->query($sql2);
	}

	function data_order_id($id)
	{
		$sql = "SELECT * FROM tb_order_pembelian WHERE id_order = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function data_order_detail_id($id)
	{
		$sql = "SELECT * FROM tb_order_pembelian_detail WHERE id_induk = '$id' ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function ubah_data_order($id,$no_opb,$tanggal,$uraian)
	{
		$sql = "
			UPDATE tb_order_pembelian SET
				no_opb  		= '$no_opb',
				tanggal 		= '$tanggal',
				uraian  		= '$uraian'
			WHERE id_order  	= '$id'
		";
		$this->db->query($sql);
	}

	function ubah_data_order_detail($id,$nama_produk,$keterangan,$kuantitas,$satuan,$harga,$total,$no_spb)
	{
		$sql = "
			UPDATE tb_order_pembelian_detail SET
				nama_produk  	= '$nama_produk',
				keterangan  	= '$keterangan',
				kuantitas  		= '$kuantitas',
				satuan  		= '$satuan',
				harga  			= '$harga',
				total  			= '$total',
				no_spb  		= '$no_spb'
			WHERE id_induk  	= '$id'
		";
		$this->db->query($sql);
	}

	function get_produk_detail($id_induk)
	{
        $sql = "SELECT * FROM tb_permintaan_barang_detail WHERE id = $id_induk ";

        return $this->db->query($sql)->row();
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

    function get_spb_detail($id)
    {
        $sql = "SELECT * FROM tb_permintaan_barang_detail WHERE id_induk = $id";
        $query = $this->db->query($sql);

        return $query->result();
    }

    function get_order_detail($id_induk){
        $sql = "
        SELECT * FROM tb_order_pembelian WHERE id_induk = $id_induk
        ";

        return $this->db->query($sql)->row();
    }

    function update_selisih_detail($vali,$kuantitas)
	{
		$sql = "
			UPDATE tb_permintaan_barang_detail SET 
				sisa_order_pembelian  	= sisa_order_pembelian - $kuantitas
			WHERE id  = '$vali'
		";
		$this->db->query($sql);
	}

    function get_transaction_info($id_barang){
        $sql = "
        SELECT pbd.id as id_peminjaman_detail,mb.id_barang , mb.nama_barang , pbd.sisa_jumlah , pbd.satuan , pb.no_spb FROM master_barang mb , tb_permintaan_barang pb , tb_permintaan_barang_detail pbd WHERE mb.id_barang = pbd.id_produk AND pb.id_permintaan = pbd.id_induk AND pbd.sisa_jumlah > 0 AND pb.divisi = '$id_barang'
        ";

        return $this->db->query($sql)->result();
    }

    function get_data_trx($id){
    	$sql = "
        SELECT pb.* , md.nama_divisi FROM tb_order_pembelian pb , master_divisi md WHERE pb.divisi = md.id_divisi AND pb.id_order = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx_detail($id){
    	$sql = "
        SELECT * FROM tb_order_pembelian_detail WHERE id_induk = '$id'
        ";

        return $this->db->query($sql)->result();
    }
}
