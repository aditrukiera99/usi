<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_pembelian_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('order_pembelian_m','order');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }

        $this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
	}

	public function index()
	{
		$data = array(
				'title' 	      => 'Order Pembelian Barang',
				'page'  	      => 'order_pembelian_v',
				'sub_menu' 	      => 'pembelian',
				'sub_menu1'	      => 'order Pembelian',
				'menu' 	   	      => 'penjualan',
				'menu2'		      => 'order_pembelian',
				'lihat_data'      => $this->order->lihat_data_order(),
				'lihat_barang'    => $this->order->lihat_data_barang(),
				'dt_dept'   	  => $this->order->lihat_data_divisi(),
				'url_simpan' 	  => base_url().'order_pembelian_c/simpan',
				'url_hapus'  	  => base_url().'order_pembelian_c/hapus',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{

		$bulan_kas = date("m",strtotime($this->input->post('tanggal')));

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

		$id_pengembalian     = $this->input->post('id_pengembalian');
		if ($id_pengembalian == '') {

			$sess_user = $this->session->userdata('sign_in');
			$nama = $sess_user['nama_user'];
			$departemen = $sess_user['departemen'];

			$dept_row = $this->db->query("SELECT * FROM master_divisi WHERE id_divisi = '$departemen'")->row();
			
			
			$tahun_kas = date("Y",strtotime($this->input->post('tanggal')));
			
			$get_nomor	   = $this->master_model_m->get_nomor_dokumen('ORDER_PEMBELIAN_BARANG');

			$no_bukti_real = $get_nomor."/OPB/".$dept_row->nama_divisi."/".$var."/".$tahun_kas;
			$tanggal 	  = $this->input->post('tanggal');
			$uraian 	  = $this->input->post('uraian');

			$this->master_model_m->update_nomor('ORDER_PEMBELIAN_BARANG');
			$this->order->simpan_data_order($no_bukti_real,$tanggal,$uraian,$departemen);
			

			$id_pengembalian_baru = $this->db->insert_id();
			$nama_produk 	    = $this->input->post('nama_produk');
			$produk    			= $this->input->post('produk');
			
			$kuantitas      	= $this->input->post('kuantitas');
			$satuan 	    	= $this->input->post('satuan');
			$reff_no 		    = $this->input->post('reff_no');
			$id_peminjaman_detail 		    = $this->input->post('id_peminjaman_detail');

			foreach ($nama_produk as $key => $val) {
					 $this->order->simpan_data_order_detail($id_pengembalian_baru,$produk[$key],$val,$uraian,$kuantitas[$key],$satuan[$key],$reff_no[$key]);
			}

			foreach ($id_peminjaman_detail as $keyi => $vali) {
				$this->order->update_selisih_detail($vali,$kuantitas[$keyi]);
			}
			$this->session->set_flashdata('sukses','1');
			redirect('pengembalian_barang_c');
		
		}else{

			$sess_user = $this->session->userdata('sign_in');
			$nama = $sess_user['nama_user'];
			$departemen = $sess_user['departemen'];

			$dept_row = $this->db->query("SELECT * FROM master_divisi WHERE id_divisi = '$departemen'")->row();
			
			
			$tahun_kas = date("Y",strtotime($this->input->post('tanggal')));
			
			$sql_buk = "SELECT NEXT_NOMOR FROM ak_nomor WHERE TIPE = 'ORDER_PEMBELIAN_BARANG'";

	        $row_buk = $this->db->query($sql_buk)->row();

			$no_buk = $row_buk->NEXT_NOMOR + 1;

			$no_bukti_real = $no_buk."/OPB/".$dept_row->nama_divisi."/".$var."/".$tahun_kas;
			$tanggal 	  = $this->input->post('tanggal');
			$uraian 	  = $this->input->post('uraian');

			$this->pengembalian->save_next_nomor('ORDER_PEMBELIAN_BARANG');
			$this->pengembalian->simpan_data_barang($no_bukti_real,$tanggal,$uraian,$nama,$departemen);
			

			$id_pengembalian_baru = $this->db->insert_id();
			$nama_produk 	    = $this->input->post('nama_produk');
			$produk    			= $this->input->post('produk');
			$keterangan     	= $this->input->post('keterangan');
			$kuantitas      	= $this->input->post('kuantitas');
			$satuan 	    	= $this->input->post('satuan');
			$reff_no 		    = $this->input->post('reff_no');
			$id_peminjaman_detail 		    = $this->input->post('id_peminjaman_detail');

			foreach ($nama_produk as $key => $val) {
					 $this->pengembalian->simpan_data_barang_detail($id_pengembalian_baru,$produk[$key],$val,$keterangan[$key],$kuantitas[$key],$satuan[$key],$reff_no[$key]);
			}

			foreach ($id_peminjaman_detail as $keyi => $vali) {
				$this->pengembalian->update_selisih_detail($vali,$kuantitas[$keyi]);
			}
			$this->session->set_flashdata('sukses','1');
			redirect('pengembalian_barang_c');
		}
	}


	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->order->hapus_order($id);
		$this->session->set_flashdata('hapus','1');
		redirect('order_pembelian_c');
	}

	function data_order_id()
	{
		$id = $this->input->post('id');
		$data = $this->order->data_order_id($id);
		echo json_encode($data);
	}

	function data_order_detail_id()
	{
		$id = $this->input->post('id');
		$data = $this->order->data_order_detail_id($id);
		echo json_encode($data);
	}

	function get_produk_popup()
	{
		$where = "1=1";

		$keyword = $this->input->post('keyword');
		if($keyword != "" || $keyword != null){
			$where = $where." AND (nama_produk LIKE '%$keyword%' OR id_produk LIKE '%$keyword%')";
		}

		$sql = "
		SELECT * FROM tb_permintaan_barang_detail WHERE $where 
		ORDER BY id DESC
		LIMIT 10
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_produk_detail(){
		$id_induk = $this->input->get('id_induk');
		$dt = $this->order->get_produk_detail($id_induk);

		echo json_encode($dt);
	}

	function get_transaction_info(){
		$id = $this->input->post('id');
		$dt = $this->order->get_transaction_info($id);

		echo json_encode($dt);
	}

	function get_spb_popup()
	{
		$where = "1=1";

		$keyword = $this->input->post('keyword');
		if($keyword != "" || $keyword != null){
			$where = $where." AND (no_spb LIKE '%$keyword%' OR nama_produk LIKE '%$keyword%')";
		}

		$sql = "
		SELECT * FROM tb_permintaan_barang WHERE $where 
		ORDER BY id_permintaan DESC
		LIMIT 10
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_spb_detail()
	{
		$id = $this->input->post('id');

		$sql = "
		SELECT b.*, a.no_spb FROM tb_permintaan_barang a
		JOIN tb_permintaan_barang_detail b ON a.id_permintaan = b.id_induk
		WHERE a.id_permintaan = $id
		";

		$dt = $this->db->query($sql)->result();
        echo json_encode($dt);
	}

	function get_order_detail(){
		$id_induk = $this->input->get('id_induk');
		$dt = $this->order->get_order_detail($id_induk);

		echo json_encode($dt);
	}

	function cetak($id=""){

		$dt = $this->order->get_data_trx($id);
		$dt_det = $this->order->get_data_trx_detail($id);


		$data =  array(
			'page' => "order_pembelian_c", 
			'dt' => $dt,
			'dt_det' => $dt_det,
		);
		
		$this->load->view('pdf/report_order_pembelian_barang_pdf', $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */