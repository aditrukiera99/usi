<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang_produksi_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('barang_produksi_m','model');
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
			$kode_akun_utama = $this->input->post('kode_akun_utama');

			$produk 	 = $this->input->post('produk');
			$kode_item   = $this->input->post('kode_item');
			$stok        = $this->input->post('stok');
			$qty         = $this->input->post('qty');
			$satuan      = $this->input->post('satuan');

			$this->model->simpan_produksi($kode_akun_utama, $item, $user->UNIT);

			$id_produksi = $this->db->insert_id();

			foreach ($produk as $key => $val) {
				$this->model->simpan_produksi_detail($id_produksi, $val, $satuan[$key], $qty[$key]);
			}

		} else if($this->input->post('ubah')){
			$msg = 3;
			$id_produksi = $this->input->post('id_produksi');
			$kode_item   = $this->input->post('item');

			$produk 	 = $this->input->post('produk');
			$kode_item   = $this->input->post('kode_item');
			$stok        = $this->input->post('stok');
			$qty         = $this->input->post('qty');
			$satuan      = $this->input->post('satuan');

			$this->model->ubah_produksi($id_produksi, $item, $user->UNIT);
			$this->db->query("DELETE FROM ak_barang_produksi_detail WHERE ID_PRODUKSI = '$id_produksi' ");
			foreach ($produk as $key => $val) {
				$this->model->simpan_produksi_detail($id_produksi, $val, $satuan[$key], $qty[$key]);
			}

		} else if($this->input->post('id_hapus')){
			$msg = 2;
			$id_hapus = $this->input->post('id_hapus');
			$this->db->query("DELETE FROM ak_barang_produksi WHERE ID = '$id_hapus' ");
			$this->db->query("DELETE FROM ak_barang_produksi_detail WHERE ID_PRODUKSI = '$id_hapus' ");

			$this->master_model_m->simpan_log($id_user, "Menghapus Barang Produksi");
		}

		$dt = $this->model->get_data_produk($keyword, $id_klien);
		$get_list_akun_all = $this->master_model_m->get_list_akun_all();

		$data =  array(
			'page' => "barang_produksi_v", 
			'title' => "Barang Produksi", 
			'msg' => "", 
			'master' => "produksi", 
			'view' => "barang_produksi", 
			'dt' => $dt, 
			'msg' => $msg, 
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
			'page' => "new_barang_produksi_v", 
			'title' => "Barang Produksi", 
			'msg' => "", 
			'master' => "produksi", 
			'view' => "barang_produksi", 
			'dt' => $dt, 
			'msg' => $msg, 
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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */