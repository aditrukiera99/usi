<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_aset_c extends CI_Controller {

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
	    $this->load->model('master_aset_m','model');
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
			$tipe_aset      = addslashes($this->input->post('tipe_aset'));
			$grup_aset      = addslashes($this->input->post('grup_aset'));
			$sub_grup_aset  = addslashes($this->input->post('sub_grup_aset'));
			$nama_aset      = addslashes($this->input->post('nama_aset'));
			$kode_akun      = addslashes($this->input->post('kode_akun'));

			$this->model->simpan_aset($tipe_aset, $grup_aset, $sub_grup_aset, $nama_aset, $kode_akun);

		} else if($this->input->post('id_hapus')){

			if($user->LEVEL == "USER"){
				$msg = 22;
			} else {
				$msg = 2;
			}

			$id   = $this->input->post('id_hapus');
			$this->model->hapus_produk($id);

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
		}

		if($this->input->post('pdf')){
			$this->cetak_pdf();
		} else if($this->input->post('excel')){
			$this->cetak_xls();
		} 

		$dt = $this->model->get_data_produk($keyword, $id_klien);
		$get_all_grup_aset = $this->model->get_all_grup_aset();

		$get_list_akun_all = $this->master_model_m->get_list_akun_all();
		$get_all_kategori_produk = $this->model->get_all_kategori_produk();

		$data =  array(
			'page' => "master_aset_v", 
			'title' => "Daftar Aset", 
			'msg' => "", 
			'master' => "aset", 
			'view' => "master_aset", 
			'dt' => $dt, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_all_kategori_produk' => $get_all_kategori_produk, 
			'post_url' => 'master_aset_c', 
			'user' => $user, 
			'get_all_grup_aset' => $get_all_grup_aset, 
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

	function get_data_sub(){
		$id_grup = $this->input->post('id_grup');

		$sql = "
		SELECT * FROM ak_aset_subgrup WHERE ID_GRUP = '$id_grup'
		ORDER BY ID ASC 
		";

		$dt = $this->db->query($sql)->result();
		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */