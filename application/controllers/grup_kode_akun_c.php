<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grup_kode_akun_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('grup_kode_akun_m','model');
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
			
			$grup         = addslashes($this->input->post('grup'));
			$kode_grup    = addslashes($this->input->post('kode_grup'));
			$nama_grup    = addslashes($this->input->post('nama_grup'));

			$id_kat = $this->model->simpan_grup($user->UNIT, $grup, $kode_grup, $nama_grup);

			$deskripsi_persetujuan = "Penambahan Grup Akun : <br> <b>Nama Grup : ".$nama_grup."</b> <br> <b> Kode Grup : ".$kode_grup."</b>";
			$this->master_model_m->simpan_persetujuan('kode_grup', $id_kat, 'ADD', $id_user, $deskripsi_persetujuan);
			$this->master_model_m->simpan_log($id_user, "Menambah Grup Kode Akun <b>".$kode_grup." : ".$nama_grup."</b>");

		} else if($this->input->post('id_hapus')){

			if($user->LEVEL == "USER"){
				$msg = 22;
			} else {
				$msg = 2;
			}
			
			$id   = $this->input->post('id_hapus');

			$item = $this->model->cari_grup_by_id($id);
			$deskripsi_persetujuan = "Penghapusan Grup Kode Akun : <br> <b>Kode Grup : ".$item->KODE_GRUP."</b>";
			$this->master_model_m->simpan_persetujuan('kode_grup', $id, 'DELETE', $id_user, $deskripsi_persetujuan);
			$this->model->hapus_kategori($id);
			$this->master_model_m->simpan_log($id_user, "Menghapus Grup Kode Akun <b>".$item->KODE_GRUP." : ".$item->NAMA_GRUP."</b>");

		} else if($this->input->post('edit')){
			if($user->LEVEL == "USER"){
				$msg = 11;
			} else {
				$msg = 1;
			}			


			$id_grup   = $this->input->post('id_grup');

			if($user->LEVEL == "USER"){
				$this->db->query('INSERT INTO ak_grup_kode_akun_edit SELECT * FROM ak_grup_kode_akun WHERE ID = '.$id_grup);			
			}

			$nama_grup_ed   = addslashes($this->input->post('nama_grup_ed'));
			$kode_grup_ed   = addslashes($this->input->post('kode_grup_ed'));
			$this->model->edit_grup($id_grup, $nama_grup_ed);

			$deskripsi_persetujuan = "Pengubahan Grup Kode Akun : <br> <b>Nama Grup : ".$nama_grup_ed."</b> <br> <b> Kode Grup : ".$kode_grup_ed."</b>";
			$this->master_model_m->simpan_persetujuan('kode_grup', $id_grup, 'EDIT', $id_user, $deskripsi_persetujuan);
			$this->master_model_m->simpan_log($id_user, "Mengubah Grup Kode Akun <b>".$nama_grup_ed."</b>");
		}

		$dt = $this->model->get_data_grup($keyword, $user->UNIT);

		$data =  array(
			'page' => "grup_kode_akun_v", 
			'title' => "Grup Kode Akun", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "grup_akun", 
			'dt' => $dt, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'post_url' => 'grup_kode_akun_c', 
			'user' => $user,
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

	function cari_grup_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_grup_by_id($id);

		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */