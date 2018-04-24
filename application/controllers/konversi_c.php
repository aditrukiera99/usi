<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Konversi_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('konversi_m','konversi');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	 => 'Master Konversi',
				'page'  	 => 'konversi_v',
				'sub_menu' 	 => 'master data',
				'sub_menu1'	 => 'master konversi',
				'menu' 	   	 => 'master_data',
				'menu2'		 => 'master konversi',
				'lihat_data' => $this->konversi->lihat_data_konversi(),
				'url_simpan' => base_url().'konversi_c/simpan',
				'url_hapus'  => base_url().'konversi_c/hapus',
				'url_ubah'	 => base_url().'konversi_c/ubah_konversi',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$kode_satuan_1 	 = $this->input->post('kode_satuan_1');
		$kode_satuan_2 	 = $this->input->post('kode_satuan_2');
		$nilai_1		 = $this->input->post('nilai_1');
		$nilai_2 		 = $this->input->post('nilai_2');

		$this->konversi->simpan_data_konversi($kode_satuan_1,$kode_satuan_2,$nilai_1,$nilai_2);
		$this->session->set_flashdata('sukses','1');
		redirect('konversi_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->konversi->hapus_konversi($id);
		$this->session->set_flashdata('hapus','1');
		redirect('konversi_c');
	}

	function data_konversi_id()
	{
		$id = $this->input->post('id');
		$data = $this->konversi->data_konversi_id($id);
		echo json_encode($data);
	}

	function ubah_konversi()
	{
		$id 					= $this->input->post('id_konversi_modal');
		$id_satuan_1_modal  	= $this->input->post('id_satuan_1_modal');
		$id_satuan_2_modal 		= $this->input->post('id_satuan_2_modal');
		$nilai_1_modal  		= $this->input->post('nilai_1_modal');
		$nilai_2_modal  		= $this->input->post('nilai_2_modal');
		
		$this->konversi->ubah_data_konversi($id,$id_satuan_1_modal,$id_satuan_2_modal,$nilai_1_modal,$nilai_2_modal);
		$this->session->set_flashdata('sukses','1');
		redirect('konversi_c');	
		// echo "1";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */