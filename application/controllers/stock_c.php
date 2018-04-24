<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }

	    $this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
	    $this->load->model('stock_m','model');
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

		$dt = $this->model->get_data_produk($keyword, $id_klien);

		if($this->input->post('pdf')){
			$this->cetak_pdf();
		} else if($this->input->post('excel')){
			$this->cetak_xls();
		}

		$data =  array(
			'page' => "stock_v", 
			'title' => "Stock", 
			'msg' => "", 
			'master' => "persediaan", 
			'view' => "stock", 
			'dt' => $dt, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'post_url' => 'stock_c', 
			'user' => $user, 
		);
		
		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
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

	function cetak_pdf(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		//$tgl   = $this->input->post('tgl');
		$judul = "";
		$lap_kategori_produk = $this->input->post("lap_kategori_produk");
		$unit = $user->UNIT;
		$view = "pdf/report_stok_pdf";
		$dt_unit = $this->master_model_m->get_unit_by_id($unit);
		$dt = $this->model->get_data_produk("", $id_klien);

		$data = array(
			'title' 		=> 'LAPORAN DAFTAR STOK PERSEDIAAN',
			'title2'		=> 'SEMUA BAGIAN',
			'data'			=> $dt,
			'judul'			=> $judul,
			'dt_unit'		=> $dt_unit,
			'data_usaha'    => $this->master_model_m->data_usaha($id_klien),
		);
		$this->load->view($view,$data);
	}

	function cetak_xls(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		//$tgl   = $this->input->post('tgl');
		$judul = "";
		$lap_kategori_produk = $this->input->post("lap_kategori_produk");
		$unit = $user->UNIT;
		$view = "xls/report_stok_xls";
		$dt_unit = $this->master_model_m->get_unit_by_id($unit);
		$dt = $this->model->get_data_produk("", $id_klien);

		$data = array(
			'title' 		=> 'LAPORAN DAFTAR STOK PERSEDIAAN',
			'title2'		=> 'SEMUA BAGIAN',
			'data'			=> $dt,
			'judul'			=> $judul,
			'dt_unit'		=> $dt_unit,
			'data_usaha'    => $this->master_model_m->data_usaha($id_klien),
		);
		$this->load->view($view,$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */