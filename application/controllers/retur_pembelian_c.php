<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Retur_pembelian_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('retur_pembelian_m','retur');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	      => 'Retur Pembelian Barang',
				'page'  	      => 'retur_pembelian_v',
				'sub_menu' 	      => 'pembelian',
				'sub_menu1'	      => 'retur pembelian',
				'menu' 	   	      => 'penjualan',
				'menu2'		      => 'retur_pembelian',
				'lihat_data'      => $this->retur->lihat_data_retur(),
				'url_simpan' 	  => base_url().'retur_pembelian_c/simpan',
				'url_hapus'  	  => base_url().'retur_pembelian_c/hapus',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$id_retur 	 = $this->input->post('id_retur');
		if ($id_retur == '') {
			
			$no_retur 	 = $this->input->post('no_retur');
			$tanggal 	 = $this->input->post('tanggal');
			$no_po 		 = $this->input->post('no_po');
			$diterima 	 = $this->input->post('diterima');

			$this->retur->simpan_data_retur($no_retur,$tanggal,$no_po,$diterima);

			$id_retur_baru = $this->db->insert_id();
			$id_produk 	   = $this->input->post('produk');
			$nama_produk   = $this->input->post('nama_produk');
			$keterangan    = $this->input->post('keterangan');
			$kuantitas 	   = $this->input->post('kuantitas');
			$harga 		   = $this->input->post('harga');
			$total 		   = $this->input->post('total');
			$no_opb 	   = $this->input->post('no_opb');

			foreach ($nama_produk as $key => $val) {
				$this->retur->simpan_data_retur_detail($id_retur_baru,$id_produk,$val,$keterangan[$key],$kuantitas[$key],$harga[$key],$total[$key],$no_opb[$key]);
			}
			$this->session->set_flashdata('sukses','1');
			redirect('retur_pembelian_c');
		
		}else{

			$id 		 = $this->input->post('id_retur'); 
			$no_retur 	 = $this->input->post('no_retur');
			$tanggal 	 = $this->input->post('tanggal');
			$no_po 		 = $this->input->post('no_po');
			$diterima 	 = $this->input->post('diterima');

			$this->retur->ubah_data_retur($no_retur,$tanggal,$no_po,$diterima);

			$nama_produk   = $this->input->post('nama_produk');
			$keterangan    = $this->input->post('keterangan');
			$kuantitas 	   = $this->input->post('kuantitas');
			$harga 		   = $this->input->post('harga');
			$total 		   = $this->input->post('total');
			$no_opb 	   = $this->input->post('no_opb');

			foreach ($nama_produk as $key => $val) {
				$this->retur->ubah_data_retur_detail($id,$val,$keterangan[$key],$kuantitas[$key],$harga[$key],$total[$key],$no_opb[$key]);
			}
			$this->session->set_flashdata('sukses','1');
			redirect('retur_pembelian_c');
		}
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->retur->hapus_retur($id);
		$this->session->set_flashdata('hapus','1');
		redirect('retur_pembelian_c');
	}

	function data_retur_id()
	{
		$id = $this->input->post('id');
		$data = $this->retur->data_retur_id($id);
		echo json_encode($data);
	}

	function po_detail_produk()
	{
		$id = $this->input->post('id');

		$sql = "
		SELECT b.*, a.no_po FROM tb_purchase_order a
		JOIN tb_purchase_order_detail b ON a.id_purchase = b.id_induk
		WHERE a.id_purchase = $id
		";

		$dt = $this->db->query($sql)->result();
        echo json_encode($dt);
	}

	function get_po_popup()
	{
		$where = "1=1";

		$keyword = $this->input->post('keyword');
		if ($keyword != "" || $keyword != null) {
			$where = $where."AND (no_po LIKE '%$keyword%' OR nama_produk LIKE '%$keyword%')";
		}

		$sql = "SELECT * FROM tb_purchase_order WHERE $where ORDER BY id_purchase DESC LIMIT 10 ";

		$dt = $this->db->query($sql)->result();
		echo json_encode($dt);
	}

	function get_po_detail()
	{
		$id_purchase = $this->input->get('id_purchase');
		$dt = $this->retur->get_po_detail($id_purchase);

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
		SELECT * FROM tb_permintaan_barang WHERE $where 
		ORDER BY id_permintaan DESC
		LIMIT 10
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_produk_detail(){
		$id_permintaan = $this->input->get('id_permintaan');
		$dt = $this->order->get_produk_detail($id_permintaan);

		echo json_encode($dt);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */