<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('pegawai_m','model');
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
			
			$nik         = addslashes($this->input->post('nik'));
			$nama    = addslashes($this->input->post('nama'));
			$alamat    = addslashes($this->input->post('alamat'));
			$jabatan    = addslashes($this->input->post('jabatan'));
			$departemen    = addslashes($this->input->post('departemen'));

			$this->model->simpan_pegawai($nik,$nama,$alamat,$jabatan,$departemen);


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
			$nik         = $this->input->post('nik');
			$nama    = $this->input->post('nama');
			$alamat    = $this->input->post('alamat');
			$jabatan    = $this->input->post('jabatan');
			$departemen    = $this->input->post('departemen');

			$this->model->edit_pegawai($id_grup,$nik,$nama,$alamat,$jabatan,$departemen);

			
		}

		$dt = $this->model->get_data_pegawai();

		$data =  array(
			'page' => "pegawai_v", 
			'title' => "Data Pegawai", 
			'msg' => "", 
			'master' => "hrd", 
			'view' => "data_pegawai", 
			'dt' => $dt, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'post_url' => 'pegawai_c', 
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

	function cari_pegawai_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_pegawai_by_id($id);

		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */