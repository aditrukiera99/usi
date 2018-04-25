<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Broker_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('broker_m','model');
	}

	function index()
	{
		$keyword = "";
		$msg = "";
		$nama_pelanggan = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);
		$unit = $user->UNIT;

		if($this->input->post('simpan')){
			$msg = 1;
			$nama_broker  = addslashes($this->input->post('nama_broker'));
			$ktp  = addslashes($this->input->post('ktp'));
			$npwp  = addslashes($this->input->post('npwp'));
			$alamat  = addslashes($this->input->post('alamat'));
			$no_telp  = addslashes($this->input->post('no_telp'));
			$no_hp  = addslashes($this->input->post('no_hp'));
			$email  = addslashes($this->input->post('email'));

			$this->model->simpan_pelanggan($id_klien, $nama_broker, $ktp, $npwp, $alamat, $no_telp, $no_hp, $email);
		
		} else if($this->input->post('id_hapus')){
			$msg = 2;

			$id   = $this->input->post('id_hapus');
			$this->model->hapus_pelanggan($id);

		} else if($this->input->post('edit')){
			$msg = 1;
			$id_broker    	  = $this->input->post('id_broker');
			$nama_broker_ed   = $this->input->post('nama_broker_ed');
			$ktp_ed    	      = $this->input->post('ktp_ed');
			$npwp_ed    	  = $this->input->post('npwp_ed');
			$alamat_ed    	  = $this->input->post('alamat_ed');
			$no_telp_ed    	  = $this->input->post('no_telp_ed');
			$no_hp_ed    	  = $this->input->post('no_hp_ed');
			$email_ed    	  = $this->input->post('email_ed');

			$this->model->edit_pelanggan($id_broker, $nama_broker_ed, $ktp_ed, $npwp_ed, $alamat_ed, $no_telp_ed, $no_hp_ed, $email_ed);

		}

		$dt = $this->model->get_data_pelanggan($keyword, $id_klien);

		$data =  array(
			'page' => "broker_v", 
			'title' => "Daftar Broker / Sales", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "broker", 
			'dt' => $dt, 
			'msg' => $msg, 
			'nama_pelanggan' => $nama_pelanggan, 
			'post_url' => 'broker_c', 
			'user' => $user, 
		);
		
		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
	}

	function cari_pelanggan(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		
		$keyword = $this->input->get('keyword');
		$dt = $this->model->get_data_pelanggan($keyword, $id_klien);

		echo json_encode($dt);
	}

	function cari_pelanggan_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_pelanggan_by_id($id);

		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */