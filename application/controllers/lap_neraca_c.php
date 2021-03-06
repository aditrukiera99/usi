<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_neraca_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('lap_neraca_m','model');
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
			'page' => "lap_neraca_v", 
			'title' => "Laporan Neraca Perusahaan", 
			'msg' => "", 
			'master' => "laporan", 
			'view' => "neraca", 
			//'dt' => $dt, 
			'msg' => $msg, 
			'user' => $user, 
			'post_url' => 'lap_neraca_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function cetak_penye_pdf(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		//$tgl   = $this->input->post('tgl');
		
		$filter = $this->input->post('filter');
		$unit = $this->input->post('unit');
		$view = "pdf/report_laporan_neraca_pdf";
		$dt = "";
		$judul = "";
		$dt_aktiva = "";
		$dt_wajib = "";

		$laba = "";
		$laba_lalu = "";

		$dt_unit = $this->master_model_m->get_unit_by_id($unit);

		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');	

		$dt = "";
		$dt_aktiva = $this->model->get_lap_neraca_bulanan($bulan, $tahun, 'AKTIVA');
		$dt_wajib =  $this->model->get_lap_neraca_bulanan($bulan, $tahun, 'KEWAJIBAN');

		$laba      = $this->model->cetak_laba_rugi_bulanan($bulan, $tahun, 'NOW');
		$laba_lalu = $this->model->cetak_laba_rugi_bulanan($bulan, $tahun, 'LALU');

		$data = array(
			'title' 		=> 'LAPORAN BUKU BESAR',
			'title2'		=> 'SEMUA BAGIAN',
			'dt'			=> $dt,
			'dt_aktiva'     => $dt_aktiva,
			'dt_wajib'      => $dt_wajib,
			'laba'          => $laba,
			'laba_lalu'     => $laba_lalu,
			'judul'			=> $this->datetostr($bulan)." ".$tahun,
		);
		$this->load->view($view,$data);
	}

	function cetak_penye_xls(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		//$tgl   = $this->input->post('tgl');
		
		$filter = $this->input->post('filter');
		$unit = $this->input->post('unit');
		$view = "xls/report_laporan_neraca_xls";
		$dt = "";
		$judul = "";
		$dt_aktiva = "";
		$dt_wajib = "";

		$laba = "";
		$laba_lalu = "";

		$dt_unit = $this->master_model_m->get_unit_by_id($unit);

		$bulan_lalu = date('m');
		$tahun_lalu = date('Y');

		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');	

		$dt = "";
		$dt_aktiva = $this->model->get_lap_neraca_bulanan($bulan, $tahun, 'AKTIVA');
		$dt_wajib =  $this->model->get_lap_neraca_bulanan($bulan, $tahun, 'KEWAJIBAN');

		$laba      = $this->model->cetak_laba_rugi_bulanan($bulan, $tahun, 'NOW');
		$laba_lalu = $this->model->cetak_laba_rugi_bulanan($bulan, $tahun, 'LALU');

		$data = array(
			'title' 		=> 'LAPORAN BUKU BESAR',
			'title2'		=> 'SEMUA BAGIAN',
			'dt'			=> $dt,
			'dt_aktiva'     => $dt_aktiva,
			'dt_wajib'      => $dt_wajib,
			'laba'          => $laba,
			'laba_lalu'     => $laba_lalu,
			'judul'			=> $this->datetostr($bulan)." ".$tahun,
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