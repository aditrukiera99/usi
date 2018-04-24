<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Divisi_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('divisi_m','divisi');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	 		=> 'Master Divisi',
				'page'  	 		=> 'divisi_v',
				'sub_menu' 	 		=> 'master data',
				'sub_menu1'	 		=> 'master divisi',
				'menu' 	   	 		=> 'master_data',
				'menu2'		 		=> 'divisi',
				'lihat_data' 		=> $this->divisi->lihat_data_divisi(),
				'lihat_departemen'  => $this->divisi->lihat_data_depart(),
				'url_simpan' 		=> base_url().'divisi_c/simpan',
				'url_hapus'  		=> base_url().'divisi_c/hapus',
				'url_ubah'	 		=> base_url().'divisi_c/ubah_divisi',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$id_depart   = $this->input->post('id_depart');
		$kode_divisi = $this->input->post('kode_divisi');
		$nama_divisi = $this->input->post('nama_divisi');

		$this->divisi->simpan_data_divisi($id_depart,$kode_divisi,$nama_divisi);
		$this->session->set_flashdata('sukses','1');
		redirect('divisi_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->divisi->hapus_divisi($id);
		$this->session->set_flashdata('hapus','1');
		redirect('divisi_c');
	}

	function data_divisi_id()
	{
		$id = $this->input->post('id');
		$data = $this->divisi->data_divisi_id($id);
		echo json_encode($data);
	}

	function ubah_divisi()
	{
		$id 				= $this->input->post('id_divisi_modal');
		$kode_divisi_modal  = $this->input->post('kode_divisi_modal');
		$nama_divisi_modal  = $this->input->post('nama_divisi_modal');
		
		$this->divisi->ubah_data_divisi($id,$kode_divisi_modal,$nama_divisi_modal);
		$this->session->set_flashdata('sukses','1');
		redirect('divisi_c');	
		// echo "1";
	}

	public function get_data_depart()
	{
		$kode =$this->input->post('kode');
		$sql  ="select * from master_departemen where id_depart = $kode ";
		$data = $this->db->query($sql)->row();

		echo json_encode($data); 
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */