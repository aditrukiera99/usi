<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sub_grup_kode_akun_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('sub_grup_kode_akun_m','model');
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
			
			$grup        = addslashes($this->input->post('grup'));
			$kode_sub    = addslashes($this->input->post('kode_sub'));
			$nama_sub    = addslashes($this->input->post('nama_sub'));

			$id_kat = $this->model->simpan_sub_grup($user->UNIT, $grup, $kode_sub, $nama_sub);

			$deskripsi_persetujuan = "Penambahan Sub Grup Kode Akun : <br> <b>Kode Sub Grup : ".$kode_sub."</b> <br> <b> Nama Sub Grup : ".$nama_sub."</b>";
			$this->master_model_m->simpan_persetujuan('kode_sub', $id_kat, 'ADD', $id_user, $deskripsi_persetujuan);
			$this->master_model_m->simpan_log($id_user, "Menambah Sub Grup Kode Akun <b>".$kode_sub." : ".$nama_sub."</b>");

		} else if($this->input->post('id_hapus')){

			if($user->LEVEL == "USER"){
				$msg = 22;
			} else {
				$msg = 2;
			}
			
			$id   = $this->input->post('id_hapus');
			$item = $this->model->cari_subgrup_by_id($id);
			$deskripsi_persetujuan = "Penghapusan Sub Grup Kode Akun : <br> <b>Kode Sub Grup : ".$item->KODE_SUB."</b> <br> <b>Nama Sub Grup : ".$item->NAMA_SUB."</b>";
			$this->master_model_m->simpan_persetujuan('kode_sub', $id, 'DELETE', $id_user, $deskripsi_persetujuan);
			$this->model->hapus_kategori($id);
			$this->master_model_m->simpan_log($id_user, "Menghapus Sub Grup Kode Akun <b>".$item->KODE_SUB." : ".$item->NAMA_SUB."</b>");

		} else if($this->input->post('edit')){
			if($user->LEVEL == "USER"){
				$msg = 11;
			} else {
				$msg = 1;
			}
			

			$id_sub   = $this->input->post('id_sub');

			if($user->LEVEL == "USER"){
				$this->db->query('INSERT INTO ak_sub_grup_kode_akun_edit SELECT * FROM ak_sub_grup_kode_akun WHERE ID = '.$id_sub);			
			}

			$nama_sub_grup_ed   = addslashes($this->input->post('nama_sub_grup_ed'));
			$kode_sub_grup_ed   = addslashes($this->input->post('kode_sub_grup_ed'));
			$this->model->edit_subgrup($id_sub, $nama_sub_grup_ed);

			$deskripsi_persetujuan = "Pengubahan Sub Grup Kode Akun : <br> <b>Nama Sub Grup : ".$nama_sub_grup_ed."</b> <br> <b> Kode Sub Grup : ".$kode_sub_grup_ed."</b>";
			$this->master_model_m->simpan_persetujuan('kode_sub', $id_sub, 'EDIT', $id_user, $deskripsi_persetujuan);

			$this->master_model_m->simpan_log($id_user, "Mengubah Sub Grup Kode Akun <b>".$kode_sub_grup_ed."</b>");
		}

		$dt = $this->model->get_data_subgrup($keyword, $user->UNIT);
		$dt_grup = $this->model->get_data_grup($keyword, $user->UNIT);

		$data =  array(
			'page' => "sub_grup_kode_akun_v", 
			'title' => "Sub Grup Kode Akun", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "sub_grup", 
			'dt' => $dt, 
			'dt_grup' => $dt_grup, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'post_url' => 'sub_grup_kode_akun_c', 
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

	function cari_subgrup_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_subgrup_by_id($id);

		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */