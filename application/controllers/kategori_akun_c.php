<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_akun_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kategori_akun_m','kategori');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	 => 'Master Kategori Akun',
				'page'  	 => 'kategori_akun_v',
				'sub_menu' 	 => 'master data',
				'sub_menu1'	 => 'master kategori akun',
				'menu' 	   	 => 'master_data',
				'menu2'		 => 'master_kategori_akun',
				'lihat_data' => $this->kategori->lihat_data_kategori(),
				'url_simpan' => base_url().'kategori_akun_c/simpan',
				'url_hapus'  => base_url().'kategori_akun_c/hapus',
				'url_ubah'	 => base_url().'kategori_akun_c/ubah_kategori_akun',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$id_klien    	= $this->input->post('id_klien');
		$nama_kategori 	= $this->input->post('nama_kategori');
		$deskripsi 		= $this->input->post('deskripsi');
		$approve 		= $this->input->post('approve');
		$user_input 	= $this->input->post('user_input');
		$tgl_input 		= $this->input->post('tgl_input');

		$this->kategori->simpan_data_kategori($id_klien,$nama_kategori,$deskripsi,$approve,$user_input,$tgl_input);
		$this->session->set_flashdata('sukses','1');
		redirect('kategori_akun_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->kategori->hapus_kategori($id);
		$this->session->set_flashdata('hapus','1');
		redirect('kategori_akun_c');
	}

	function data_kategori_id()
	{
		$id = $this->input->post('id');
		$data = $this->kategori->data_kategori_id($id);
		echo json_encode($data);
	}

	function ubah_kategori_akun()
	{
		$id 			      = $this->input->post('id_kategori_modal');
		$id_klien_modal		  = $this->input->post('id_klien_modal');
		$nama_kategori_modal  = $this->input->post('nama_kategori_modal');
		$deskripsi_modal  	  = $this->input->post('deskripsi_modal');
		$approve_modal  	  = $this->input->post('approve_modal');
		$user_input_modal  	  = $this->input->post('user_input_modal');
		$tgl_input_modal  	  = $this->input->post('tgl_input_modal');
		
		$this->kategori->ubah_kategori_akun($id,$id_klien_modal,$nama_kategori_modal,$deskripsi_modal,$approve_modal,$user_input_modal,$tgl_input_modal);
		$this->session->set_flashdata('sukses','1');
		redirect('kategori_akun_c');	
		// echo "1";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */