<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kas_bank_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('kas_bank_m','model');

	}

	function index()
	{
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];

		if($this->input->post('simpan')){
			$msg = 1;

			$nomor_akun = addslashes($this->input->post('kode_akun'));
			$deskripsi  = addslashes($this->input->post('deskripsi'));
			$saldo_awal = str_replace(',', '', $this->input->post('saldo_awal'));


			// $this->model->simpan_akun($id_klien, $nama_akun, $nomor_akun, $deskripsi, $kategori);

			if($saldo_awal > 0){
				$tgl = date('d-m-Y');
				$this->model->simpan_saldo_awal($id_klien, $nomor_akun, $tgl, $saldo_awal, $deskripsi);
				$this->model->simpan_ekuitas_saldo($id_klien, $nomor_akun, $tgl, $saldo_awal, $deskripsi);
				$this->master_model_m->simpan_log($id_user, "Menambah Saldo Awal dengan nomor akun: <b>".$nama_akun."</b> dan Saldo Awal sebesar <b>".number_format($saldo_awal)."</b>");
			}
		}

		$dt = $this->model->get_kas_bank();
		$get_list_akun_all = $this->master_model_m->get_list_akun_all();
		
		$data =  array(
			'page' => "kas_bank_v", 
			'title' => "Input Saldo Awal", 
			'msg' => "", 
			'master' => "input_akuntansi", 
			'view' => "kas_bank", 
			'dt' => $dt, 
			'dt2' => $dt2, 
			'msg' => $msg, 
			'get_list_akun_all' => $get_list_akun_all, 
			'kode_produk' => $kode_produk, 
			'post_url' => 'kas_bank_c', 
			'last_kas_bank' => $this->model->get_last_kas_bank($id_klien), 
			'last_cc' => $this->model->get_last_cc($id_klien), 
			'get_jml_kas' => $this->model->get_jml_kas($id_klien), 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function terima_uang(){
		$keyword = "";
		$msg = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		if($this->input->post('simpan')){
			$msg = 1;
			$kode_akun_setor = $this->input->post('kode_akun_setor');
			$yang_membayar   = addslashes($this->input->post('yang_membayar'));
			$tgl_trx   = $this->input->post('tgl_trx');
			$no_trx    = $this->input->post('no_trx');
			$no_trx2    = $this->input->post('no_trx2');
			$total_all = $this->input->post('total_all');

			$this->model->simpan_kas_bank($id_klien, $kode_akun_setor, $yang_membayar, $tgl_trx, $no_trx, $total_all);
			$this->model->save_next_nomor($id_klien, 'Terima Uang', $no_trx2);

			$id_kas_bank = $this->model->get_id_kas_bank($id_klien, $no_trx)->ID;

			// SIMPAN DETAIL 

			$kode_akun  = $this->input->post('kode_akun');
			$deskripsi  = $this->input->post('deskripsi');
			$nilai      = $this->input->post('nilai');

			foreach ($kode_akun as $key => $val) {
				$this->model->simpan_kas_bank_detail($id_klien, $id_kas_bank, $no_trx, $val, $deskripsi[$key], $nilai[$key]);
			}

		}

		$list_akun = $this->model->get_list_akun($id_klien);
		$get_list_akun_all = $this->model->get_list_akun_all($id_klien);
		$get_pel_sup = $this->model->get_pel_sup($id_klien);
		$no_trx = $this->model->get_no_trx($id_klien);

		$data =  array(
			'page' => "kas_bank_terima_uang_v", 
			'title' => "Kas dan Bank (Terima Uang)", 
			'msg' => "", 
			'master' => "input_data", 
			'view' => "kas_bank", 
			'msg' => $msg, 
			'list_akun' => $list_akun, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_pel_sup' => $get_pel_sup, 
			'no_trx' => $no_trx, 
			'post_url' => 'kas_bank_c/terima_uang', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function transfer_uang(){
		$keyword = "";
		$msg = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user  = $sess_user['id'];

		if($this->input->post('simpan')){
			$msg = 1;
			$trf_dari    = $this->input->post('trf_dari');
			$setor_ke    = $this->input->post('setor_ke');
			$nilai_trf   = $this->input->post('nilai_trf');
			$tgl_trx 	 = $this->input->post('tgl_trx');
			$no_trx      = $this->input->post('no_trx');
			$no_trx2    = $this->input->post('no_trx2');
			$memo 		 = addslashes($this->input->post('memo'));

			$nilai_trf   = str_replace(',', '', $nilai_trf);

			$this->model->proses_trf_bank_1($id_klien, $trf_dari, $no_trx, $tgl_trx, $nilai_trf, $memo);
			$this->model->proses_trf_bank_2($id_klien, $setor_ke, $no_trx, $tgl_trx, $nilai_trf, $memo);

			$this->master_model_m->simpan_log($id_user, "Melakukan transfer uang dari akun <b>".$trf_dari."</b> menuju akun <b>".$setor_ke."</b> dengan nilai sebesar <b>".number_format($nilai_trf)."</b>");

			$this->model->save_next_nomor($id_klien, 'Trf Uang', $no_trx2);
		}

		$list_akun = $this->model->get_list_akun($id_klien);
		$get_list_akun_all = $this->model->get_list_akun_all($id_klien);
		$get_pel_sup = $this->model->get_pel_sup($id_klien);
		$no_trx = $this->model->get_no_trx_trfuang($id_klien);

		$data =  array(
			'page' => "kas_bank_trf_uang_v", 
			'title' => "Kas dan Bank (Transfer Uang Antar Bank)", 
			'msg' => "", 
			'master' => "input_data", 
			'view' => "kas_bank", 
			'msg' => $msg, 
			'list_akun' => $list_akun, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_pel_sup' => $get_pel_sup, 
			'no_trx' => $no_trx, 
			'post_url' => 'kas_bank_c/transfer_uang', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function kirim_uang(){
		$keyword = "";
		$msg = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		if($this->input->post('simpan')){
			$msg = 1;
			$kode_akun_setor = $this->input->post('kode_akun_setor');
			$yang_membayar   = addslashes($this->input->post('yang_membayar'));
			$tgl_trx   = $this->input->post('tgl_trx');
			$no_trx    = $this->input->post('no_trx');
			$no_trx2    = $this->input->post('no_trx2');
			$total_all = $this->input->post('total_all');

			$this->model->simpan_kas_bank_kirim_uang($id_klien, $kode_akun_setor, $yang_membayar, $tgl_trx, $no_trx, $total_all);
			$this->model->save_next_nomor($id_klien, 'Kirim Uang', $no_trx2);

			$id_kas_bank = $this->model->get_id_kas_bank($id_klien, $no_trx)->ID;

			// SIMPAN DETAIL 

			$kode_akun  = $this->input->post('kode_akun');
			$deskripsi  = $this->input->post('deskripsi');
			$nilai      = $this->input->post('nilai');

			foreach ($kode_akun as $key => $val) {
				$this->model->simpan_kas_bank_detail($id_klien, $id_kas_bank, $no_trx, $val, $deskripsi[$key], $nilai[$key]);
			}

		}

		$list_akun = $this->model->get_list_akun($id_klien);
		$get_list_akun_all = $this->model->get_list_akun_all($id_klien);
		$get_pel_sup = $this->model->get_pel_sup($id_klien);
		$no_trx = $this->model->get_no_trx_kirim_uang($id_klien);

		$data =  array(
			'page' => "kas_bank_kirim_uang_v", 
			'title' => "Kas dan Bank (Kirim Uang)", 
			'msg' => "", 
			'master' => "input_data", 
			'view' => "kas_bank", 
			'msg' => $msg, 
			'list_akun' => $list_akun, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_pel_sup' => $get_pel_sup, 
			'no_trx' => $no_trx, 
			'post_url' => 'kas_bank_c/kirim_uang', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function cari_kas_bank(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		
		$keyword = $this->input->get('keyword');
		$dt = $this->model->get_kas_bank($keyword, $id_klien);

		echo json_encode($dt);
	}

	function cari_produk_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_produk_by_id($id);

		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */