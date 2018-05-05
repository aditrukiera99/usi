<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gudang_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('gudang_m','model');
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
			
			$nama         = addslashes($this->input->post('nama'));
			$kapasitas         = addslashes($this->input->post('kapasitas'));
			$penanggung_jawab    = addslashes($this->input->post('penanggung_jawab'));


			$this->model->simpan_gudang($nama,$kapasitas,$penanggung_jawab);


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

		
			$nama         = addslashes($this->input->post('nama'));
			$kapasitas         = addslashes($this->input->post('kapasitas'));
			$penanggung_jawab    = addslashes($this->input->post('penanggung_jawab'));

			$this->model->edit_gudang($id_gr,$no_polisi,$merk,$tahun,$no_rangka,$no_mesin,$kapasitas,$sopir);

			
		}

		$dt = $this->model->get_data_gudang();

		$data =  array(
			'page' => "gudang_v", 
			'title' => "Master Gudang", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "gudang", 
			'dt' => $dt, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'post_url' => 'gudang_c', 
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

	function cari_gudang_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_gudang_by_id($id);

		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */