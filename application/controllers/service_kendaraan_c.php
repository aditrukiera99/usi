<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_kendaraan_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('service_kendaraan_m','model');
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

		if($this->input->post('simpan')){
			if($user->LEVEL == "USER"){
				$msg = 33;
			} else {
				$msg = 1;
			}
			
			$kendaraan_pol          = addslashes($this->input->post('kendaraan_pol'));
			$tahun    				= addslashes($this->input->post('tahun'));
			$keterangan   			= addslashes($this->input->post('keterangan'));
			$biaya   				= addslashes($this->input->post('biaya'));

			$this->model->simpan_service_kendaraan($kendaraan_pol,$tahun,$keterangan,$biaya);


		} else if($this->input->post('id_hapus')){

			if($user->LEVEL == "USER"){
				$msg = 22;
			} else {
				$msg = 2;
			}
			
			$id   = $this->input->post('id_hapus');
			
			$this->model->hapus_kategori($id);
			

		} else if($this->input->post('edit')){
			if($user->LEVEL == "USER"){
				$msg = 11;
			} else {
				$msg = 1;
			}			


			$id_grup   = $this->input->post('id');

		
			$id_gr         = addslashes($this->input->post('id_gr'));
			$no_polisi         = addslashes($this->input->post('no_polisi'));
			$merk    = addslashes($this->input->post('merk'));
			$tahun    = addslashes($this->input->post('tahun'));
			$no_rangka    = addslashes($this->input->post('no_rangka'));
			$no_mesin    = addslashes($this->input->post('no_mesin'));
			$kapasitas    = addslashes($this->input->post('kapasitas'));
			$sopir    = addslashes($this->input->post('sopir'));

			$this->model->edit_kendaraan($id_gr,$no_polisi,$merk,$tahun,$no_rangka,$no_mesin,$kapasitas,$sopir);

			
		}

		$dt = $this->model->get_data_service_kendaraan();

		$data =  array(
			'page' => "service_kendaraan_v", 
			'title' => "Service Kendaraan", 
			'msg' => "", 
			'master' => "logistik", 
			'view' => "service_kendaraan", 
			'dt' => $dt, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'post_url' => 'service_kendaraan_c', 
			'user' => $user,
		);
		
		$this->load->view('beranda_v', $data);
	}

	function cari_kat(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		
		$keyword = $this->input->get('keyword');
		$dt = $this->model->get_data_kategori($keyword, $id_klien);

		echo json_encode($dt);
	}

	function cari_kendaraan_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_kendaraan_by_id($id);

		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */