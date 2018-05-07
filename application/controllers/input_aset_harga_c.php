<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_aset_harga_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	}

	function index()
	{
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		$bulan = date('m');
		$tahun = date('Y');
		$sts = "";

		if($this->input->post('tampilkan')){	
			$sts = 1;		
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
		} else if($this->input->post('simpan')){	
			$sts = 1;	
			$msg = 1;	
			$bulan = $this->input->post('bulan_input');
			$tahun = $this->input->post('tahun_input');

			$id_aset   		   = $this->input->post('id_aset');
			$id_grup   		   = $this->input->post('id_grup');
			$id_sub            = $this->input->post('id_sub');
			$nama_aset         = $this->input->post('nama_aset');
			$tipe 			   = "";
			$kode_akun 		   = $this->input->post('kode_akun');
			$th_perolehan      = $this->input->post('th_perolehan');
			$harga_perolehan   = $this->input->post('harga_perolehan');
			$tarif_susut 	   = $this->input->post('tarif_susut');
			$akumulasi_susut_1 = $this->input->post('akumulasi_susut_1');
			$susut_sd_now 	   = $this->input->post('susut_sd_now');
			$akumulasi_susut_2 = $this->input->post('akumulasi_susut_2');
			$nilai_buku_akhir  = $this->input->post('nilai_buku_akhir');

			$this->db->query("DELETE FROM ak_aset_nilai WHERE BULAN = '$bulan' AND TAHUN = '$tahun' ");
			foreach ($id_aset as $key => $val) {
				$this->simpan_data($bulan, $tahun, $val, $id_grup[$key], $id_sub[$key], $nama_aset[$key], "", $kode_akun[$key], $th_perolehan[$key], $harga_perolehan[$key], 
					$tarif_susut[$key], $akumulasi_susut_1[$key], $susut_sd_now[$key], $akumulasi_susut_2[$key], $nilai_buku_akhir[$key]);
			}


		} 

		$dt_grup = $this->db->query("SELECT * FROM ak_aset_grup ORDER BY ID ASC")->result();
		$bln_txt = $this->datetostr($bulan);

		$data =  array(
			'page' => "input_aset_harga_v", 
			'title' => "Input Harga dan Penyusutan", 
			'msg' => "", 
			'master' => "aset", 
			'view' => "input_aset_harga", 
			'dt_grup' => $dt_grup, 
			'msg' => $msg, 
			'post_url' => 'input_aset_harga_c', 
			'user' => $user, 
			'bulan' => $bulan, 
			'bln_txt' => $bln_txt, 
			'tahun' => $tahun, 
			'sts' => $sts, 
		);
		
		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
	}

	function simpan_data($bulan, $tahun, $id_aset, $id_grup, $id_sub, $nama_aset, $tipe, $kode_akun, $th_perolehan, $harga_perolehan, 
					$tarif_susut, $akumulasi_susut_1, $susut_sd_now, $akumulasi_susut_2, $nilai_buku_akhir){
		$harga_perolehan = str_replace(',', '', $harga_perolehan);
		$tarif_susut = str_replace(',', '', $tarif_susut);
		$akumulasi_susut_1 = str_replace(',', '', $akumulasi_susut_1);
		$susut_sd_now = str_replace(',', '', $susut_sd_now);
		$akumulasi_susut_2 = str_replace(',', '', $akumulasi_susut_2);
		$nilai_buku_akhir = str_replace(',', '', $nilai_buku_akhir);

		$sql = "
		INSERT INTO ak_aset_nilai
		(BULAN, TAHUN, ID_ASET, ID_GRUP, ID_SUB, NAMA_ASET, TIPE, TH_PEROLEHAN, HARGA_PEROLEHAN, TARIF_SUSUT, AKUMULASI_SUSUT_1, SUSUT_SD_NOW, AKUMULASI_SUSUT_2, NILAI_BUKU_AKHIR, KODE_AKUN)
		VALUES
		('$bulan', '$tahun', '$id_aset', '$id_grup', '$id_sub', '$nama_aset', '$tipe', '$th_perolehan', '$harga_perolehan', '$tarif_susut', '$akumulasi_susut_1', 
		'$susut_sd_now', '$akumulasi_susut_2', '$nilai_buku_akhir', '$kode_akun')
		";

		$this->db->query($sql);

	}

	function datetostr($var){

		 if($var == "01"){
		 	$var = "Januari";
		 } else if($var == "02"){
		 	$var = "Februari";
		 } else if($var == "03"){
		 	$var = "Maret";
		 } else if($var == "04"){
		 	$var = "April";
		 } else if($var == "05"){
		 	$var = "Mei";
		 } else if($var == "06"){
		 	$var = "Juni";
		 } else if($var == "07"){
		 	$var = "Juli";
		 } else if($var == "08"){
		 	$var = "Agustus";
		 } else if($var == "09"){
		 	$var = "September";
		 } else if($var == "10"){
		 	$var = "Oktober";
		 } else if($var == "11"){
		 	$var = "November";
		 } else if($var == "12"){
		 	$var = "Desember";
		 }

		 return $var;

	}

	function cari_produk(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		
		$keyword = $this->input->get('keyword');
		$dt = $this->model->get_data_produk($keyword, $id_klien);

		echo json_encode($dt);
	}

	function cari_produk_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_produk_by_id($id);

		echo json_encode($dt);
	}

	function get_history_harga(){
		$id = $this->input->get('id');
		$dt = $this->model->get_history_harga($id);

		echo json_encode($dt);

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */