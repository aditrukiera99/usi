<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_order_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_purchase($no_po,$tanggal,$supplier,$subtotal_jml,$pot_po,$po_text,$ppn,$ppn_text,$totla,$departemen,$terms)
	{
		$sql = "
			INSERT INTO tb_purchase_order (
				no_po,
				tanggal,
				supplier,
				sub_total,
				dc_po,
				po_text,
				dc_ppn,
				ppn_text,
				total,
				divisi,
				terms
			) VALUES (
				'$no_po',
				'$tanggal',
				'$supplier',
				'$subtotal_jml',
				'$pot_po',
				'$po_text',
				'$ppn',
				'$ppn_text',
				'$totla',
				'$departemen',
				'$terms'

			)";
		$this->db->query($sql);
	}

	function simpan_data_purchase_detail($id_purchase_baru,$id_produk,$nama_produk,$keterangan,$kuantitas,$harga,$disc,$total,$no_opb)
	{

		$kuantitas 	= str_replace(',', '', $kuantitas);
		$harga 		= str_replace(',', '', $harga);
		$total 		= str_replace(',', '', $total);

		$sql = "
			INSERT INTO tb_purchase_order_detail (
				id_induk,
				id_produk,
				nama_produk,
				keterangan,
				kuantitas,
				harga,
				disc,
				total,
				no_opb,
				penerimaan
			) VALUES (
				'$id_purchase_baru',
				'$id_produk',
				'$nama_produk',
				'$keterangan',
				'$kuantitas',
				'$harga',
				'$disc',
				'$total',
				'$no_opb',
				'0'
			)";
		$this->db->query($sql);
	}

	function lihat_data_purchase()
	{
		$sql = "
			SELECT * FROM tb_purchase_order ";

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

	function hapus_purchase($id)
	{
		$sql = "UPDATE tb_purchase_order SET status = '1' WHERE id_purchase = '$id' " ;
		$this->db->query($sql);
		
		// $sql = "DELETE FROM  tb_purchase_order WHERE id_purchase = '$id' " ;
		// $this->db->query($sql);

		// $sql = "DELETE FROM  tb_purchase_order_detail WHERE id_induk = '$id' " ;
		// $this->db->query($sql);
	}

	function data_purchase_id($id)
	{
		$sql = "SELECT * FROM tb_purchase_order WHERE id_purchase = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function data_purchase_detail_id($id)
	{
		$sql = "SELECT * FROM tb_purchase_order_detail WHERE id_induk = '$id' ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function ubah_data_purchase($id,$no_po,$tanggal,$supplier)
	{
		$sql = "
			UPDATE tb_purchase_order SET
				no_po 	 = '$no_po',
				tanggal  = '$tanggal',
				supplier = '$supplier'
			WHERE id_purchase = '$id'
		";
		$this->db->query($sql);
	}

	function ubah_data_purchase_detail($id,$nama_produk,$keterangan,$kuantitas,$harga,$total,$no_opb)
	{
		$kuantitas 	= str_replace(',', '', $kuantitas);
		$harga 		= str_replace(',', '', $harga);
		$total 		= str_replace(',', '', $total);
		
		$sql = "
			UPDATE tb_purchase_order_detail SET
				nama_produk  	= '$nama_produk',
				keterangan  	= '$keterangan',
				kuantitas  		= '$kuantitas',
				harga  			= '$harga',
				total  			= '$total',
				no_opb  		= '$no_opb'
			WHERE id_induk  = '$id '
		";
		$this->db->query($sql);
	}

	function get_transaction_info($id_barang){
        $sql = "
        SELECT pbd.id as id_peminjaman_detail, pbd.nama_produk , pbd.keterangan, pb.no_opb , pbd.kuantitas , pbd.realisasi , pbd.id_produk FROM tb_order_pembelian pb , tb_order_pembelian_detail pbd WHERE pb.id_order = pbd.id_induk AND pb.divisi = '$id_barang'
        ";

        return $this->db->query($sql)->result();
    }

    function get_transaction_supplier($id_barang){
        $sql = "
        SELECT * FROM master_supplier WHERE id_supplier = '$id_barang'
        ";

        return $this->db->query($sql)->row();
    }

	function get_supplier_detail($id_supplier)
	{
		$sql = "SELECT * FROM master_supplier WHERE id_supplier = $id_supplier";

		return $this->db->query($sql)->row();
	}

	function get_produk_detail($id_barang)
	{
		$sql = "SELECT * FROM master_barang WHERE id_barang = $id_barang";

		return $this->db->query($sql)->row();
	}

	function get_opb_detail($id_permintaan)
	{
		$sql = "SELECT * FROM tb_permintaan_barang WHERE id_permintaan = $id_permintaan";

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

	function get_data_trx($id){
    	$sql = "
        SELECT pb.* , md.nama_divisi FROM tb_purchase_order pb , master_divisi md WHERE pb.divisi = md.id_divisi AND pb.id_purchase = '$id'
        ";

        return $this->db->query($sql)->row();
    }

    function get_data_trx_detail($id){
    	$sql = "
        SELECT * FROM tb_purchase_order_detail WHERE id_induk = '$id'
        ";

        return $this->db->query($sql)->result();
    }
}
