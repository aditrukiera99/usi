<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi_penjualan_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('transaksi_penjualan_m','model');
	    $this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
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
		$user = $this->master_model_m->get_user_info($id_user);

		if($this->input->post('simpan')){

			$msg = 1;

			$no_trx 	   = $this->input->post('no_trx');
			$no_trx2       = $this->input->post('no_trx2');
			$id_pelanggan  = $this->input->post('pelanggan_sel');
			$pelanggan     = $this->input->post('pelanggan');
			$alamat_tagih  = $this->input->post('alamat_tagih');
			$kota_tujuan   = $this->input->post('kota_tujuan');
			$no_po         = $this->input->post('no_po');
			$no_do         = $this->input->post('no_do');
			$tgl_trx 	   = $this->input->post('tgl_trx');
			$keterangan    = $this->input->post('memo_lunas');
			$jatuh_tempo   = $this->input->post('jatuh_tempo');
			$no_pol        = $this->input->post('no_pol');
			$sopir 		   = $this->input->post('sopir');
			$alat_angkut   = $this->input->post('alat_angkut');
			$segel_atas    = $this->input->post('segel_atas');
			$segel_bawah   = $this->input->post('segel_bawah');
			$broker        = $this->input->post('broker');

			$temperatur    = $this->input->post('temperatur');
			$density       = $this->input->post('density');
			$flash_point   = $this->input->post('flash_point');
			$water_content = $this->input->post('water_content');

			$tgl_do        = $this->input->post('tgl_trx');
			$tgl_sj        = $this->input->post('tgl_trx');
			$tgl_inv       = $this->input->post('tgl_trx');
			$tgl_kwi       = $this->input->post('tgl_trx');	
			$operator      = $user->NAMA;

			$this->model->simpan_penjualan($no_trx, $id_pelanggan, $pelanggan, $alamat_tagih, $kota_tujuan, $no_po, $no_do, $tgl_trx, $keterangan, $jatuh_tempo, $no_pol, $sopir, $alat_angkut, $segel_atas, $segel_bawah, $broker, $temperatur, $density, $flash_point, $water_content, $tgl_do, $tgl_sj, $tgl_inv, $tgl_kwi, $operator);

			$id_penjualan = $this->db->insert_id(); 

			$this->model->save_next_nomor($id_klien, 'Penjualan', $no_trx2);

			$id_produk 	    = $this->input->post('produk');
			$kode_akun 	 	= $this->input->post('kode_akun');
			$nama_produk 	= $this->input->post('nama_produk');
			$qty 	        = $this->input->post('qty');

			$harga_modal    = $this->input->post('harga_modal');
			$harga_jual     = $this->input->post('harga_jual');
			$harga_invoice  = $this->input->post('harga_invoice');
			$tax 	        = $this->input->post('tax');
			$cashback 	    = $this->input->post('cashback');
			$profit 	    = $this->input->post('profit');
			$supplier 	    = $this->input->post('supplier');
			

			foreach ($id_produk as $key => $val) {
				$this->model->simpan_detail_penjualan($id_penjualan, $val, $kode_akun[$key], $nama_produk[$key], $qty[$key], $harga_modal[$key], $harga_jual[$key], $harga_invoice[$key], $tax[$key], $cashback[$key], $profit[$key], $supplier[$key]);	
				// $this->model->update_stok($id_klien, $id_produk[$key], $qty[$key]);
			}

			$this->master_model_m->simpan_log($id_user, "Melakukan transaksi penjualan dengan nomor transaksi : <b>".$no_trx."</b>");

		}

		if($this->input->post('edit_cui')){
			$msg = 1;

			$id 	       = $this->input->post('id_pp');
			$no_trx 	   = $this->input->post('no_trx');
			$no_trx2       = $this->input->post('no_trx2');
			$id_pelanggan  = $this->input->post('pelanggan_sel');
			$pelanggan     = $this->input->post('pelanggan');
			$alamat_tagih  = $this->input->post('alamat_tagih');
			$kota_tujuan   = $this->input->post('kota_tujuan');
			$no_po         = $this->input->post('no_po');
			$no_do         = $this->input->post('no_do');
			$tgl_trx 	   = $this->input->post('tgl_trx');
			$keterangan    = $this->input->post('memo_lunas');
			$jatuh_tempo   = $this->input->post('jatuh_tempo');
			$no_pol        = $this->input->post('no_pol');
			$sopir 		   = $this->input->post('sopir');
			$alat_angkut   = $this->input->post('alat_angkut');
			$segel_atas    = $this->input->post('segel_atas');
			$segel_bawah   = $this->input->post('segel_bawah');
			$broker        = $this->input->post('broker');

			$temperatur    = $this->input->post('temperatur');
			$density       = $this->input->post('density');
			$flash_point   = $this->input->post('flash_point');
			$water_content = $this->input->post('water_content');

			$tgl_do        = $this->input->post('tgl_trx');
			$tgl_sj        = $this->input->post('tgl_trx');
			$tgl_inv       = $this->input->post('tgl_trx');
			$tgl_kwi       = $this->input->post('tgl_trx');	
			$operator      = $user->NAMA;
			

			$this->model->ubah_penjualan_detail($id,$no_trx, $id_pelanggan, $pelanggan, $alamat_tagih, $kota_tujuan, $no_po, $no_do, $tgl_trx, $keterangan, $jatuh_tempo, $no_pol, $sopir, $alat_angkut, $segel_atas, $segel_bawah, $broker, $temperatur, $density, $flash_point, $water_content, $tgl_do, $tgl_sj, $tgl_inv, $tgl_kwi, $operator);

			$id_penjualan  = $this->input->post('id_pnj');
			$id_produk 	    = $this->input->post('produk');
			$kode_akun 	 	= $this->input->post('kode_akun');
			$nama_produk 	= $this->input->post('nama_produk');
			$qty 	        = $this->input->post('qty');

			$harga_modal    = $this->input->post('harga_modal');
			$harga_jual     = $this->input->post('harga_jual');
			$harga_invoice  = $this->input->post('harga_invoice');
			$tax 	        = $this->input->post('tax');
			$cashback 	    = $this->input->post('cashback');
			$profit 	    = $this->input->post('profit');
			$supplier 	    = $this->input->post('supplier');
			

			$this->model->hapus_detail_trx($id);

			foreach ($id_produk as $key => $val) {
				$this->model->ubah_detail_penjualan($id_penjualan, $val, $kode_akun[$key], $nama_produk[$key], $qty[$key], $harga_modal[$key], $harga_jual[$key], $harga_invoice[$key], $tax[$key], $cashback[$key], $profit[$key], $supplier[$key]);
			}

			$this->master_model_m->simpan_log($id_user, "Mengubah transaksi penjualan dengan nomor transaksi : <b>".$no_trx."</b>");
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
			$this->model->hapus_trx_penjualan($id_hapus);
			$this->model->hapus_detail_trx($id_hapus);


			$this->master_model_m->simpan_log($id_user, "Menghapus transaksi penjualan dengan nomor transaksi : <b>".$get_data_trx->NO_BUKTI."</b>");
		
		} else if($this->input->post('edit')){
			$msg = 1;
		} 

		$get_list_akun_all = $this->master_model_m->get_list_akun_all();
		$dt = $this->model->get_penjualan($keyword, $id_klien);
		$dt_supplier = $this->model->get_supplier();
		
		$data =  array(
			'page' => "transaksi_penjualan_v", 
			'title' => "Transaksi Penjualan",  
			'master' => "penjualan", 
			'view' => "transaksi_penjualan", 
			'dt' => $dt, 
			'dt_supplier' => $dt_supplier, 
			'msg' => $msg, 
			'tgl_full' => $tgl_full, 
			'kode_produk' => $kode_produk, 
			'get_list_akun_all' => $get_list_akun_all, 
			'post_url' => 'transaksi_penjualan_c', 
			'last_kas_bank' => $this->model->get_last_kas_bank($id_klien), 
			'last_cc' => $this->model->get_last_cc($id_klien), 
		);
		
		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
	}

	function new_invoice(){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		

		$list_akun = $this->model->get_list_akun($id_klien);
		$get_list_akun_all = $this->model->get_list_akun_all($id_klien);
		$get_all_produk    = $this->model->get_all_produk($id_klien);
		$get_pel_sup = $this->model->get_pel_sup($id_klien);
		$get_pajak = $this->model->get_pajak($id_klien);
		$no_trx = $this->model->get_no_trx_penjualan($id_klien);
		$no_pem= $this->model->get_no_trx_pembelian($id_klien);
		$get_broker = $this->model->get_broker();
		$dt_supplier = $this->model->get_supplier();

		$data =  array(
			'page' => "buat_transaksi_penjualan_new_v", 
			'title' => "Buat Penjualan Baru", 
			'msg' => "", 
			'master' => "penjualan", 
			'view' => "transaksi_penjualan", 
			'msg' => $msg, 
			'dt_supplier' => $dt_supplier, 
			'list_akun' => $list_akun, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_all_produk' => $get_all_produk, 
			'get_pel_sup' => $get_pel_sup, 
			'get_pajak' => $get_pajak, 
			'no_trx' => $no_trx, 
			'no_pem' => $no_pem, 
			'get_broker' => $get_broker, 
			'post_url' => 'transaksi_penjualan_c', 
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
		
		$dt = $this->model->get_data_trx($id);
		$dt_detail = $this->model->get_data_trx_detail_a($id);

		$get_broker = $this->model->get_broker();
		$dt_supplier = $this->model->get_supplier();

		$data =  array(
			'page' => "edit_transaksi_penjualan_v", 
			'title' => "Ubah Transaksi Penjualan", 
			'msg' => "", 
			'master' => "penjualan", 
			'view' => "transaksi_penjualan_c", 
			'dt_supplier' => $dt_supplier, 
			'get_broker' => $get_broker, 
			'msg' => $msg, 
			'dt' => $dt, 
			'dt_detail' => $dt_detail, 
			'list_akun' => $list_akun, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_all_produk' => $get_all_produk, 
			'get_pel_sup' => $get_pel_sup, 
			'get_pajak' => $get_pajak, 
			'post_url' => 'transaksi_penjualan_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function detail($id=""){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];

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
		}

		$dt = $this->model->get_data_trx($id);
		$dt_detail = $this->model->get_data_trx_detail($id);

		$data =  array(
			'page' => "detail_transaksi_penjualan_v", 
			'title' => "Detail Transaksi Penjualan", 
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

	function cetak($id=""){


		$data =  array(
			'page' => "transaksi_penjualan_c", 
		);
		
		$this->load->view('pdf/report_sales_order_pdf', $data);
	}

	function cetak_do($id=""){


		$data =  array(
			'page' => "transaksi_penjualan_c", 
		);
		
		$this->load->view('pdf/report_delivery_order_solar_pdf.php', $data);
	}

	function cetak_inv($id=""){


		$data =  array(
			'page' => "transaksi_penjualan_c", 
		);
		
		$this->load->view('pdf/report_invoice_pdf.php', $data);
	}

	function cetak_sj($id=""){


		$data =  array(
			'page' => "transaksi_penjualan_c", 
		);
		
		$this->load->view('pdf/report_surat_jalan_solar_pdf.php', $data);
	}

	function cetak_kwi($id=""){

		$data =  array(
			'page' => "transaksi_penjualan_c", 
		);
		
		$this->load->view('pdf/report_kwitansi_pdf.php', $data);
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

		$id_user = $sess_user['id'];
        $user = $this->master_model_m->get_user_info($id_user);
        $where_unit = "1=1";
        if($user->LEVEL == "ADMIN"){
            $where_unit = "1=1";
        } else {
            $where_unit = "UNIT = ".$user->UNIT;
        }

		$keyword = $this->input->post('keyword');
		if($keyword != "" || $keyword != null){
			$where = $where." AND (NAMA_PELANGGAN LIKE '%$keyword%' OR NAMA_USAHA LIKE '%$keyword%')";
		}

		$sql = "
		SELECT * FROM ak_pelanggan WHERE ID_KLIEN = $id_klien AND $where AND APPROVE = 3 AND $where_unit
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

	function detail_transaksi(){
		$id = $this->input->post('id');

		$data = array();
		$data['dt'] = $this->model->get_data_trx($id);
		$data['dt_detail'] = $this->model->get_data_trx_detail($id);

		echo json_encode($data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */