<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Barang_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('barang_m','barang');
		$this->load->helper(array('form', 'url'));
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	      => 'Master Barang',
				'page'  	      => 'barang_v',
				'sub_menu' 	      => 'master data',
				'sub_menu1'	      => 'master barang',
				'menu' 	   	      => 'master_data',
				'menu2'		      => 'master barang',
				'lihat_data'      => $this->barang->lihat_data_barang(),
				'lihat_satuan'    => $this->barang->lihat_data_satuan(),
				'lihat_supplier'  => $this->barang->lihat_data_supplier(),
				'lihat_kategori'  => $this->barang->lihat_data_kategori(),
				'url_simpan' 	  => base_url().'barang_c/simpan',
				'url_hapus'  	  => base_url().'barang_c/hapus',
				'url_ubah'	 	  => base_url().'barang_c/ubah_barang',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$kode_barang 	= $this->input->post('kode_barang');
		$nama_barang 	= $this->input->post('nama_barang');
		$id_satuan   	= $this->input->post('id_satuan');
		$nama_satuan 	= $this->input->post('nama_satuan');
		$harga_jual  	= str_replace(',', '', $this->input->post('harga_jual'));
		$harga_beli  	= str_replace(',', '', $this->input->post('harga_beli'));
		$id_supplier 	= $this->input->post('id_supplier');
		$nama_supplier  = $this->input->post('nama_supplier');
		$id_kategori 	= $this->input->post('id_kategori');
		$nama_kategori  = $this->input->post('nama_kategori');

		  $config['upload_path'] = './assets/';
	      $config['allowed_types'] = 'gif|jpg|png';
	      $config['max_size'] = '500';
	      // $config['max_width'] = '1024';
	      // $config['max_height'] = '768';
	      $this->load->library('upload', $config);

	      if (!$this->upload->do_upload('userfiles')) {
	        $data = array('upload_data' => $this->upload->data());
	        $src_image = $_FILES['userfiles']['name'];
	      }else{
	      	$src_image = 'Kosong';
	      }

		$this->barang->simpan_data_barang($kode_barang,$nama_barang,$id_satuan,$nama_satuan,$harga_jual,$harga_beli,$id_supplier,$nama_supplier,								  $id_kategori,$nama_kategori,$src_image);
		$this->session->set_flashdata('sukses','1');
		redirect('barang_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->barang->hapus_barang($id);
		$this->session->set_flashdata('hapus','1');
		redirect('barang_c');
	}

	function data_barang_id()
	{
		$id = $this->input->post('id');
		$data = $this->barang->data_barang_id($id);
		echo json_encode($data);
	}

	function ubah_barang()
	{
		$id 				  = $this->input->post('id_barang_modal');
		$kode_barang_modal    = $this->input->post('kode_barang_modal');
		$nama_barang_modal    = $this->input->post('nama_barang_modal');
		$id_satuan_modal   	  = $this->input->post('id_satuan_modal');
		$nama_satuan_modal 	  = $this->input->post('nama_satuan_modal');
		$harga_jual_modal  	  = str_replace(',', '', $this->input->post('harga_jual_modal'));
		$harga_beli_modal  	  = str_replace(',', '', $this->input->post('harga_beli_modal'));
		$id_supplier_modal 	  = $this->input->post('id_supplier_modal');
		$nama_supplier_modal  = $this->input->post('nama_supplier_modal');
		$id_kategori_modal 	  = $this->input->post('id_kategori_modal');
		$nama_kategori_modal  = $this->input->post('nama_kategori_modal');
		
		$this->barang->ubah_data_barang($id,$kode_barang_modal,$nama_barang_modal,$id_satuan_modal,$nama_satuan_modal,$harga_jual_modal,
										$harga_beli_modal,$id_supplier_modal,$nama_supplier_modal,$id_kategori_modal,$nama_kategori_modal);
		$this->session->set_flashdata('sukses','1');
		redirect('barang_c');	
		// echo "1";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */