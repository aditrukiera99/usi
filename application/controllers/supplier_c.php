<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('supplier_m','supplier');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	 => 'Master Supplier',
				'page'  	 => 'supplier_v',
				'sub_menu' 	 => 'master data',
				'sub_menu1'	 => 'master supplier',
				'menu' 	   	 => 'master_data',
				'menu2'		 => 'master supplier',
				'lihat_data' => $this->supplier->lihat_data_supplier(),
				'url_simpan' => base_url().'supplier_c/simpan',
				'url_hapus'  => base_url().'supplier_c/hapus',
				'url_ubah'	 => base_url().'supplier_c/ubah_supplier',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$kode_supplier 	 = $this->input->post('kode_supplier');
		$nama_supplier 	 = $this->input->post('nama_supplier');
		$alamat_supplier = $this->input->post('alamat_supplier');
		$telp 			 = $this->input->post('telp');
		$email			 = $this->input->post('email');
		$npwp 			 = $this->input->post('npwp');

		$this->supplier->simpan_data_supplier($kode_supplier,$nama_supplier,$alamat_supplier,$telp,$email,$npwp);
		$this->session->set_flashdata('sukses','1');
		redirect('supplier_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->supplier->hapus_supplier($id);
		$this->session->set_flashdata('hapus','1');
		redirect('supplier_c');
	}

	function data_supplier_id()
	{
		$id = $this->input->post('id');
		$data = $this->supplier->data_supplier_id($id);
		echo json_encode($data);
	}

	function ubah_supplier()
	{
		$id 					= $this->input->post('id_supplier_modal');
		$kode_supplier_modal  	= $this->input->post('kode_supplier_modal');
		$nama_supplier_modal 	= $this->input->post('nama_supplier_modal');
		$alamat_supplier_modal  = $this->input->post('alamat_supplier_modal');
		$telp_modal  			= $this->input->post('telp_modal');
		$email_modal 			= $this->input->post('email_modal');
		$npwp_modal 			= $this->input->post('npwp_modal');
		
		$this->supplier->ubah_data_supplier($id,$kode_supplier_modal,$nama_supplier_modal,$alamat_supplier_modal,$telp_modal,$email_modal,$npwp_modal);
		$this->session->set_flashdata('sukses','1');
		redirect('supplier_c');	
		// echo "1";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */