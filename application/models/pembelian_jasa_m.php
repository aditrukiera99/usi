<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembelian_jasa_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_barang($no_bukti_real,$tanggal,$uraian,$nama,$departemen,$subtotal_text,$po_text,$ppn_text,$pph_text,$total_semua,$id_supplier,$pot_po,$ppn,$pph,$terms)
	{
		$sql = "
			INSERT INTO tb_pembelian_jasa (
				no_spb,
				tanggal,
				uraian,
				user,
				status,
				divisi,
				sub_total,
				disc_po,
				disc_ppn,
				disc_pph,
				total,
				kode_supplier,
				prosentase,
				po,
				ppn,
				pph,
				terms
			) VALUES (
				'$no_bukti_real',
				'$tanggal',
				'$uraian',
				'$nama',
				'0',
				'$departemen',
				'$subtotal_text',
				'$po_text',
				'$ppn_text',
				'$pph_text',
				'$total_semua',
				'$id_supplier',
				'0',
				'$pot_po',
				'$ppn',
				'$pph',
				'$terms'
			)";
		$this->db->query($sql);
	}

	function simpan_data_barang_detail($id_pengembalian_baru,$nama,$keterangan,$harga,$disc,$total,$no_opek)
	{
		$harga 	= str_replace(',', '', $harga);
		$total 	= str_replace(',', '', $total);

		$sql = "
			INSERT INTO tb_pembelian_jasa_detail (
				id_induk,
				nama,
				keterangan,
				harga,
				disc,
				total,
				no_opek,
				status,
				prosentase,
				pembayaran,
				prosentase_akhir
			) VALUES (
				'$id_pengembalian_baru',
				'$nama',
				'$keterangan',
				'$harga',
				'$disc',
				'$total',
				'$no_opek',
				'0',
				'0',
				'0',
				'0'
			)";
		$this->db->query($sql);
	}

	function lihat_data_pengembalian()
	{
		$sql = "
			SELECT pb.* , md.nama_divisi as nama_div FROM tb_pembelian_jasa pb , master_divisi md WHERE pb.divisi = md.id_divisi ";

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

	function lihat_data_supplier()
	{
		$sql = "
			SELECT * FROM master_supplier ";

		return $this->db->query($sql)->result();
	}


	function hapus_pengembalian($id)
	{
		$sql = "UPDATE tb_pembelian_jasa SET status = '1' WHERE id_pengembalian = '$id' " ;
		$this->db->query($sql);
		
		// $sql = "DELETE FROM  tb_pembelian_jasa WHERE id_pengembalian = '$id' " ;
		// $this->db->query($sql);

		// $sql2 = "DELETE FROM  tb_pembelian_jasa_detail WHERE id_induk = '$id' " ;
		// $this->db->query($sql2);
	}

	function data_pengembalian_id($id)
	{
		$sql = "SELECT * FROM tb_pembelian_jasa WHERE id_pengembalian = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function data_pengembalian_detail_id($id)
	{
		$sql = "SELECT * FROM tb_pembelian_jasa_detail WHERE id_induk = '$id' ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function ubah_data_pengembalian($id,$no_spb,$tanggal,$uraian)
	{
		$sql = "
			UPDATE tb_pembelian_jasa SET 
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
			UPDATE tb_pembelian_jasa_detail SET 
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
        SELECT pbd.id as id_peminjaman_detail, pbd.nama , pbd.keterangan, pb.no_opek FROM tb_order_pekerjaan pb , tb_order_pekerjaan_detail pbd WHERE pb.id_opek = pbd.id_induk AND pbd.status = 0 AND pb.divisi = '$id_barang'
        ";

        return $this->db->query($sql)->result();
    }

    function get_transaction_supplier($id_barang){
        $sql = "
        SELECT * FROM master_supplier WHERE id_supplier = '$id_barang'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx($id){
    	$sql = "
        SELECT pb.* , md.nama_divisi , ms.nama_supplier FROM tb_pembelian_jasa pb , master_divisi md , master_supplier ms WHERE pb.divisi = md.id_divisi AND pb.kode_supplier = ms.id_supplier AND pb.id_pengembalian = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx_detail($id){
    	$sql = "
        SELECT * FROM tb_pembelian_jasa_detail WHERE id_induk = '$id'
        ";

        return $this->db->query($sql)->result();
    }
}
