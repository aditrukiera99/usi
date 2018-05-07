<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grup_aset_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
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
			$msg = 1;
			$nama_grup       = $this->input->post('nama_grup');
			$this->db->query("INSERT INTO ak_aset_grup (GRUP) VALUES ('$nama_grup')");

		} else if($this->input->post('edit')){
			$msg = 1;
			$nama_grup_ed   = $this->input->post('nama_grup_ed');
			$id_grup    = $this->input->post('id_grup');

			$this->db->query("UPDATE ak_aset_grup SET GRUP = '$nama_grup_ed' WHERE ID = '$id_grup' ");

		} else if($this->input->post('id_hapus')){
			$msg = 2;
			$id_hapus = $this->input->post('id_hapus');
			$this->db->query("DELETE FROM ak_aset_grup WHERE ID = '$id_hapus' ");
		}

		$dt = $this->db->query("SELECT * FROM ak_aset_grup ORDER BY ID ASC")->result();

		$data =  array(
			'page' => "grup_aset_v", 
			'title' => "Grup Aset", 
			'msg' => "", 
			'master' => "aset", 
			'view' => "grup_aset", 
			'dt' => $dt, 
			'msg' => $msg, 
			'post_url' => 'grup_aset_c', 
			'user' => $user, 
		);
		
		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
	}

	function add_new()
	{
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		$dt = $this->model->get_data_produk2($keyword, $id_klien);
		$get_list_akun_all = $this->master_model_m->get_list_akun_all();

		$data =  array(
			'page' => "new_harga_v", 
			'title' => "Input Harga Baru", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "harga", 
			'dt' => $dt, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'get_list_akun_all' => $get_list_akun_all, 
			'post_url' => 'harga_c', 
			'user' => $user, 
		);
		
		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
	}

	function update_harga($id_produk){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		$dt = $this->model->get_data_produk_by_id($id_produk);
		$get_list_akun_all = $this->master_model_m->get_list_akun_all();

		$data =  array(
			'page' => "update_harga_v", 
			'title' => "Update Harga", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "harga", 
			'dt' => $dt, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'get_list_akun_all' => $get_list_akun_all, 
			'post_url' => 'harga_c', 
			'user' => $user, 
		);
		
		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
	}

	function ubah($id_produksi)
	{
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		$dt = $this->model->get_data_produk2($keyword, $id_klien);

		$dt_produksi = $this->model->get_data_barang_produksi_by_id($id_produksi);
		$dt_produksi_detail = $this->model->get_data_barang_produksi_detail_by_id($id_produksi);
		$get_list_akun_all = $this->master_model_m->get_list_akun_all();

		$data =  array(
			'page' => "ubah_barang_produksi_v", 
			'title' => "Barang Produksi", 
			'msg' => "", 
			'master' => "produksi", 
			'view' => "barang_produksi", 
			'dt' => $dt, 
			'dt_produksi' => $dt_produksi, 
			'dt_produksi_detail' => $dt_produksi_detail, 
			'msg' => $msg, 
			'id_produksi' => $id_produksi, 
			'kode_produk' => $kode_produk, 
			'get_list_akun_all' => $get_list_akun_all, 
			'post_url' => 'barang_produksi_c', 
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

	function get_history_harga(){
		$id = $this->input->get('id');
		$dt = $this->model->get_history_harga($id);

		echo json_encode($dt);

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */