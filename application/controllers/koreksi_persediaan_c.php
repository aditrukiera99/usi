<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Koreksi_persediaan_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('koreksi_persediaan_m','model');
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
			$no_trx2         = $this->input->post('no_trx2');
			$kode_akun         = $this->input->post('kode_akun');
			$no_koreksi      = addslashes($this->input->post('no_koreksi'));
			$tipe 			 = addslashes($this->input->post('tipe'));
			$tgl_trx 		 = addslashes($this->input->post('tgl_trx'));
			$no_ref 		 = addslashes($this->input->post('no_ref'));
			$catatan 	     = addslashes($this->input->post('catatan'));

			$produk 	     = $this->input->post('produk');
			$qty 	         = $this->input->post('qty');
			$harga_satuan 	 = $this->input->post('harga_satuan');

			$this->model->simpan_koreksi_persediaan($no_koreksi, $tipe, $tgl_trx, $no_ref, $catatan, $user->UNIT, $kode_akun);

			$id_koreksi = $this->db->insert_id();

			foreach ($produk as $key => $val) {
				$this->model->simpan_koreksi_persediaan_detail($id_koreksi, $val, $qty[$key], $harga_satuan[$key],  $user->UNIT);
				$this->model->update_produk($val, $qty[$key], $harga_satuan[$key]);
			}

			$this->model->save_next_nomor('Koreksi', $no_trx2);
		
		} else if($this->input->post('ubah')){
			$msg = 1;
			$id_koreksi      = $this->input->post('id_koreksi');
			$kode_akun       = $this->input->post('kode_akun');
			$no_koreksi      = addslashes($this->input->post('no_koreksi'));
			$tipe 			 = addslashes($this->input->post('tipe'));
			$tgl_trx 		 = addslashes($this->input->post('tgl_trx'));
			$no_ref 		 = addslashes($this->input->post('no_ref'));
			$catatan 	     = addslashes($this->input->post('catatan'));

			$produk 	     = $this->input->post('produk');
			$qty 	         = $this->input->post('qty');
			$harga_satuan 	 = $this->input->post('harga_satuan');

			$this->model->update_koreksi_persediaan($id_koreksi, $kode_akun, $tipe, $tgl_trx, $no_ref, $catatan);

			$this->db->query("DELETE FROM ak_koreksi_persediaan_detail WHERE ID_KOREKSI = '$id_koreksi' ");
			foreach ($produk as $key => $val) {
				$this->model->simpan_koreksi_persediaan_detail($id_koreksi, $val, $qty[$key], $harga_satuan[$key],  $user->UNIT);
				$this->model->update_produk($val, $qty[$key], $harga_satuan[$key]);
			}

		} else if($this->input->post('id_hapus')){
			$msg = 2;
			$id_hapus = $this->input->post('id_hapus');
			$this->db->query("DELETE FROM ak_koreksi_persediaan WHERE ID = '$id_hapus' ");
			$this->db->query("DELETE FROM ak_koreksi_persediaan_detail WHERE ID_KOREKSI = '$id_hapus' ");

			$this->master_model_m->simpan_log($id_user, "Menghapus Koreksi Persediaan");
		}

		$dt = $this->model->get_data_koreksi($user->UNIT);

		$data =  array(
			'page' => "koreksi_persediaan_v", 
			'title' => "Koreksi Persediaan", 
			'msg' => "", 
			'master' => "persediaan", 
			'view' => "koreksi_persediaan", 
			'dt' => $dt, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'post_url' => 'koreksi_persediaan_c', 
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

		$dt = $this->model->get_data_produk($keyword, $id_klien);
		$no_trx = $this->model->get_no_koreksi();
		$get_list_akun_all = $this->master_model_m->get_list_akun_all();

		$data =  array(
			'page' => "add_koreksi_persediaan_v", 
			'title' => "Koreksi Persediaan", 
			'msg' => "", 
			'master' => "persediaan", 
			'view' => "koreksi_persediaan", 
			'dt' => $dt, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'post_url' => 'koreksi_persediaan_c', 
			'user' => $user, 
			'no_trx' => $no_trx, 
			'get_list_akun_all' => $get_list_akun_all, 
		);
		
		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
	}

	function detail($id_koreksi)
	{
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		$dt = $this->model->get_data_koreksi_detail($id_koreksi);
		$dt_detail = $this->model->get_data_koreksi_detail2($id_koreksi);
		$no_trx = $this->model->get_no_koreksi();
		$get_list_akun_all = $this->master_model_m->get_list_akun_all();

		$data =  array(
			'page' => "detail_koreksi_persediaan_v", 
			'title' => "Koreksi Persediaan", 
			'msg' => "", 
			'master' => "persediaan", 
			'view' => "koreksi_persediaan", 
			'dt' => $dt, 
			'dt_detail' => $dt_detail, 
			'msg' => $msg, 
			'id_koreksi' => $id_koreksi, 
			'kode_produk' => $kode_produk, 
			'post_url' => 'koreksi_persediaan_c', 
			'user' => $user, 
			'no_trx' => $no_trx, 
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

	function cari_produk_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_produk_by_id($id);

		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */