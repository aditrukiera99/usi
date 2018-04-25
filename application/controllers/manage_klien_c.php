<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_klien_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect('login_tambora');
	    }
	    $this->load->model('manage_klien_m','model');
	    error_reporting(0);
	}

	function index()
	{
		$keyword = "";
		$alert = "";
		$msg = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		

		if($this->input->post('id_hapus')){
			$msg = 2;
			$id_hapus = $this->input->post('id_hapus');
			$this->model->hapus_user($id_hapus);

		} else if($this->input->post('edit_user')){
			$msg = 1;
			$id_edit = $this->input->post('id_edit');
			$nama_lengkap = $this->input->post('nama_lengkap');
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$this->model->edit_user($id_edit, $nama_lengkap, $username, $password);
		}

		$user = $this->master_model_m->get_user_info($id_user);
		$dt = $this->model->get_data_user($id_user, $user->UNIT);

		$data =  array(
			'page' => "manage_klien_v", 
			'title' => "Manage Klien", 
			'master' => "", 
			'view' => "", 
			'dt' => $dt, 
			'msg' => $msg, 
			'alert' => $alert, 
			'post_url' => 'manage_klien_c', 
			'unit' => $user->NAMA_UNIT, 
		);
		
		$this->load->view('beranda_tambora_v', $data);
	}

	function add_new_user(){
		$msg = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];

		$user = $this->master_model_m->get_user_info($id_user);
		if($this->input->post('simpan')){
		    $nama_lengkap = $this->input->post('nama_lengkap');
		    $username     = $this->input->post('username');
		    $password     = $this->input->post('password');
		    $password2    = $this->input->post('password2');

		    $cek_username = count($this->db->query("SELECT * FROM ak_user WHERE USERNAME = '$username' ")->result());
		    if($cek_username > 0){
		    	$msg = 11;
		    } else {
		    	if($password != $password2){
		    		$msg = 22;
		    	} else {
		    		$msg = 33;
		    		$pass = md5(md5($password));
		    		$this->db->query("INSERT INTO ak_user (ID_KLIEN, USERNAME, PASSWORD, NAMA, LEVEL, UNIT, APPROVE) VALUES (13, '$username', '$pass', '$nama_lengkap', 'ADMIN', '0', 1)");
		    	}
		    }
		}


		$data =  array(
			'msg' => $msg, 
			'page' => "add_new_klien_v", 
			'title' => "Add New User", 
			'unit' => $user->NAMA_UNIT, 
			'master' => "", 
			'view' => "", 
			'post_url' => 'manage_klien_c/add_new_user', 
		);
		
		$this->load->view('beranda_tambora_v', $data);
	}

	function kelola_akses($id){
		$dt_user = $this->model->get_user_data($id);
		$msg = "";

		if($this->input->post('simpan')){
			$msg = 33;
			$this->db->query("DELETE FROM ak_hak_akses WHERE ID_USER = '$id'");

			$menu_2 = $this->input->post('menu_2');

			foreach ($menu_2 as $key => $val) {
				$menu_1 = $this->db->query("SELECT b.NAMA FROM ak_menu_2 a JOIN ak_menu_1 b ON a.ID_MENU = b.ID WHERE a.NAMA = '$val'")->row()->NAMA;
				$this->model->simpan_hak_akses($id, $menu_1, $val);
			}
		}

		$data =  array(
			'msg' => $msg, 
			'id' => $id, 
			'dt_user' => $dt_user, 
			'page' => "kelola_akses_v", 
			'title' => "Kelola Hak Akses", 
			'master' => "setting", 
			'view' => "user_management", 
			'post_url' => 'user_management_c/kelola_akses/'.$id, 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function get_data_user(){
		$id = $this->input->post('id');
		$data = $this->model->get_data_user_by_id($id);
		echo json_encode($data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */