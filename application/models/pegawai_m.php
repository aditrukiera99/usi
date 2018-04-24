<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function simpan_data_pegawai($id_status,$nik,$nama,$alamat,$jenis_kelamin,$tempat_lahir,$tanggal_lahir,
								 $kota,$agama,$pendidikan,$id_keluarga,$id_depart,$id_jabatan,$kode_gaji,$tgl_masuk,$tgl_keluar,$jamsostek,
								 $mutasi,$pengalaman_kerja,$kursus,$foto,$id_user,$tipe_jadwal,$nama_bank,$ket_depart,$digaji,$no_rekening)
	{
		$sql = "
			INSERT INTO master_pegawai (
				id_status,nik,nama,alamat,jenis_kelamin,tempat_lahir,tanggal_lahir,kota,agama,pendidikan,id_keluarga,
				id_depart,id_jabatan,kode_gaji,tgl_masuk,tgl_keluar,jamsostek,mutasi,pengalaman_kerja,kursus,foto,id_user,tipe_jadwal,nama_bank,
				ket_depart,	digaji,	no_rekening
			) VALUES (
				'$id_status','$nik','$nama','$alamat','$jenis_kelamin','$tempat_lahir','$tanggal_lahir','$kota','$agama',
				'$pendidikan','$id_keluarga','$id_depart','$id_jabatan','$kode_gaji','$tgl_masuk','$tgl_keluar','$jamsostek','$mutasi',	
				'$pengalaman_kerja','$kursus','$foto','$id_user','$tipe_jadwal','$nama_bank','$ket_depart','$digaji','$no_rekening'
			)";
		$this->db->query($sql);
	}

	function lihat_data_pegawai()
	{
		$sql = "
			SELECT * FROM master_pegawai ";

		return $this->db->query($sql)->result();
	}

	function lihat_data_status()
	{
		$sql = "
			SELECT * FROM master_status ";

		return $this->db->query($sql)->result();
	}

	function lihat_data_keluarga()
	{
		$sql = "
			SELECT * FROM master_keluarga ";

		return $this->db->query($sql)->result();
	}

	function lihat_data_departemen()
	{
		$sql = "
			SELECT * FROM master_departemen ";

		return $this->db->query($sql)->result();
	}

	function lihat_data_jabatan()
	{
		$sql = "
			SELECT * FROM master_jabatan ";

		return $this->db->query($sql)->result();
	}

	function hapus_pegawai($id)
	{
		$sql = "DELETE FROM  master_pegawai WHERE id_pegawai = '$id' " ;
		$this->db->query($sql);
	}

	function data_pegawai_id($id)
	{
		$sql = "SELECT * FROM master_pegawai WHERE id_pegawai = '$id' ";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function ubah_data_pegawai($id,$id_status,$nik,$nama,$alamat,$jenis_kelamin,$tempat_lahir,										  					  	   			  	   $tanggal_lahir,$kota,$agama,$pendidikan,$id_keluarga,$id_depart,$id_jabatan,
							   $kode_gaji,$tgl_masuk,$tgl_keluar,$jamsostek,$mutasi,$pengalaman_kerja,$kursus,	
							   $foto,$id_user,$tipe_jadwal,$nama_bank,$ket_depart,$digaji,$no_rekening)
	{
		$sql = "
			UPDATE master_pegawai SET
				id_status    		= '$id_status',
				nik  				= '$nik',
				nama  				= '$nama',
				alamat 				= '$alamat',
				jenis_kelamin  		= '$jenis_kelamin',
				tempat_lahir  		= '$tempat_lahir',
				tanggal_lahir  		= '$tanggal_lahir',
				kota  				= '$kota',
				agama 				= '$agama',
				pendidikan  		= '$pendidikan',
				id_keluarga  		= '$id_keluarga',
				id_depart  			= '$id_depart',
				id_jabatan  		= '$id_jabatan',
				kode_gaji  			= '$kode_gaji',
				tgl_masuk  			= '$tgl_masuk',
				tgl_keluar  		= '$tgl_keluar',
				jamsostek  			= '$jamsostek',
				mutasi  			= '$mutasi',
				pengalaman_kerja  	= '$pengalaman_kerja',
				kursus  			= '$kursus',
				foto  				= '$foto',
				id_user  			= '$id_user',
				tipe_jadwal  		= '$tipe_jadwal',
				nama_bank  			= '$nama_bank',
				ket_depart  		= '$ket_depart',
				digaji  			= '$digaji',
				no_rekening  		= '$no_rekening'
			WHERE id_pegawai = '$id'
		";
		$this->db->query($sql);
	}
}
