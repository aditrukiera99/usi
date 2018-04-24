<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_model_m extends CI_Model
{
	function __construct() {
		  parent::__construct();
		  $this->load->database();
	}

	function get_user_info(){
		$data = $this->session->userdata('sign_in');
        $id = $data['id'];

        $sql = "SELECT a.*, b.nama_divisi FROM tb_user a JOIN master_divisi b ON a.departemen = b.id_divisi WHERE a.id = '$id' ";
        return $this->db->query($sql)->row();
	}

	function get_nomor_dokumen($tipe){
		$id_divisi  = $this->get_user_info()->departemen;
		$divisi     = $this->get_user_info()->nama_divisi;
		$bln        = date('m');
		$thn        = date('Y');

        $sqlcek = $this->db->query("SELECT * FROM ak_nomor WHERE TIPE = '$tipe' AND BULAN = '$bln' AND TAHUN = '$thn' AND DIVISI = '$id_divisi' ")->result();
        if(count($sqlcek) == 0){
        	$this->db->query("INSERT INTO ak_nomor (ID_KLIEN, TIPE, NEXT_NOMOR, BULAN, TAHUN, DIVISI) VALUES ('13', '$tipe', '1', '$bln', '$thn', '$id_divisi' ) ");
        	$nomor = $this->db->query("SELECT * FROM ak_nomor WHERE TIPE = '$tipe' AND BULAN = '$bln' AND TAHUN = '$thn' AND DIVISI = '$id_divisi' ")->row()->NEXT_NOMOR;
        } else {
        	// $this->db->query("UPDATE ak_nomor SET NEXT_NOMOR = NEXT_NOMOR+1 WHERE TIPE = '$tipe' AND BULAN = '$bln' AND TAHUN = '$thn' AND DIVISI = '$id_divisi'  ");
        	$nomor = $this->db->query("SELECT * FROM ak_nomor WHERE TIPE = '$tipe' AND BULAN = '$bln' AND TAHUN = '$thn' AND DIVISI = '$id_divisi' ")->row()->NEXT_NOMOR;
        }

        $nomor = str_pad($nomor, 6, '0', STR_PAD_LEFT);
        $bln   = $this->tgl_to_romawi($bln);

        return $nomor;
	}

	function update_nomor($tipe){
		$bln        = date('m');
		$thn        = date('Y');
		$id_divisi  = $this->get_user_info()->departemen;
		
		$this->db->query("UPDATE ak_nomor SET NEXT_NOMOR = NEXT_NOMOR+1 WHERE TIPE = '$tipe' AND BULAN = '$bln' AND TAHUN = '$thn' AND DIVISI = '$id_divisi'  ");
	}

	function tgl_to_romawi($var){
	  if($var == "01"){
	    $var = "I";
	   } else if($var == "02"){
	    $var = "II";
	   } else if($var == "03"){
	    $var = "III";
	   } else if($var == "04"){
	    $var = "IV";
	   } else if($var == "05"){
	    $var = "V";
	   } else if($var == "06"){
	    $var = "VI";
	   } else if($var == "07"){
	    $var = "VII";
	   } else if($var == "08"){
	    $var = "VIII";
	   } else if($var == "09"){
	    $var = "IX";
	   } else if($var == "10"){
	    $var = "X";
	   } else if($var == "11"){
	    $var = "XI";
	   } else if($var == "12"){
	    $var = "XII";
	   }

	   return $var;
	}

}
