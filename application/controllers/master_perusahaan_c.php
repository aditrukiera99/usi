<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_perusahaan_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('master_perusahaan_m','model');
	}

	function index()
	{
		$keyword = "";
		$alert = "";
		$msg = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];

		if($this->input->post('simpan')){

			$nama_lengkap   = addslashes($this->input->post('nama_lengkap'));
			$username   = addslashes($this->input->post('username'));
			$temp_image     = $this->input->post('temp_image');
			$is_ganti       = $this->input->post('is_ganti');

			$this->model->ubah_nama($id_user, $nama_lengkap, $username);

			if($temp_image != 1 && $is_ganti != 1){
		    	$msg = 1;
		    } else if($temp_image == 1 && $is_ganti != 1){
		    	$msg = 1;
		    }


			if($temp_image == 1){
	            $name_array = array();
				$count = count($_FILES['userfile']['size']);
				foreach($_FILES as $key=>$value)
				for($s=0; $s<=$count-1; $s++) {
					$_FILES['userfile']['name']    	= str_replace(' ', '_', $value['name'][$s]) ;
					$_FILES['userfile']['type']    	= $value['type'][$s];
					$_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
					$_FILES['userfile']['error']    = $value['error'][$s];
					$_FILES['userfile']['size']    	= $value['size'][$s];  
					$config['upload_path'] = './files/foto/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '200000';
					$config['max_width']  = '10000';
					$config['max_height']  = '10000';
					$this->load->library('upload', $config);
					$this->upload->do_upload();
					$data = $this->upload->data();
					$name_array[] = $data['file_name'];

					$this->model->edit_ava_user($id_user, str_replace(' ', '_', $value['name'][$s]) );
				}
		    }

		    if($is_ganti == 1){

		    	$data_user = $this->model->get_data_akun($id_user);
		    	$pass_lama  = $this->input->post('pass_lama');
		    	$pass_baru1 = $this->input->post('pass_baru1');
		    	$pass_baru2 = $this->input->post('pass_baru2');

		    	if($data_user->PASSWORD != md5(md5($pass_lama))) {
		    		$alert = 1;
		    	} else {
		    		if($pass_baru1 != $pass_baru2){
		    			$alert = 2;
		    		} else {
		    			$this->model->ganti_password($id_user, $pass_baru1);
		    			$msg = 1;
		    		}
		    	}
		    }

		    
		}

		if($this->input->post('simpan_bank')){
			$nama_bank     		 = $this->input->post('nama_bank');
			$rekening_bank       = $this->input->post('rekening_bank');
			$atas_nama       	 = $this->input->post('atas_nama');
			$cabang       	     = $this->input->post('cabang');

			$this->model->simpan_bank($nama_bank, $rekening_bank, $atas_nama , $cabang);
		}

		if($this->input->post('update_bank')){
			$id_bank     		 = $this->input->post('id_bank');
			$nama_bank     		 = $this->input->post('nama_bank');
			$rekening_bank       = $this->input->post('rekening_bank');
			$atas_nama       	 = $this->input->post('atas_nama');
			$cabang       	     = $this->input->post('cabang');

			$this->model->update_bank($id_bank,$nama_bank, $rekening_bank, $atas_nama , $cabang);
		}

		$dt = $this->model->get_data_rekening();

		$data =  array(
			'page' => "master_perusahaan_v", 
			'title' => "Pengaturan Akun", 
			'master' => "setting", 
			'view' => "master_perusahaan", 
			'dt' => $dt, 
			'msg' => $msg, 
			'alert' => $alert, 
			'post_url' => 'master_perusahaan_c', 
		);
		
		$user = $this->master_model_m->get_user_info($id_user);
		if($user->LEVEL == "ADMIN"){
			$this->load->view('beranda_super_v', $data);
		} else if($user->LEVEL == "MANAGER"){
			$this->load->view('beranda_admin_v', $data);
		} else if($user->LEVEL == "TAMBORA"){
			$this->load->view('beranda_tambora_v', $data);
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

	function get_master(){
		$id = $this->input->get('id_pel');
		$dt = $this->model->get_master($id);

		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */