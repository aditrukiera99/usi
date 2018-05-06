<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelanggan_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('pelanggan_m','model');
	}

	function index()
	{
		$keyword = "";
		$msg = "";
		$nama_pelanggan = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);
		$unit = $user->UNIT;

		if($this->input->post('simpan')){
			if($user->LEVEL == "USER"){
				$msg = 33;
			} else {
				$msg = 1;
			}

			$nama_pelanggan  = addslashes($this->input->post('nama_pelanggan'));
			$npwp 			 = addslashes($this->input->post('npwp'));
			$alamat_tagih    = addslashes($this->input->post('alamat_tagih'));
			$alamat_kirim    = addslashes($this->input->post('alamat_kirim'));
			$no_telp   	     = $this->input->post('no_telp');
			$no_hp   		 = $this->input->post('no_hp');
			$email   		 = $this->input->post('email');
			$limit_beli   	 = $this->input->post('limit_beli');
			$tipe   		 = $this->input->post('tipe');
			$wilayah   		 = $this->input->post('wilayah');
			$nama_usaha   	 = addslashes($this->input->post('nama_usaha'));
			$tdp   	 	     = addslashes($this->input->post('tdp'));
			$siup   	     = addslashes($this->input->post('siup'));

			if($tipe == "Perorangan"){
				$nama_usaha = "";
				$tdp = "";
				$siup = "";
			}

			$id_pelanggan = $this->model->simpan_pelanggan($id_klien, $nama_pelanggan, $npwp, $alamat_tagih, $alamat_kirim, $no_telp, $no_hp, $email, $tipe, $nama_usaha, $tdp, $siup, $unit, $wilayah,$limit_beli);

			$broker_nama   = addslashes($this->input->post('broker_nama'));
			$broker_alamat = addslashes($this->input->post('broker_alamat'));
			$broker_telp   = addslashes($this->input->post('broker_telp'));
			$broker_ktp    = addslashes($this->input->post('broker_ktp'));
			$broker_npwp   = addslashes($this->input->post('broker_npwp'));
			$broker_komisi = $this->input->post('broker_komisi');
			$broker_komisi = str_replace(',', '', $broker_komisi);

			if($broker_nama != ""){
				$this->model->simpan_broker($id_pelanggan, $broker_nama, $broker_alamat, $broker_telp, $broker_ktp, $broker_npwp, $broker_komisi);
			}


			$deskripsi_persetujuan = "Penambahan Pelanggan : <br> <b>Nama Pelanggan : ".$nama_pelanggan."</b> <br> <b> NPWP : ".$npwp."</b> <br> <b> Alamat Tagih : ".$alamat_tagih."</b> <br> <b> Alamat Kirim : ".$alamat_kirim."</b>";
			$this->master_model_m->simpan_persetujuan('pelanggan', $id_pelanggan, 'ADD', $id_user, $deskripsi_persetujuan);
			$this->master_model_m->simpan_log($id_user, "Menambah Data Pelanggan dengan nama pelanggan : <b>".$nama_pelanggan."</b>");

		} else if($this->input->post('id_hapus')){

			if($user->LEVEL == "USER"){
				$msg = 22;
			} else {
				$msg = 2;
			}

			$id   = $this->input->post('id_hapus');

			$item = $this->model->cari_pelanggan_by_id($id);
			$deskripsi_persetujuan = "Penghapusan Pelanggan : <br> <b>Nama Pelanggan : ".$item->NAMA_PELANGGAN."</b>";
			$this->master_model_m->simpan_persetujuan('pelanggan', $id, 'DELETE', $id_user, $deskripsi_persetujuan);

			$this->model->hapus_pelanggan($id);
			$this->master_model_m->simpan_log($id_user, "Menghapus Data Pelanggan dengan nama pelanggan : <b>".$item->NAMA_PELANGGAN."</b>");

		} else if($this->input->post('edit')){
			if($user->LEVEL == "USER"){
				$msg = 11;
			} else {
				$msg = 1;
			}

			$id_pelanggan    	  = $this->input->post('id_pelanggan');
			$nama_pelanggan_ed    = addslashes($this->input->post('nama_pelanggan_ed'));
			$npwp_ed    		  = addslashes($this->input->post('npwp_ed'));
			$alamat_tagih_ed      = addslashes($this->input->post('alamat_tagih_ed'));
			$alamat_kirim_ed      = addslashes($this->input->post('alamat_kirim_ed'));
			$no_telp_ed    		  = addslashes($this->input->post('no_telp_ed'));
			$no_hp_ed    		  = addslashes($this->input->post('no_hp_ed'));
			$email_ed    		  = addslashes($this->input->post('email_ed'));
			$tipe_ed    		  = addslashes($this->input->post('tipe_ed'));
			$nama_usaha_ed    	  = addslashes($this->input->post('nama_usaha_ed'));
			$tdp_ed    	          = addslashes($this->input->post('tdp_ed'));
			$siup_ed    	      = addslashes($this->input->post('siup_ed'));

			if($tipe_ed == "Perorangan"){
				$nama_usaha_ed = "";
				$tdp_ed = "";
				$siup_ed = "";
			}

			$nama_pelanggan       = addslashes($this->input->post('nama_pelanggan_ed'));

			if($user->LEVEL == "USER"){
				$this->db->query('INSERT INTO ak_pelanggan_edit SELECT * FROM ak_pelanggan WHERE ID = '.$id_pelanggan);		
			}			
			
			$this->model->edit_pelanggan($id_pelanggan, $nama_pelanggan_ed, $npwp_ed, $alamat_tagih_ed, $alamat_kirim_ed, $no_telp_ed, $no_hp_ed, $email_ed, $tipe_ed, $nama_usaha_ed, $tdp_ed, $siup_ed);
			
			$deskripsi_persetujuan = "Pengubahan Pelanggan : <br> <b>Nama Pelanggan : ".$nama_pelanggan_ed."</b> <br> <b> NPWP : ".$npwp_ed."</b> <br> <b> Alamat Tagih : ".$alamat_tagih_ed."</b> <br> <b> Alamat Kirim : ".$alamat_kirim_ed."</b>";
			$this->master_model_m->simpan_persetujuan('pelanggan', $id_pelanggan, 'EDIT', $id_user, $deskripsi_persetujuan);
			$this->master_model_m->simpan_log($id_user, "Mengubah Data Pelanggan dengan nama pelanggan : <b>".$nama_pelanggan_ed."</b>");
		}

		$dt = $this->model->get_data_pelanggan($keyword, $id_klien);

		$data =  array(
			'page' => "pelanggan_v", 
			'title' => "Daftar Pelanggan", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "daftar_pelanggan", 
			'dt' => $dt, 
			'msg' => $msg, 
			'nama_pelanggan' => $nama_pelanggan, 
			'post_url' => 'pelanggan_c', 
			'user' => $user, 
		);
		
		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
	}

	function cari_pelanggan(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		
		$keyword = $this->input->get('keyword');
		$dt = $this->model->get_data_pelanggan($keyword, $id_klien);

		echo json_encode($dt);
	}

	function cari_pelanggan_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_pelanggan_by_id($id);

		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */