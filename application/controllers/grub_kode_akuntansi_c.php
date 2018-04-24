<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grub_kode_akuntansi_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('grub_kode_akuntansi_m','grub_kode');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	 		=> 'Master Grup Kode Akuntansi',
				'page'  	 		=> 'grub_kode_akuntansi_v',
				'sub_menu' 	 		=> 'master data',
				'sub_menu1'	 		=> 'master grup kode akuntansi',
				'menu' 	   	 		=> 'master_data',
				'menu2'		 		=> 'grub_kode_akun',
				'lihat_data' 		=> $this->grub_kode->lihat_data_akun(),
				'url_simpan' 		=> base_url().'grub_kode_akuntansi_c/simpan',
				'url_hapus'  		=> base_url().'grub_kode_akuntansi_c/hapus',
				'url_ubah'	 		=> base_url().'grub_kode_akuntansi_c/ubah_grub_akun',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$grub 		 = $this->input->post('grub');
		$kode_grub   = $this->input->post('kode_grub');
		$nama_grub   = $this->input->post('nama_grub');
		$unit 		 = $this->input->post('unit');
		$approve   	 = $this->input->post('approve');

		$this->grub_kode->simpan_data_grub_kode_akun($grub,$kode_grub,$nama_grub,$unit,$approve);
		$this->session->set_flashdata('sukses','1');
		redirect('grub_kode_akuntansi_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->grub_kode->hapus_grub_kode_akun($id);
		$this->session->set_flashdata('hapus','1');
		redirect('grub_kode_akuntansi_c');
	}

	function data_grub_kode_akun_id()
	{
		$id = $this->input->post('id');
		$data = $this->grub_kode->data_grub_kode_akun_id($id);
		echo json_encode($data);
	}

	function ubah_grub_akun()
	{
		$id 	 		  = $this->input->post('id_kode_grub_modal');
		$grub_modal  	  = $this->input->post('grub_modal');
		$kode_grub_modal  = $this->input->post('kode_grub_modal');
		$nama_grub_modal  = $this->input->post('nama_grub_modal');
		$unit_modal  	  = $this->input->post('unit_modal');
		$approve_modal    = $this->input->post('approve_modal');
		
		$this->grub_kode->ubah_data_grub_kode_akun($id,$grub_modal,$kode_grub_modal,$nama_grub_modal,$unit_modal,$approve_modal);
		$this->session->set_flashdata('sukses','1');
		redirect('grub_kode_akuntansi_c');	
		// echo "1";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */