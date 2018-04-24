<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Satuan_c extends CI_Controller {

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
				'page'  	 => 'satuan_v',
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

	function simpan()
	{
		$kode_satuan = $this->input->post('kode_satuan');
		$nama_satuan = $this->input->post('nama_satuan');
		$konversi = $this->input->post('konversi');
		$satuan_utama = $this->input->post('satuan_utama');
		if($satuan_utama == ''){
			$itu = $kode_satuan;
		}else{
			$itu = $satuan_utama;
		}
		$tipe_satuan = $this->input->post('tipe_satuan');

		$this->satuan->simpan_data_satuan($kode_satuan,$nama_satuan,$konversi,$itu,$tipe_satuan);
		$this->session->set_flashdata('sukses','1');
		redirect('satuan_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->satuan->hapus_satuan($id);
		$this->session->set_flashdata('hapus','1');
		redirect('satuan_c');
	}

	function data_satuan_id()
	{
		$id = $this->input->post('id');
		$data = $this->satuan->data_satuan_id($id);
		echo json_encode($data);
	}

	function ubah_satuan()
	{
		$id 				= $this->input->post('id_satuan_modal');
		$kode_satuan_modal  = $this->input->post('kode_satuan_modal');
		$nama_satuan_modal  = $this->input->post('nama_satuan_modal');
		
		$this->satuan->ubah_data_satuan($id,$kode_satuan_modal,$nama_satuan_modal);
		$this->session->set_flashdata('sukses','1');
		redirect('satuan_c');	
		// echo "1";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */