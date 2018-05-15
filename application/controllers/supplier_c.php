<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('supplier_m','model');
	}

	function index()
	{
		$keyword = "";
		$msg = "";
		$nama_supplier = "";
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

			$kode_sup   = addslashes($this->input->post('kode_sup'));
			$nama_supplier   = addslashes($this->input->post('nama_supplier'));
			$npwp 			 = addslashes($this->input->post('npwp'));
			$alamat_tagih    = addslashes($this->input->post('alamat_tagih'));
			$kota    		 = addslashes($this->input->post('kota'));
			$no_telp   	     = $this->input->post('no_telp');
			$no_hp   		 = $this->input->post('no_hp');
			$email   		 = $this->input->post('email');

			$tipe   		 = $this->input->post('tipe');
			$nama_usaha   	 = addslashes($this->input->post('nama_usaha'));
			$tdp   	 	     = addslashes($this->input->post('tdp'));
			$siup   	     = addslashes($this->input->post('siup'));

			if($tipe == "Perorangan"){
				$nama_usaha = "";
				$tdp = "";
				$siup = "";
			}


			$id_supplier = $this->model->simpan_supplier($id_klien,$kode_sup, $nama_supplier, $npwp, $alamat_tagih, $kota, $no_telp, $no_hp, $email, $tipe, $nama_usaha, $tdp, $siup);

			$deskripsi_persetujuan = "Penambahan Supplier : <br> <b>Nama Supplier : ".$nama_supplier."</b> <br> <b> NPWP : ".$npwp."</b> <br> <b> Alamat : ".$alamat_tagih."</b>";
			$this->master_model_m->simpan_persetujuan('supplier', $id_supplier, 'ADD', $id_user, $deskripsi_persetujuan);
			$this->master_model_m->simpan_log($id_user, "Menambah Data Supplier dengan nama supplier : <b>".$nama_supplier."</b>");

		} else if($this->input->post('id_hapus')){

			if($user->LEVEL == "USER"){
				$msg = 22;
			} else {
				$msg = 2;
			}
			
			$id   = $this->input->post('id_hapus');

			$item = $this->model->cari_supplier_by_id($id);
			$deskripsi_persetujuan = "Penghapusan Supplier : <br> <b>Nama Supplier : ".$item->NAMA_SUPPLIER."</b>";
			$this->master_model_m->simpan_persetujuan('supplier', $id, 'DELETE', $id_user, $deskripsi_persetujuan);

			$this->model->hapus_supplier($id);
			$this->master_model_m->simpan_log($id_user, "Menghapus Data Supplier dengan nama supplier : <b>".$item->NAMA_SUPPLIER."</b>");

		} else if($this->input->post('edit')){
			if($user->LEVEL == "USER"){
				$msg = 11;
			} else {
				$msg = 1;
			}
			

			$id_supplier    	  = $this->input->post('id_supplier');
			$nama_supplier_ed    = addslashes($this->input->post('nama_supplier_ed'));
			$npwp_ed    		  = addslashes($this->input->post('npwp_ed'));
			$alamat_tagih_ed      = addslashes($this->input->post('alamat_tagih_ed'));
			$no_telp_ed    		  = addslashes($this->input->post('no_telp_ed'));
			$no_hp_ed    		  = addslashes($this->input->post('no_hp_ed'));
			$email_ed    		  = addslashes($this->input->post('email_ed'));
			$tipe_ed    		  = addslashes($this->input->post('tipe_ed'));
			$nama_usaha_ed    	  = addslashes($this->input->post('nama_usaha_ed'));
			$tdp_ed    	          = addslashes($this->input->post('tdp_ed'));
			$siup_ed    	      = addslashes($this->input->post('siup_ed'));
			$kota_ed    	      = addslashes($this->input->post('kota_ed'));

			if($tipe_ed == "Perorangan"){
				$nama_usaha_ed = "";
				$tdp_ed = "";
				$siup_ed = "";
			}

			$nama_supplier       = addslashes($this->input->post('nama_supplier_ed'));

			if($user->LEVEL == "USER"){
				$this->db->query('INSERT INTO ak_supplier_edit SELECT * FROM ak_supplier WHERE ID = '.$id_supplier);			
			}

			$this->model->edit_supplier($id_supplier, $nama_supplier_ed, $npwp_ed, $alamat_tagih_ed, $no_telp_ed, $no_hp_ed, $email_ed, $tipe_ed, $nama_usaha_ed, $tdp_ed, $siup_ed, $kota_ed);
			$deskripsi_persetujuan = "Pengubahan Supplier : <br> <b>Nama Supplier : ".$nama_supplier_ed."</b> <br> <b> NPWP : ".$npwp_ed."</b> <br> <b> Alamat : ".$alamat_tagih_ed."</b>";
			$this->master_model_m->simpan_persetujuan('supplier', $id_supplier, 'EDIT', $id_user, $deskripsi_persetujuan);
			$this->master_model_m->simpan_log($id_user, "Mengubah Data Supplier dengan nama supplier : <b>".$nama_supplier_ed."</b>");
		}

		$dt = $this->model->get_data_supplier($keyword, $id_klien);

		$data =  array(
			'page' => "supplier_v", 
			'title' => "Daftar Supplier", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "daftar_supplier", 
			'dt' => $dt, 
			'msg' => $msg, 
			'nama_supplier' => $nama_supplier, 
			'post_url' => 'supplier_c', 
			'user' => $user, 
		);
		
		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
	}

	function cari_supplier(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		
		$keyword = $this->input->get('keyword');
		$dt = $this->model->get_data_supplier($keyword, $id_klien);

		echo json_encode($dt);
	}

	function cari_supplier_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_supplier_by_id($id);

		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */