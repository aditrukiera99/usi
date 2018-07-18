<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_lowongan_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    // error_reporting(0);
	    $this->load->model('data_lowongan_m','model');
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
			
				$nama = $this->input->post('nama');
				$tgl_awal = $this->input->post('tgl_awal');
				$tgl_akhir = $this->input->post('tgl_akhir');
				$keterangan = $this->input->post('keterangan');
				$maksimal_umur = $this->input->post('maksimal_umur');
				$sertifikat = $this->input->post('sertifikat');
			

			$this->model->simpan_lowongan($nama,$tgl_awal,$tgl_akhir,$keterangan,$maksimal_umur);

			$id_lowongan = $this->db->insert_id(); 


			foreach ($sertifikat as $key => $value) {
				$this->model->simpan_lowongan_sertifikat($id_lowongan,$value[$key]);
			}


		} else if($this->input->post('id_hapus')){

			if($user->LEVEL == "USER"){
				$msg = 22;
			} else {
				$msg = 2;
			}
			
			$id   = $this->input->post('id_hapus');
			
			$this->model->hapus_lowongan($id);
			$this->model->hapus_lowongan_sertifikat($id);
			

		} else if($this->input->post('simpan_ubah')){

			$id = $this->input->post('id');
			$nama = $this->input->post('nama');
			$tgl_awal = $this->input->post('tgl_awal');
			$tgl_akhir = $this->input->post('tgl_akhir');
			$keterangan = $this->input->post('keterangan');
			$maksimal_umur = $this->input->post('maksimal_umur');
			$sertifikat = $this->input->post('sertifikat');			
		
			
			$this->model->edit_data_lowongan($id,$nama,$tgl_awal,$tgl_akhir,$keterangan,$maksimal_umur);

			$this->model->hapus_lowongan_sertifikat($id);

			foreach ($sertifikat as $key => $value) {
				$this->model->simpan_lowongan_sertifikat($id,$value);
			}

			
		}

		$dt = $this->model->get_data_transportir();
		$sertifikat = $this->db->query("SELECT * FROM ak_sertifikat")->result();

		$data =  array(
			'page' => "data_lowongan_v", 
			'title' => "Lowongan Pekerjaan", 
			'msg' => "", 
			'master' => "hrd", 
			'view' => "lowongan", 
			'dt' => $dt, 
			'sertifikat' => $sertifikat, 
			'msg' => $msg, 
			'post_url' => 'data_lowongan_c', 
			'user' => $user,
		);
		
		$this->load->view('beranda_v', $data);
	}

	function edit_lowongan_kerja($id=""){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		

		
		$dt = $this->model->cari_lowongan_by_id($id);

		$data =  array(
			'page' => "ubah_data_lowongan_v", 
			'title' => "Edit Lowongan Kerja", 
			'msg' => "", 
			'master' => "hrd", 
			'view' => "lowongan", 
			'msg' => $msg,
			'dt' => $dt,
			'post_url' => 'data_lowongan_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function data_pendaftar($id=""){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		

		
		$dt = $this->model->data_pendaftar_lowongan_a($id);

		$data =  array(
			'page' => "data_pendaftar_lowongan_v", 
			'title' => "Data Lowongan Kerja", 
			'msg' => "", 
			'master' => "hrd", 
			'view' => "lowongan", 
			'msg' => $msg,
			'dt' => $dt,
			'post_url' => 'data_lowongan_c', 
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

	function cari_lowongan_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_lowongan_by_id($id);

		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */