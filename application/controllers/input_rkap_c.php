<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_rkap_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('input_rkap_m','model');

	}

	function index()
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

		}

		if($this->input->post('cari')){
			$tgl_full = $this->input->post('tgl');
			$tgl = explode(' sampai ', $tgl_full);
			$tgl_awal = $tgl[0];
			$tgl_akhir = $tgl[1];

			$dt = $this->model->get_penjualan_filter($keyword, $id_klien, $tgl_awal, $tgl_akhir);
		
		} else if($this->input->post('id_hapus')){
			$msg = 2;

			$id_hapus = $this->input->post('id_hapus');
			$get_rkap = $this->model->get_rkap_by_id($id_hapus);


			$this->model->hapus_rkap($id_hapus);
			$this->master_model_m->simpan_log($id_user, "Menghapus RKAP dengan KODE AKUN : <b>".$get_rkap->KODE_AKUN."</b> TAHUN <b>".$get_rkap->TAHUN."</b>");
		}

		$dt = $this->model->get_data_rkap($keyword, $id_klien);

		$data =  array(
			'page' => "input_rkap_v", 
			'title' => "Input Perencanaan / RKAP",  
			'master' => "input_data", 
			'view' => "input_rkap", 
			'dt' => $dt, 
			'msg' => $msg, 
			'tgl_full' => $tgl_full, 
			'post_url' => 'input_rkap_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function new_rkap(){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		if($this->input->post('simpan')){
			$msg = 11;
			$kode_akun = $this->input->post('kode_akun');
			$tahun = $this->input->post('tahun');

			$januari = $this->input->post('januari');
			$februari = $this->input->post('februari');
			$maret = $this->input->post('maret');
			$april = $this->input->post('april');
			$mei = $this->input->post('mei');
			$juni = $this->input->post('juni');
			$juli = $this->input->post('juli');
			$agustus = $this->input->post('agustus');
			$september = $this->input->post('september');
			$oktober = $this->input->post('oktober');
			$november = $this->input->post('november');
			$desember = $this->input->post('desember');
			$total_rkap = $this->input->post('total_rkap');

			$this->model->simpan_rkap($user->UNIT, $kode_akun, $tahun, $januari, $februari, $maret, $april, $mei, $juni, $juli, $agustus, $september, $oktober, $november, $desember, $total_rkap);
			$this->master_model_m->simpan_log($id_user, "Melakukan input RKAP pada tahun : <b>".$tahun."</b> dengan kode akun : <b>".$kode_akun."</b>");

		}

		$list_akun = $this->model->get_list_akun($user->UNIT);

		$data =  array(
			'page' => "input_new_rkap_v", 
			'title' => "Input RKAP Baru", 
			'msg' => "", 
			'master' => "input_data", 
			'view' => "input_rkap", 
			'msg' => $msg, 
			'user' => $user, 
			'list_akun' => $list_akun, 
			'post_url' => 'input_rkap_c/new_rkap', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function ubah_data($id=""){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];

		$list_akun = $this->model->get_list_akun($id_klien);
		$get_list_akun_all = $this->model->get_list_akun_all($id_klien);
		$get_all_produk    = $this->model->get_all_produk($id_klien);
		$get_pajak = $this->model->get_pajak($id_klien);
		$get_pel_sup = $this->model->get_pel_sup($id_klien);

		if($this->input->post('simpan')){
			$msg = 1;
			$id_pelanggan     =   $this->input->post('pelanggan_sel');
			$pelanggan 	      =   $this->input->post('pelanggan');
			$alamat_tagih     =   $this->input->post('alamat_tagih');
			$tgl_trx          =   $this->input->post('tgl_trx');
			$tgl_jatuh_tempo  =   "";
			$no_trx           =   $this->input->post('no_trx');
			$no_trx2          =   $this->input->post('no_trx2');
			$id_pajak         =   $this->input->post('id_pajak');
			$sub_total        =   str_replace(',', '', $this->input->post('sub_total'));
			$pajak_total      =   str_replace(',', '', $this->input->post('pajak_all'));
			$total_all        =   str_replace(',', '', $this->input->post('total_all'));
			$sts_lunas        =   $this->input->post('sts_lunas');
			$akun_piutang     =   $this->input->post('akun_piutang');
			$kode_akun_pajak  =   $this->input->post('kode_akun_pajak');
			$memo_lunas       =   addslashes($this->input->post('memo_lunas'));

			if($sts_lunas == 1){
				$akun_piutang = "";
			}

			$this->model->ubah_penjualan($id, $no_trx, $id_pelanggan, $pelanggan, $alamat_tagih, $tgl_trx, $tgl_jatuh_tempo, $id_pajak, $sub_total, $pajak_total, $total_all, $sts_lunas, $memo_lunas, $akun_piutang, $kode_akun_pajak);
		
			$nama_produk 	= $this->input->post('nama_produk');
			$qty 	        = $this->input->post('qty');
			$satuan 		= $this->input->post('satuan');
			$harga_satuan 	= $this->input->post('harga_satuan');
			$jumlah 	 	= $this->input->post('jumlah');

			$this->model->hapus_detail_trx($id);

			foreach ($nama_produk as $key => $val) {
				$this->model->simpan_detail_penjualan($id, $id_klien, $val, $qty[$key], $satuan[$key], $harga_satuan[$key], $jumlah[$key]);
			}

			$this->master_model_m->simpan_log($id_user, "Mengubah transaksi penjualan dengan nomor transaksi : <b>".$no_trx."</b>");
		}

		$dt = $this->model->get_data_trx($id);
		$dt_detail = $this->model->get_data_trx_detail($id);

		$data =  array(
			'page' => "edit_transaksi_penjualan_v", 
			'title' => "Ubah Transaksi Penjualan", 
			'msg' => "", 
			'master' => "input_data", 
			'view' => "transaksi_penjualan", 
			'msg' => $msg, 
			'dt' => $dt, 
			'dt_detail' => $dt_detail, 
			'list_akun' => $list_akun, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_all_produk' => $get_all_produk, 
			'get_pel_sup' => $get_pel_sup, 
			'get_pajak' => $get_pajak, 
			'post_url' => 'transaksi_penjualan_c/ubah_data/'.$id, 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function get_detail_rkap(){
		$id = $this->input->post('id');
		$data = $this->model->get_rkap_by_id($id);

		echo json_encode($data);

	}
	
	function get_pelanggan_detail(){
		$id_pel = $this->input->get('id_pel');
		$dt = $this->model->get_pelanggan_detail($id_pel);

		echo json_encode($dt);
	}

	function get_produk_detail(){
		$id_produk = $this->input->get('id_produk');
		$dt = $this->model->get_produk_detail($id_produk);

		echo json_encode($dt);
	}

	function get_pajak_prosen(){
		$id_pajak = $this->input->get('id_pajak');
		$dt = $this->model->get_pajak_prosen($id_pajak);

		echo json_encode($dt);
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

	function get_pelanggan_popup(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$where = "1=1";

		$keyword = $this->input->post('keyword');
		if($keyword != "" || $keyword != null){
			$where = $where." AND (NAMA_PELANGGAN LIKE '%$keyword%' OR NAMA_USAHA LIKE '%$keyword%')";
		}

		$sql = "
		SELECT * FROM ak_pelanggan WHERE ID_KLIEN = $id_klien AND $where AND APPROVE = 3
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_produk_popup(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);
        $where_unit = "1=1";
        if($user->LEVEL == "ADMIN"){
            $where_unit = "1=1";
        } else {
            $where_unit = "UNIT = ".$user->UNIT;
        }

		$where = "1=1";

		$keyword = $this->input->post('keyword');
		if($keyword != "" || $keyword != null){
			$where = $where." AND (KODE_PRODUK LIKE '%$keyword%' OR NAMA_PRODUK LIKE '%$keyword%')";
		}

		$sql = "
		SELECT * FROM ak_produk WHERE ID_KLIEN = $id_klien AND $where AND $where_unit AND APPROVE = 3
		LIMIT 10
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function simpan_add_produk(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

		$kode_produk = addslashes($this->input->post('kode_produk'));
		$nama_produk = addslashes($this->input->post('nama_produk'));
		$satuan      = addslashes($this->input->post('satuan'));
		$deskripsi   = addslashes($this->input->post('deskripsi'));
		$harga       = $this->input->post('harga');
		$harga  	 = str_replace(',', '', $harga);

		$sql = "
        INSERT INTO ak_produk
        (ID_KLIEN, KODE_PRODUK, NAMA_PRODUK, SATUAN, DESKRIPSI, HARGA)
        VALUES 
        ($id_klien, '$kode_produk', '$nama_produk', '$satuan', '$deskripsi', '$harga')
        ";

        $this->db->query($sql);
        echo json_encode(1);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */