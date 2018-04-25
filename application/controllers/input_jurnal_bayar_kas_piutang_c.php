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

			$kode_akun_hutang  = $this->input->post('kode_akun_hutang');
			$kode_akun_pajak   = $this->input->post('kode_akun_pajak');
			$no_trx_akun  	   = $this->input->post('no_trx_akun');
			$tgl_cek      	   = $this->input->post('tgl_cek');
			$uraian       	   = $this->input->post('uraian');
			$atas_nama    	   = $this->input->post('atas_nama');
			$pembayaran_untuk  = $this->input->post('pembayaran_untuk');
			$no_giro           = $this->input->post('no_giro');
			$total_kredit_all  = $this->input->post('total_kredit_all');
			$unit  			   = $this->input->post('unit');

			$hutang_usaha = str_replace(',', '', $this->input->post('piutang_usaha'));
			$hutang_lain  = str_replace(',', '', $this->input->post('piutang_lain'));

			if($pembayaran_untuk == "piutang_usaha"){
				$sisa_hutang = $hutang_usaha;
			} else if($pembayaran_untuk == "piutang_lainnya"){
				$sisa_hutang = $hutang_lain;
			}

			if($pembayaran_untuk == 'pajak'){
				$kode_akun = $kode_akun_pajak;
			} else {
				$kode_akun = $kode_akun_hutang;
			}

			$this->model->simpan_jbk($id_klien, $no_trx_akun, $no_giro, $kode_akun, $tgl_cek, 0, $total_kredit_all, $uraian, $atas_nama, $sisa_hutang, $unit);

			$kode_akun_row = $this->input->post('kode_akun_row');
			$kredit_row    = $this->input->post('kredit_row');

			foreach ($kode_akun_row as $key => $val) {
				$this->model->simpan_jbk($id_klien, $no_trx_akun, $no_giro, $val, $tgl_cek, $kredit_row[$key], 0, $uraian, $atas_nama, 0, $unit);
			}

			$this->master_model_m->simpan_log($id_user, "Melakukan input jurnal bayar kas / bank dengan nomor transaksi akun : <b>".$no_trx_akun."</b>");
			
		}

		$dt = "";
		$get_list_akun_all = $this->model->get_list_akun_all($id_klien);

		$get_no_trx_akun = $this->model->get_no_trx_akun($id_klien);

		$data =  array(
			'page' => "input_jurnal_bayar_kas_piutang_v", 
			'title' => "Pelunasan Piutang",  
			'master' => "input_akuntansi", 
			'view' => "jurnal_bayar_kas_piutang", 
			'dt' => $dt, 
			'msg' => $msg, 
			'user' => $user, 
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
		SELECT a.NO_VOUCHER, a.NO_BUKTI, a.KONTAK, a.URAIAN FROM ak_input_voucher a 
		LEFT JOIN (
			SELECT a.NO_VOUCHER_DETAIL, a.KODE_AKUN, ((a.KREDIT + a.DEBET) - IFNULL(aa.DEBET,0) ) AS JML, a.ID_KLIEN, KODE.KATEGORI FROM ak_input_voucher_detail a 
			LEFT JOIN (
				SELECT aaa.NO_VOUCHER, aaa.ID_KLIEN, aaa.KODE_AKUN, IFNULL(aaa.DEBET, 0) AS DEBET FROM (
					SELECT NO_VOUCHER, ID_KLIEN, KODE_AKUN, SUM(KREDIT) AS DEBET 
					FROM ak_jurnal_kas_bank
					WHERE ID_KLIEN = $id_klien
					GROUP BY NO_VOUCHER, ID_KLIEN, KODE_AKUN
				) aaa
			) aa ON a.NO_VOUCHER_DETAIL = aa.NO_VOUCHER AND a.ID_KLIEN = aa.ID_KLIEN AND a.KODE_AKUN = aa.KODE_AKUN
			LEFT JOIN ak_kode_akuntansi KODE ON a.KODE_AKUN = KODE.KODE_AKUN
		) b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
		WHERE  (b.KODE_AKUN LIKE '%110%' OR b.KODE_AKUN LIKE '%112%')
			  AND b.JML > 0
			  AND $where
			  AND $where_unit
		GROUP BY a.NO_VOUCHER, a.NO_BUKTI, a.KONTAK, a.URAIAN
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_transaksi(){
		$no_voucher = $this->input->post('no_voucher');
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		$sql = "
		SELECT * FROM ak_input_voucher WHERE ID_KLIEN = $id_klien AND NO_VOUCHER = '$no_voucher'
		";

		$dt = $this->db->query($sql)->row();
		echo json_encode($dt);
	}

	function get_transaksi_detail(){
		$no_bukti   = $this->input->post('no_bukti');
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		$sql = "
		SELECT b.* FROM ak_pembelian a
		JOIN ak_pembelian_detail b ON a.ID = b.ID_PENJUALAN
		WHERE a.NO_BUKTI = '$no_bukti' AND a.ID_KLIEN = $id_klien
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
			WHERE DEBET > 0 AND KODE_AKUN LIKE '%110%' 
			GROUP BY NO_VOUCHER, KODE_AKUN
		) b ON b.NO_VOUCHER = a.NO_VOUCHER AND a.KODE_AKUN = b.KODE_AKUN

		LEFT JOIN (
			SELECT NO_VOUCHER, KODE_AKUN, SUM(IFNULL(DEBET, 0)) AS SISA_HUTANG_LAIN
			FROM ak_jurnal_kas_bank
			WHERE DEBET > 0 AND KODE_AKUN LIKE '%112%' 
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