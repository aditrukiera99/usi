<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_kas_bank_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    // $this->load->model('lap_buku_besar_m','model');
	    $this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
	}

	function index()
	{
		$keyword = "";
		$msg = "";
		$nomor_akun = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user  = $sess_user['id'];
		$user 	  = $this->master_model_m->get_user_info($id_user);

		if($this->input->post('pdf')){
			$this->cetak_laporan_pdf();
		} else if($this->input->post('excel')){
			$this->cetak_laporan_xls();
		} 

		//$dt = $this->model->get_no_akun($keyword, $id_klien);

		$data =  array(
			'page' => "lap_kas_bank_v", 
			'title' => "Laporan Kas/Bank", 
			'msg' => "", 
			'master' => "laporan_keuangan", 
			'view' => "lap_kas_bank_v", 
			//'dt' => $dt, 
			'msg' => $msg, 
			'user' => $user, 
			'post_url' => 'lap_kas_bank_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function cetak_laporan_pdf(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		//$tgl   = $this->input->post('tgl');
		
		$filter = $this->input->post('filter');
		$unit   = $this->input->post('unit');
		$view = "pdf/report_kas_bank_pdf";
		$dt = "";
		$judul = "";

		$dt_unit = $this->master_model_m->get_unit_by_id($unit);

		if($filter == "Harian"){
			$tgl_full = $this->input->post('tgl');
			if($tgl_full == ""){
				$tgl_full = date('d-m-Y')." sampai ".date('d-m-Y');
			}

			$tgl = explode(' sampai ', $tgl_full);
			$tgl_awal = $tgl[0];
			$tgl_akhir = $tgl[1];
			$judul = "TANGGAL $tgl_awal s/d $tgl_akhir";
			$judul_2 = "HARIAN";

			$sql = "SELECT a.KODE_AKUN, a.NAMA_AKUN, IFNULL(TERIMA.DEBET,0) AS PENERIMAAN, IFNULL(KELUAR.KREDIT,0) AS PENGELUARAN, IFNULL(SA.SALDO_AWAL,0) AS SALDO_AWAL FROM ak_kode_akuntansi a 
			        LEFT JOIN ak_grup_kode_akun b ON a.KODE_GRUP = b.KODE_GRUP

			        LEFT JOIN (
			        SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET 
			        FROM ak_input_voucher a 
			        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
			        WHERE STR_TO_DATE(a.TGL, '%d-%c-%Y') <= STR_TO_DATE('$tgl_akhir' , '%d-%c-%Y') AND STR_TO_DATE(a.TGL, '%d-%c-%Y') >= STR_TO_DATE('$tgl_awal' , '%d-%c-%Y')
			        GROUP BY KODE_AKUN
			        ) TERIMA ON a.KODE_AKUN = TERIMA.KODE_AKUN

			        LEFT JOIN (
			        SELECT b.KODE_AKUN, SUM(b.KREDIT) AS KREDIT 
			        FROM ak_input_voucher a 
			        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
			        WHERE STR_TO_DATE(a.TGL, '%d-%c-%Y') <= STR_TO_DATE('$tgl_akhir' , '%d-%c-%Y') AND STR_TO_DATE(a.TGL, '%d-%c-%Y') >= STR_TO_DATE('$tgl_awal' , '%d-%c-%Y')
			        GROUP BY KODE_AKUN
			        ) KELUAR ON a.KODE_AKUN = KELUAR.KODE_AKUN

			        LEFT JOIN (
			        SELECT b.KODE_AKUN, SUM(b.DEBET - b.KREDIT) AS SALDO_AWAL 
			        FROM ak_input_voucher a 
			        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
			        WHERE STR_TO_DATE(a.TGL, '%d-%c-%Y') < STR_TO_DATE('$tgl_awal' , '%d-%c-%Y')
			        GROUP BY KODE_AKUN
			        ) SA ON a.KODE_AKUN = SA.KODE_AKUN

			        WHERE b.ID = 1
			        ORDER BY a.ID
			      ";
			$dt = $this->db->query($sql)->result();
		
		} else if($filter == "Bulanan"){
			$tahun = $this->input->post('tahun');
			$bulan = $this->input->post('bulan');
			$bln_txt = $this->datetostr($bulan);
			$judul = "BULAN $bln_txt $tahun";
			$judul_2 = "BULANAN";

			$sql = "SELECT a.KODE_AKUN, a.NAMA_AKUN, IFNULL(TERIMA.DEBET,0) AS PENERIMAAN, IFNULL(KELUAR.KREDIT,0) AS PENGELUARAN, IFNULL(SA.SALDO_AWAL,0) AS SALDO_AWAL FROM ak_kode_akuntansi a 
			        LEFT JOIN ak_grup_kode_akun b ON a.KODE_GRUP = b.KODE_GRUP

			        LEFT JOIN (
			        SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET 
			        FROM ak_input_voucher a 
			        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
			        WHERE a.TGL LIKE '%-$bulan-$tahun%'
			        GROUP BY KODE_AKUN
			        ) TERIMA ON a.KODE_AKUN = TERIMA.KODE_AKUN

			        LEFT JOIN (
			        SELECT b.KODE_AKUN, SUM(b.KREDIT) AS KREDIT 
			        FROM ak_input_voucher a 
			        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
			        WHERE a.TGL LIKE '%-$bulan-$tahun%'
			        GROUP BY KODE_AKUN
			        ) KELUAR ON a.KODE_AKUN = KELUAR.KODE_AKUN

			        LEFT JOIN (
			        SELECT b.KODE_AKUN, SUM(b.DEBET - b.KREDIT) AS SALDO_AWAL 
			        FROM ak_input_voucher a 
			        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
			        WHERE STR_TO_DATE(a.TGL, '%d-%c-%Y') < STR_TO_DATE('01-$bulan-$tahun' , '%d-%c-%Y')
			        GROUP BY KODE_AKUN
			        ) SA ON a.KODE_AKUN = SA.KODE_AKUN

			        WHERE b.ID = 1
			        ORDER BY a.ID
			      ";
			$dt = $this->db->query($sql)->result();
		} 



		$data = array(
			'title' 		=> 'LAPORAN KAS/BANK ',
			'title2'		=> 'SEMUA BAGIAN',
			'data'			=> $dt,
			'judul'			=> $judul,
			'judul_2'			=> $judul_2,
			'dt_unit'			=> $dt_unit,
			'data_usaha'    => $this->master_model_m->data_usaha($id_klien),
		);
		$this->load->view($view,$data);
	}

	function cetak_laporan_xls(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		//$tgl   = $this->input->post('tgl');
		
		$filter = $this->input->post('filter');
		$unit   = $this->input->post('unit');
		$view = "xls/report_kas_bank_xls";
		$dt = "";
		$judul = "";

		$dt_unit = $this->master_model_m->get_unit_by_id($unit);

		if($filter == "Harian"){
			$tgl_full = $this->input->post('tgl');
			if($tgl_full == ""){
				$tgl_full = date('d-m-Y')." sampai ".date('d-m-Y');
			}

			$tgl = explode(' sampai ', $tgl_full);
			$tgl_awal = $tgl[0];
			$tgl_akhir = $tgl[1];
			$judul = "TANGGAL $tgl_awal s/d $tgl_akhir";
			$judul_2 = "HARIAN";

			$sql = "SELECT a.KODE_AKUN, a.NAMA_AKUN, IFNULL(TERIMA.DEBET,0) AS PENERIMAAN, IFNULL(KELUAR.KREDIT,0) AS PENGELUARAN, IFNULL(SA.SALDO_AWAL,0) AS SALDO_AWAL FROM ak_kode_akuntansi a 
			        LEFT JOIN ak_grup_kode_akun b ON a.KODE_GRUP = b.KODE_GRUP

			        LEFT JOIN (
			        SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET 
			        FROM ak_input_voucher a 
			        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
			        WHERE STR_TO_DATE(a.TGL, '%d-%c-%Y') <= STR_TO_DATE('$tgl_akhir' , '%d-%c-%Y') AND STR_TO_DATE(a.TGL, '%d-%c-%Y') >= STR_TO_DATE('$tgl_awal' , '%d-%c-%Y')
			        GROUP BY KODE_AKUN
			        ) TERIMA ON a.KODE_AKUN = TERIMA.KODE_AKUN

			        LEFT JOIN (
			        SELECT b.KODE_AKUN, SUM(b.KREDIT) AS KREDIT 
			        FROM ak_input_voucher a 
			        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
			        WHERE STR_TO_DATE(a.TGL, '%d-%c-%Y') <= STR_TO_DATE('$tgl_akhir' , '%d-%c-%Y') AND STR_TO_DATE(a.TGL, '%d-%c-%Y') >= STR_TO_DATE('$tgl_awal' , '%d-%c-%Y')
			        GROUP BY KODE_AKUN
			        ) KELUAR ON a.KODE_AKUN = KELUAR.KODE_AKUN

			        LEFT JOIN (
			        SELECT b.KODE_AKUN, SUM(b.DEBET - b.KREDIT) AS SALDO_AWAL 
			        FROM ak_input_voucher a 
			        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
			        WHERE STR_TO_DATE(a.TGL, '%d-%c-%Y') < STR_TO_DATE('$tgl_awal' , '%d-%c-%Y')
			        GROUP BY KODE_AKUN
			        ) SA ON a.KODE_AKUN = SA.KODE_AKUN

			        WHERE b.ID = 1
			        ORDER BY a.ID
			      ";
			$dt = $this->db->query($sql)->result();
		
		} else if($filter == "Bulanan"){
			$tahun = $this->input->post('tahun');
			$bulan = $this->input->post('bulan');
			$bln_txt = $this->datetostr($bulan);
			$judul = "BULAN $bln_txt $tahun";
			$judul_2 = "BULANAN";

			$sql = "SELECT a.KODE_AKUN, a.NAMA_AKUN, IFNULL(TERIMA.DEBET,0) AS PENERIMAAN, IFNULL(KELUAR.KREDIT,0) AS PENGELUARAN, IFNULL(SA.SALDO_AWAL,0) AS SALDO_AWAL FROM ak_kode_akuntansi a 
			        LEFT JOIN ak_grup_kode_akun b ON a.KODE_GRUP = b.KODE_GRUP

			        LEFT JOIN (
			        SELECT b.KODE_AKUN, SUM(b.DEBET) AS DEBET 
			        FROM ak_input_voucher a 
			        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
			        WHERE a.TGL LIKE '%-$bulan-$tahun%'
			        GROUP BY KODE_AKUN
			        ) TERIMA ON a.KODE_AKUN = TERIMA.KODE_AKUN

			        LEFT JOIN (
			        SELECT b.KODE_AKUN, SUM(b.KREDIT) AS KREDIT 
			        FROM ak_input_voucher a 
			        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
			        WHERE a.TGL LIKE '%-$bulan-$tahun%'
			        GROUP BY KODE_AKUN
			        ) KELUAR ON a.KODE_AKUN = KELUAR.KODE_AKUN

			        LEFT JOIN (
			        SELECT b.KODE_AKUN, SUM(b.DEBET - b.KREDIT) AS SALDO_AWAL 
			        FROM ak_input_voucher a 
			        JOIN ak_input_voucher_detail b ON a.NO_VOUCHER = b.NO_VOUCHER_DETAIL
			        WHERE STR_TO_DATE(a.TGL, '%d-%c-%Y') < STR_TO_DATE('01-$bulan-$tahun' , '%d-%c-%Y')
			        GROUP BY KODE_AKUN
			        ) SA ON a.KODE_AKUN = SA.KODE_AKUN

			        WHERE b.ID = 1
			        ORDER BY a.ID
			      ";
			$dt = $this->db->query($sql)->result();
		} 



		$data = array(
			'title' 		=> 'LAPORAN KAS/BANK ',
			'title2'		=> 'SEMUA BAGIAN',
			'data'			=> $dt,
			'judul'			=> $judul,
			'judul_2'			=> $judul_2,
			'dt_unit'			=> $dt_unit,
			'data_usaha'    => $this->master_model_m->data_usaha($id_klien),
		);
		$this->load->view($view,$data);
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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */