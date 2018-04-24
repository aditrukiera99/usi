<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produksi_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('produksi_m','model');
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

			$item = $this->input->post('item');
			$jml_produksi = $this->input->post('jml_produksi');
			$jml_produksi = str_replace(',', '', $jml_produksi);
			$kode_akun    = $this->input->post('kode_akun');

			$id_bahan 	  = $this->input->post('id_bahan');
			$nama_bahan   = $this->input->post('nama_bahan');
			$qty_produksi = $this->input->post('qty_produksi');
			$sisa_stok    = $this->input->post('sisa_stok');
			$satuan       = $this->input->post('satuan');

			$this->model->simpan_produksi_barang($item, $jml_produksi, $user->UNIT, $kode_akun);
			$id_produksi = $this->db->insert_id();

			foreach ($id_bahan as $key => $val) {
				$this->model->simpan_produksi_barang_detail($id_produksi, $nama_bahan[$key], $qty_produksi[$key], $satuan[$key], $sisa_stok[$key], $val);
			}
		}

		$dt = $this->model->get_data_produk($keyword, $id_klien);
		$dt_history = $this->model->get_history($user->UNIT);
		$get_list_akun_all = $this->master_model_m->get_list_akun_all();

		$data =  array(
			'page' => "produksi_v", 
			'title' => "Produksi", 
			'msg' => "", 
			'master' => "produksi", 
			'view' => "produksi", 
			'dt' => $dt, 
			'dt_history' => $dt_history, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'post_url' => 'produksi_c', 
			'user' => $user, 
			'get_list_akun_all' => $get_list_akun_all, 
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

	function get_item_detail(){
		$id = $this->input->post('id');
		$dt = $this->model->get_item_detail($id);

		echo json_encode($dt);
	}

	function get_bahan_baku(){
		$id_produksi = $this->input->post('id_produksi');
		$dt = $this->model->get_barang_baku($id_produksi);

		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */