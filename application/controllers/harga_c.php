<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Harga_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('harga_m','model');
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
			$item       = $this->input->post('item');
			$harga_beli = $this->input->post('harga_beli');
			$harga_beli = str_replace(',', '', $harga_beli);
			
			$harga_jual = $this->input->post('harga_jual');
			$harga_jual = str_replace(',', '', $harga_jual);

			$this->model->simpan_harga($item, $harga_beli, $harga_jual, $user->UNIT);
			$this->master_model_m->simpan_log($id_user, "Menambah Harga Baru di Master Harga");

		} else if($this->input->post('edit')){
			$msg = 1;
			$id_produk_ed   = $this->input->post('id_produk_ed');
			$id_harga_ed    = $this->input->post('id_harga_ed');
			$nama_produk_ed = $this->input->post('nama_produk_ed');

			$harga_beli_ed 	 = $this->input->post('harga_beli_ed');
			$harga_beli_ed   = str_replace(',', '', $harga_beli_ed);

			$harga_jual_ed   = $this->input->post('harga_jual_ed');
			$harga_jual_ed   = str_replace(',', '', $harga_jual_ed);

			$this->db->query("UPDATE ak_harga SET HARGA_BELI = '$harga_beli_ed', HARGA_JUAL = '$harga_jual_ed' WHERE ID = '$id_harga_ed' ");
			$this->db->query("UPDATE ak_produk SET HARGA = '$harga_beli_ed', HARGA_JUAL = '$harga_jual_ed' WHERE ID = '$id_produk_ed' ");

			$this->master_model_m->simpan_log($id_user, "Mengubah Master Harga dengan Nama Barang <b>".$nama_produk_ed."</b>");

		} else if($this->input->post('update')){
			$msg = 1;
			$id_produk       = $this->input->post('id_produk');
			$produk       = $this->input->post('produk');
			$harga_beli = $this->input->post('harga_beli');
			$harga_beli = str_replace(',', '', $harga_beli);
			
			$harga_jual = $this->input->post('harga_jual');
			$harga_jual = str_replace(',', '', $harga_jual);

			$this->model->simpan_harga($id_produk, $harga_beli, $harga_jual, $user->UNIT);
			$this->master_model_m->simpan_log($id_user, "Update Harga Baru di Master Harga dengan nama Produk <b>".$produk."</b>");

		}  else if($this->input->post('id_hapus')){
			$msg = 2;
			$id_hapus = $this->input->post('id_hapus');
			$this->db->query("DELETE FROM ak_barang_produksi WHERE ID = '$id_hapus' ");
			$this->db->query("DELETE FROM ak_barang_produksi_detail WHERE ID_PRODUKSI = '$id_hapus' ");

			$this->master_model_m->simpan_log($id_user, "Menghapus Barang Produksi");
		}

		$dt = $this->model->get_data_produk($keyword, $id_klien);
		$get_list_akun_all = $this->master_model_m->get_list_akun_all();

		$data =  array(
			'page' => "harga_v", 
			'title' => "Master Harga", 
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