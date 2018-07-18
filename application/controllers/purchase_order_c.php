<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_order_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('purchase_order_m','model');
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

			$bulan_kas = date("m",strtotime($this->input->post('tgl_trx')));

				if($bulan_kas == "01"){
			    $var = "I";
			   } else if($bulan_kas == "02"){
			    $var = "II";
			   } else if($bulan_kas == "03"){
			    $var = "III";
			   } else if($bulan_kas == "04"){
			    $var = "IV";
			   } else if($bulan_kas == "05"){
			    $var = "V";
			   } else if($bulan_kas == "06"){
			    $var = "VI";
			   } else if($bulan_kas == "07"){
			    $var = "VII";
			   } else if($bulan_kas == "08"){
			    $var = "VIII";
			   } else if($bulan_kas == "09"){
			    $var = "IX";
			   } else if($bulan_kas == "10"){
			    $var = "X";
			   } else if($bulan_kas == "11"){
			    $var = "XI";
			   } else if($bulan_kas == "12"){
			    $var = "XII";
			   }

			   $tahun_kas = date("y",strtotime($this->input->post('tgl_trx')));

			  

			$no_trx 	   = $this->input->post('no_trx');
			$no_trx2       = $this->input->post('no_trx2');
			// $kode_sh       = $this->input->post('kode_sh');
			$id_pelanggan  = $this->input->post('pelanggan_sel');
			$pelanggan     = $this->input->post('pelanggan');
			$alamat_tagih  = $this->input->post('alamat_tagih');
			$supply_point  = $this->input->post('supply_point');
			$pajak_supply  = $this->input->post('aksi_on');

			$tgl_trx 	    = $this->input->post('tgl_trx');
			$jatuh_tempo 	= $this->input->post('jatuh_tempo');
			$hari_tempo 	= $this->input->post('hari_tempo');
			$keterangan     = $this->input->post('memo_lunas');
			$sub_total      = $this->input->post('subtotal_txt');

			$penampung_pbbkb       = $this->input->post('penampung_pbbkb');
			$penampung_ppn         = $this->input->post('penampung_ppn');
			$penampung_pph_21      = $this->input->post('penampung_pph_21');
			$penampung_pph_15      = $this->input->post('penampung_pph_15');
			$penampung_pph_23      = $this->input->post('penampung_pph_23');
			$penampung_pph_22      = $this->input->post('penampung_pph_22');


			$total_hasil_pajak      = $this->input->post('total_hasil_pajak');

			$pelanggan_cust      	= $this->input->post('pelanggan_cust');
			$alamat_tagih_cust      = $this->input->post('alamat_tagih_cust');
			$kode_sh_cust      		= $this->input->post('kode_sh_cust');

			$oat      		= $this->input->post('oat');
			$qty_total      = $this->input->post('qty_total');
			$ppn 			= 0.1 * $sub_total;

			$kode_gudang = $this->db->query("SELECT * FROM ak_gudang WHERE ID = '$pajak_supply' ")->row();

			$no_bukti_real = $no_trx."/".$kode_gudang->KODE_SUPPLY_POINT."/".$var."/".$tahun_kas;

			$pajak_area = $this->db->query("SELECT * FROM ak_pajak_supply WHERE ID = '$pajak_supply'")->row();

			// $nilai_pbbkb = 0;
			// $nilai_qty_total = 0;
			// $ppn_oat = 0 ;
			// $nilai_pph = 0;
			// if ($pbbkb == 'ada') {
			//  	$nilai_pbbkb = ($pajak_area->PAJAK/100) * $sub_total;
			//  	$nilai_pph = 0.003 * $sub_total;
			//  }

			// if ($oat == 'ada') {
			//  	$nilai_qty_total = 100 * $qty_total;
			//  	$ppn_oat = 0.1 * $nilai_qty_total;
			// } 
			$operator      = $user->NAMA;
			$type_cetak      = 'SOLAR';

			$this->model->simpan_pembelian_po($no_trx, $id_pelanggan, $pelanggan, $tgl_trx, $sub_total, $keterangan, $penampung_ppn , $penampung_pph_21 ,$penampung_pbbkb ,$penampung_pph_15 ,$penampung_pph_23 , $no_trx, $supply_point,$jatuh_tempo,$pajak_supply,$total_hasil_pajak,$pelanggan_cust,$alamat_tagih_cust,$kode_sh_cust,$no_bukti_real,$penampung_pph_22,$hari_tempo,$qty_total,$type_cetak);

			$id_pembelian = $this->db->insert_id();

			$this->model->save_next_nomor($id_klien, 'Pembelian', $no_trx2);

			$id_produk 	    = $this->input->post('produk');
			$kode_akun 	 	= $this->input->post('kode_akun');
			$nomor_so 	 	= $this->input->post('nomor_so');
			$nama_produk 	= $this->input->post('nama_produk');
			$qty 	        = $this->input->post('qty');

			$harga_modal    = $this->input->post('harga_modal');
			$harga_invoice  = $this->input->post('harga_invoice');			

			foreach ($id_produk as $key => $val) {
				$this->model->simpan_detail_pembelian($id_pembelian, $val, $kode_akun[$key], $nama_produk[$key], $qty[$key], $harga_modal[$key], $harga_invoice[$key],$no_trx,$nomor_so[$key]);	
				$this->model->update_status_so($nomor_so[$key]);
				// $this->model->update_stok($pajak_supply, $id_produk[$key], $qty[$key]);
			}

			$transportir 	 	= $this->input->post('transportir');

			foreach ($transportir as $key => $tra) {
				$this->model->simpan_detail_transportir($id_pembelian, $tra);
				
			}

			// $data_cust = $this->input->post('data_cust');
			// foreach ($data_cust as $key => $val) {
			// 	$this->db->query("INSERT INTO ak_pembelian_customer (ID_PEMBELIAN, NAMA_CUSTOMER) VALUES ('$id_penjualan', '$val') ");
			// }

			$this->master_model_m->simpan_log($id_user, "Melakukan transaksi penjualan dengan nomor transaksi : <b>".$no_trx."</b>");

		}

		if($this->input->post('simpan_umum')){

			$msg = 1;

			$no_trx 	   = $this->input->post('no_trx');
			$no_trx2       = $this->input->post('no_trx2');
			$id_pelanggan  = $this->input->post('pelanggan_sel');
			$pelanggan     = $this->input->post('pelanggan');
			$supply_point  = $this->input->post('supply_point');

			$tgl_trx 	    = $this->input->post('tgl_trx');
			$keterangan     = $this->input->post('memo_lunas');
			$sub_total      = $this->input->post('sub_total');
			
			$operator      = $user->NAMA;

			$this->model->simpan_pembelian_po_umum($no_trx,$id_pelanggan, $pelanggan, $tgl_trx, $sub_total, $keterangan, $supply_point);

			$id_pembelian = $this->db->insert_id();

			$this->model->save_next_nomor($id_klien, 'Umum', $no_trx2);

			$nama_produk 	= $this->input->post('nama_produk');
			$qty 	        = $this->input->post('qty');

			$harga_modal    = $this->input->post('harga_modal');
			$harga_invoice  = $this->input->post('harga_invoice');			

			foreach ($nama_produk as $key => $val) {
				$this->model->simpan_detail_pembelian_umum($id_pembelian, $val, $qty[$key], $harga_modal[$key], $harga_invoice[$key],$no_trx);	
			}

	

			$this->master_model_m->simpan_log($id_user, "Melakukan transaksi penjualan dengan nomor transaksi : <b>".$no_trx."</b>");

		}

		if($this->input->post('simpan_ciu')){
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

			$atas_nama        = $this->input->post('atas_nama');
			$transport        = $this->input->post('transport');
			$data_cust        = $this->input->post('data_cust');

			$temperatur    = $this->input->post('temperatur');
			$density       = $this->input->post('density');
			$flash_point   = $this->input->post('flash_point');
			$water_content = $this->input->post('water_content');

			$tgl_ambil = $this->input->post('tgl_ambil');

			$tgl_do        = $this->input->post('tgl_trx');
			$tgl_sj        = $this->input->post('tgl_trx');
			$tgl_inv       = $this->input->post('tgl_trx');
			$tgl_kwi       = $this->input->post('tgl_trx');	
			$operator      = $user->NAMA;

			$id_penjualan   = $this->input->post('id_penjualan');

			$this->model->ubah_pembelian_new($id_penjualan,$no_trx, $id_pelanggan, $pelanggan, $alamat_tagih, $kota_tujuan, $no_po, $no_do, $tgl_trx, $keterangan, $jatuh_tempo, $no_pol, $sopir, $alat_angkut, $segel_atas, $segel_bawah, $broker, $temperatur, $density, $flash_point, $water_content, $tgl_do, $tgl_sj, $tgl_inv, $tgl_kwi, $operator, $atas_nama, $transport, $tgl_ambil);

			

			$id_produk 	    = $this->input->post('produk');
			$kode_akun 	 	= $this->input->post('kode_akun');
			$nama_produk 	= $this->input->post('nama_produk');
			$qty 	        = $this->input->post('qty2');

			$harga_modal    = $this->input->post('harga_modal');
			$harga_invoice  = $this->input->post('harga_invoice');

			$this->model->hapus_detail_trx($id_penjualan);			

			foreach ($id_produk as $key => $val) {
				$this->model->simpan_detail_penjualan($id_penjualan, $val, $kode_akun[$key], $nama_produk[$key], $qty[$key], $harga_modal[$key], $harga_invoice[$key]);	
				
			}

			$this->model->hapus_detail_cust($id_penjualan);

			foreach ($data_cust as $key => $val) {
				$this->db->query("INSERT INTO ak_pembelian_customer (ID_PEMBELIAN, NAMA_CUSTOMER) VALUES ('$id_penjualan', '$val') ");
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

		} else if($this->input->post('edit_say')){
			$msg = 2;

			$id_hapus 	 = $this->input->post('id_edit_say');
			$memos_lunas = $this->input->post('memos_lunas');
			$tgl_trx 	 = $this->input->post('tgl_trx');

			$this->model->edit_tanggal_po($id_hapus,$memos_lunas,$tgl_trx);


			$this->master_model_m->simpan_log($id_user, "Mengubah transaksi penjualan dengan nomor transaksi : <b>".$get_data_trx->NO_BUKTI."</b>");
		}



		$get_list_akun_all = $this->master_model_m->get_list_akun_all();
		$dt = $this->model->get_penjualan($keyword, $id_klien);
		
		$data =  array(
			'page' => "purchase_order_v", 
			'title' => "Transaksi Pembelian",  
			'master' => "pembelian", 
			'view' => "purchase_order", 
			'dt' => $dt, 
			'msg' => $msg, 
			'tgl_full' => $tgl_full, 
			'kode_produk' => $kode_produk, 
			'get_list_akun_all' => $get_list_akun_all, 
			'post_url' => 'purchase_order_c', 
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
		$get_broker = $this->model->get_broker();
		$supply = $this->model->supply();
		$trans = $this->model->trans();

		$data =  array(
			'page' => "buat_transaksi_po_new_v", 
			'title' => "Buat Pembelian Baru", 
			'msg' => "", 
			'master' => "pembelian", 
			'view' => "purchase_order", 
			'msg' => $msg, 
			'list_akun' => $list_akun, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_all_produk' => $get_all_produk, 
			'get_pel_sup' => $get_pel_sup, 
			'get_pajak' => $get_pajak, 
			'no_trx' => $no_trx, 
			'get_broker' => $get_broker, 
			'supply' => $supply, 
			'trans' => $trans, 
			'post_url' => 'purchase_order_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function ubah_new_invoice($id=""){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		

		$dt = $this->model->dt_purchase_order($id);

		$data =  array(
			'page' => "ubah_purchase_order_v", 
			'title' => "Buat Pembelian Baru", 
			'msg' => "", 
			'master' => "pembelian", 
			'view' => "purchase_order", 
			'msg' => $msg, 
			'dt' => $dt, 
			'post_url' => 'purchase_order_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function new_invoice_umum(){
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
		$no_trx = $this->model->get_no_trx_umum($id_klien);
		$get_broker = $this->model->get_broker();
		$supply = $this->model->supply();

		$data =  array(
			'page' => "buat_transaksi_po_umum_v", 
			'title' => "Buat Pembelian Baru", 
			'msg' => "", 
			'master' => "pembelian", 
			'view' => "purchase_order", 
			'msg' => $msg, 
			'list_akun' => $list_akun, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_all_produk' => $get_all_produk, 
			'get_pel_sup' => $get_pel_sup, 
			'get_pajak' => $get_pajak, 
			'no_trx' => $no_trx, 
			'get_broker' => $get_broker, 
			'supply' => $supply, 
			'post_url' => 'purchase_order_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function new_invoice_baru(){
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
		$get_broker = $this->model->get_broker();
		$supply = $this->model->supply();

		$data =  array(
			'page' => "buat_transaksi_po_langsung_v", 
			'title' => "Buat Penjualan Baru", 
			'msg' => "", 
			'master' => "pembelian", 
			'view' => "purchase_order", 
			'msg' => $msg, 
			'list_akun' => $list_akun, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_all_produk' => $get_all_produk, 
			'get_pel_sup' => $get_pel_sup, 
			'get_pajak' => $get_pajak, 
			'no_trx' => $no_trx, 
			'get_broker' => $get_broker, 
			'supply' => $supply, 
			'post_url' => 'purchase_order_c', 
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

		

		$dt_count = $this->db->query("SELECT COUNT(*) as HITUNG FROM ak_pembelian_new_detail WHERE ID_PENJUALAN = '$id' ")->row();
		$dt_count1 = $this->db->query("SELECT COUNT(*) as HITUNG_CUST FROM ak_pembelian_customer WHERE ID_PEMBELIAN = '$id' ")->row();
		$dt = $this->model->get_data_trx($id);
		$dt_detail = $this->model->get_data_trxx_detail($id);
		$dt_cust = $this->model->get_data_cust_detail($id);

		$data =  array(
			'page' => "edit_transaksi_po_v", 
			'title' => "Ubah Transaksi Penjualan", 
			'msg' => "", 
			'master' => "pembelian", 
			'view' => "fatulsembiring", 
			'msg' => $msg, 
			'dt' => $dt, 
			'dt_count' => $dt_count, 
			'dt_count1' => $dt_count1, 
			'dt_detail' => $dt_detail, 
			'dt_cust' => $dt_cust, 
			'list_akun' => $list_akun, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_all_produk' => $get_all_produk, 
			'get_pel_sup' => $get_pel_sup, 
			'get_pajak' => $get_pajak, 
			'post_url' => 'purchase_order_c', 
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

		$dt = $this->model->get_data_trx($id);
		$dt_det = $this->model->get_data_trx_detail($id);
		$dt_det_cust = $this->model->get_data_cust_detail($id);

		$data =  array(
			'page' => "transaksi_penjualan_c", 
			'dt' => $dt,
			'dt_det' => $dt_det,
			'dt_det_cust' => $dt_det_cust,
		);
		
		$this->load->view('pdf/report_purchase_order_pdf', $data);
	}

	function cetak_confirm($id=""){

		$dt = $this->model->get_data_trx($id);
		$dt_detil = $this->model->get_data_trx_detail_trans($id);
		$trans_det = $this->model->get_data_trans_detail($id);

		$data =  array(
			'page' => "purchase_order_c", 
			'dt' => $dt,
			'dt_detil' => $dt_detil,
			'trans_det' => $trans_det,
		);
		
		$this->load->view('pdf/report_penawaran_beli_pdf', $data);
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

	function get_supply_point(){
		$id = $this->input->post('id');
		$dt = $this->model->get_supply_point($id);

		echo json_encode($dt);
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

	function get_produk_detail_langsung(){
		$id_produk = $this->input->get('id_produk');
		$dt = $this->model->get_produk_detail_langsung($id_produk);

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
			$where = $where." AND (NAMA_PELANGGAN LIKE '%$keyword%' OR NAMA_USAHA LIKE '%$keyword%' OR ALAMAT_TAGIH LIKE '%$keyword%')";
		}

		$sql = "
		SELECT * FROM ak_pelanggan WHERE ID_KLIEN = $id_klien AND $where AND APPROVE = 3 AND $where_unit
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_supplier_detail(){
		$id_pel = $this->input->get('id_pel');
		$dt = $this->model->get_supplier_detail($id_pel);

		echo json_encode($dt);
	}


	function get_produk_popup_po(){
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
		$kode = $this->input->post('kode');
		$kode_id = $this->input->post('kode_id');
		if($keyword != "" || $keyword != null){
			$where = $where." AND (KODE_PRODUK LIKE '%$keyword%' OR NAMA_PRODUK LIKE '%$keyword%')";
		}

		$sql = "
		SELECT mh.HARGA_BELI , p.NAMA_PRODUK , p.KODE_PRODUK , p.ID FROM ak_produk p , ak_master_harga mh WHERE ID_KLIEN = $id_klien AND mh.ID_PRODUK = p.ID AND mh.SUPPLY_POINT = '$kode' AND mh.ID_PELANGGAN = '$kode_id' AND STATUS = '0' AND $where AND $where_unit AND APPROVE = 3
		LIMIT 10
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_supply_popup_po(){
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
		$kode = $this->input->post('kode');
		if($keyword != "" || $keyword != null){
			$where = $where." AND (g.NAMA LIKE '%$keyword%' OR ps.NAMA_BPPKB LIKE '%$keyword%')";
		}

		$sql = "
		SELECT g.NAMA as NAMA_SUPPLY , ps.NAMA_BPPKB as PAJAK_BPPKB , ps.PAJAK as PERSEN , mh.SUPPLY_POINT , g.ID , ps.ID as NAMID FROM ak_gudang g , ak_pajak_supply ps , ak_master_harga mh WHERE mh.SUPPLY_POINT = ps.ID AND ps.ID_SUPPLY = g.ID AND mh.ID_PELANGGAN = '$kode' AND STATUS = '0' AND $where GROUP BY mh.SUPPLY_POINT
		LIMIT 10
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_supply_popup_so(){
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
		$kode = $this->input->post('kode');
		if($keyword != "" || $keyword != null){
			$where = $where." AND (g.NAMA LIKE '%$keyword%' OR ps.NAMA_BPPKB LIKE '%$keyword%')";
		}

		$sql = "
		SELECT g.NAMA as NAMA_SUPPLY , ps.NAMA_BPPKB as PAJAK_BPPKB , ps.PAJAK as PERSEN , mh.SUPPLY_POINT , g.ID , ps.ID as NAMID FROM ak_gudang g , ak_pajak_supply ps , ak_master_harga mh WHERE mh.SUPPLY_POINT = ps.ID AND ps.ID_SUPPLY = g.ID AND mh.ID_PELANGGAN = '$kode' AND STATUS = '0' AND $where GROUP BY mh.SUPPLY_POINT
		LIMIT 10
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
			$where = $where." AND (NO_BUKTI LIKE '%$keyword%' OR CUSTOMER LIKE '%$keyword%')";
		}

		$sql = "
		SELECT * FROM ak_penjualan WHERE $where AND STATUS_PO = '0'
		LIMIT 10
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_produk_popup_cari(){
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