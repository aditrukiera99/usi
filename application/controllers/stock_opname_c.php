<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_opname_c extends CI_Controller {

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
	    $this->load->model('stock_opname_m','model');
	}

	function index()
	{
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		if($this->input->post('simpan')){
			$msg = 1;
			$no_trx2         = $this->input->post('no_trx2');
			$no_stock_opname = addslashes($this->input->post('no_stock_opname'));
			$tipe 			 = addslashes($this->input->post('tipe'));
			$tgl_trx 		 = addslashes($this->input->post('tgl_trx'));
			$no_ref 		 = addslashes($this->input->post('no_ref'));
			$catatan 	     = addslashes($this->input->post('catatan'));
			$kode_akun 	     = addslashes($this->input->post('kode_akun'));

			$kode_akun_det 	       = $this->input->post('kode_akun_det');
			$produk 	           = $this->input->post('produk');
			$qty 	               = $this->input->post('qty');
			$harga_satuan 	       = $this->input->post('harga_satuan');
			$qty_fisik 	     	   = $this->input->post('qty_fisik');
			$harga_satuan_fisik    = $this->input->post('harga_satuan_fisik');
			$qty_selisih 	       = $this->input->post('qty_selisih');
			$harga_satuan_selisih  = $this->input->post('harga_satuan_selisih');

			$this->model->simpan_stock_opname($no_stock_opname, $tipe, $tgl_trx, $no_ref, $catatan, $user->UNIT, $kode_akun);
			$id_opname = $this->db->insert_id();

			foreach ($produk as $key => $val) {
				$this->model->simpan_stock_opname_detail($id_opname, $val, $qty[$key], $harga_satuan[$key], $qty_fisik[$key], $harga_satuan_fisik[$key], $qty_selisih[$key], $harga_satuan_selisih[$key], $user->UNIT, $kode_akun_det[$key]);
				$this->model->update_produk($val, $qty_fisik[$key], $harga_satuan_fisik[$key]);
			}

			$this->model->save_next_nomor('Stock Opname', $no_trx2);

		} else if($this->input->post('id_hapus')){
			$msg = 2;
			$id = $this->input->post('id_hapus');
			$this->db->query("DELETE FROM ak_stock_opname WHERE ID = '$id' ");
			$this->db->query("DELETE FROM ak_stock_opname_detail WHERE ID_OPNAME = '$id' ");

			$this->master_model_m->simpan_log($id_user, "Menghapus Barang Produksi");
		} else if($this->input->post('ubah')){
			$msg = 1;
			$id_opname       = $this->input->post('id_opname');
			$no_trx2         = $this->input->post('no_trx2');
			$no_stock_opname = addslashes($this->input->post('no_stock_opname'));
			$tipe 			 = addslashes($this->input->post('tipe'));
			$tgl_trx 		 = addslashes($this->input->post('tgl_trx'));
			$no_ref 		 = addslashes($this->input->post('no_ref'));
			$catatan 	     = addslashes($this->input->post('catatan'));
			$kode_akun 	     = addslashes($this->input->post('kode_akun'));

			$kode_akun_det 	       = $this->input->post('kode_akun_det');
			$produk 	           = $this->input->post('produk');
			$qty 	               = $this->input->post('qty');
			$harga_satuan 	       = $this->input->post('harga_satuan');
			$qty_fisik 	     	   = $this->input->post('qty_fisik');
			$harga_satuan_fisik    = $this->input->post('harga_satuan_fisik');
			$qty_selisih 	       = $this->input->post('qty_selisih');
			$harga_satuan_selisih  = $this->input->post('harga_satuan_selisih');

			$this->model->ubah_stock_opname($id_opname, $no_stock_opname, $tipe, $tgl_trx, $no_ref, $catatan, $kode_akun);
			$this->db->query("DELETE FROM ak_stock_opname_detail WHERE ID_OPNAME = '$id_opname' ");						
			foreach ($produk as $key => $val) {
				$this->model->simpan_stock_opname_detail($id_opname, $val, $qty[$key], $harga_satuan[$key], $qty_fisik[$key], $harga_satuan_fisik[$key], $qty_selisih[$key], $harga_satuan_selisih[$key], $user->UNIT, $kode_akun_det[$key]);
				// $this->model->update_produk($val, $qty_fisik[$key], $harga_satuan_fisik[$key]);
			}
		}

		if($this->input->post('pdf')){
			$this->cetak_pdf();
		} else if($this->input->post('excel')){
			$this->cetak_xls();
		}

		$dt = $this->model->get_data_opname($user->UNIT);

		$data =  array(
			'page' => "stock_opname_v", 
			'title' => "Stock Opname", 
			'msg' => "", 
			'master' => "persediaan", 
			'view' => "stock_opname", 
			'dt' => $dt, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'post_url' => 'stock_opname_c', 
			'user' => $user, 
		);
		
		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
	}

	function add_new()
	{
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		$dt = $this->model->get_data_produk($keyword, $id_klien);
		$no_trx = $this->model->get_no_opname();
		$get_list_akun_all = $this->master_model_m->get_list_akun_all();


		$data =  array(
			'page' => "add_stock_opname_v", 
			'title' => "Stock Opname", 
			'msg' => "", 
			'master' => "persediaan", 
			'view' => "stock_opname", 
			'dt' => $dt, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'post_url' => 'stock_opname_c', 
			'user' => $user, 
			'no_trx' => $no_trx, 
			'get_list_akun_all' => $get_list_akun_all, 
		);
		
		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
	}

	function detail($id_opname)
	{
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		$dt = $this->model->get_data_opname_id($id_opname);
		$dt_detail = $this->model->get_data_opname_detail_id($id_opname);
		$no_trx = $this->model->get_no_opname();
		$get_list_akun_all = $this->master_model_m->get_list_akun_all();


		$data =  array(
			'page' => "detail_stock_opname_v", 
			'title' => "Stock Opname", 
			'msg' => "", 
			'master' => "persediaan", 
			'view' => "stock_opname", 
			'dt' => $dt, 
			'dt_detail' => $dt_detail, 
			'id_opname' => $id_opname, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'post_url' => 'stock_opname_c', 
			'user' => $user, 
			'no_trx' => $no_trx, 
			'get_list_akun_all' => $get_list_akun_all, 
		);
		
		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
	}

	function cari_produk(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		
		$keyword = $this->input->get('keyword');
		$dt = $this->model->get_data_produk($keyword, $id_klien);

		echo json_encode($dt);
	}

	function cari_produk_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_produk_by_id($id);

		echo json_encode($dt);
	}

	function cetak_pdf(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		//$tgl   = $this->input->post('tgl');
		$bulan = $this->input->post("bulan");
		$tahun = $this->input->post("tahun");
		$judul = "Bulan ".$this->datetostr($bulan)." ".$tahun;
		$unit = $user->UNIT;
		$view = "pdf/report_stok_opname_pdf";
		$dt_unit = $this->master_model_m->get_unit_by_id($unit);
		$dt = $this->model->get_lap_data_opname($unit, $bulan, $tahun);

		$data = array(
			'title' 		=> 'LAPORAN DAFTAR STOK PERSEDIAAN',
			'title2'		=> 'SEMUA BAGIAN',
			'data'			=> $dt,
			'judul'			=> $judul,
			'dt_unit'		=> $dt_unit,
			'data_usaha'    => $this->master_model_m->data_usaha($id_klien),
		);
		$this->load->view($view,$data);
	}

	function cetak_xls(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		//$tgl   = $this->input->post('tgl');
		$bulan = $this->input->post("bulan");
		$tahun = $this->input->post("tahun");
		$judul = "Bulan ".$this->datetostr($bulan)." ".$tahun;
		$unit = $user->UNIT;
		$view = "xls/report_stok_opname_xls";
		$dt_unit = $this->master_model_m->get_unit_by_id($unit);
		$dt = $this->model->get_lap_data_opname($unit, $bulan, $tahun);

		$data = array(
			'title' 		=> 'LAPORAN DAFTAR STOK PERSEDIAAN',
			'title2'		=> 'SEMUA BAGIAN',
			'data'			=> $dt,
			'judul'			=> $judul,
			'dt_unit'		=> $dt_unit,
			'data_usaha'    => $this->master_model_m->data_usaha($id_klien),
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
		 } else{
		 	$var = "";
		 }

		 return $var;

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */