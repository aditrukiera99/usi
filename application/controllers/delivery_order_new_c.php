<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Delivery_order_new_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('delivery_order_new_m','model');
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

			$no_deo         = $this->input->post('no_do');
			$no_trx 	    = $this->input->post('no_trx');
			$id_pelanggan   = $this->input->post('pelanggan_sel');
			$pelanggan      = $this->input->post('pelanggan');
			$tgl_trx 	    = $this->input->post('tgl_trx');
			$keterangan     = $this->input->post('memo_lunas');
			$dikirim        = $this->input->post('dikirim');
			$segel_atas 	= $this->input->post('segel_atas');
			$meter_atas   	= $this->input->post('meter_atas');
			$no_pol    		= $this->input->post('no_pol');
			$segel_bawah    = $this->input->post('segel_bawah');
			$meter_bawah    = $this->input->post('meter_bawah');
			$nama_kapal     = $this->input->post('nama_kapal');
			$temperatur     = $this->input->post('temperatur');
			$sg_meter   	= $this->input->post('sg_meter');
			$nama_produk 	= $this->input->post('nama_produk');
			$id_produk	 	= $this->input->post('produk');
			$qty 	        = $this->input->post('qty');
			$qty_stok       = $this->input->post('qty_stok');
			$harga_modal 	= $this->input->post('harga_modal');
			$no_po 			= $this->input->post('no_po');
			$no_lpb 		= $this->input->post('no_lpb');
			$alamat_tagih 	= $this->input->post('alamat_tagih');
			$operator       = $user->NAMA;

			$pjk = $this->db->query("SELECT g.KODE_SUPPLY_POINT , p.SUPPLY_POINT FROM ak_gudang g , ak_penjualan p , ak_pelanggan pl WHERE p.ID_PELANGGAN = pl.ID AND pl.ID_SUPPLY_POINT = g.ID AND p.NO_BUKTI = '$no_trx' ")->row();

			$no_bukti_real = $no_deo."/".$pjk->KODE_SUPPLY_POINT."/".$var."/".$tahun_kas;

			$this->model->simpan_delivery_order($no_deo, $id_pelanggan, $pelanggan, $nama_produk[0] , $qty[0] , $segel_atas ,$meter_atas,$no_pol,$segel_bawah,$meter_bawah,$nama_kapal,$temperatur,$sg_meter,$keterangan, $no_trx, $tgl_trx, $harga_modal[0],$no_bukti_real,$no_po,$no_lpb,$id_produk[0],$alamat_tagih,$qty_stok[0]);

			$this->model->update_status_so($no_trx, $qty_stok[0]);

			$id_penjualan = $this->db->insert_id(); 

			$this->model->update_stok_master($pjk->SUPPLY_POINT,$id_produk[0],$qty_stok[0]);

			$this->model->update_sisa_lpb($qty_stok[0],$no_lpb);

			$this->model->save_next_nomor($id_klien, 'Delivery_order', $no_deo);

			
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

		if($this->input->post('simpan_ubah')){
			$memo 			= $this->input->post('memo_lunas');
			$tgl_trx 		= $this->input->post('tgl_trx');
			$id 			= $this->input->post('no_id');
			$segel_atas 	= $this->input->post('segel_atas');
			$meter_atas   	= $this->input->post('meter_atas');
			$no_pol    		= $this->input->post('no_pol');
			$segel_bawah    = $this->input->post('segel_bawah');
			$meter_bawah    = $this->input->post('meter_bawah');
			$nama_kapal     = $this->input->post('nama_kapal');
			$temperatur     = $this->input->post('temperatur');
			$sg_meter   	= $this->input->post('sg_meter');


			$dt = $this->model->ubah_do($memo, $id,$segel_atas ,$meter_atas ,$no_pol,$segel_bawah,$meter_bawah,$nama_kapal ,$temperatur ,$sg_meter, $tgl_trx );
		
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
			

			$s = $this->db->query("SELECT NO_SO,QTY,NO_BUKTI,ID_PRODUK,NOMER_LPB FROM ak_delivery_order WHERE ID = $id_hapus ")->row();
		
			$this->model->update_stock_so($s->NO_SO,$s->QTY);
			$this->model->update_stock_lpb($s->NOMER_LPB,$s->QTY);
			$this->model->hapus_invoice($s->NO_BUKTI);
			$this->model->hapus_trx_penjualan($id_hapus);

			$nos = $s->NO_SO;

			$do = $this->db->query("SELECT * FROM ak_penjualan WHERE NO_BUKTI = $nos")->row();

			$this->model->update_stok_master_kurang($do->SUPPLY_POINT,$s->ID_PRODUK,$s->QTY);


			$this->master_model_m->simpan_log($id_user, "Menghapus transaksi penjualan dengan nomor transaksi : <b>".$get_data_trx->NO_BUKTI."</b>");
		}



		$get_list_akun_all = $this->master_model_m->get_list_akun_all();
		$dt = $this->model->get_penjualan($keyword, $id_klien);
		
		$data =  array(
			'page' => "delivery_order_new_v", 
			'title' => "Transaksi Penerimaan Barang",  
			'master' => "penjualan", 
			'view' => "delivery_order", 
			'dt' => $dt, 
			'msg' => $msg, 
			'tgl_full' => $tgl_full, 
			'kode_produk' => $kode_produk, 
			'get_list_akun_all' => $get_list_akun_all, 
			'post_url' => 'delivery_order_new_c', 
			'last_kas_bank' => $this->model->get_last_kas_bank($id_klien), 
			'last_cc' => $this->model->get_last_cc($id_klien), 
		);
		
		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
	}

	function new_delivery_order(){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		

		$list_akun = $this->model->get_list_akun($id_klien);
		$get_all_produk    = $this->model->get_all_produk($id_klien);
		$get_pel_sup = $this->model->get_pel_sup($id_klien);
		$no_trx = $this->model->get_no_trx_penjualan($id_klien);
		$no_do = $this->model->get_no_trx_do($id_klien);

		$data =  array(
			'page' => "buat_delivery_order_new_v", 
			'title' => "Buat Delivery Order Baru", 
			'msg' => "", 
			'master' => "penjualan", 
			'view' => "delivery_order", 
			'msg' => $msg, 
			'no_trx' => $no_trx, 
			'no_do' => $no_do, 
			'post_url' => 'delivery_order_new_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function ubah_delivery_order($id=""){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		

		$dt = $this->model->get_do($id);
		

		$data =  array(
			'page' => "ubah_delivery_order_v", 
			'title' => "Buat Delivery Order Baru", 
			'msg' => "", 
			'master' => "penjualan", 
			'view' => "delivery_order", 
			'msg' => $msg, 
			'dt' => $dt, 
			'post_url' => 'delivery_order_new_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function get_so_popup(){
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
			$where = $where." AND (p.TGL_TRX LIKE '%$keyword%' OR p.NO_BUKTI LIKE '%$keyword%')";
		}

		$sql = "
		SELECT p.* , pd.NAMA_PRODUK FROM ak_penjualan p , ak_penjualan_detail pd WHERE p.ID = pd.ID_PENJUALAN AND (p.STATUS_DO = '0' OR (p.STATUS_DO = '1' AND p.SISA > 0 AND TUTUP_OUTSTANDING = 'Belum') OR (TUTUP_OUTSTANDING = 'Belum' AND p.STATUS_DO = '0' ) OR (TUTUP_OUTSTANDING = 'Selesai' AND p.SISA > 0)) AND $where ORDER BY ID DESC
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_po_popup(){
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
			$where = $where." AND (pb.TGL_TRX LIKE '%$keyword%' OR pb.NO_BUKTI LIKE '%$keyword%')";
		}

		$sql = "
		SELECT pb.* , pd.NAMA_PRODUK , p.NAMA_CUSTOMER , p.NOMER_PO as NOMER_POS FROM ak_penerimaan_barang pb , ak_penerimaan_detail pd , ak_pembelian p WHERE pb.ID = pd.ID_PENJUALAN AND p.NO_PO = pb.NO_PO AND pb.NO_PO <> '' AND pb.SISA_ORDER > 0 AND $where  
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
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

	function get_so_detail(){
		$id_pel = $this->input->get('id_pel');
		$dt = $this->model->get_so_detail($id_pel);

		echo json_encode($dt);
	}

	function get_do_detail(){
		$id_pel = $this->input->get('id_pel');
		$dt = $this->model->get_do_detail($id_pel);

		echo json_encode($dt);
	}

	function get_sales_detail(){
		$id_pel = $this->input->get('id_pel');
		$dt = $this->model->get_sales_detail($id_pel);

		echo json_encode($dt);
	}

	function get_penerimaan_detail(){
		$id_pel = $this->input->get('id_pel');
		$dt = $this->model->get_penerimaan_detail($id_pel);

		echo json_encode($dt);
	}


	function get_do_tabel(){
		$id_pel = $this->input->get('id_pel');
		$dt = $this->model->get_do_tabel($id_pel);

		echo json_encode($dt);
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


		$dt = $this->model->get_data_do($id);
		$dt_det = $this->model->get_data_trx_detail($id);
		$dt_det_cust = $this->model->get_data_cust_detail($id);

		$data =  array(
			'page' => "delivery_order_new_c", 
			'dt' => $dt,
			'dt_det' => $dt_det,
			'dt_det_cust' => $dt_det_cust,
		);
		
		$this->load->view('pdf/report_delivery_order_new_pdf', $data);
	}

	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */