<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_jurnal_bayar_kas_piutang_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('input_jurnal_bayar_kas_piutang_m','model');

	}

	function index()
	{
		$keyword = "";
		$msg = "";
		$tgl_full = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user  = $sess_user['id'];
		$user 	  = $this->master_model_m->get_user_info($id_user);

		if($this->input->post('simpan')){
			$msg = 1;

			$no_hutang    = addslashes($this->input->post('no_hutang'));
			$no_hutang2   = addslashes($this->input->post('no_hutang2'));
			$no_bukti     = addslashes($this->input->post('no_bukti'));
			$tgl_cek      = addslashes($this->input->post('tgl_cek'));
			$atas_nama    = addslashes($this->input->post('atas_nama'));
			$id_atas_nama = addslashes($this->input->post('id_atas_nama'));
			$uraian       = addslashes($this->input->post('uraian'));

			$kode_akun_add = $this->input->post('kode_akun_add');
			$nominal       = $this->input->post('nominal');
			$nominal       = str_replace(',', '', $nominal);

			$this->model->simpan_pelunasan_hutang($no_hutang, $no_bukti, $tgl_cek, $id_atas_nama, $atas_nama, $kode_akun_add, $nominal);
			$this->model->update_no_bukti($no_bukti, $no_hutang);

			$this->master_model_m->simpan_voucher_hutang($no_hutang, $no_bukti, $kode_akun_add, $nominal, $tgl_cek, $id_atas_nama, $atas_nama, $uraian);

			$this->model->save_next_nomor($id_klien, 'Hutang', $no_hutang2);

			$this->master_model_m->simpan_log($id_user, "Melakukan pelunasan hutang dengan nomor hutang : <b>".$no_hutang."</b>");
		}

		$dt = "";
		$get_list_akun_all = $this->model->get_list_akun_all($id_klien);

		$get_no_trx_akun = $this->model->get_no_trx_akun($id_klien);
		$no_trx = $this->model->get_no_trx_penjualan($id_klien);
		$data =  array(
			'page' => "input_jurnal_bayar_kas_piutang_v", 
			'title' => "Pelunasan Piutang",  
			'master' => "input_akuntansi", 
			'view' => "jurnal_bayar_kas_piutang", 
			'dt' => $dt, 
			'msg' => $msg, 
			'user' => $user, 
			'no_trx' => $no_trx, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_no_trx_akun' => $get_no_trx_akun, 
			'post_url' => 'input_jurnal_bayar_kas_piutang_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function get_no_bukti(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user  = $sess_user['id'];
		$user 	  = $this->master_model_m->get_user_info($id_user);

		$where = "1=1";
		$where_unit = "1=1";

		if($user->LEVEL != 'ADMIN'){
			$where_unit = "a.UNIT = ".$user->UNIT;
		}

		$keyword = $this->input->post('keyword');
		if($keyword != "" || $keyword != null){
			$where = $where." AND (a.NO_VOUCHER LIKE '%$keyword%' OR a.URAIAN LIKE '%$keyword%')";
		}

		$sql = "
		SELECT * FROM ak_input_voucher WHERE DEBET = 0 AND IS_LUNAS = 0
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_transaksi(){
		$no_voucher = $this->input->post('no_voucher');
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		$sql = "
		SELECT * FROM ak_input_voucher WHERE NO_VOUCHER = '$no_voucher'
		";

		$dt = $this->db->query($sql)->row();
		echo json_encode($dt);
	}

	function get_transaksi_detail(){
		$no_voucher   = $this->input->post('no_voucher');
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		$sql = "
		SELECT * FROM ak_input_voucher_detail WHERE NO_VOUCHER_DETAIL = '$no_voucher' AND DEBET > 0
		";

		$dt = $this->db->query($sql)->result();
		echo json_encode($dt);
	}

	function get_hitungan_hutang(){
		$no_voucher   = $this->input->post('no_voucher');
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		$sql = "
		SELECT a.NO_VOUCHER, a.KODE_AKUN, a.KREDIT, a.NAMA_PAJAK, 
			   IFNULL(b.SISA_HUTANG_USAHA, 0) AS SISA_HUTANG_USAHA, 
			   IFNULL(c.SISA_HUTANG_LAIN, 0) AS SISA_HUTANG_LAIN, 
			   IFNULL(d.SISA_HUTANG_PAJAK, 0) AS SISA_HUTANG_PAJAK  FROM (
			SELECT a.NO_VOUCHER, a.KODE_AKUN, a.KREDIT, IFNULL(a.NAMA_PAJAK, '-') AS NAMA_PAJAK FROM (
				SELECT a.NO_VOUCHER_DETAIL AS NO_VOUCHER, a.KODE_AKUN, (a.KREDIT + a.DEBET) AS KREDIT, b.NAMA_PAJAK FROM ak_input_voucher_detail a
				LEFT JOIN ak_setup_pajak b ON a.KODE_AKUN = b.PAJAK_PEMBELIAN
				WHERE  a.NO_VOUCHER_DETAIL = '$no_voucher'
			) a
		) a

		LEFT JOIN (
			SELECT NO_VOUCHER, KODE_AKUN, SUM(IFNULL(DEBET, 0)) AS SISA_HUTANG_USAHA
			FROM ak_jurnal_kas_bank
			WHERE DEBET > 0 AND KODE_AKUN LIKE '%200%' 
			GROUP BY NO_VOUCHER, KODE_AKUN
		) b ON b.NO_VOUCHER = a.NO_VOUCHER AND a.KODE_AKUN = b.KODE_AKUN

		LEFT JOIN (
			SELECT NO_VOUCHER, KODE_AKUN, SUM(IFNULL(DEBET, 0)) AS SISA_HUTANG_LAIN
			FROM ak_jurnal_kas_bank
			WHERE DEBET > 0 AND KODE_AKUN LIKE '%260%' 
			GROUP BY NO_VOUCHER, KODE_AKUN
		) c ON c.NO_VOUCHER = a.NO_VOUCHER AND a.KODE_AKUN = c.KODE_AKUN

		LEFT JOIN (
			SELECT NO_VOUCHER, KODE_AKUN, SUM(IFNULL(DEBET, 0)) AS SISA_HUTANG_PAJAK
			FROM ak_jurnal_kas_bank
			WHERE DEBET > 0 AND KODE_AKUN LIKE '%240%' 
			GROUP BY NO_VOUCHER, KODE_AKUN
		) d ON d.NO_VOUCHER = a.NO_VOUCHER AND a.KODE_AKUN = d.KODE_AKUN
		";

		$dt = $this->db->query($sql)->result();
		echo json_encode($dt);
	}

	function get_pajak_row(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$no_akun = $this->input->post('no_akun');

		$sql = "
		SELECT * FROM ak_kode_akuntansi WHERE ID_KLIEN = $id_klien AND KODE_AKUN = '$no_akun'
		";

		$dt = $this->db->query($sql)->row();
		echo json_encode($dt);
	}

	function get_kode_akun_rinci(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$no_akun = $this->input->post('no_akun');

		$id_user = $sess_user['id'];		
		$user 	  = $this->master_model_m->get_user_info($id_user);

		$sql = "
		SELECT * FROM ak_kode_akuntansi WHERE KODE_AKUN = '$no_akun' AND UNIT = '$user->UNIT'
		";

		$dt = $this->db->query($sql)->row();
		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */