<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_barang_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kategori_barang_m','kategori');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	 => 'Master Kategori',
				'page'  	 => 'kategori_barang_v',
				'sub_menu' 	 => 'master data',
				'sub_menu1'	 => 'master kategori',
				'menu' 	   	 => 'master_data',
				'menu2'		 => 'master kategori',
				'lihat_data' => $this->kategori->lihat_data_kategori(),
				'url_simpan' => base_url().'kategori_barang_c/simpan',
				'url_hapus'  => base_url().'kategori_barang_c/hapus',
				'url_ubah'	 => base_url().'kategori_barang_c/ubah_divisi',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$kode_kategori = $this->input->post('kode_kategori');
		$nama_kategori = $this->input->post('nama_kategori');

		$this->kategori->simpan_data_kategori($kode_kategori,$nama_kategori);
		$this->session->set_flashdata('sukses','1');
		redirect('kategori_barang_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->kategori->hapus_kategori($id);
		$this->session->set_flashdata('hapus','1');
		redirect('kategori_barang_c');
	}

	function data_kategori_id()
	{
		$id = $this->input->post('id');
		$data = $this->kategori->data_kategori_id($id);
		echo json_encode($data);
	}

	function ubah_divisi()
	{
		$id 				  = $this->input->post('id_kategori_modal');
		$kode_kategori_modal  = $this->input->post('kode_kategori_modal');
		$nama_kategori_modal  = $this->input->post('nama_kategori_modal');
		
		$this->kategori->ubah_data_kategori($id,$kode_kategori_modal,$nama_kategori_modal);
		$this->session->set_flashdata('sukses','1');
		redirect('kategori_barang_c');	
		// echo "1";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */