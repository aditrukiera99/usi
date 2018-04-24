<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('invoice_m','invoice');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	      => 'Invoice',
				'page'  	      => 'invoice_v',
				'sub_menu' 	      => 'penjualan',
				'sub_menu1'	      => 'invoice',
				'menu' 	   	      => 'penjualan',
				'menu2'		      => 'invoice',
				'lihat_data'      => $this->invoice->lihat_data_invoice(),
				'url_simpan' 	  => base_url().'invoice_c/simpan',
				'url_hapus'  	  => base_url().'invoice_c/hapus',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$id_invoice 	= $this->input->post('id_invoice');
		if ($id_invoice == '') {
			
			$no_invoice 	= $this->input->post('no_invoice');
			$tanggal 		= $this->input->post('tanggal');
			$sales_order 	= $this->input->post('sales_order');

			$this->invoice->simpan_data_invoice($no_invoice,$tanggal,$sales_order);

			$id_invoice_baru 	= $this->db->insert_id();
			$id_produk 			= $this->input->post('id_produk');
			$nama_produk 		= $this->input->post('nama_produk');
			$keterangan 		= $this->input->post('keterangan');
			$kuantitas  		= $this->input->post('kuantitas');
			$harga 				= $this->input->post('harga');
			$total 				= $this->input->post('total');

			foreach ($nama_produk as $key => $val) {
				$this->invoice->simpan_data_invoice_detail($id_invoice_baru,$id_produk,$val,$keterangan[$key],$kuantitas[$key],										  $harga[$key],$total[$key]);
			}
			$this->session->set_flashdata('sukses','1');
			redirect('invoice_c');
		
		}else{

			$id 			= $this->input->post('id_invoice');
			$no_invoice 	= $this->input->post('no_invoice');
			$tanggal 		= $this->input->post('tanggal');
			$sales_order 	= $this->input->post('sales_order');

			$this->invoice->ubah_data_invoice($id,$no_invoice,$tanggal,$sales_order);

			$nama_produk 	= $this->input->post('nama_produk');
			$keterangan 	= $this->input->post('keterangan');
			$kuantitas  	= $this->input->post('kuantitas');
			$harga 			= $this->input->post('harga');
			$total 			= $this->input->post('total');

			foreach ($nama_produk as $key => $val) {
				$this->invoice->ubah_data_invoice_detail($id,$val,$keterangan[$key],$kuantitas[$key],															  $harga[$key],$total[$key]);
			}
			$this->session->set_flashdata('sukses','1');
			redirect('invoice_c');
		}
		
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->invoice->hapus_invoice($id);
		$this->session->set_flashdata('hapus','1');
		redirect('invoice_c');
	}

	function data_invoice_id()
	{
		$id = $this->input->post('id');
		$data = $this->invoice->data_invoice_id($id);
		echo json_encode($data);
	}

	function data_invoice_detail_id()
	{
		$id = $this->input->post('id');
		$data = $this->invoice->data_invoice_detail_id($id);
		echo json_encode($data);
	}

	function get_sales_popup()
	{
		$where = "1=1";

		$keyword = $this->input->post('keyword');
		if ($keyword != "" || $keyword != null) {
			$where = $where."AND (no_spb LIKE '%$keyword%' OR uraian LIKE '%$keyword%')";
		}

		$sql = "SELECT * FROM tb_permintaan_barang WHERE $where ORDER BY id_permintaan DESC LIMIT 10 ";

		$dt = $this->db->query($sql)->result();
		echo json_encode($dt);
	}

	function get_sales_detail()
	{
		$id_sales = $this->input->get('id_sales');
		$dt = $this->invoice->get_sales_detail($id_sales);

		echo json_encode($dt);
	}

	function get_produk_popup()
	{
		$where = "1=1";

		$keyword = $this->input->post('keyword');
		if ($keyword != "" || $keyword != null) {
			$where = $where."AND (kode_barang LIKE '%$keyword%' OR nama_barang LIKE '%$keyword%')";
		}

		$sql = "SELECT * FROM master_barang WHERE $where ORDER BY id_barang DESC LIMIT 10 ";

		$dt = $this->db->query($sql)->result();
		echo json_encode($dt);
	}

	function get_produk_detail()
	{
		$id_barang = $this->input->get('id_barang');
		$dt = $this->invoice->get_produk_detail($id_barang);

		echo json_encode($dt);
	}

	function get_opb_popup()
	{
		$where = "1=1";

		$keyword = $this->input->post('keyword');
		if ($keyword != "" || $keyword != null) {
			$where = $where."AND (no_spb LIKE '%$keyword%' OR uraian LIKE '%$keyword%')";
		}

		$sql = "SELECT * FROM tb_permintaan_barang WHERE $where ORDER BY id_permintaan DESC LIMIT 10 ";

		$dt = $this->db->query($sql)->result();
		echo json_encode($dt);
	}

	function get_opb_detail()
	{
		$id_permintaan = $this->input->get('id_permintaan');
		$dt = $this->invoice->get_opb_detail($id_permintaan);

		echo json_encode($dt);
	}

	function produk_opb_detail()
	{
		$id = $this->input->post('id');

		$sql = "
		SELECT b.*, a.no_opb FROM tb_order_pembelian a
		JOIN tb_order_pembelian_detail b ON a.id_order = b.id_induk
		WHERE a.id_order = $id
		";

		$dt = $this->db->query($sql)->result();
        echo json_encode($dt);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */