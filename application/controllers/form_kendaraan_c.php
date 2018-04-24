<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_kendaraan_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('satuan_m','satuan');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	 => 'Master Satuan',
				'page'  	 => 'form_kendaraan',
				'sub_menu' 	 => 'master data',
				'sub_menu1'	 => 'master satuan',
				'menu' 	   	 => 'master_data',
				'menu2'		 => 'master satuan',
				'lihat_data'   => $this->satuan->lihat_data_satuan(),
				'satuan_utama' => $this->satuan->lihat_data_satuan_utama(),
				'url_simpan' => base_url().'satuan_c/simpan',
				'url_hapus'  => base_url().'satuan_c/hapus',
				'url_ubah'	 => base_url().'satuan_c/ubah_satuan',
			);
		
		$this->load->view('home_v',$data);
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */