<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_komparasi_neraca_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('lap_komparasi_neraca_m','model');
	    $this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
	}

	function index()
	{
		$keyword = "";
		$msg = "";
		$nomor_akun = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user  = $sess_user['id'];
		$user 	  = $this->master_model_m->get_user_info($id_user);

		if($this->input->post('pdf')){
			$this->cetak_penye_pdf();
		} else if($this->input->post('excel')){
			$this->cetak_penye_xls();
		} 

		//$dt = $this->model->get_no_akun($keyword, $id_klien);

		$data =  array(
			'page' => "lap_komparasi_neraca_v", 
			'title' => "Laporan Kompilasi Neraca", 
			'msg' => "", 
			'master' => "laporan", 
			'view' => "lap_komparasi_neraca", 
			//'dt' => $dt, 
			'msg' => $msg, 
			'user' => $user, 
			'post_url' => 'lap_komparasi_neraca_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function cetak_penye_xls(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		//$tgl   = $this->input->post('tgl');
		
		$filter = $this->input->post('filter');
		$unit = $this->input->post('unit');
		$view = "xls/lap_komparasi_neraca_xls";
		$dt = "";
		$judul = "";
		$dt_aktiva = "";
		$dt_wajib = "";

		$laba = "";
		$laba_lalu = "";

		$dt_unit = $this->master_model_m->get_unit_by_id($unit);		


		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');
		$bln_txt = $this->datetostr($bulan);
		$judul = "Bulan $bln_txt Tahun $tahun";
		
		$data = array(
			'title' 		=> 'LAPORAN NERACA PERUSAHAAN ',
			'title2'		=> 'SEMUA BAGIAN',
			'dt'			=> $dt,
			'dt_unit'		=> $dt_unit,
			'judul'			=> $judul,
			'filter'        => $filter,
			'tahun'         => $tahun,
			'bulan'         => $bulan,
			'bulan_txt'     => $this->datetostr($bulan),
			'data_usaha'    => $this->master_model_m->data_usaha($id_klien),
			'get_unit'      => $this->model->get_unit(),
		);
		$this->load->view($view,$data);
	}


	function cari_kode(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		$keyword = $this->input->get('keyword');
		$dt = $this->model->get_no_akun($keyword, $id_klien);

		echo json_encode($dt);
	}

	function cari_kode_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_kode_by_id($id);

		echo json_encode($dt);
	}

	function datetostr_last_day($var){

		 if($var == "01"){
		 	$var = "31 Januari";
		 } else if($var == "02"){
		 	$var = "28 Februari";
		 } else if($var == "03"){
		 	$var = "31 Maret";
		 } else if($var == "04"){
		 	$var = "30 April";
		 } else if($var == "05"){
		 	$var = "31 Mei";
		 } else if($var == "06"){
		 	$var = "30 Juni";
		 } else if($var == "07"){
		 	$var = "31 Juli";
		 } else if($var == "08"){
		 	$var = "31 Agustus";
		 } else if($var == "09"){
		 	$var = "30 September";
		 } else if($var == "10"){
		 	$var = "31 Oktober";
		 } else if($var == "11"){
		 	$var = "30 November";
		 } else if($var == "12"){
		 	$var = "31 Desember";
		 } else{
		 	$var = "";
		 }

		 return $var;

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
		 } else{
		 	$var = "";
		 }

		 return $var;

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */