<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_jurnal_bayar_kas_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('lap_jurnal_bayar_kas_m','model');
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
			$this->cetak_bayar_kas_bank();
		} else if($this->input->post('excel')){
			$this->cetak_bayar_kas_bank_xls();
		} 
 

		//$dt = $this->model->get_no_akun($keyword, $id_klien);

		$data =  array(
			'page' => "lap_jurnal_bayar_kas_v", 
			'title' => "Laporan Jurnal Bayar Kas & Bank", 
			'msg' => "", 
			'master' => "laporan", 
			'view' => "jbk", 
			//'dt' => $dt, 
			'msg' => $msg, 
			'user' => $user, 
			'post_url' => 'lap_jurnal_bayar_kas_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function cetak_bayar_kas_bank(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		//$tgl   = $this->input->post('tgl');
		
		$filter = $this->input->post('filter');
		$unit = $this->input->post('unit');
		$view = "pdf/report_jurnal_bayar_kas_bank_pdf";
		$dt = "";
		$judul = "";

		$dt_unit = $this->master_model_m->get_unit_by_id($unit);
		

		if($filter == "Harian"){
			$tgl_full = $this->input->post('tgl');
			if($tgl_full == ""){
				$tgl_full = date('d-m-Y')." sampai ".date('d-m-Y');
			}
			
			$tgl = explode(' sampai ', $tgl_full);
			$tgl_awal = $tgl[0];
			$tgl_akhir = $tgl[1];
			$judul = "Tanggal $tgl_awal s/d $tgl_akhir";

			$dt = $this->model->cetak_kas_bank_harian($id_klien, $tgl_awal, $tgl_akhir, $unit);
		
		} else if($filter == "Bulanan"){
			$tahun = $this->input->post('tahun');
			$bulan = $this->input->post('bulan');
			$bln_txt = $this->datetostr($bulan);
			$judul = "Bulan $bln_txt Tahun $tahun";

			$dt = $this->model->cetak_kas_bank_bulanan($id_klien, $bulan, $tahun, $unit);
		} 



		$data = array(
			'title' 		=> 'LAPORAN JURNAL BAYAR KAS BANK ',
			'title2'		=> 'SEMUA BAGIAN',
			'data'			=> $dt,
			'judul'			=> $judul,
			'dt_unit'		=> $dt_unit,
			'data_usaha'    => $this->master_model_m->data_usaha($id_klien),
		);
		$this->load->view($view,$data);
	}

	function cetak_bayar_kas_bank_xls(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		//$tgl   = $this->input->post('tgl');
		
		$filter = $this->input->post('filter');
		$unit = $this->input->post('unit');
		$view = "xls/report_jurnal_bayar_kas_bank_xls";
		$dt = "";
		$judul = "";

		

		if($filter == "Harian"){
			$tgl_full = $this->input->post('tgl');
			if($tgl_full == ""){
				$tgl_full = date('d-m-Y')." sampai ".date('d-m-Y');
			}
			
			$tgl = explode(' sampai ', $tgl_full);
			$tgl_awal = $tgl[0];
			$tgl_akhir = $tgl[1];
			$judul = "Tanggal $tgl_awal s/d $tgl_akhir";

			$dt = $this->model->cetak_kas_bank_harian($id_klien, $tgl_awal, $tgl_akhir, $unit);
		
		} else if($filter == "Bulanan"){
			$tahun = $this->input->post('tahun');
			$bulan = $this->input->post('bulan');
			$bln_txt = $this->datetostr($bulan);
			$judul = "Bulan $bln_txt Tahun $tahun";

			$dt = $this->model->cetak_kas_bank_bulanan($id_klien, $bulan, $tahun, $unit);
		} 



		$data = array(
			'title' 		=> 'LAPORAN JURNAL BAYAR KAS BANK ',
			'title2'		=> 'SEMUA BAGIAN',
			'data'			=> $dt,
			'judul'			=> $judul,
			'data_usaha'    => $this->master_model_m->data_usaha($id_klien),
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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */