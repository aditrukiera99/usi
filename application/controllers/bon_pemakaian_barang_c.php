<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bon_pemakaian_barang_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('bon_pemakaian_barang_m','model');
	    $this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');

	}

	function index()
	{
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$tgl_full = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);


		if($this->input->post('simpan')){
			$msg = 1;
			$no_opb   = $this->input->post('no_opb');
			$no_po   = $this->input->post('no_po');
			$tgl_trx  = $this->input->post('tgl_trx');

			$id_pelanggan   = $this->input->post('pelanggan_sel');
			$pelanggan      = $this->input->post('pelanggan');

			$dpp = $this->input->post('dpp');
			$ppn = $this->input->post('ppn');

			if($dpp == ""){
				$dpp = 0;
				$ppn = 0;
			} else {
				$dpp = str_replace(',', '', $dpp);
				if($ppn){
					$ppn = ($dpp * 10) / 100;
				} else {
					$ppn = 0;
				}
			}

			$uraian   = addslashes($this->input->post('uraian'));

			$this->model->simpan_order_pembelian_barang($unit, $no_opb, $tgl_trx, $uraian, $user->UNIT, $dpp, $ppn, $id_pelanggan, $pelanggan, $no_po);
			$last_id = $this->db->insert_id();

			$nama_produk 	= $this->input->post('nama_produk');
			$keterangan 	= $this->input->post('keterangan');
			$jenis_produk 	= $this->input->post('jenis_produk');
			$id_produk 	    = $this->input->post('produk');
			$qty 	        = $this->input->post('qty');
			$satuan 		= $this->input->post('satuan');
			$harga_satuan 	= $this->input->post('harga_satuan');
			$jumlah 	 	= $this->input->post('jumlah');
			$kode_akun 	 	= $this->input->post('kode_akun');
			$no_spb 	 	= $this->input->post('no_spb');

			foreach ($nama_produk as $key => $val) {
				$this->model->simpan_detail_pembelian($last_id, $id_klien, $val, $qty[$key], $satuan[$key], $harga_satuan[$key], $jumlah[$key], $kode_akun[$key], $keterangan[$key], $id_produk[$key], $no_spb[$key]);
				if($jenis_produk[$key] != "JASA"){
					$this->model->update_stok($id_klien, $id_produk[$key], $qty[$key]);
				}
			}

			// $this->master_model_m->simpan_log($id_user, "Melakukan transaksi pembelian dengan nomor transaksi : <b>".$no_spb."</b>");

		} else if($this->input->post('id_hapus')){
			$msg = 2;

			$id_hapus = $this->input->post('id_hapus');
			$get_data_trx = $this->model->get_data_trx($id_hapus);

			$no_voc = $get_data_trx->NO_TRX_AKUN;
			$this->model->hapus_voucher($id_klien, $no_voc);
			$this->model->hapus_trx_pembelian($id_hapus);

			$this->master_model_m->simpan_log($id_user, "Menghapus transaksi pembelian dengan nomor transaksi : <b>".$get_data_trx->NO_BUKTI."</b>");
		}

		$dt = $this->model->get_pembelian($keyword, $id_klien);

		if($this->input->post('cari')){
			$tgl_full = $this->input->post('tgl');
			$tgl = explode(' sampai ', $tgl_full);
			$tgl_awal = $tgl[0];
			$tgl_akhir = $tgl[1];

			$dt = $this->model->get_pembelian_filter($keyword, $id_klien, $tgl_awal, $tgl_akhir);
		}

		$get_list_akun_all = $this->master_model_m->get_list_akun_all();
		
		$data =  array(
			'page' => "bon_pemakaian_barang_v", 
			'title' => "Bon Pemakaian Barang",  
			'master' => "produksi", 
			'view' => "bon_pemakaian_barang", 
			'dt' => $dt, 
			'msg' => $msg, 
			'tgl_full' => $tgl_full, 
			'get_list_akun_all' => $get_list_akun_all, 
			'kode_produk' => $kode_produk, 
			'post_url' => 'bon_pemakaian_barang_c', 
			'last_kas_bank' => $this->model->get_last_kas_bank($id_klien), 
			'last_cc' => $this->model->get_last_cc($id_klien), 
		);
		
		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
	}

	function add_new(){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];

		if($this->input->post('simpan')){
			$msg = 1;
			$id_pelanggan	 = $this->input->post('pelanggan_sel');
			$tgl_trx         = $this->input->post('tgl_trx');
			$tgl_jatuh_tempo = "";
			$no_trx          = $this->input->post('no_trx');
			$no_trx2         = $this->input->post('no_trx2');
			$id_pajak        = $this->input->post('id_pajak');
			$sub_total       = str_replace(',', '', $this->input->post('sub_total'));
			$pajak_total     = str_replace(',', '', $this->input->post('pajak_all'));
			$total_all       = str_replace(',', '', $this->input->post('total_all'));
			$sts_lunas       = $this->input->post('sts_lunas');
			$akun_hutang     = $this->input->post('akun_hutang');
			$kode_akun_pajak = $this->input->post('kode_akun_pajak');
			$memo_lunas      = addslashes($this->input->post('memo_lunas'));
			$unit            = $this->input->post('unit');

			if($sts_lunas == 1){
				$akun_hutang = "";
			}


			$this->model->simpan_pembelian($id_klien, $no_trx, $id_pelanggan, $pelanggan, $alamat_tagih, $tgl_trx, $tgl_jatuh_tempo, $id_pajak, $sub_total, $pajak_total, $total_all, $sts_lunas, $memo_lunas, $akun_hutang, $kode_akun_pajak, $unit);
			
			// // KONDISI KE PIUTANG / HUTANG
			// $this->model->simpan_hutang($id_klien, $no_trx, $tgl_trx, $total_all, 'HUTANG');				
			// $this->model->simpan_ke_trx_akuntansi_detail($id_klien, '5-5900', $sub_total, $no_trx);

			// if($pajak_total > 0){
			// 	$no_akun_pajak = $this->model->get_pajak_prosen($id_pajak)->PAJAK_PEMBELIAN;
			// 	$this->model->simpan_ke_trx_akuntansi_detail($id_klien, $no_akun_pajak, $pajak_total, $no_trx);
			// }

			$this->model->save_next_nomor($id_klien, 'Pembelian', $no_trx2);

			$id_penjualan = $this->model->get_id_pembelian($id_klien, $no_trx)->ID;

			$nama_produk 	= $this->input->post('nama_produk');
			$jenis_produk 	= $this->input->post('jenis_produk');
			$id_produk 	    = $this->input->post('produk');
			$qty 	        = $this->input->post('qty');
			$satuan 		= $this->input->post('satuan');
			$harga_satuan 	= $this->input->post('harga_satuan');
			$jumlah 	 	= $this->input->post('jumlah');
			$kode_akun 	 	= $this->input->post('kode_akun');

			foreach ($nama_produk as $key => $val) {
				$this->model->simpan_detail_pembelian($id_penjualan, $id_klien, $val, $qty[$key], $satuan[$key], $harga_satuan[$key], $jumlah[$key], $kode_akun[$key]);
				if($jenis_produk[$key] != "JASA"){
					$this->model->update_stok($id_klien, $id_produk[$key], $qty[$key]);
				}
			}

			$this->master_model_m->simpan_log($id_user, "Melakukan transaksi pembelian dengan nomor transaksi : <b>".$no_trx."</b>");

		}

		$list_akun = $this->model->get_list_akun($id_klien);
		$get_list_akun_all = $this->master_model_m->get_list_akun_all();
		$get_all_produk    = $this->model->get_all_produk($id_klien);
		$get_pel_sup = $this->model->get_pel_sup($id_klien);
		$get_pajak = $this->model->get_pajak($id_klien);
		$no_trx = $this->model->get_no_trx_pembelian($id_klien);

		$data =  array(
			'page' => "new_bon_pemakaian_barang_v", 
			'title' => "Buat Bon Pemakaian Barang", 
			'msg' => "", 
			'master' => "produksi", 
			'view' => "bon_pemakaian_barang", 
			'msg' => $msg, 
			'list_akun' => $list_akun, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_all_produk' => $get_all_produk, 
			'get_pel_sup' => $get_pel_sup, 
			'get_pajak' => $get_pajak, 
			'no_trx' => $no_trx, 
			'post_url' => 'bon_pemakaian_barang_c', 
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
		$get_list_akun_all = $this->master_model_m->get_list_akun_all();
		$get_all_produk    = $this->model->get_all_produk($id_klien);
		$get_pajak = $this->model->get_pajak($id_klien);
		$get_pel_sup = $this->model->get_pel_sup($id_klien);

		if($this->input->post('simpan')){
			$msg = 1;
			$id_pelanggan	 = $this->input->post('pelanggan_sel');
			$pelanggan 	     = $this->input->post('pelanggan');
			$alamat_tagih    = $this->input->post('alamat_tagih');
			$tgl_trx         = $this->input->post('tgl_trx');
			$tgl_jatuh_tempo = "";
			$no_trx          = $this->input->post('no_trx');
			$no_trx2         = $this->input->post('no_trx2');
			$id_pajak        = $this->input->post('id_pajak');
			$sub_total       = str_replace(',', '', $this->input->post('sub_total'));
			$pajak_total     = str_replace(',', '', $this->input->post('pajak_all'));
			$total_all       = str_replace(',', '', $this->input->post('total_all'));
			$sts_lunas       = $this->input->post('sts_lunas');
			$akun_hutang       = $this->input->post('akun_hutang');
			$kode_akun_pajak = $this->input->post('kode_akun_pajak');
			$memo_lunas      = addslashes($this->input->post('memo_lunas'));

			if($sts_lunas == 1){
				$akun_hutang = "";
			}
			$this->model->ubah_penjualan($id, $no_trx, $id_pelanggan, $pelanggan, $alamat_tagih, $tgl_trx, $tgl_jatuh_tempo, $id_pajak, $sub_total, $pajak_total, $total_all, $sts_lunas, $memo_lunas, $akun_hutang, $kode_akun_pajak);
		
			$nama_produk 	= $this->input->post('nama_produk');
			$qty 	        = $this->input->post('qty');
			$satuan 		= $this->input->post('satuan');
			$harga_satuan 	= $this->input->post('harga_satuan');
			$jumlah 	 	= $this->input->post('jumlah');
			$kode_akun 	 	= $this->input->post('kode_akun');

			$this->model->hapus_detail_trx($id);

			foreach ($nama_produk as $key => $val) {
				$this->model->simpan_detail_pembelian($id, $id_klien, $val, $qty[$key], $satuan[$key], $harga_satuan[$key], $jumlah[$key], $kode_akun[$key]);

			}

			$this->master_model_m->simpan_log($id_user, "Mengubah transaksi pembelian dengan nomor transaksi : <b>".$no_trx."</b>");
		}

		$dt = $this->model->get_data_trx($id);
		$dt_detail = $this->model->get_data_trx_detail($id);

		$data =  array(
			'page' => "edit_transaksi_pembelian_v", 
			'title' => "Ubah Belanja Harian", 
			'msg' => "", 
			'master' => "input_data", 
			'view' => "transaksi_pembelian", 
			'msg' => $msg, 
			'dt' => $dt, 
			'dt_detail' => $dt_detail, 
			'list_akun' => $list_akun, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_all_produk' => $get_all_produk, 
			'get_pel_sup' => $get_pel_sup, 
			'get_pajak' => $get_pajak, 
			'post_url' => 'transaksi_pembelian_c/ubah_data/'.$id, 
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
			$id_pelanggan	 = $this->input->post('pelanggan_sel');
			$pelanggan 	     = $this->input->post('pelanggan');
			$alamat_tagih    = $this->input->post('alamat_tagih');
			$tgl_trx         = $this->input->post('tgl_trx');
			$tgl_jatuh_tempo = "";
			$no_trx          = $this->input->post('no_trx');
			$no_trx2         = $this->input->post('no_trx2');
			$id_pajak        = $this->input->post('id_pajak');
			$sub_total       = str_replace(',', '', $this->input->post('sub_total'));
			$pajak_total     = str_replace(',', '', $this->input->post('pajak_all'));
			$total_all       = str_replace(',', '', $this->input->post('total_all'));
			$sts_lunas       = $this->input->post('sts_lunas');
			$akun_hutang       = $this->input->post('akun_hutang');
			$kode_akun_pajak = $this->input->post('kode_akun_pajak');
			$memo_lunas      = addslashes($this->input->post('memo_lunas'));

			if($sts_lunas == 1){
				$akun_hutang = "";
			}
			$this->model->ubah_penjualan($id, $no_trx, $id_pelanggan, $pelanggan, $alamat_tagih, $tgl_trx, $tgl_jatuh_tempo, $id_pajak, $sub_total, $pajak_total, $total_all, $sts_lunas, $memo_lunas, $akun_hutang, $kode_akun_pajak);
		
			$nama_produk 	= $this->input->post('nama_produk');
			$qty 	        = $this->input->post('qty');
			$satuan 		= $this->input->post('satuan');
			$harga_satuan 	= $this->input->post('harga_satuan');
			$jumlah 	 	= $this->input->post('jumlah');

			$this->model->hapus_detail_trx($id);

			foreach ($nama_produk as $key => $val) {
				$this->model->simpan_detail_pembelian($id, $id_klien, $val, $qty[$key], $satuan[$key], $harga_satuan[$key], $jumlah[$key]);

			}
		}

		$dt = $this->model->get_data_trx($id);
		$dt_detail = $this->model->get_data_trx_detail($id);

		$data =  array(
			'page' => "detail_transaksi_pembelian_v", 
			'title' => "Detail Belanja Harian", 
			'msg' => "", 
			'master' => "input_data", 
			'view' => "transaksi_pembelian", 
			'msg' => $msg, 
			'dt' => $dt, 
			'dt_detail' => $dt_detail, 
			'list_akun' => $list_akun, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_all_produk' => $get_all_produk, 
			'get_pel_sup' => $get_pel_sup, 
			'get_pajak' => $get_pajak, 
			'post_url' => 'transaksi_pembelian_c/ubah_data/'.$id, 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function cetak($id=""){


		$data =  array(
			'page' => "cetak_transaksi_pembelian_v", 
		);
		
		$this->load->view('pdf/report_bon_pemakaian_barang_pdf', $data);
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
		$id_user = $sess_user['id'];
		$where = "1=1";

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
		if($keyword != "" || $keyword != null){
			$where = $where." AND (KODE_PRODUK LIKE '%$keyword%' OR NAMA_PRODUK LIKE '%$keyword%')";
		}

		$sql = "
		SELECT * FROM ak_produk WHERE $where AND $where_unit AND APPROVE = 3
		ORDER BY ID DESC
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

	function get_all_spb(){
		$sql = "
		SELECT DISTINCT a.ID, a.TGL_TRX, a.NO_BUKTI, a.MEMO, a.PELANGGAN , a.ID_PELANGGAN FROM ak_pembelian a 
		JOIN ak_pembelian_detail b ON a.ID = b.ID_PENJUALAN
		WHERE a.TIPE = 'PO'
		";

		$dt = $this->db->query($sql)->result();
        echo json_encode($dt);
	}

	function get_more(){
		$id_spb = $this->input->post('id_spb');

		$sql = "
		SELECT b.*, a.NO_BUKTI AS SPB FROM ak_pembelian a
		JOIN ak_pembelian_detail b ON a.ID = b.ID_PENJUALAN
		WHERE b.ID_PENJUALAN = '$id_spb'
		";

		$dt = $this->db->query($sql)->result();
        echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */