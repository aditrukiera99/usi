<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_transportir_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('master_transportir_m','model');
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
			
			$nama_master_transportir  = addslashes($this->input->post('nama_master_transportir'));
			$alamat_master_transportir  = addslashes($this->input->post('alamat_master_transportir'));

			$this->model->simpan_master_transportir($nama_master_transportir,$alamat_master_transportir);


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
		
			$id_gr          = addslashes($this->input->post('id_gr'));
			$nama_master_transportir_ed = addslashes($this->input->post('nama_transportir_ed'));
			$alamat_master_transportir_ed = addslashes($this->input->post('alamat_transportir_ed'));

			$this->model->edit_master_transportir($id_gr,$nama_master_transportir_ed,$alamat_master_transportir_ed);

			
		}

		$dt = $this->model->get_data_transportir();

		$data =  array(
			'page' => "master_transportir_v", 
			'title' => "master_transportir", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "master_transportir", 
			'dt' => $dt, 
			'msg' => $msg, 
			'post_url' => 'master_transportir_c', 
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