<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_pembelian_supp_produk_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('lap_pembelian_m','model');
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

		

		//$dt = $this->model->get_no_akun($keyword, $id_klien);

		$data =  array(
			'page' => "lap_pembelian_supp_produk_v", 
			'title' => "Laporan Pembelian Supplier Detail Produk", 
			'msg' => "", 
			'master' => "laporan_pembelian", 
			'view' => "lap_pembelian_supp_produk_v", 
			//'dt' => $dt, 
			'msg' => $msg, 
			'user' => $user, 
			'post_url' => 'lap_pembelian_supp_produk_c/cetak_laporan', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function cetak_laporan(){
		if($this->input->post('pdf')){
			$this->cetak_laporan_pdf();
		} else if($this->input->post('excel')){
			$this->cetak_laporan_xls();
		} 
	}

	function cetak_laporan_pdf(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$unit = $this->input->post('unit');
		//$tgl   = $this->input->post('tgl');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$filter = $this->input->post('filter');
		$tgl_awal = '';
		$tgl_akhir = '';

		if($filter == "Harian"){
			$view = "pdf/report_pembelian_supp_produk_pdf";
			$dt = "";
			$dt_unit = $this->master_model_m->get_unit_by_id($unit);

			$tgl_full = $this->input->post('tgl');
			if($tgl_full == ""){
				$tgl_full = date('d-m-Y')." sampai ".date('d-m-Y');
			}
			
			$tgl = explode(' sampai ', $tgl_full);
			$tgl_awal = $tgl[0];
			$tgl_akhir = $tgl[1];
			$judul =  date("d-F-Y", strtotime($tgl_awal))."  -  ".date("d-F-Y", strtotime($tgl_akhir));

			$sql = "
				SELECT
					b.KODE_SUP,
					a.ID_SUPPLIER,
					a.SUPPLIER,
					COUNT(c.ID) AS NILAI,
					SUM(c.TOTAL) AS TOTAL
				FROM ak_penerimaan_barang a
				LEFT JOIN ak_supplier b ON b.ID = a.ID_SUPPLIER
				LEFT JOIN ak_penerimaan_detail c ON c.ID_PENJUALAN = a.ID
				LEFT JOIN ak_produk d ON d.ID = c.ID_PRODUK
				WHERE STR_TO_DATE(a.TGL_TRX, '%d-%c-%Y') <= STR_TO_DATE('$tgl_akhir' , '%d-%c-%Y') 
				AND STR_TO_DATE(a.TGL_TRX, '%d-%c-%Y') >= STR_TO_DATE('$tgl_awal' , '%d-%c-%Y')
				GROUP BY b.KODE_SUP
				ORDER BY a.ID ASC
			";

			$dt = $this->db->query($sql)->result();
		} else {
			$view = "pdf/report_pembelian_supp_produk2_pdf";
			$dt = "";
			$dt_unit = $this->master_model_m->get_unit_by_id($unit);

			$bulan_lalu = $bulan - 1;
			if($bulan_lalu == 0){
				$bulan_lalu = 12;
			}

			if($bulan_lalu < 10){
				$bulan_txt2 = '0'.$bulan_lalu;
			}

			$judul =  "BULAN : ".$this->datetostr($bulan)." ".$tahun;

			$sql = "
				SELECT
					a.ID,
					a.TGL_TRX,
					a.ID_SUPPLIER,
					a.KODE_SUP,
					a.SUPPLIER,
					SUM(a.QTY_BLN_LALU) AS QTY_BLN_LALU,
					SUM(a.TOTAL_BLN_LALU) AS TOTAL_BLN_LALU,
					SUM(a.QTY) AS QTY,
					SUM(a.TOTAL) AS TOTAL
				FROM(
					SELECT
						a.ID,
						a.TGL_TRX,
						a.ID_SUPPLIER,
						c.KODE_SUP,
						a.SUPPLIER,
						IFNULL(e.QTY,0) AS QTY_BLN_LALU,
						IFNULL(e.TOTAL,0) AS TOTAL_BLN_LALU,
						'0' AS QTY,
						'0' AS TOTAL
					FROM ak_penerimaan_barang a
					LEFT JOIN ak_penerimaan_detail b ON b.ID_PENJUALAN = a.ID
					LEFT JOIN ak_supplier c ON c.ID = a.ID_SUPPLIER
					LEFT JOIN(
						SELECT
							b.TGL_TRX,
							a.ID_PENJUALAN,
							a.QTY,
							a.HARGA_SATUAN,
							a.TOTAL
						FROM ak_penerimaan_detail a
						LEFT JOIN ak_penerimaan_barang b ON b.ID = a.ID_PENJUALAN
						WHERE b.TGL_TRX LIKE '%-$bulan_txt2-$tahun%'
					) e ON e.ID_PENJUALAN = a.ID

					UNION ALL

					SELECT
						a.ID,
						a.TGL_TRX,
						a.ID_SUPPLIER,
						c.KODE_SUP,
						a.SUPPLIER,
						'0' AS QTY_BLN_LALU,
						'0' AS TOTAL_BLN_LALU,
						IFNULL(e.QTY,0) AS QTY,
						IFNULL(e.TOTAL,0) AS TOTAL
					FROM ak_penerimaan_barang a
					LEFT JOIN ak_penerimaan_detail b ON b.ID_PENJUALAN = a.ID
					LEFT JOIN ak_supplier c ON c.ID = a.ID_SUPPLIER
					LEFT JOIN(
						SELECT
							b.TGL_TRX,
							a.ID_PENJUALAN,
							a.QTY,
							a.HARGA_SATUAN,
							a.TOTAL
						FROM ak_penerimaan_detail a
						LEFT JOIN ak_penerimaan_barang b ON b.ID = a.ID_PENJUALAN
						WHERE b.TGL_TRX LIKE '%-$bulan-$tahun%'
					) e ON e.ID_PENJUALAN = a.ID
				) a
				GROUP BY a.ID_SUPPLIER
			";

			$dt = $this->db->query($sql)->result();
		}

		$data = array(
			'title' 		=> 'LAPORAN JURNAL MEMORIAL',
			'title2'		=> 'SEMUA BAGIAN',
			'data'			=> $dt,
			'judul'			=> $judul,
			'dt_unit'		=> $dt_unit,
			'data_usaha'    => $this->master_model_m->data_usaha($id_klien),
			'bulan'			=> $this->datetostr($bulan),
			'bulan_lalu'	=> $this->datetostr($bulan_txt2),
			'tahun'			=> $tahun
		);
		$this->load->view($view,$data);
	}

	function cetak_laporan_xls(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		//$tgl   = $this->input->post('tgl');
		
		$filter = $this->input->post('filter');
		$unit = $this->input->post('unit');
		$view = "xls/report_pembelian_xls";
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
			$judul = "Tanggal $tgl_awal s/d $tgl_akhir";

			$dt = $this->model->get_lap_penjualan($id_klien, $tgl_awal, $tgl_akhir, $unit);
		
		} else if($filter == "Bulanan"){
			$tahun = $this->input->post('tahun');
			$bulan = $this->input->post('bulan');
			$bln_txt = $this->datetostr($bulan);
			$judul = "Bulan $bln_txt Tahun $tahun";

			$dt = $this->model->get_lap_penjualan_bulanan($id_klien, $bulan, $tahun, $unit);
		} 



		$data = array(
			'title' 		=> 'LAPORAN JURNAL MEMORIAL',
			'title2'		=> 'SEMUA BAGIAN',
			'data'			=> $dt,
			'judul'			=> $judul,
			'dt_unit'		=> $dt_unit,
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