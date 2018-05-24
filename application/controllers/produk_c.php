<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk_c extends CI_Controller {

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
	    $this->load->model('produk_m','model');
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
			if($user->LEVEL == "USER"){
				$msg = 33;
			} else {
				$msg = 1;
			}

			$kode_produk   = addslashes($this->input->post('kode_produk'));
			$tipe_barang   = addslashes($this->input->post('tipe_barang'));
			$nama_produk   = addslashes($this->input->post('nama_produk'));
			$satuan        = addslashes($this->input->post('satuan'));
			$deskripsi     = addslashes($this->input->post('deskripsi'));
			$kode_akun     = addslashes($this->input->post('kode_akun'));
			$kategori_produk  = addslashes($this->input->post('kategori_produk'));
			$harga_jual       = $this->input->post('harga_jual');
			$harga_jual  	  = str_replace(',', '', $harga_jual);

			$harga_beli       = $this->input->post('harga_beli');
			$harga_beli  	   = str_replace(',', '', $harga_beli);

			$ppn       	   = $this->input->post('ppn');
			$ppn       	   = str_replace(',', '', $ppn);
			
			$pph           = $this->input->post('pph');
			$pph       	   = str_replace(',', '', $pph);

			$service           = $this->input->post('service');
			$service       	   = str_replace(',', '', $service);

			$id_produk = $this->model->simpan_produk($id_klien, $kode_produk, $nama_produk, $satuan, $deskripsi, $harga_jual, $harga_beli, $user->UNIT, $ppn, $pph, $service, $kode_akun, $tipe_barang, $kategori_produk);

			$deskripsi_persetujuan = "Penambahan Produk: <br> <b>Kode Produk : ".$kode_produk."</b> <br> <b> Nama Produk : ".$nama_produk."</b>";
			$this->master_model_m->simpan_persetujuan('produk', $id_produk, 'ADD', $id_user, $deskripsi_persetujuan);
			$this->master_model_m->simpan_log($id_user, "Menambah Data Produk : <b>(".$kode_produk.") - ".$nama_produk."</b>");

		} else if($this->input->post('id_hapus')){

			if($user->LEVEL == "USER"){
				$msg = 22;
			} else {
				$msg = 2;
			}

			$id   = $this->input->post('id_hapus');

			$item = $this->model->cari_produk_by_id($id);
			$deskripsi_persetujuan = "Penghapusan Produk : <br> <b>Nama Produk : ".$item->NAMA_PRODUK."</b>";
			$this->master_model_m->simpan_persetujuan('produk', $id, 'DELETE', $id_user, $deskripsi_persetujuan);

			$this->model->hapus_produk($id);
			$this->master_model_m->simpan_log($id_user, "Menghapus Data Produk : <b>".$item->NAMA_PRODUK."</b>");

		} else if($this->input->post('edit')){
			if($user->LEVEL == "USER"){
				$msg = 11;
			} else {
				$msg = 1;
			}
			
			$id_produk   = $this->input->post('id_produk');
			$tipe_barang      = addslashes($this->input->post('tipe_barang_ed'));
			$kode_produk_ed   = addslashes($this->input->post('kode_produk_ed'));
			$nama_produk_ed   = addslashes($this->input->post('nama_produk_ed'));
			$satuan_ed        = addslashes($this->input->post('satuan_ed'));
			$deskripsi_ed     = addslashes($this->input->post('deskripsi_ed'));
			$kode_produk      = addslashes($this->input->post('kode_produk_ed'));
			$kode_akun        = addslashes($this->input->post('kode_akun_ed'));
			$kategori_produk  = addslashes($this->input->post('kategori_produk_ed'));

			$ppn_ed           = addslashes($this->input->post('ppn_ed'));
			$pph_ed      	  = addslashes($this->input->post('pph_ed'));
			$service_ed       = addslashes($this->input->post('service_ed'));

			$harga_jual       = $this->input->post('harga_jual_ed');
			$harga_jual      = str_replace(',', '', $harga_jual);

			$harga_beli    = $this->input->post('harga_beli_ed');
			$harga_beli    = str_replace(',', '', $harga_beli);

			if($user->LEVEL == "USER"){
				$this->db->query('INSERT INTO ak_produk_edit SELECT * FROM ak_produk WHERE ID = '.$id_produk);		
			}
			
			$this->model->edit_produk($id_produk, $kode_produk_ed, $nama_produk_ed, $satuan_ed, $deskripsi_ed, $harga_jual, $harga_beli, $ppn_ed, $pph_ed, $service_ed, $kode_akun, $tipe_barang, $kategori_produk);

			$deskripsi_persetujuan = "Pengubahan Produk: <br> <b>Kode Produk : ".$kode_produk_ed."</b> <br> <b> Nama Produk : ".$nama_produk_ed."</b>";
			$this->master_model_m->simpan_persetujuan('produk', $id_produk, 'EDIT', $id_user, $deskripsi_persetujuan);
			$this->master_model_m->simpan_log($id_user, "Mengubah Data Produk : <b>(".$kode_produk_ed.") - ".$nama_produk_ed."</b>");

		} else if($this->input->post('ubah_produk')){
			if($user->LEVEL == "USER"){
				$msg = 11;
			} else {
				$msg = 1;
			}
			
			$kode_produk_ed      = addslashes($this->input->post('kode_produk_ed'));
			$id_produk   		 = addslashes($this->input->post('id_produk'));
			$nama_produk_ed      = addslashes($this->input->post('nama_produk_ed'));
			$satuan_ed           = addslashes($this->input->post('satuan_ed'));
			$deskripsi_ed        = addslashes($this->input->post('deskripsi_ed'));


			$this->model->edit_produk_detail($kode_produk_ed, $id_produk, $nama_produk_ed, $satuan_ed, $deskripsi_ed);

		}

		if($this->input->post('pdf')){
			$this->cetak_pdf();
		} else if($this->input->post('excel')){
			$this->cetak_xls();
		} 

		$dt = $this->model->get_data_produk($keyword, $id_klien);
		$get_list_akun_all = $this->master_model_m->get_list_akun_all();
		$get_all_kategori_produk = $this->model->get_all_kategori_produk();

		$data =  array(
			'page' => "produk_v", 
			'title' => "Daftar Produk", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "daftar_produk", 
			'dt' => $dt, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_all_kategori_produk' => $get_all_kategori_produk, 
			'post_url' => 'produk_c', 
			'user' => $user, 
		);
		
		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
	}

	function ubah_produk($id){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		

		// $list_akun = $this->model->get_list_akun($id_klien);
		$get_list_akun_all = $this->model->get_list_akun_all($id_klien);
		// $get_all_produk    = $this->model->get_all_produk($id_klien);
		// $get_pel_sup = $this->model->get_pel_sup($id_klien);
		// $get_pajak = $this->model->get_pajak($id_klien);
		// $no_trx = $this->model->get_no_trx_penjualan($id_klien);
		// $get_broker = $this->model->get_broker();
		$dt = $this->model->get_produk_detail($id);

		$data =  array(
			'page' => "ubah_produk_v", 
			'title' => "Ubah Produk", 
			'msg' => "", 
			'master' => "master_data", 
			'view' => "produk", 
			'msg' => $msg, 
			'dt' => $dt, 
			'post_url' => 'produk_c', 
		);
		
		$this->load->view('beranda_v', $data);
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
		
		$lap_kategori_produk = $this->input->post("lap_kategori_produk");
		$unit = $user->UNIT;
		$view = "pdf/report_daftar_produk_pdf";
		$dt = "";
		$judul = "SEMUA KATEGORI";
		if($lap_kategori_produk != ""){
			$judul = "KATEGORI : ".$lap_kategori_produk;
		}

		$dt_unit = $this->master_model_m->get_unit_by_id($unit);
		$dt = $this->model->get_produk_by_kategori($lap_kategori_produk, $unit);

		$data = array(
			'title' 		=> 'LAPORAN DAFTAR PRODUK',
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
		
		$lap_kategori_produk = $this->input->post("lap_kategori_produk");
		$unit = $user->UNIT;
		$view = "xls/report_daftar_produk_xls";
		$dt = "";
		$judul = "SEMUA KATEGORI";
		if($lap_kategori_produk != ""){
			$judul = "KATEGORI : ".$lap_kategori_produk;
		}

		$dt_unit = $this->master_model_m->get_unit_by_id($unit);
		$dt = $this->model->get_produk_by_kategori($lap_kategori_produk, $unit);

		$data = array(
			'title' 		=> 'LAPORAN DAFTAR PRODUK',
			'title2'		=> 'SEMUA BAGIAN',
			'data'			=> $dt,
			'judul'			=> $judul,
			'dt_unit'		=> $dt_unit,
			'data_usaha'    => $this->master_model_m->data_usaha($id_klien),
		);
		$this->load->view($view,$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */