<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bukti_kas_masuk_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('bukti_kas_masuk_m','model');
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

			$from_trx 			 = $this->input->post('from_trx');
			$no_trx    		     = $this->input->post('no_trx');
			$no_trx2    		 = $this->input->post('no_trx2');
			$tgl_trx 			 = $this->input->post('tgl_trx');
			$no_reff    		 = $this->input->post('no_reff');
			$pelanggan  		 = $this->input->post('pelanggan');
			$id_pelanggan        = $this->input->post('id_pelanggan');
			$memo                = $this->input->post('memo');
			$kode_akun_kasbank   = $this->input->post('kode_akun_kasbank');

			$is_lunas = 1;

			$data = array(
				'NO_VOUCHER'   => addslashes($this->input->post('no_trx')),
				'NO_BUKTI'     => addslashes($this->input->post('no_reff')),
				'KODE_AKUN'    => addslashes($this->input->post('kode_akun_kasbank')),
				'TGL'          => addslashes($this->input->post('tgl_trx')),
				'URAIAN'       => addslashes($this->input->post('memo')),
				'ID_KONTAK'    => addslashes($this->input->post('id_pelanggan')),
				'KONTAK'       => addslashes($this->input->post('pelanggan')),
				'TIPE'         => 'BKM',
				'IS_LUNAS'     => $is_lunas
		    );

		    $this->db->insert('ak_input_voucher',$data);
			$this->model->save_next_nomor($id_klien, 'BKM', $no_trx2);

			$kode_akun 	= $this->input->post('kode_akun');
			$ket 	    = $this->input->post('ket');
			$nilai      = $this->input->post('nilai');			

			$nilai_total = 0;
			foreach ($kode_akun as $key => $val) {
				$nilai_total += str_replace(',', '', $nilai[$key]);
				$this->model->simpan_detail_penjualan($no_trx, $no_reff, $val, $ket[$key], $nilai[$key]);
			}
				$this->model->simpan_detail_penjualan_kasbank($no_trx, $no_reff, $kode_akun_kasbank, '',  $nilai_total, 0);
				$this->model->update_nilai_voucher($no_trx, $nilai_total);

			$this->master_model_m->simpan_log($id_user, "Melakukan input bukti kas masuk dengan nomor : <b>".$no_trx."</b>");

		}

		if($this->input->post('edit')){
			$msg = 1;

			$no_trx    		     = $this->input->post('no_trx');
			$tgl_trx 			 = $this->input->post('tgl_trx');
			$memo                = $this->input->post('memo');
			$kode_akun_kasbank   = $this->input->post('kode_akun_kasbank');

			$data = array(
				'TGL'          => $this->input->post('tgl_trx'),
				'URAIAN'       => $this->input->post('memo'),
				'KODE_AKUN'    => $this->input->post('kode_akun_kasbank')
		    );

		    $this->db->where('NO_VOUCHER', $no_trx);
    		$this->db->update('ak_input_voucher', $data);

    		$this->db->where('NO_VOUCHER_DETAIL', $no_trx);
   			$this->db->delete('ak_input_voucher_detail');  

			$kode_akun 	= $this->input->post('kode_akun');
			$ket 	    = $this->input->post('ket');
			$nilai      = $this->input->post('nilai');				

			$nilai_total = 0;
			foreach ($kode_akun as $key => $val) {
				$nilai_total += str_replace(',', '', $nilai[$key]);
				$this->model->simpan_detail_penjualan($no_trx, $no_reff, $val, $ket[$key], $nilai[$key]);
			}
				$this->model->simpan_detail_penjualan_kasbank($no_trx, $no_reff, $kode_akun_kasbank, '',  $nilai_total, 0);
				$this->model->update_nilai_voucher($no_trx, $nilai_total);

			$this->master_model_m->simpan_log($id_user, "Melakukan ubah bukti kas masuk dengan nomor : <b>".$no_trx."</b>");

		}

		if($this->input->post('cari')){
			$tgl_full = $this->input->post('tgl');
			$tgl = explode(' sampai ', $tgl_full);
			$tgl_awal = $tgl[0];
			$tgl_akhir = $tgl[1];

			$dt = $this->model->get_penjualan_filter($keyword, $id_klien, $tgl_awal, $tgl_akhir);
		
		} 

		if($this->input->post('id_hapus')){
			$msg = 2;

			$id_hapus = $this->input->post('id_hapus');
			$this->model->hapus_trx_penjualan($id_hapus);
			$this->model->hapus_detail_trx($id_hapus);
			$this->master_model_m->simpan_log($id_user, "Menghapus Bukti Kas Masuk dengan nomor bukti : <b>".$id_hapus."</b>");
		}

		$get_list_akun_all = $this->master_model_m->get_list_akun_all();
		$dt = $this->model->get_penjualan($keyword, $id_klien);
		
		$data =  array(
			'page' => "bukti_kas_masuk_v", 
			'title' => "Bukti Kas Masuk",  
			'master' => "input_akuntansi", 
			'view' => "bkm", 
			'dt' => $dt, 
			'msg' => $msg, 
			'tgl_full' => $tgl_full, 
			'kode_produk' => $kode_produk, 
			'get_list_akun_all' => $get_list_akun_all, 
			'post_url' => 'bukti_kas_masuk_c', 
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
		$user = $this->master_model_m->get_user_info($id_user);

		

		$list_akun = $this->model->get_list_akun($id_klien);
		$get_list_akun_all = $this->model->get_list_akun_all($id_klien);
		$get_list_akun_bank = $this->master_model_m->get_list_akun_bank();
		$get_all_produk    = $this->model->get_all_produk($id_klien);
		$get_pel_sup = $this->model->get_pel_sup($id_klien);
		$get_pajak = $this->model->get_pajak($id_klien);
		$no_trx = $this->model->get_no_trx_penjualan($id_klien);
		$get_broker = $this->model->get_broker();

		$data =  array(
			'page' => "add_bukti_kas_masuk_v", 
			'title' => "Buat Bukti Kas Masuk", 
			'msg' => "", 
			'master' => "input_akuntansi", 
			'view' => "bkm", 
			'msg' => $msg, 
			'list_akun' => $list_akun, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_list_akun_bank' => $get_list_akun_bank, 
			'get_all_produk' => $get_all_produk, 
			'get_pel_sup' => $get_pel_sup, 
			'get_pajak' => $get_pajak, 
			'no_trx' => $no_trx, 
			'get_broker' => $get_broker, 
			'post_url' => 'bukti_kas_masuk_c', 
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
		$get_list_akun_bank = $this->master_model_m->get_list_akun_bank();
		$get_all_produk    = $this->model->get_all_produk($id_klien);
		$get_pel_sup = $this->model->get_pel_sup($id_klien);
		$get_pajak = $this->model->get_pajak($id_klien);
		$no_trx = $this->model->get_no_trx_penjualan($id_klien);
		$get_broker = $this->model->get_broker();

		$dt = $this->model->get_data_trx_edit($id);
		$dt_detail = $this->model->get_data_trx_detail_edit($id);

		$data =  array(
			'page' => "edit_bukti_kas_masuk_v", 
			'title' => "Edit Bukti Kas Masuk", 
			'msg' => "", 
			'master' => "input_akuntansi", 
			'view' => "bkm", 
			'msg' => $msg, 
			'list_akun' => $list_akun, 
			'get_list_akun_all' => $get_list_akun_all, 
			'get_list_akun_bank' => $get_list_akun_bank, 
			'get_all_produk' => $get_all_produk, 
			'get_pel_sup' => $get_pel_sup, 
			'get_pajak' => $get_pajak, 
			'no_trx' => $no_trx, 
			'get_broker' => $get_broker, 
			'dt' => $dt,
			'dt_detail' => $dt_detail,
			'post_url' => 'bukti_kas_masuk_c', 
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

	function get_PO(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$where = "1=1";

		$keyword = $this->input->post('keyword');
		if($keyword != "" || $keyword != null){
			$where = $where." AND (NO_PO LIKE '%$keyword%' OR PELANGGAN LIKE '%$keyword%')";
		}

		$sql = "
		SELECT * FROM ak_penjualan WHERE NO_BUKTI NOT IN (SELECT NO_BUKTI FROM ak_input_voucher WHERE TIPE = 'BKM' ) AND $where
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_PO_detail(){
		$id = $this->input->get('id');
		$dt = $this->model->get_PO_detail($id);

		echo json_encode($dt);
	}

	function get_PO_detail2(){
		$id = $this->input->post('id');
		$dt = $this->model->get_PO_detail2($id);

		echo json_encode($dt);
	}


	function cetak($id=""){

		$dt = $this->model->get_data_trx($id);
		$dt_det = $this->model->get_data_trx_detail($id);

		$data =  array(
			'page' => "bukti_kas_masuk_c", 
			'dt' => $dt,
			'dt_det' => $dt_det,
		);
		
		$this->load->view('pdf/cetak_bukti_kas_masuk_pdf', $data);
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