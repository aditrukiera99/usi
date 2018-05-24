<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_logistik_c extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_user = $sess_user['id'];
		if($id_user == "" || $id_user == null){
	        redirect(base_url());
	    }
	    $this->load->model('order_logistik_m','model');
	    $this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
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
			
			$supply_point          	= addslashes($this->input->post('supply_point'));
			$id_supply_point    	= addslashes($this->input->post('id_supply_point'));
			$kode_supply_point    	= addslashes($this->input->post('kode_supply_point'));
			$no_trx   				= addslashes($this->input->post('no_trx'));
			$tgl_trx   				= addslashes($this->input->post('tgl_trx'));
			$keterangan   			= addslashes($this->input->post('memo_lunas'));

			$no_bukti =  $no_trx."/".$kode_supply_point."/".$var."/".$tahun_kas;

			$this->model->simpan_order_logistik($id_supply_point, $supply_point, $tgl_trx, $no_bukti, $keterangan  );



			$id_order = $this->db->insert_id();

			$id_produk    		= $this->input->post('id_produk');
			$nama_produk    	= $this->input->post('nama_produk');
			$qty   				= $this->input->post('qty');
			$memo   			= $this->input->post('memo');

			foreach ($id_produk as $key => $val) {
				$this->model->simpan_order_logistik_detail($val, $nama_produk[$key], $qty[$key], $memo[$key] ,$id_order);
			}

			$this->model->save_next_nomor($id_klien, 'Order_barang', $no_trx);


		} else if($this->input->post('id_hapus')){

			if($user->LEVEL == "USER"){
				$msg = 22;
			} else {
				$msg = 2;
			}
			
			$id   = $this->input->post('id_hapus');
			
			$this->model->hapus_kategori($id);
			

		} else if($this->input->post('edit')){
			if($user->LEVEL == "USER"){
				$msg = 11;
			} else {
				$msg = 1;
			}			


			$id_grup   = $this->input->post('id');

		
			$id_gr         = addslashes($this->input->post('id_gr'));
			$no_polisi         = addslashes($this->input->post('no_polisi'));
			$merk    = addslashes($this->input->post('merk'));
			$tahun    = addslashes($this->input->post('tahun'));
			$no_rangka    = addslashes($this->input->post('no_rangka'));
			$no_mesin    = addslashes($this->input->post('no_mesin'));
			$kapasitas    = addslashes($this->input->post('kapasitas'));
			$sopir    = addslashes($this->input->post('sopir'));

			$this->model->edit_kendaraan($id_gr,$no_polisi,$merk,$tahun,$no_rangka,$no_mesin,$kapasitas,$sopir);

			
		}

		$dt 	= $this->model->get_data_service_kendaraan();
		$no_trx = $this->model->get_no_trx($id_klien);

		$data =  array(
			'page' => "order_logistik_v", 
			'title' => "Order Logistik", 
			'msg' => "", 
			'master' => "logistik", 
			'view' => "logistik_order", 
			'dt' => $dt, 
			'no_trx' => $no_trx, 
			'msg' => $msg, 
			'kode_produk' => $kode_produk, 
			'post_url' => 'order_logistik_c', 
			'user' => $user,
		);
		
		$this->load->view('beranda_v', $data);
	}


	function new_invoice(){
		$keyword = "";
		$msg = "";
		$kode_produk = "";
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		$id_user = $sess_user['id'];
		$user = $this->master_model_m->get_user_info($id_user);
	
		$dt = $this->model->get_data_service_kendaraan();

		$data =  array(
			'page' => "order_logistik_view_v", 
			'title' => "Buat Pembelian Baru", 
			'msg' => "", 
			'master' => "pembelian", 
			'view' => "purchase_order", 
			'msg' => $msg, 
			'dt' => $dt,
			'post_url' => 'order_logistik_c', 
		);
		
		$this->load->view('beranda_v', $data);
	}

	function get_supplier_detail(){
		$id_pel = $this->input->get('id_pel');
		$dt = $this->model->get_supplier_detail($id_pel);

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
		SELECT * FROM ak_gudang
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function cetak($id=""){

		$dt = $this->model->get_data_trx($id);
		$dt_det = $this->model->get_data_trx_detail($id);

		$data =  array(
			'page' => "order_logistik_c", 
			'dt' => $dt,
			'dt_det' => $dt_det,
		);
		
		$this->load->view('pdf/report_order_logistik_pdf', $data);
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

	function cari_kat(){
		$sess_user = $this->session->userdata('masuk_akuntansi');
		$id_klien = $sess_user['id_klien'];
		
		$keyword = $this->input->get('keyword');
		$dt = $this->model->get_data_kategori($keyword, $id_klien);

		echo json_encode($dt);
	}

	function cari_kendaraan_by_id(){
		$id = $this->input->get('id');
		$dt = $this->model->cari_kendaraan_by_id($id);

		echo json_encode($dt);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */