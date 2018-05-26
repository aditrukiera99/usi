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

			$id 	       = $this->input->post('id_pp');
			$no_trx 	   = $this->input->post('no_trx');
			$no_trx2       = $this->input->post('no_trx2');
			$id_pelanggan  = $this->input->post('pelanggan_sel');
			$pelanggan     = $this->input->post('pelanggan');
			
			$alamat_tagih  = $this->input->post('alamat_tagih');
			$no_po_pelanggan  = $this->input->post('no_po_pelanggan');
			
			$tgl_trx 	    = $this->input->post('tgl_trx');
			$keterangan     = $this->input->post('memo_lunas');
			$sub_total      = $this->input->post('sub_total');
			$pbbkb      	= $this->input->post('pbbkb');
			$oat      		= $this->input->post('oat');
			$qty_total      = $this->input->post('qty_total');
			$penampung_oat  = $this->input->post('penampung_oat');
			$pajak_id  		= $this->input->post('pajak_id');

			$ppn 			= $this->input->post('penampung_ppn');

			
			$kode_gudang = $this->db->query("SELECT * FROM ak_gudang WHERE ID = '$pajak_id' ")->row();

			$no_bukti_real = $no_trx."/".$kode_gudang->KODE_SUPPLY_POINT."/".$var."/".$tahun_kas;

			$operator      = $user->NAMA;

			$id_produk 	    = $this->input->post('produk');
			$kode_akun 	 	= $this->input->post('kode_akun');
			$nama_produk 	= $this->input->post('nama_produk');
			$qty 	        = $this->input->post('qty');
			$harga_modal 	= $this->input->post('harga_modal');
			$harga_beli 	= $this->input->post('harga_beli');
			$total_id 		= $this->input->post('total_id');

			$this->model->simpan_penjualan_so($no_trx, $id_pelanggan, $pelanggan, $alamat_tagih, $tgl_trx, $sub_total, $keterangan, $ppn , $nilai_pph ,$nilai_pbbkb , $nilai_qty_total , $ppn_oat,$no_po_pelanggan,$penampung_oat,$no_bukti_real);

			$id_penjualan = $this->db->insert_id(); 

			// $this->model->simpan_pembelian_po($no_po, $id_supplier, $supplier, $tgl_trx, $sub_total, $keterangan, $ppn , $nilai_pph ,$nilai_pbbkb , $no_trx);

			// $id_pembelian = $this->db->insert_id();

			// $this->model->simpan_penerimaan_barang($no_lpbe, $id_supplier, $supplier, $keterangan, $no_po ,$nilai_pbbkb);

			// $id_penerimaan = $this->db->insert_id();

			// $this->model->simpan_delivery_order($no_deo, $id_pelanggan, $pelanggan, $nama_produk[0] , $qty[0] , $segel_atas ,$meter_atas,$no_pol,$segel_bawah,$meter_bawah,$nama_kapal,$temperatur,$sg_meter,$keterangan, $no_trx);

			// $id_delivery = $this->db->insert_id();

			

			$this->model->save_next_nomor($id_klien, 'Penjualan', $no_trx2);
			// $this->model->save_next_nomor($id_klien, 'Pembelian', $no_po);
			// $this->model->save_next_nomor($id_klien, 'Penerimaan_barang', $no_lpbe);
			// $this->model->save_next_nomor($id_klien, 'Delivery_order', $no_deo);
			// $this->model->save_next_nomor($id_klien, 'Invoice', $no_inv);
			// $this->model->save_next_nomor($id_klien, 'Surat_jalan', $no_sj);


			foreach ($id_produk as $key => $val) {
				$this->model->simpan_detail_penjualan($id_penjualan, $val, $kode_akun[$key], $nama_produk[$key], $qty[$key], $harga_modal[$key], $total_id[$key],$harga_beli[$key]);	
				// $this->model->simpan_detail_pembelian($id_pembelian, $val, $kode_akun[$key], $nama_produk[$key], $qty[$key], $harga_modal[$key], $total_id[$key]);
				// $this->model->simpan_detail_penerimaan($id_penerimaan, $val, $kode_akun[$key], $nama_produk[$key], $qty[$key], $harga_modal[$key], $total_id[$key]);	
				// $this->model->update_stok($id_klien, $id_produk[$key], $qty[$key]);
			}

			// $this->master_model_m->simpan_log($id_user, "Melakukan transaksi penjualan dengan nomor transaksi : <b>".$no_trx."</b>");

		}

		if($this->input->post('edit_inv')){
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



			$no_invoice    = $this->input->post('no_invoice');
			$qty_diterima  = $this->input->post('qty_diterima');
			$no_trx        = $this->input->post('no_solo');
			$invoice        = $this->input->post('no_invoice');
			$no_do        = $this->input->post('no_trx');

			$kode_gudang = $this->db->query("SELECT g.KODE_SUPPLY_POINT FROM ak_gudang g , ak_penjualan p , ak_pelanggan pl WHERE p.ID_PELANGGAN = pl.ID AND pl.ID_SUPPLY_POINT = g.ID AND p.NO_BUKTI = '$no_trx' ")->row();

			$no_bukti_real = $invoice."/".$kode_gudang->KODE_SUPPLY_POINT."/INV/".$var."/".$tahun_kas;
			// $qty           = $this->input->post('qty');

			// $kode_gudang = $this->db->query("SELECT * FROM ak_gudang WHERE ID = '$pajak_id' ")->row();

			// $no_bukti_real = $no_trx."/".$kode_gudang->KODE_SUPPLY_POINT."/".$var."/".$tahun_kas;


			$this->model->edit_status_invoice($no_invoice,$qty_diterima,$no_trx,$no_bukti_real);
			$this->model->edit_status_do($no_do);
			$this->model->save_next_nomor('13', 'Invoice', $invoice);


		}

		if($this->input->post('edit_cui')){
			$msg = 1;

			$id 	       = $this->input->post('id_pp');
			$no_trx 	   = $this->input->post('no_trx');
			$no_trx2       = $this->input->post('no_trx2');
			$id_pelanggan  = $this->input->post('pelanggan_sel');
			$pelanggan     = $this->input->post('pelanggan');
			$alamat_tagih  = $this->input->post('alamat_tagih');
			// $kota_tujuan   = $this->input->post('kota_tujuan');
			$no_po         = $this->input->post('no_po');
			$no_do         = $this->input->post('no_do');
			$tgl_trx 	   = $this->input->post('tgl_trx');
			$keterangan    = $this->input->post('memo_lunas');
			// $jatuh_tempo   = $this->input->post('jatuh_tempo');
			$dikirim        = $this->input->post('dikirim');
			$segel_atas 	= $this->input->post('segel_atas');
			$meter_atas   	= $this->input->post('meter_atas');
			$no_pol    		= $this->input->post('no_pol');
			$segel_bawah    = $this->input->post('segel_bawah');
			$meter_bawah    = $this->input->post('meter_bawah');
			$nama_kapal     = $this->input->post('nama_kapal');
			$temperatur     = $this->input->post('temperatur');
			$sg_meter   	= $this->input->post('sg_meter');

			$tgl_do        = $this->input->post('tgl_trx');
			$tgl_sj        = $this->input->post('tgl_trx');
			$tgl_inv       = $this->input->post('tgl_trx');
			$tgl_kwi       = $this->input->post('tgl_trx');	
			$operator      = $user->NAMA;
			

			// $this->model->ubah_penjualan_detail($id,$no_trx, $id_pelanggan, $pelanggan, $alamat_tagih, $kota_tujuan, $no_po, $no_do, $tgl_trx, $keterangan, $jatuh_tempo, $no_pol, $sopir, $alat_angkut, $segel_atas, $segel_bawah, $broker, $temperatur, $density, $flash_point, $water_content, $tgl_do, $tgl_sj, $tgl_inv, $tgl_kwi, $operator);

			$id_penjualan   = $this->input->post('id_pnj');
			$id_produk 	    = $this->input->post('produk');
			$kode_akun 	 	= $this->input->post('kode_akun');
			$nama_produk 	= $this->input->post('nama_produk');
			$qty 	        = $this->input->post('qty');

			$harga_modal    = $this->input->post('harga_modal');
			$supplier 	    = $this->input->post('supplier');
			

			

			foreach ($id_produk as $key => $val) {
				$this->model->ubah_detail_penjualan($no_trx, $val, $kode_akun[$key], $nama_produk[$key], $qty[$key], $harga_modal[$key]);
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

			$this->model->edit_status_invoice_br($id_hapus);
			// $this->model->edit_status_do_br($no_do);
			// $this->model->save_next_nomor('13', 'Invoice', $invoice);


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
		$no_trx = $this->model->get_no_trx_penjualan($id_klien);
		$no_pem= $this->model->get_no_trx_pembelian($id_klien);
		$no_lpb= $this->model->get_no_trx_lpb($id_klien);
		$no_do = $this->model->get_no_trx_do($id_klien);
		$inv = $this->model->get_no_trx_inv($id_klien);
		$sj = $this->model->get_no_trx_sj($id_klien);
		$get_broker = $this->model->get_broker();
		$dt_supplier = $this->model->get_supplier();
		$supply = $this->model->supply();

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
			'no_lpb' => $no_lpb,
			'no_do' => $no_do,
			'inv' => $inv,
			'sj' => $sj,
			'supply' => $supply,
			'get_broker' => $get_broker, 
			'post_url' => 'transaksi_penjualan_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function new_invoice_trans(){
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
		$no_trx = $this->model->get_no_trx_penjualan($id_klien);
		$no_pem= $this->model->get_no_trx_pembelian($id_klien);
		$no_lpb= $this->model->get_no_trx_lpb($id_klien);
		$no_do = $this->model->get_no_trx_do($id_klien);
		$inv = $this->model->get_no_trx_inv($id_klien);
		$sj = $this->model->get_no_trx_sj($id_klien);
		$get_broker = $this->model->get_broker();
		$dt_supplier = $this->model->get_supplier();
		$supply = $this->model->supply();

		$data =  array(
			'page' => "buat_transaksi_penjualan_new_trans_v", 
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
			'no_lpb' => $no_lpb,
			'no_do' => $no_do,
			'inv' => $inv,
			'sj' => $sj,
			'supply' => $supply,
			'get_broker' => $get_broker, 
			'post_url' => 'transaksi_penjualan_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function buka_invoice(){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);


		if($this->input->post('edit_inv')){
			$msg = 1;

			

			$no_so    = $this->input->post('no_solo');
			$memo  = $this->input->post('memo_lunas');


			$this->model->edit_invoice($no_so,$memo);


		}


		

		$list_akun = $this->model->get_list_akun($id_klien);
		$get_list_akun_all = $this->model->get_list_akun_all($id_klien);
		$get_all_produk    = $this->model->get_all_produk($id_klien);
		$get_pel_sup = $this->model->get_pel_sup($id_klien);
		$no_trx = $this->model->get_no_trx_penjualan($id_klien);
		$no_pem= $this->model->get_no_trx_pembelian($id_klien);
		$no_lpb= $this->model->get_no_trx_lpb($id_klien);
		$no_do = $this->model->get_no_trx_do($id_klien);
		$inv = $this->model->get_no_trx_inv($id_klien);
		$get_broker = $this->model->get_broker();
		$dt_supplier = $this->model->get_supplier();
		$dt = $this->model->get_penjualan_invoice($keyword, $id_klien);

		$data =  array(
			'page' => "invoice_new_v", 
			'title' => "Buat Penjualan Baru", 
			'msg' => "", 
			'master' => "penjualan", 
			'view' => "invoice", 
			'msg' => $msg, 
			'dt_supplier' => $dt_supplier, 
			'list_akun' => $list_akun, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_all_produk' => $get_all_produk, 
			'get_pel_sup' => $get_pel_sup, 
			'get_pajak' => $get_pajak, 
			'no_trx' => $no_trx, 
			'no_pem' => $no_pem, 
			'no_lpb' => $no_lpb,
			'no_do' => $no_do,
			'inv' => $inv,
			'dt' => $dt,
			'get_broker' => $get_broker, 
			'post_url' => 'transaksi_penjualan_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function buka_invoice_baru(){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		

		$get_all_produk    = $this->model->get_all_produk($id_klien);
		$get_pel_sup = $this->model->get_pel_sup($id_klien);
		$no_trx = $this->model->get_no_trx_penjualan($id_klien);
		$no_pem= $this->model->get_no_trx_pembelian($id_klien);
		$no_lpb= $this->model->get_no_trx_lpb($id_klien);
		$no_do = $this->model->get_no_trx_do($id_klien);
		$inv = $this->model->get_no_trx_inv($id_klien);
		$dt_supplier = $this->model->get_supplier();
		$dt = $this->model->get_penjualan($keyword, $id_klien);

		$data =  array(
			'page' => "buat_invoice_new_v", 
			'title' => "Buat Penjualan Baru", 
			'msg' => "", 
			'master' => "penjualan", 
			'view' => "invoice", 
			'msg' => $msg, 
			'dt_supplier' => $dt_supplier, 
			'get_all_produk' => $get_all_produk, 
			'get_pel_sup' => $get_pel_sup, 
			'no_trx' => $no_trx, 
			'no_pem' => $no_pem, 
			'no_lpb' => $no_lpb,
			'no_do' => $no_do,
			'inv' => $inv,
			'dt' => $dt,
			'post_url' => 'transaksi_penjualan_c/buka_invoice', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function ubah_invoice_baru($id=""){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		

		// $get_all_produk    = $this->model->get_all_produk($id_klien);
		// $get_pel_sup = $this->model->get_pel_sup($id_klien);
		// $no_trx = $this->model->get_no_trx_penjualan($id_klien);
		// $no_pem= $this->model->get_no_trx_pembelian($id_klien);
		// $no_lpb= $this->model->get_no_trx_lpb($id_klien);
		// $no_do = $this->model->get_no_trx_do($id_klien);
		// $inv = $this->model->get_no_trx_inv($id_klien);
		// $dt_supplier = $this->model->get_supplier();
		$dt = $this->model->get_penjualan_inv($id);

		$data =  array(
			'page' => "ubah_invoice_baru_v", 
			'title' => "Ubah Invoice", 
			'msg' => "", 
			'master' => "penjualan", 
			'view' => "invoice", 
			'msg' => $msg, 
			'dt_supplier' => $dt_supplier, 
			'get_all_produk' => $get_all_produk, 
			'get_pel_sup' => $get_pel_sup, 
			'no_trx' => $no_trx, 
			'no_pem' => $no_pem, 
			'no_lpb' => $no_lpb,
			'no_do' => $no_do,
			'inv' => $inv,
			'dt' => $dt,
			'post_url' => 'transaksi_penjualan_c/buka_invoice', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function buka_surat_jalan(){
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
		$no_trx = $this->model->get_no_trx_penjualan($id_klien);
		$no_pem= $this->model->get_no_trx_pembelian($id_klien);
		$no_lpb= $this->model->get_no_trx_lpb($id_klien);
		$no_do = $this->model->get_no_trx_do($id_klien);
		$inv = $this->model->get_no_trx_inv($id_klien);
		$get_broker = $this->model->get_broker();
		$dt_supplier = $this->model->get_supplier();
		$dt = $this->model->get_penjualan($keyword, $id_klien);

		$data =  array(
			'page' => "surat_jalan_new_v", 
			'title' => "Buat Surat Jalan Baru", 
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
			'no_lpb' => $no_lpb,
			'no_do' => $no_do,
			'inv' => $inv,
			'dt' => $dt,
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

	function get_inv_popup(){
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
			$where = $where." AND (TGL_TRX LIKE '%$keyword%' OR NO_BUKTI LIKE '%$keyword%')";
		}

		$sql = "
		SELECT * FROM ak_penjualan WHERE STATUS_INV is null AND $where  
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_do_popup(){
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
			$where = $where." AND (TGL_TRX LIKE '%$keyword%' OR NO_BUKTI LIKE '%$keyword%')";
		}

		$sql = "
		SELECT * FROM ak_delivery_order WHERE STATUS = '0' 
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function cetak($id=""){

		$dt = $this->model->get_data_trx($id);
		$dt_deti = $this->model->get_data_trx_detail($id);

		$data =  array(
			'page' => "transaksi_penjualan_c", 
			'dt' => $dt,
			'dt_deti' => $dt_deti,
		);
		
		$this->load->view('pdf/report_sales_order_pdf', $data);
	}

	function cetak_confirm($id=""){

		$dt = $this->model->get_data_trx($id);
		$dt_deti = $this->model->get_data_trx_detail($id);
		$dt_detil = $this->model->get_data_trxx_detail($id);

		$data =  array(
			'page' => "transaksi_penjualan_c", 
			'dt' => $dt,
			'dt_deti' => $dt_deti,
			'dt_detil' => $dt_detil,
		);
		
		$this->load->view('pdf/report_penawaran_beli_pdf', $data);
	}

	function cetak_inv($id=""){

		$dt = $this->model->get_data_trx($id);
		$dt_deti = $this->model->get_data_trx_detail($id);

		$data =  array(
			'page' => "transaksi_penjualan_c", 
			'dt' => $dt,
			'dt_deti' => $dt_deti,
			'dt_detil' => $dt_detil,
		);
		
		$this->load->view('pdf/report_invoice_new_pdf', $data);
	}

	function cetak_loses($id=""){

		$dt = $this->model->get_data_trx_loses($id);
		$dt_deti = $this->model->get_data_trx_detail_loses($id);

		$data =  array(
			'page' => "transaksi_penjualan_c", 
			'dt' => $dt,
			'dt_deti' => $dt_deti,
			'dt_detil' => $dt_detil,
		);
		
		$this->load->view('pdf/cetak_loses_pdf', $data);
	}

	function cetak_bbm($id=""){

		$dt = $this->model->get_data_trx_loses($id);
		$dt_deti = $this->model->get_data_trx_detail_loses($id);

		$data =  array(
			'page' => "transaksi_penjualan_c", 
			'dt' => $dt,
			'dt_deti' => $dt_deti,
			'dt_detil' => $dt_detil,
		);
		
		$this->load->view('pdf/cetak_bbm_pdf', $data);
	}

	function cetak_transport($id=""){

		$dt = $this->model->get_data_trx_loses($id);
		$dt_deti = $this->model->get_data_trx_detail_loses($id);

		$data =  array(
			'page' => "transaksi_penjualan_c", 
			'dt' => $dt,
			'dt_deti' => $dt_deti,
			'dt_detil' => $dt_detil,
		);
		
		$this->load->view('pdf/cetak_transport_pdf', $data);
	}

	function cetak_do($id=""){


		$data =  array(
			'page' => "transaksi_penjualan_c", 
		);
		
		$this->load->view('pdf/report_delivery_order_solar_pdf.php', $data);
	}

	

	function cetak_sj($id=""){

		$dt = $this->model->get_data_trx($id);
		$dt_det = $this->model->get_data_trx_detail($id);



		$data =  array(
			'page' => "transaksi_penjualan_c", 
			'dt' => $dt,
			'dt_det' => $dt_det,
			'dt_detil' => $dt_detil,
		);
		
		$this->load->view('pdf/report_surat_jalan_new_pdf', $data);
	
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

	function get_supplier_detail(){
		$id_pel = $this->input->get('id_pel');
		$dt = $this->model->get_supplier_detail($id_pel);

		echo json_encode($dt);
	}

	function get_produk_detail(){
		$id_produk = $this->input->get('id_produk');
		$dt = $this->model->get_produk_detail($id_produk);

		echo json_encode($dt);
	}

	function get_produk_detail_mh(){
		$id_produk = $this->input->get('id_produk');
		$dt = $this->model->get_produk_detail_mh($id_produk);

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

	function get_supplier_popup(){
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
			$where = $where." AND (NAMA_SUPPLIER LIKE '%$keyword%' OR NAMA_USAHA LIKE '%$keyword%')";
		}

		$sql = "
		SELECT * FROM ak_supplier WHERE ID_KLIEN = $id_klien AND $where AND APPROVE = 3 AND $where_unit
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
		$kode_pelanggan = $this->input->post('kode_pelanggan');
		if($keyword != "" || $keyword != null){
			$where = $where." AND (KODE_PRODUK LIKE '%$keyword%' OR NAMA_PRODUK LIKE '%$keyword%')";
		}

		$sql = "
		SELECT mh.HARGA_BELI , p.NAMA_PRODUK , p.KODE_PRODUK , mh.ID FROM ak_produk p , ak_master_harga mh WHERE  mh.ID_PRODUK = p.ID AND mh.ID_PELANGGAN = '$kode_pelanggan' AND mh.STATUS = '0'
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