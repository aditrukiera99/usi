<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_supplier($kode_supplier,$nama_supplier,$alamat_supplier,$telp,$email,$npwp)
	{
		$sql = "
			INSERT INTO master_supplier (
				kode_supplier,
				nama_supplier,
				alamat_supplier,
				telp,
				email,
				npwp
			) VALUES (
				'$kode_supplier',
				'$nama_supplier',
				'$alamat_supplier',
				'$telp',
				'$email',
				'$npwp'
			)";
		$this->db->query($sql);
	}

	function lihat_data_supplier()
	{
		$sql = "
			SELECT * FROM master_supplier ";

		return $this->db->query($sql)->result();
	}

	function hapus_supplier($id)
	{
		$sql = "DELETE FROM  master_supplier WHERE id_supplier = '$id' " ;
		$this->db->query($sql);
	}

	function data_supplier_id($id)
	{
		$sql = "SELECT * FROM master_supplier WHERE id_supplier = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_data_supplier($id,$kode_supplier_modal,$nama_supplier_modal,$alamat_supplier_modal,$telp_modal,$email_modal,$npwp_modal)
	{
		$sql = "
			UPDATE master_supplier SET
				kode_supplier 	 = '$kode_supplier_modal',
				nama_supplier  	 = '$nama_supplier_modal',
				alamat_supplier  = '$alamat_supplier_modal',
				telp  			 = '$telp_modal',
				email 			 = '$email_modal',
				npwp  			 = '$npwp_modal'
			WHERE id_supplier = '$id'
		";
		$this->db->query($sql);
	}
}
