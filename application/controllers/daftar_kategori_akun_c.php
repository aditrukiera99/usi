<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftar_kategori_akun_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('daftar_kategori_akun_m','model');
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
			
			$nama_kat     = addslashes($this->input->post('nama_kat'));
			$deskripsi    = addslashes($this->input->post('deskripsi'));
			if($deskripsi == ""){
				$deskripsi = "-";
			}

			$id_kat = $this->model->simpan_kat($id_klien, $nama_kat, $deskripsi, $id_user);

			$deskripsi_persetujuan = "Penambahan Kategori Akun : <br> <b>Nama Kategori : ".$nama_kat."</b> <br> <b> Deskripsi : ".$deskripsi."</b>";
			$this->master_model_m->simpan_persetujuan('kategori_akun', $id_kat, 'ADD', $id_user, $deskripsi_persetujuan);
			$this->master_model_m->simpan_log($id_user, "Menambah kategori akun <b>".$nama_kat."</b>");

		} else if($this->input->post('id_hapus')){

			if($user->LEVEL == "USER"){
				$msg = 22;
			} else {
				$msg = 2;
			}
			
			$id   = $this->input->post('id_hapus');

			$item = $this->model->cari_kat_by_id($id);
			$deskripsi_persetujuan = "Penghapusan Kategori Akun : <br> <b>Nama Kategori : ".$item->NAMA_KATEGORI."</b>";
			$this->master_model_m->simpan_persetujuan('kategori_akun', $id, 'DELETE', $id_user, $deskripsi_persetujuan);
			$this->model->hapus_kategori($id);
			$this->master_model_m->simpan_log($id_user, "Menghapus kategori akun <b>".$item->NAMA_KATEGORI."</b>");

		} else if($this->input->post('edit')){
			if($user->LEVEL == "USER"){
				$msg = 11;
			} else {
				$msg = 1;
			}
			

			$id_kat   = $this->input->post('id_kat');
			$nama_kat_ed   = addslashes($this->input->post('nama_kat_ed'));
			$deskripsi_ed   = addslashes($this->input->post('deskripsi_ed'));

			if($user->LEVEL == "USER"){
				$this->db->query('INSERT INTO ak_kategori_akun_edit SELECT * FROM ak_kategori_akun WHERE ID = '.$id_kat);				
			}

			$this->model->edit_kat($id_kat, $nama_kat_ed, $deskripsi_ed);

			$deskripsi_persetujuan = "Pengubahan Kategori Akun : <br> <b>Nama Kategori : ".$nama_kat_ed."</b> <br> <b> Deskripsi : ".$deskripsi_ed."</b>";
			$this->master_model_m->simpan_persetujuan('kategori_akun', $id_kat, 'EDIT', $id_user, $deskripsi_persetujuan);
			
			$this->master_model_m->simpan_log($id_user, "Mengubah kategori akun <b>".$nama_kat_ed."</b>");
		}

		$dt = $this->model->get_data_kategori($keyword, $id_klien);

		$data =  array(
			'page' => "daftar_kategori_akun_v", 
			'title' => "Daftar Kategori Akun", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "daftar_kat_akun", 
			'dt' => $dt, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'post_url' => 'daftar_kategori_akun_c', 
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

	function cari_kat_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_kat_by_id($id);

		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */