<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelanggan_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		error_reporting(0);
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
			$tipe_perusahaan  = addslashes($this->input->post('tipe_perusahaan'));
			$kode_pelanggan  = addslashes($this->input->post('kode_pelanggan'));
			$npwp 			 = addslashes($this->input->post('npwp'));
			$alamat_tagih    = addslashes($this->input->post('alamat_tagih'));
			$alamat_kirim    = addslashes($this->input->post('alamat_kirim'));
			$no_telp   	     = $this->input->post('no_telp');
			$no_hp   		 = $this->input->post('no_hp');
			$email   		 = $this->input->post('email');
			$limit_beli   	 = $this->input->post('limit_beli');
			$tipe   		 = $this->input->post('tipe');
			$wilayah   		 = $this->input->post('wilayah');
			$ppn   		 	 = $this->input->post('ppn');
			$pph_23   		 = $this->input->post('pph_23');
			$pph_15   		 = $this->input->post('pph_15');
			$pph_21   		 = $this->input->post('pph_21');
			$pph_22   		 = $this->input->post('pph_22');
			$oat   		 	 = $this->input->post('oat');
			$pajak_pbbkb   	 = $this->input->post('pajak_pbbkb');
			$nama_usaha   	 = addslashes($this->input->post('nama_usaha'));
			$tdp   	 	     = addslashes($this->input->post('tdp'));
			$siup   	     = addslashes($this->input->post('siup'));
			$kode_customer   = addslashes($this->input->post('kode_customer'));
			$lokasi   	     = addslashes($this->input->post('lokasi'));
			$supply_point    = addslashes($this->input->post('supply_point'));
			$aksi_on   	     = addslashes($this->input->post('aksi_on'));
			$rek_bank   	 = addslashes($this->input->post('rek_bank'));
			$aksi_bd   	 	 = $this->input->post('aksi_bd');
			// $diskon_beli   	     = addslashes($this->input->post('diskon_beli'));
			// $diskon_jual   	     = addslashes($this->input->post('diskon_jual'));

			if($tipe == "Perorangan"){
				$nama_usaha = "";
				$tdp = "";
				$siup = "";
			}

			$id_pelanggan = $this->model->simpan_pelanggan($id_klien,$kode_pelanggan, $nama_pelanggan, $npwp, $alamat_tagih, $alamat_kirim, $no_telp, $no_hp, $email, $tipe, $nama_usaha, $tdp, $siup, $unit, $wilayah,$limit_beli,$ppn,$pph_23 ,$pph_15 ,$pajak_pbbkb,$kode_customer,$lokasi,$pph_21,$supply_point,$aksi_on,$oat,$tipe_perusahaan,$pph_22,$rek_bank);


			foreach ($aksi_bd as $key => $value) {
				$this->model->simpan_supply($kode_pelanggan,$value);
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
			$ppn   		 	 	  = $this->input->post('ppn_ed');
			$pph_23   		 	  = $this->input->post('pph_23_ed');
			$pph_15   		 	  = $this->input->post('pph_15_ed');
			$pph_21   		 	  = $this->input->post('pph_21_ed');
			$pph_22   		 	  = $this->input->post('pph_22_ed');
			$oat   		 	 	  = $this->input->post('oat_ed');
			$supply_point   	  = $this->input->post('supply_point');
			$aksi_bd   		 	  = $this->input->post('aksi_bd');
			$id_sp   		 	  = $this->input->post('id_sp');
			$kode_sh   		 	  = $this->input->post('kode_sh');
			$rekening_bank   	  = $this->input->post('rekening_bank');

			if($tipe_ed == "Perorangan"){
				$nama_usaha_ed = "";
				$tdp_ed = "";
				$siup_ed = "";
			}

			$nama_pelanggan       = addslashes($this->input->post('nama_pelanggan_ed'));



			if($user->LEVEL == "USER"){
				$this->db->query('INSERT INTO ak_pelanggan_edit SELECT * FROM ak_pelanggan WHERE ID = '.$id_pelanggan);		
			}			
			
			$this->model->edit_pelanggan($id_pelanggan, $nama_pelanggan_ed, $npwp_ed, $alamat_tagih_ed, $alamat_kirim_ed, $no_telp_ed, $no_hp_ed, $email_ed, $tipe_ed, $nama_usaha_ed, $tdp_ed, $siup_ed,$ppn,$pph_23,$pph_15,$pph_21,$oat,$rekening_bank,$pph_21);

			foreach ($supply_point as $key => $vl) {
				if($id_sp[$key] == ''){
					$this->model->insert_pelanggan_supply($aksi_bd[$key],$kode_sh);
				}else{
					$this->model->update_pelanggan_supply($aksi_bd[$key],$id_sp);
				}
			}
			
			$deskripsi_persetujuan = "Pengubahan Pelanggan : <br> <b>Nama Pelanggan : ".$nama_pelanggan_ed."</b> <br> <b> NPWP : ".$npwp_ed."</b> <br> <b> Alamat Tagih : ".$alamat_tagih_ed."</b> <br> <b> Alamat Kirim : ".$alamat_kirim_ed."</b>";
			$this->master_model_m->simpan_persetujuan('pelanggan', $id_pelanggan, 'EDIT', $id_user, $deskripsi_persetujuan);
			$this->master_model_m->simpan_log($id_user, "Mengubah Data Pelanggan dengan nama pelanggan : <b>".$nama_pelanggan_ed."</b>");
		}

		$dt = $this->model->get_data_pelanggan($keyword, $id_klien);
		$master_tipe = $this->model->get_master_tipe();
		$supply = $this->model->supply_kenter();

		$data =  array(
			'page' => "pelanggan_v", 
			'title' => "Daftar Pelanggan", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "daftar_pelanggan", 
			'dt' => $dt, 
			'msg' => $msg, 
			'nama_pelanggan' => $nama_pelanggan, 
			'master_tipe' => $master_tipe, 
			'supply' => $supply,
			'post_url' => 'pelanggan_c', 
			'user' => $user, 
		);
		
		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
	}

	function duplicate_pelanggan($id=""){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];

		
		$dt = $this->model->get_data_pelanggan_dup($id);
		$master_tipe = $this->model->get_master_tipe();
		$supply = $this->model->supply_kenter();

		$data =  array(
			'page' => "duplicate_pelanggan_v", 
			'title' => "Duplicate Pelanggan", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "daftar_pelanggan",
			'msg' => $msg, 
			'dt' => $dt,
			'master_tipe' => $master_tipe, 
			'supply' => $supply,
			'post_url' => 'pelanggan_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function ubah_data_customer($id=""){
		
		$msg = "";
		
		$dt = $this->model->cari_pelanggan_by_id($id);
		$master_tipe = $this->model->get_master_tipe();
		$supply = $this->model->supply_kenter();

		$data =  array(
			'page' => "ubah_data_customer_v", 
			'title' => "Duplicate Pelanggan", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "daftar_pelanggan",
			'msg' => $msg, 
			'dt' => $dt,
			'master_tipe' => $master_tipe, 
			'supply' => $supply,
			'post_url' => 'pelanggan_c', 
		);
		
		$this->load->view('beranda_v', $data);
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

	function save_tipe_usaha(){
		$tipe = addslashes($this->input->post('nama_tipe'));

		$sql = "
			INSERT INTO ak_master_tipe
			(NAMA)
			VALUES 
			('$tipe')
		";

		$this->db->query($sql);

		$sql_tampil = $this->db->query("SELECT * FROM ak_master_tipe ORDER BY ID ASC")->result();
		echo json_encode($sql_tampil);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */