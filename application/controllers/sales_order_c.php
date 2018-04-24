<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales_order_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('sales_order_m','sales');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	            => 'Sales Order',
				'page'  	            => 'sales_order_v',
				'sub_menu' 	            => 'penjualan',
				'sub_menu1'	            => 'sales order',
				'menu' 	   	            => 'penjualan',
				'menu2'		            => 'sales_order',
				'lihat_data'            => $this->sales->lihat_data_sales(),
				'lihat_kode_akuntansi'  => $this->sales->lihat_kode_akuntansi(),
				'url_simpan' 	        => base_url().'sales_order_c/simpan',
				'url_hapus'  	        => base_url().'sales_order_c/hapus',
				'url_ubah'	 	        => base_url().'sales_order_c/ubah_sales',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$id_sales 			= $this->input->post('id_sales');
		if ($id_sales == '') {
			
			$pelanggan 	 	 	= $this->input->post('pelanggan');
			$divisi 	  		= $this->input->post('divisi');
			$alamat_penagihan 	= $this->input->post('alamat_penagihan');
			$tanggal_transaksi  = $this->input->post('tanggal_transaksi');
			$no_transaksi   	= $this->input->post('no_transaksi');
			$uraian    			= $this->input->post('uraian');

			$this->sales->simpan_data_sales($pelanggan,$divisi,$alamat_penagihan,$tanggal_transaksi,$no_transaksi,$uraian);

			$id_sales_baru 		= $this->db->insert_id();
			$id_produk 			= $this->input->post('id_produk');
			$id_akun 			= $this->input->post('id_akun');
			$kode_akun 	  		= $this->input->post('kode_akun');
			$nama_produk 	  	= $this->input->post('nama_produk');
			$kuantitas 	  		= $this->input->post('kuantitas');
			$satuan 	  		= $this->input->post('satuan');
			$harga 		  		= $this->input->post('harga');
			$tax 	  			= $this->input->post('tax');
			$jumlah 	  		= $this->input->post('jumlah');

			foreach ($kode_akun as $key => $val) {
				$this->sales->simpan_data_sales_detail($id_sales_baru,$id_produk,$id_akun,$val,$nama_produk[$key],$kuantitas[$key],$satuan[$key],$harga[$key],$tax[$key],$jumlah[$key]); 
			}
			$this->session->set_flashdata('sukses','1');
			redirect('sales_order_c');
		
		}else{

			$id 				= $this->input->post('id_sales');
			$pelanggan 	 	 	= $this->input->post('pelanggan');
			$divisi 	  		= $this->input->post('divisi');
			$alamat_penagihan 	= $this->input->post('alamat_penagihan');
			$tanggal_transaksi  = $this->input->post('tanggal_transaksi');
			$no_transaksi   	= $this->input->post('no_transaksi');
			$uraian    			= $this->input->post('uraian');

			$this->sales->ubah_data_sales($id,$pelanggan,$divisi,$alamat_penagihan,$tanggal_transaksi,$no_transaksi,$uraian);

			$kode_akun 	  		= $this->input->post('kode_akun');
			$nama_produk 	  	= $this->input->post('nama_produk');
			$kuantitas 	  		= $this->input->post('kuantitas');
			$satuan 	  		= $this->input->post('satuan');
			$harga 		  		= $this->input->post('harga');
			$tax 	  			= $this->input->post('tax');
			$jumlah 	  		= $this->input->post('jumlah');

			foreach ($kode_akun as $key => $val) {
				$this->sales->ubah_data_sales_detail($id,$val,$nama_produk[$key],$kuantitas[$key],$satuan[$key],$harga[$key],$tax[$key],$jumlah[$key]); 
			}

			$this->session->set_flashdata('sukses','1');
			redirect('sales_order_c');
		}
		
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->sales->hapus_sales($id);
		$this->session->set_flashdata('hapus','1');
		redirect('sales_order_c');
	}

	function data_sales_id()
	{
		$id = $this->input->post('id');
		$data = $this->sales->data_sales_id($id);
		echo json_encode($data);
	}

	function data_sales_detail_id()
	{
		$id = $this->input->post('id');
		$data = $this->sales->data_sales_detail_id($id);
		echo json_encode($data);
	}


	function get_pelanggan_popup()
	{
		$where = "1=1";

		$keyword = $this->input->post('keyword');
		if($keyword != "" || $keyword != null){
			$where = $where." AND (nama_pelanggan LIKE '%$keyword%' OR alamat_pelanggan LIKE '%$keyword%')";
		}

		$sql = "
		SELECT * FROM master_pelanggan WHERE $where 
		ORDER BY id_pelanggan DESC
		LIMIT 10
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_pelanggan_detail(){
		$id_pelanggan = $this->input->get('id_pelanggan');
		$dt = $this->sales->get_pelanggan_detail($id_pelanggan);

		echo json_encode($dt);
	}

	function get_produk_popup()
	{
		$where = "1=1";

		$keyword = $this->input->post('keyword');
		if($keyword != "" || $keyword != null){
			$where = $where." AND (kode_barang LIKE '%$keyword%' OR nama_barang LIKE '%$keyword%')";
		}

		$sql = "
		SELECT * FROM master_barang WHERE $where 
		ORDER BY id_barang DESC
		LIMIT 10
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_produk_detail(){
		$id_barang = $this->input->get('id_barang');
		$dt = $this->sales->get_produk_detail($id_barang);

		echo json_encode($dt);
	}

	public function get_kode_akuntansi()
	{
		$kode = $this->input->post('kode');
		$sql = "select * from ak_kode_akuntansi where ID = $kode";
		$data = $this->db->query($sql)->row();

		echo json_encode($data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */