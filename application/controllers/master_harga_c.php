<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_harga_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('master_harga_m','model');
	    $this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
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
			
			$kode_sh       = addslashes($this->input->post('kode_sh'));
			$nama_produk   = addslashes($this->input->post('nama_produk'));
			$harga_beli    = $this->input->post('harga_beli');
			$harga_jual    = $this->input->post('harga_jual');
			$periode       = $this->input->post('periode');

			$this->model->simpan_master_harga($kode_sh,$nama_produk,$harga_beli,$harga_jual,$periode);


		}else if($this->input->post('simpan_update')){
			if($user->LEVEL == "USER"){
				$msg = 33;
			} else {
				$msg = 1;
			}
			
			$id_master     = addslashes($this->input->post('id_master'));
			$kode_sh       = addslashes($this->input->post('kode_sh'));
			$id_produk     = addslashes($this->input->post('id_produk'));
			$harga_beli    = addslashes($this->input->post('harga_beli'));
			$harga_jual    = addslashes($this->input->post('harga_jual'));
			$periode     = $this->input->post('periode');

			$this->model->simpan_master_harga_update($kode_sh,$id_produk,$harga_beli,$harga_jual,$periode);
			$this->model->update_status_master($id_master);


		}else if($this->input->post('simpan_ganti')){
			if($user->LEVEL == "USER"){
				$msg = 33;
			} else {
				$msg = 1;
			}
			
			$id_master     = addslashes($this->input->post('id_master'));
			$kode_sh       = addslashes($this->input->post('kode_sh'));
			$id_produk     = addslashes($this->input->post('id_produk'));
			$harga_beli    = addslashes($this->input->post('harga_beli'));
			$harga_jual    = addslashes($this->input->post('harga_jual'));
			$periode     = $this->input->post('periode');

			$this->model->simpan_master_harga_ganti($id_master,$harga_beli,$harga_jual);
			// $this->model->update_status_master($id_master);


		}


		 else if($this->input->post('id_hapus')){

			if($user->LEVEL == "USER"){
				$msg = 22;
			} else {
				$msg = 2;
			}
			
			$id   = $this->input->post('id_hapus');
			
			$this->model->hapus_kategori($id);
			

		} else if($this->input->post('id_hapus_semua')){

			if($user->LEVEL == "USER"){
				$msg = 22;
			} else {
				$msg = 2;
			}
			
			$id   = $this->input->post('id_hapus_semua');
			
			$this->model->hapus_kategori_semua($id);
			

		} else if($this->input->post('edit')){
			if($user->LEVEL == "USER"){
				$msg = 11;
			} else {
				$msg = 1;
			}			


			$id_grup   = $this->input->post('id');

		
			$id_gr         = addslashes($this->input->post('id_gr'));
			$no_polisi         = addslashes($this->input->post('no_polisi'));
			$merk    = addslashes($this->input->post('merk'));
			$tahun    = addslashes($this->input->post('tahun'));
			$no_rangka    = addslashes($this->input->post('no_rangka'));
			$no_mesin    = addslashes($this->input->post('no_mesin'));
			$kapasitas    = addslashes($this->input->post('kapasitas'));
			$sopir    = addslashes($this->input->post('sopir'));

			$this->model->edit_master_harga($id_gr,$no_polisi,$merk,$tahun,$no_rangka,$no_mesin,$kapasitas,$sopir);

			
		}

		$dt = $this->model->get_data_master_harga();

		$data =  array(
			'page' => "master_harga_v", 
			'title' => "Master Harga", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "master_harga", 
			'dt' => $dt, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'post_url' => 'master_harga_c', 
			'user' => $user,
		);
		
		$this->load->view('beranda_v', $data);
	}

	function add_harga(){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		

		$dt_pel = $this->model->get_pelanggan($id_klien);

		$data =  array(
			'page' => "add_master_harga_v", 
			'title' => "Buat Harga Baru", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "master_harga", 
			'msg' => $msg, 
			'dt_pel' => $dt_pel,
			'post_url' => 'master_harga_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function ubah_harga($id=""){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		

		$dt = $this->model->get_pelanggan_detail($id);

		$data =  array(
			'page' => "ubah_master_harga_v", 
			'title' => "Buat Harga Baru", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "master_harga", 
			'msg' => $msg, 
			'dt' => $dt,
			'post_url' => 'master_harga_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function ganti_harga($id=""){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		

		$dt = $this->model->get_pelanggan_detail($id);

		$data =  array(
			'page' => "ganti_master_harga_v", 
			'title' => "Buat Harga Baru", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "master_harga", 
			'msg' => $msg, 
			'dt' => $dt,
			'post_url' => 'master_harga_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function cetak($id="",$id_p=""){

		$dt = $this->model->get_data_master($id,$id_p);

		$data =  array(
			'page' => "master_harga_c", 
			'dt' => $dt,
		);
		
		$this->load->view('pdf/report_master_harga_pdf', $data);
	}

	function cari_kat(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		
		$keyword = $this->input->get('keyword');
		$dt = $this->model->get_data_kategori($keyword, $id_klien);

		echo json_encode($dt);
	}

	function cari_master_harga_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_master_harga_by_id($id);

		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */