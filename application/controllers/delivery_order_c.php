<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Delivery_order_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('delivery_order_m','model');
	    $this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
	}

	function index()
	{
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);

		$msg = "";
		$tgl_full = "";

		if($this->input->post('edit')){
			$msg = 1;
			$tgl      = $this->input->post('tgl');
			$id_lapor = $this->input->post('id_lapor');
			$this->db->query("UPDATE ak_penjualan_new SET TGL_DO = '$tgl' WHERE ID = '$id_lapor' ");
		}

		$dt = $this->model->get_penjualan_all();
		if($this->input->post('cari')){
			$tgl_full = $this->input->post('tgl');
			$tgl = explode(' sampai ', $tgl_full);
			$tgl_awal = $tgl[0];
			$tgl_akhir = $tgl[1];

			$dt = $this->model->get_penjualan_filter($id_klien, $tgl_awal, $tgl_akhir);
		
		}

		


		$data =  array(
			'page' => "delivery_order_v", 
			'title' => "Delivery Order",  
			'master' => "penjualan", 
			'view' => "delivery_order", 
			'dt' => $dt, 
			'msg' => $msg, 
			'tgl_full' => $tgl_full, 
			'post_url' => 'delivery_order_c', 
		);
		
		if($user->LEVEL == "ADMIN"){
		$this->load->view('beranda_super_v', $data);
		} else {
		$this->load->view('beranda_v', $data);			
		}
	}


	function cetak($id=""){

		$dt = $this->model->get_data_trx($id);
		$dt_det = $this->model->get_data_trx_detail($id);

		$data =  array(
			'page' => "transaksi_penjualan_c", 
			'dt' => $dt,
			'dt_det' => $dt_det,
		);
		
		$this->load->view('pdf/report_delivery_order_pdf', $data);
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