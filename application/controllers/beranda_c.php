<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Beranda_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
	    $this->load->model('beranda_m','model');

	    error_reporting(0);
	}

	function index()
	{
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);
		$msg = "";
		$tgl_1 = date('d-m-Y');
		$tgl_2 = date('d-m-Y', strtotime('-1 days', strtotime($tgl_1)));
		$tgl_3 = date('d-m-Y', strtotime('-2 days', strtotime($tgl_1)));
		$tgl_4 = date('d-m-Y', strtotime('-3 days', strtotime($tgl_1)));
		$tgl_5 = date('d-m-Y', strtotime('-4 days', strtotime($tgl_1)));

		$bulan_1 = date('m-Y');
		$bulan_2 = date('m-Y', strtotime('-1 month', strtotime($tgl_1)));
		$bulan_3 = date('m-Y', strtotime('-2 month', strtotime($tgl_1)));
		$bulan_4 = date('m-Y', strtotime('-3 month', strtotime($tgl_1)));
		$bulan_5 = date('m-Y', strtotime('-4 month', strtotime($tgl_1)));

		if($this->input->post('simpan_unit')){
			$nama_unit_add = $this->input->post('nama_unit_add');
			$msg = 1;
			$this->db->query("INSERT INTO ak_unit (NAMA_UNIT, STS) VALUES ('$nama_unit_add', 1)");
		}

		if($this->input->post('ubah_unit')){
			$nama_unit_ed = $this->input->post('nama_unit_ed');
			$id_unit_ed = $this->input->post('id_unit_ed');
			$msg = 1;
			$this->db->query("UPDATE ak_unit SET NAMA_UNIT = '$nama_unit_ed' WHERE ID = '$id_unit_ed' ");
		}

		if($this->input->post('id_hapus')){
			$msg = 2;
			$id_hapus = $this->input->post('id_hapus');
			$this->db->query("DELETE FROM ak_unit WHERE ID = '$id_hapus'");

		}

		if($this->input->post('simpan_pengaturan')){
			$nama_app = $this->input->post('nama_app');
			$batas_unit = $this->input->post('batas_unit');

			$this->db->query("UPDATE ak_profil_usaha SET NAMA_APP = '$nama_app', BATAS_UNIT = '$batas_unit' ");
			$msg = 1;
		}

		if($this->input->post('matikan_aplikasi')){
			$this->db->query("UPDATE ak_profil_usaha SET AKTIF = 0");
		}

		if($this->input->post('aktifkan_aplikasi')){
			$this->db->query("UPDATE ak_profil_usaha SET AKTIF = 1");
		}

		if($this->input->post('ganti_logo')){
			$name_array = array();
			$count = count($_FILES['userfile']['size']);
			foreach($_FILES as $key=>$value)
			for($s=0; $s<=$count-1; $s++) {
				$_FILES['userfile']['name']    	= str_replace(' ', '_', $value['name'][$s]) ;
				$_FILES['userfile']['type']    	= $value['type'][$s];
				$_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
				$_FILES['userfile']['error']    = $value['error'][$s];
				$_FILES['userfile']['size']    	= $value['size'][$s];  
				$config['upload_path'] = './files/unit/logo/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']	= '200000';
				$config['max_width']  = '10000';
				$config['max_height']  = '10000';
				$this->load->library('upload', $config);
				$this->upload->do_upload();
				$data = $this->upload->data();
				$name_array[] = $data['file_name'];

				$this->model->edit_logo_unit($user->UNIT, str_replace(' ', '_', $value['name'][$s]) );
				$msg = 1;
			}
		}

		if($this->input->post('ganti_background')){
			$name_array = array();
			$count = count($_FILES['userfile']['size']);
			foreach($_FILES as $key=>$value)
			for($s=0; $s<=$count-1; $s++) {
				$_FILES['userfile']['name']    	= str_replace(' ', '_', $value['name'][$s]) ;
				$_FILES['userfile']['type']    	= $value['type'][$s];
				$_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
				$_FILES['userfile']['error']    = $value['error'][$s];
				$_FILES['userfile']['size']    	= $value['size'][$s];  
				$config['upload_path'] = './files/unit/background/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']	= '200000';
				$config['max_width']  = '10000';
				$config['max_height']  = '10000';
				$this->load->library('upload', $config);
				$this->upload->do_upload();
				$data = $this->upload->data();
				$name_array[] = $data['file_name'];

				$this->model->edit_background_unit($user->UNIT, str_replace(' ', '_', $value['name'][$s]) );
				$msg = 1;
			}
		}

		$data =  array(
			'page' => "", 
			'title' => "Sistem Akuntansi PD CMJT", 
			'msg' => $msg, 
			'master' => "", 
			'view' => "", 
			'user' => $user, 
			'penjualan_bulan_ini' => $this->model->penjualan_bulan_ini($id_klien),
			'pembelian_bulan_ini' => $this->model->pembelian_bulan_ini($id_klien),
			'laba_rugi_bulan_ini' => $this->model->cetak_laba_rugi_bulanan($id_klien),
			'penjualan_grafik_harian_1' => $this->model->penjualan_grafik_harian($id_klien, $tgl_1),
			'penjualan_grafik_harian_2' => $this->model->penjualan_grafik_harian($id_klien, $tgl_2),
			'penjualan_grafik_harian_3' => $this->model->penjualan_grafik_harian($id_klien, $tgl_3),
			'penjualan_grafik_harian_4' => $this->model->penjualan_grafik_harian($id_klien, $tgl_4),
			'penjualan_grafik_harian_5' => $this->model->penjualan_grafik_harian($id_klien, $tgl_5),

			'pembelian_grafik_harian_1' => $this->model->pembelian_grafik_harian($id_klien, $tgl_1),
			'pembelian_grafik_harian_2' => $this->model->pembelian_grafik_harian($id_klien, $tgl_2),
			'pembelian_grafik_harian_3' => $this->model->pembelian_grafik_harian($id_klien, $tgl_3),
			'pembelian_grafik_harian_4' => $this->model->pembelian_grafik_harian($id_klien, $tgl_4),
			'pembelian_grafik_harian_5' => $this->model->pembelian_grafik_harian($id_klien, $tgl_5),

			'laba_rugi_harian_1' => $this->model->grafik_laba_rugi_harian($id_klien, $tgl_1),
			'laba_rugi_harian_2' => $this->model->grafik_laba_rugi_harian($id_klien, $tgl_2),
			'laba_rugi_harian_3' => $this->model->grafik_laba_rugi_harian($id_klien, $tgl_3),
			'laba_rugi_harian_4' => $this->model->grafik_laba_rugi_harian($id_klien, $tgl_4),
			'laba_rugi_harian_5' => $this->model->grafik_laba_rugi_harian($id_klien, $tgl_5),

			'laba_rugi_bulanan_1' => $this->model->grafik_laba_rugi_bulanan($id_klien, $bulan_1),
			'laba_rugi_bulanan_2' => $this->model->grafik_laba_rugi_bulanan($id_klien, $bulan_2),
			'laba_rugi_bulanan_3' => $this->model->grafik_laba_rugi_bulanan($id_klien, $bulan_3),
			'laba_rugi_bulanan_4' => $this->model->grafik_laba_rugi_bulanan($id_klien, $bulan_4),
			'laba_rugi_bulanan_5' => $this->model->grafik_laba_rugi_bulanan($id_klien, $bulan_5),

			'dt_pengajuan_produk' 		 => $this->model->get_data_pengajuan_produk($user->UNIT),
			'dt_pengajuan_supplier' 	 => $this->model->get_data_pengajuan_supplier($user->UNIT),
			'dt_pengajuan_pelanggan' 	 => $this->model->get_data_pengajuan_pelanggan($user->UNIT),
			'dt_pengajuan_kode_akun' 	 => $this->model->get_data_pengajuan_kode_akun($user->UNIT),
			'dt_pengajuan_kategori_akun' => $this->model->get_data_pengajuan_kategori_akun($user->UNIT),

			'dt_log_aktifitas' => $this->model->get_data_log_aktifitas($user->UNIT, $user->LEVEL),
			'dt_log_aktifitas_saya' => $this->model->get_data_log_aktifitas_saya($id_user),

			'dt_unit' => $this->model->get_data_unit(),
			'dt_unit_saya' => $this->model->get_data_unit_saya($user->UNIT),
			'dt_setting' => $this->master_model_m->get_setting_app(),
		);

		
		if($user->LEVEL == "ADMIN"){
			$this->load->view('beranda_super_v', $data);
		} else if($user->LEVEL == "MANAGER"){
			$this->load->view('beranda_admin_v', $data);
		} else if($user->LEVEL == "TAMBORA"){
			$this->load->view('beranda_tambora_v', $data);
		} else {
			$this->load->view('beranda_v', $data);
		}
		
	}

	function cetak_laporan(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$sa = "";
		$dt = "";
		$dt_aktiva = "";
		$dt_wajib = "";
		$laba = "";
		$laba_lalu = "";


		$laporan = $this->input->post('laporan');
		$bulan = $this->input->post('bln');
		$tahun = $this->input->post('thn');
		$unit = $this->input->post('unit');

		if($laporan == "Laporan Buku Besar"){
			$view = "pdf/report_buku_besar_beranda_pdf";
			$bln_txt = $this->datetostr($bulan);
			$judul = "Bulan $bln_txt Tahun $tahun";
			$title = "LAPORAN BUKU BESAR";

			$dt = $this->model->get_lap_buku_besar_bulanan($id_klien, $bulan, $tahun, $unit);
		}

		if($laporan == "Laporan Laba Rugi"){
			$view = "pdf/report_laba_rugi_rinci_beranda_pdf";
			$bln_txt = $this->datetostr($bulan);
			$judul = "Bulan $bln_txt Tahun $tahun";
			$title = "LAPORAN LABA RUGI";

			$dt = $this->model->cetak_laba_rugi_bulanan_laporan($id_klien, $bulan, $tahun, $unit);
		}

		if($laporan == "Laporan Jurnal Umum"){
			$view = "pdf/report_jurnal_umum_beranda_pdf";
			$bln_txt = $this->datetostr($bulan);
			$judul = "Bulan $bln_txt Tahun $tahun";
			$title = "LAPORAN JURNAL UMUM";

			$dt = $this->model->get_lap_jurnal_umum_bulanan($id_klien, $bulan, $tahun, $unit);
		}

		if($laporan == "Laporan Arus Kas"){
			$view = "pdf/report_arus_kas_beranda_pdf";
			$bln_txt = $this->datetostr($bulan);
			$judul = "Bulan $bln_txt Tahun $tahun";
			$title = "LAPORAN ARUS KAS";

			$bulan_saldo = $bulan - 1;
			$tahun_saldo = $tahun;

			if($bulan_saldo == 0){
				$bulan_saldo = 12;
				$tahun_saldo = $tahun - 1;
			}

			$bulan_saldo = str_pad($bulan_saldo, 2, '0', STR_PAD_LEFT);

			$sa_lalu = $this->model->get_sa_bulanan_lalu($id_klien, $bulan_saldo, $tahun_saldo, $unit)->TOTAL_SA;
			$sa_skrg = $this->model->get_sa_bulanan_skrg($id_klien, $bulan, $tahun, $unit)->TOTAL_SA;

			$cek_saldo_lalu = $this->model->cek_saldo_awal_bulan_lalu($id_klien, $bulan_saldo, $tahun_saldo, $unit);
			if(count($cek_saldo_lalu) == 0){
				$this->model->simpan_saldo_awal_arus_kas($id_klien, $bulan_saldo, $tahun_saldo, $sa_lalu, 'BULANAN', $unit);
			}

			$get_saldo_awal_sebelumnya = $this->model->get_saldo_awal_sebelumnya($id_klien, $bulan_saldo, $tahun_saldo, 'BULANAN', $unit)->NILAI;
			$nilai_saldo_skrg = $get_saldo_awal_sebelumnya + $sa_skrg;
			$this->model->update_saldo_skrg($id_klien, $bulan, $tahun, $nilai_saldo_skrg, 'BULANAN', $unit);

			$sa = $this->model->get_saldo_awal_sebelumnya($id_klien, $bulan_saldo, $tahun_saldo, 'BULANAN', $unit)->NILAI;
			$dt = $this->model->cetak_arus_kas_bulanan($id_klien, $bulan, $tahun, $unit);
		}

		if($laporan == "Jurnal Bayar Kas Bank"){
			$view = "pdf/report_jurnal_bayar_kas_bank_beranda_pdf";
			$bln_txt = $this->datetostr($bulan);
			$judul = "Bulan $bln_txt Tahun $tahun";
			$title = "LAPORAN JURNAL BAYAR KAS BANK";

			$dt = $this->model->cetak_kas_bank_bulanan($id_klien, $bulan, $tahun, $unit);
		}

		if($laporan == "Jurnal Penyesuaian"){
			$view = "pdf/report_jurnal_penye_beranda_pdf";
			$bln_txt = $this->datetostr($bulan);
			$judul = "Bulan $bln_txt Tahun $tahun";
			$title = "LAPORAN JURNAL PENYESUAIAN";

			$dt = $this->model->get_lap_jurnal_penyesuaian_bulanan($id_klien, $bulan, $tahun, $unit);
		}

		if($laporan == "Laporan Neraca"){
			$view = "pdf/report_laporan_neraca_beranda_pdf";
			$bln_txt = $this->datetostr($bulan);
			$judul = "Bulan $bln_txt Tahun $tahun";
			$title = 'LAPORAN NERACA PERUSAHAAN';

			$dt_aktiva = $this->model->get_lap_neraca_bulanan($id_klien, $bulan, $tahun, 'AKTIVA', $unit);
			$dt_wajib = $this->model->get_lap_neraca_bulanan($id_klien, $bulan, $tahun, 'KEWAJIBAN', $unit);

			$laba      = $this->model->cetak_laba_rugi_bulanan_neraca($id_klien, $bulan, $tahun, 'NOW', $unit);
			$laba_lalu = $this->model->cetak_laba_rugi_bulanan_neraca($id_klien, $bulan, $tahun, 'LALU', $unit);
		}
		

		$data = array(
			'title' 		=> $title,
			'title2'		=> 'SEMUA BAGIAN',
			'data'			=> $dt,
			'sa'			=> $sa,
			'dt_aktiva'     => $dt_aktiva,
			'dt_wajib'      => $dt_wajib,
			'laba'          => $laba,
			'laba_lalu'     => $laba_lalu,
			'judul'			=> $judul,
			'bulan'			=> $bulan,
			'tahun'			=> $tahun,
			'unit'			=> $unit,
			'data_usaha'    => $this->master_model_m->data_usaha($id_klien),
			'filter'		=> 'Bulanan',
		);
		$this->load->view($view,$data);
	}

	function datetostr($var){

		 if($var == "01"){
		 	$var = "Januari";
		 } else if($var == "02"){
		 	$var = "Februari";
		 } else if($var == "03"){
		 	$var = "Maret";
		 } else if($var == "04"){
		 	$var = "April";
		 } else if($var == "05"){
		 	$var = "Mei";
		 } else if($var == "06"){
		 	$var = "Juni";
		 } else if($var == "07"){
		 	$var = "Juli";
		 } else if($var == "08"){
		 	$var = "Agustus";
		 } else if($var == "09"){
		 	$var = "September";
		 } else if($var == "10"){
		 	$var = "Oktober";
		 } else if($var == "11"){
		 	$var = "November";
		 } else if($var == "12"){
		 	$var = "Desember";
		 }

		 return $var;

	}

	public function sign_out(){
		$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
		$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
		$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);
		$unit = strtolower($user->NAMA_UNIT);
		$unit = str_replace(' ', '-', $unit);

		$this->master_model_m->simpan_log($id_user, "<b>Logout</b> dari Aplikasi");

		$this->session->unset_userdata('masuk_akuntansi');
		$this->session->sess_destroy();

		if($user->LEVEL == "ADMIN"){
			redirect('login_direktur');	
		} else {
			redirect('login/'.$unit);			
		}
	}

	public function sign_out_tambora(){
		$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
		$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
		$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];

		$this->master_model_m->simpan_log($id_user, "<b>Logout</b> dari Aplikasi");

		$this->session->unset_userdata('masuk_akuntansi');
		$this->session->sess_destroy();
		redirect('login_tambora');
	}

	function simpan_kolom_buku_besar(){
		$this->db->query('DELETE FROM ak_kolom_laporan WHERE LAPORAN = "Buku Besar" ');
		$kolom = $this->input->post('kolom_buku_besar');

		foreach ($kolom as $key => $val) {
			$this->db->query("INSERT INTO ak_kolom_laporan (LAPORAN, KOLOM) VALUES ('Buku Besar', '$val')");
		}

		echo json_encode(1);
	}

	function simpan_kolom_labarugi(){
		$this->db->query('DELETE FROM ak_kolom_laporan WHERE LAPORAN = "Laba Rugi" ');
		$kolom = $this->input->post('kolom_laba_rugi');

		foreach ($kolom as $key => $val) {
			$this->db->query("INSERT INTO ak_kolom_laporan (LAPORAN, KOLOM) VALUES ('Laba Rugi', '$val')");
		}

		echo json_encode(1);
	}

	function simpan_kolom_ju(){
		$this->db->query('DELETE FROM ak_kolom_laporan WHERE LAPORAN = "JU" ');
		$kolom = $this->input->post('kolom_ju');

		foreach ($kolom as $key => $val) {
			$this->db->query("INSERT INTO ak_kolom_laporan (LAPORAN, KOLOM) VALUES ('JU', '$val')");
		}

		echo json_encode(1);
	}

	function simpan_kolom_arus(){
		$this->db->query('DELETE FROM ak_kolom_laporan WHERE LAPORAN = "ARUS_KAS" ');
		$kolom = $this->input->post('kolom_arus');

		foreach ($kolom as $key => $val) {
			$this->db->query("INSERT INTO ak_kolom_laporan (LAPORAN, KOLOM) VALUES ('ARUS_KAS', '$val')");
		}

		echo json_encode(1);
	}

	function simpan_kolom_jp(){
		$this->db->query('DELETE FROM ak_kolom_laporan WHERE LAPORAN = "JP" ');
		$kolom = $this->input->post('kolom_jp');

		foreach ($kolom as $key => $val) {
			$this->db->query("INSERT INTO ak_kolom_laporan (LAPORAN, KOLOM) VALUES ('JP', '$val')");
		}

		echo json_encode(1);
	}

	function get_log_by_tgl(){
		$tgl_full = $this->input->post('tgl');
		$tgl = explode(' sampai ', $tgl_full);
		$tgl_awal = $tgl[0];
		$tgl_akhir = $tgl[1];

		$data = array();
		$data['log_all']  = $this->model->get_log_by_tgl_all($tgl_awal, $tgl_akhir);
		$data['log_saya'] = $this->model->get_log_by_tgl_saya($tgl_awal, $tgl_akhir);

		echo json_encode($data);
	}

	function simpan_persetujuan(){
		$apr_aksi = $this->input->post('apr_aksi');
		$id_persetujuan = $this->input->post('id_persetujuan');
		$item = $this->input->post('item');
		$id_item = $this->input->post('id_item');
		$jenis = $this->input->post('jenis');
		$apr_alasan = addslashes($this->input->post('apr_alasan'));

		if($apr_aksi == "SETUJU"){
			$this->model->simpan_persetujuan($id_persetujuan, 1, $apr_alasan);
			if($jenis == "ADD"){
				$this->model->persetujuan_add($item, $id_item);
			} else if($jenis == "DELETE"){
				$this->model->persetujuan_delete($item, $id_item);
			} else if($jenis == "EDIT"){
				$this->model->persetujuan_edit($item, $id_item);
			}
		} else {
			$this->model->simpan_persetujuan($id_persetujuan, 2, $apr_alasan);
			if($jenis == "ADD"){
				$this->model->tidak_persetujuan_add($item, $id_item);
			} else if($jenis == "DELETE"){
				$this->model->tidak_persetujuan_delete($item, $id_item);
			} else if($jenis == "EDIT"){
				$this->model->tidak_persetujuan_edit($item, $id_item);
			}
		}

		echo json_encode(1);
	}

	function kelola_manager($id_unit){
		$msg = "";

		$unit = $this->model->get_unit_by_id($id_unit);
		
		if($this->input->post('simpan')){
		    $nama_lengkap = $this->input->post('nama_lengkap');
		    $username     = $this->input->post('username');
		    $password     = $this->input->post('password');
		    $password2    = $this->input->post('password2');

		    $sts    = $this->input->post('sts');

		    if($sts == 0){
			    $cek_username = count($this->db->query("SELECT * FROM ak_user WHERE USERNAME = '$username' ")->result());
			    if($cek_username > 0){
			    	$msg = 11;
			    } else {
			    	if($password != $password2){
			    		$msg = 22;
			    	} else {
			    		$msg = 33;
			    		$pass = md5(md5($password));
			    		$this->db->query("INSERT INTO ak_user (ID_KLIEN, USERNAME, PASSWORD, NAMA, LEVEL, UNIT, APPROVE) VALUES (13, '$username', '$pass', '$nama_lengkap', 'MANAGER', '$id_unit', 1)");
			    	}
			    }
		    } else {
		    	$id_user    = $this->input->post('id_user');
		    	$cek_username = count($this->db->query("SELECT * FROM ak_user WHERE USERNAME = '$username' AND ID != '$id_user' ")->result());
		    	if($cek_username > 0){
			    	$msg = 11;
			    } else {
			    	if($password == ""){
			    		$msg = 44;
			    		$this->db->query("UPDATE ak_user SET NAMA = '$nama_lengkap', USERNAME = '$username' WHERE UNIT = '$id_unit' AND LEVEL = 'MANAGER' ");
			    	} else {
			    		$msg = 44;
			    		$pass = md5(md5($password));
			    		$this->db->query("UPDATE ak_user SET NAMA = '$nama_lengkap', USERNAME = '$username', PASSWORD = '$pass' WHERE UNIT = '$id_unit' AND LEVEL = 'MANAGER' ");
			    	}
			    }
		    	
		    }
		}

		$user_unit = $this->model->get_data_manager_unit2($id_unit);


		$data =  array(
			'msg' => $msg, 
			'page' => "kelola_manager_v", 
			'title' => "Kelola Manager", 
			'unit' => $unit,
			'user_unit' => $user_unit,
			'master' => "", 
			'view' => "", 
			'post_url' => 'beranda_c/kelola_manager/'.$id_unit, 
		);
		
		$this->load->view('beranda_super_v', $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */