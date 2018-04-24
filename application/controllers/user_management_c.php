<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_management_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_management_m','user_management');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}	

	public function index()
	{
		$data = array(
				'title' 	 => 'Master user_management',
				'page'  	 => 'user_management_v',
				'sub_menu' 	 => 'master data',
				'sub_menu1'	 => 'master user_management',
				'menu' 	   	 => 'master_data',
				'menu2'		 => 'master user_management',
				'lihat_data'   => $this->user_management->lihat_data_user_management(),
				'divisi'   => $this->user_management->lihat_data_divisi(),
				'url_simpan' => base_url().'user_management_c/simpan',
				'url_hapus'  => base_url().'user_management_c/hapus',
				'url_ubah'	 => base_url().'user_management_c/ubah_user_management',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$tipe_user_management 	= $this->input->post('tipe_user_management');
		$nama_user 				= $this->input->post('nama_user');
		$username 				= $this->input->post('username');
		$password 				= md5($this->input->post('password'));;
		$departemen 			= $this->input->post('departemen');


		$this->user_management->simpan_data_user_management($tipe_user_management,$nama_user,$username,$password,$departemen);
		$this->session->set_flashdata('sukses','1');
		redirect('user_management_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->user_management->hapus_user_management($id);
		$this->session->set_flashdata('hapus','1');
		redirect('user_management_c');
	}

	function data_user_management_id()
	{
		$id = $this->input->post('id');
		$data = $this->user_management->data_user_management_id($id);
		echo json_encode($data);
	}

	function ubah_user_management()
	{
		$id 				= $this->input->post('id_user_management_modal');
		$kode_user_management_modal  = $this->input->post('kode_user_management_modal');
		$nama_user_management_modal  = $this->input->post('nama_user_management_modal');
		
		$this->user_management->ubah_data_user_management($id,$kode_user_management_modal,$nama_user_management_modal);
		$this->session->set_flashdata('sukses','1');
		redirect('user_management_c');	
		// echo "1";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */