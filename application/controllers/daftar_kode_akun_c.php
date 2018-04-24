<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftar_kode_akun_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('daftar_kode_akun_m','model');
	}

	function index()
	{
		$keyword = "";
		$msg = "";
		$nomor_akun = "";
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

			$kode_grup   = $this->input->post('kode_grup');
			$kode_sub   = $this->input->post('kode_sub');
			$no_akun   = $this->input->post('no_akun');
			$tipe   = $this->input->post('tipe');

			$nama_akun  = addslashes($this->input->post('nama_akun'));
			$nomor_akun   = $kode_grup.".".$kode_sub.".".$no_akun;

			$id_akun = $this->model->simpan_akun($id_klien, $nama_akun, $nomor_akun, $kode_grup, $kode_sub, $tipe);

			$deskripsi_persetujuan = "Penambahan Kode Akun : <br> <b>Nama Akun : ".$nama_akun."</b> <br> <b> Nomor Akun : ".$nomor_akun."</b>";
			$this->master_model_m->simpan_persetujuan('kode_akun', $id_akun, 'ADD', $id_user, $deskripsi_persetujuan);
			$this->master_model_m->simpan_log($id_user, "Menambah Kode akun <b>".$nomor_akun."</b>");

		} else if($this->input->post('id_hapus')){
			if($user->LEVEL == "USER"){
				$msg = 22;
			} else {
				$msg = 2;
			}
			
			$id   = $this->input->post('id_hapus');
			$item = $this->model->cari_kode_by_id($id);
			$deskripsi_persetujuan = "Penghapusan Kode Akun : <br> <b>Kode Akun : ".$item->KODE_AKUN."</b> <br> <b>Nama Akun : ".$item->NAMA_AKUN."</b>";
			$this->master_model_m->simpan_persetujuan('kode_akun', $id, 'DELETE', $id_user, $deskripsi_persetujuan);

			$this->model->hapus_akun($id);

			$this->master_model_m->simpan_log($id_user, "Menghapus Kode akun <b>".$item->KODE_AKUN."</b>");


		} else if($this->input->post('edit')){
			if($user->LEVEL == "USER"){
				$msg = 11;
			} else {
				$msg = 1;
			}

			$nama_akun_ed  = addslashes($this->input->post('nama_akun_ed'));
			$id_akun_ed    = $this->input->post('id_akun_ed');
			$nomor_akun_ed = addslashes($this->input->post('nomor_akun_ed'));
			$deskripsi_ed  = addslashes($this->input->post('deskripsi_ed'));
			$tipe_ed       = addslashes($this->input->post('tipe_ed'));

			$nomor_akun = addslashes($this->input->post('nomor_akun_ed'));

			if($user->LEVEL == "USER"){
				$this->db->query('INSERT INTO ak_kode_akuntansi_edit SELECT * FROM ak_kode_akuntansi WHERE ID = '.$id_akun_ed);			
			}

			$this->model->edit_akun($id_akun_ed, $nama_akun_ed, $nomor_akun_ed, $deskripsi_ed, $tipe_ed);
			$deskripsi_persetujuan = "Pengubahan Kode Akun : <br> <b>Nama Akun : ".$nama_akun_ed."</b> <br> <b> Nomor Akun : ".$nomor_akun_ed."</b>";
			$this->master_model_m->simpan_persetujuan('kode_akun', $id_akun_ed, 'EDIT', $id_user, $deskripsi_persetujuan);
			$this->master_model_m->simpan_log($id_user, "Mengubah Kode akun <b>".$nomor_akun_ed."</b>");
		}

		$dt = $this->model->get_no_akun($keyword, $id_klien, $user->UNIT);

		$data =  array(
			'page' => "daftar_kode_akun_v", 
			'title' => "Daftar Kode Akuntansi", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "daftar_akun", 
			'dt' => $dt, 
			'dt_grup' => $this->model->get_data_grup('', $user->UNIT), 
			'msg' => $msg, 
			'nomor_akun' => $nomor_akun, 
			'user' => $user, 
			'post_url' => 'daftar_kode_akun_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function cari_kode(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		$keyword = $this->input->get('keyword');
		$dt = $this->model->get_no_akun($keyword, $id_klien);

		echo json_encode($dt);
	}

	function cari_kode_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_kode_by_id($id);

		echo json_encode($dt);
	}

	function cari_sub_by_id(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		$kode_grup = $this->input->get('kode_grup');
		$dt = $this->model->cari_sub_by_id($kode_grup, $user->UNIT);

		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */