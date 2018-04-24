<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_transaksi_akuntansi_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('input_transaksi_akuntansi_m','model');

	}

	function index($tipe_1="", $id_bukti="")
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
			
			$no_trx_akun      = $this->input->post('no_trx_akun');
			$no_trx_akun2     = $this->input->post('no_trx_akun2');
			$no_bukti         = $this->input->post('no_bukti');
			$total_debet_all  = $this->input->post('total_debet_all');
			$total_kredit_all = $this->input->post('total_kredit_all');
			$tgl_trx 		  = $this->input->post('tgl_trx');
			$tipe             = $this->input->post('tipe');
			$kontak           = addslashes($this->input->post('kontak'));
			$uraian           = addslashes($this->input->post('uraian'));

			$this->model->simpan_trx_akuntansi($id_klien, $no_trx_akun, $no_bukti, $total_debet_all, $total_kredit_all, $tgl_trx, $tipe, $kontak, $uraian, $user->UNIT);
			$this->model->update_penjualan_pembelian($id_klien, $no_bukti, $no_trx_akun);

			$kode_akun_row = $this->input->post('kode_akun_row');
			$debet_row 	   = $this->input->post('debet_row');
			$kredit_row    = $this->input->post('kredit_row');

			foreach ($kode_akun_row as $key => $val) {
				$this->model->simpan_trx_akuntansi_detail($id_klien, $no_trx_akun, $val, $debet_row[$key], $kredit_row[$key], $no_bukti);
			}

			if($tipe == "Penjualan"){
				$get_nilai_hutang_piutang = $this->model->get_nilai_hutang_piutang($id_klien, $no_bukti, 'PIUTANG')->DEBET;
			} else {
				$get_nilai_hutang_piutang = $this->model->get_nilai_hutang_piutang($id_klien, $no_bukti, 'HUTANG')->KREDIT;
			}

			$this->model->repair_detail_voucher($id_klien, $no_trx_akun, $no_bukti);
			$this->model->save_next_nomor($id_klien, 'TRANSAKSI_AKUN', $no_trx_akun2);

			$this->master_model_m->simpan_log($id_user, "Melakukan pembukuan akuntansi dengan nomor transaksi akun : <b>".$no_trx_akun."</b>");
		}

		$dt = "";
		$get_list_akun_all = $this->model->get_list_akun_all($id_klien);

		$get_no_trx_akun = $this->model->get_no_trx_akun($id_klien);

		$data =  array(
			'page' => "input_transaksi_akuntansi_v", 
			'title' => "Input Transaksi Akuntansi",  
			'master' => "input_akuntansi", 
			'view' => "input_transaksi_akuntansi", 
			'dt' => $dt, 
			'msg' => $msg, 
			'user' => $user, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_no_trx_akun' => $get_no_trx_akun, 
			'tipe_1' => $tipe_1, 
			'id_bukti' => $id_bukti, 
			'post_url' => 'input_transaksi_akuntansi_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function ubah()
	{
		$keyword = "";
		$msg = "";
		$tgl_full = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];

		if($this->input->post('simpan')){
			$msg = 1;
			
			$no_trx_akun      = $this->input->post('no_trx_akun');
			$no_bukti         = $this->input->post('no_bukti');
			$total_debet_all  = $this->input->post('total_debet_all');
			$total_kredit_all = $this->input->post('total_kredit_all');
			$tgl_trx 		  = $this->input->post('tgl_trx');
			$tipe             = $this->input->post('tipe');
			$kontak           = addslashes($this->input->post('kontak'));
			$uraian           = addslashes($this->input->post('uraian'));

			$this->model->ubah_trx_akuntansi($id_klien, $no_trx_akun, $no_bukti, $total_debet_all, $total_kredit_all, $tgl_trx, $tipe, $kontak, $uraian);
			//$this->model->update_penjualan_pembelian($id_klien, $no_bukti, $no_trx_akun);

			$kode_akun_row = $this->input->post('kode_akun_row');
			$debet_row 	   = $this->input->post('debet_row');
			$kredit_row    = $this->input->post('kredit_row');

			$this->model->delete_detail_voucher($id_klien, $no_trx_akun);
			foreach ($kode_akun_row as $key => $val) {
				$this->model->simpan_trx_akuntansi_detail($id_klien, $no_trx_akun, $val, $debet_row[$key], $kredit_row[$key], $no_bukti);
			}

			$this->master_model_m->simpan_log($id_user, "Mengubah pembukuan akuntansi dengan nomor transaksi akun : <b>".$no_trx_akun."</b>");

			// if($tipe == "Penjualan"){
			// 	$get_nilai_hutang_piutang = $this->model->get_nilai_hutang_piutang($id_klien, $no_bukti, 'PIUTANG')->DEBET;
			// 	//$this->model->simpan_piutang($id_klien, $no_bukti, $tgl_trx, $get_nilai_hutang_piutang, 'PIUTANG');
			// } else {
			// 	$get_nilai_hutang_piutang = $this->model->get_nilai_hutang_piutang($id_klien, $no_bukti, 'HUTANG')->KREDIT;
			// 	//$this->model->simpan_hutang($id_klien, $no_bukti, $tgl_trx, $get_nilai_hutang_piutang, 'HUTANG');
			// }

			//$this->model->repair_detail_voucher($id_klien, $no_trx_akun, $no_bukti);
			//$this->model->save_next_nomor($id_klien, 'TRANSAKSI_AKUN', $no_trx_akun2);
		
		} else if($this->input->post('id_hapus')){

			$msg = 2;
			$no_voucher_hps   = $this->input->post('id_hapus');
			$this->model->hapus_voucher($id_klien, $no_voucher_hps);
			$this->master_model_m->simpan_log($id_user, "Menghapus pembukuan akuntansi dengan nomor transaksi akun : <b>".$no_voucher_hps."</b>");
		}

		$dt = "";
		$get_list_akun_all = $this->model->get_list_akun_all($id_klien);

		$get_no_trx_akun = $this->model->get_no_trx_akun($id_klien);

		$data =  array(
			'page' => "ubah_transaksi_akuntansi_v", 
			'title' => "Ubah Transaksi Akuntansi",  
			'master' => "input_akuntansi", 
			'view' => "input_transaksi_akuntansi", 
			'dt' => $dt, 
			'msg' => $msg, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_no_trx_akun' => $get_no_trx_akun, 
			'post_url' => 'input_transaksi_akuntansi_c/ubah', 
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
			$where_unit = "UNIT = ".$user->UNIT;
		}

		$keyword = $this->input->post('keyword');
		$tipe_bukti = $this->input->post('tipe_bukti');
		if($keyword != "" || $keyword != null){
			$where = $where." AND (NO_BUKTI LIKE '%$keyword%' OR TIPE LIKE '%$keyword%')";
		}

		$sql = "
		SELECT a.* FROM (
			SELECT ID, NO_BUKTI, TGL_TRX, TOTAL, 'JUAL' AS TIPE, IFNULL(MEMO, '-') AS MEMO FROM ak_penjualan 
			WHERE NO_TRX_AKUN IS NULL AND $where_unit

			UNION ALL 

			SELECT ID, NO_BUKTI, TGL_TRX, TOTAL, 'BELI' AS TIPE, IFNULL(MEMO, '-') AS MEMO FROM ak_pembelian 
			WHERE NO_TRX_AKUN IS NULL AND $where_unit

			UNION ALL 

			SELECT ID, NO_BUKTI, TGL_TRX, TOTAL, 'LAIN' AS TIPE, IFNULL(MEMO, '-') AS MEMO FROM ak_transaksi_lainnya 
			WHERE NO_TRX_AKUN IS NULL AND $where_unit
		) a
		WHERE $where AND a.TIPE = '$tipe_bukti'
		ORDER BY a.ID DESC
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_no_voucher(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user  = $sess_user['id'];
		$user 	  = $this->master_model_m->get_user_info($id_user);

		$where = "1=1";
		$where_unit = "1=1";

		if($user->LEVEL != 'ADMIN'){
			$where_unit = "UNIT = ".$user->UNIT;
		}

		$keyword = $this->input->post('keyword');
		if($keyword != "" || $keyword != null){
			$where = $where." AND (a.NO_BUKTI LIKE '%$keyword%' OR a.NO_VOUCHER LIKE '%$keyword%')";
		}

		$sql = "
		SELECT a.*, b.ID AS ID_BUKTI, b.TIPE AS TIPE_BUKTI 
		FROM ak_input_voucher a 
		JOIN(
			SELECT ID, NO_BUKTI, 'JUAL' AS TIPE FROM ak_penjualan 
			WHERE ID_KLIEN = $id_klien AND $where_unit

			UNION ALL 

			SELECT ID, NO_BUKTI, 'BELI' AS TIPE FROM ak_pembelian 
			WHERE ID_KLIEN = $id_klien AND $where_unit
		) b ON a.NO_BUKTI = b.NO_BUKTI
		WHERE a.ID_KLIEN = $id_klien AND $where
		ORDER BY a.ID DESC
		LIMIT 10
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_transaksi(){
		$id   = $this->input->post('id');
		$tipe = $this->input->post('tipe');

		$tabel = "";
		$kode = "";
		if($tipe=="JUAL"){
			$tabel = "ak_penjualan";
			$kode = "a.KODE_AKUN_PIUTANG";
		} else if($tipe == "BELI"){
			$tabel = "ak_pembelian";
			$kode = "a.KODE_AKUN_HUTANG";
		} else if($tipe == "LAIN"){
			$tabel = "ak_transaksi_lainnya";
			$kode = "a.KODE_AKUN_HUTANG";
		}

		$sql = "
		SELECT a.*, b.NAMA_PAJAK, b.PROSEN, b.PAJAK_PEMBELIAN, b.PAJAK_PENJUALAN, '$tipe' AS TIPE_TRX, c.NAMA_AKUN AS NAMA_AKUN_HP FROM $tabel a 
		LEFT JOIN ak_setup_pajak b ON a.ID_PAJAK = b.ID
		LEFT JOIN ak_kode_akuntansi c ON $kode = c.KODE_AKUN
		WHERE a.ID = $id
		";

		$dt = $this->db->query($sql)->row();
		echo json_encode($dt);
	}

	function get_transaksi_detail(){
		$id   = $this->input->post('id');
		$tipe = $this->input->post('tipe');

		$tabel = "ak_transaksi_lainnya_detail";
		if($tipe=="JUAL"){
			$tabel = "ak_penjualan_detail";
		} else if($tipe == "BELI"){
			$tabel = "ak_pembelian_detail";
		}

		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user  = $sess_user['id'];
		$user 	  = $this->master_model_m->get_user_info($id_user);

		$sql = "
		SELECT DISTINCT a.*, b.NAMA_AKUN, b.KATEGORI FROM $tabel a 
		LEFT JOIN ak_kode_akuntansi b ON a.KODE_AKUN = b.KODE_AKUN AND b.UNIT = '$user->UNIT'
		WHERE a.ID_PENJUALAN = $id
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

	function get_voc_detail(){
		$no_voucher = $this->input->post('no_voucher');

		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user 	  = $this->master_model_m->get_user_info($id_user);

		$sql = "
		SELECT a.*, b.NAMA_AKUN FROM ak_input_voucher_detail a 
		JOIN ak_kode_akuntansi b ON a.KODE_AKUN = b.KODE_AKUN AND b.UNIT = '$user->UNIT'
		WHERE a.ID_KLIEN = $id_klien AND a.NO_VOUCHER_DETAIL = '$no_voucher'
		ORDER BY a.DEBET DESC
		";

		$dt = $this->db->query($sql)->result();
		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */