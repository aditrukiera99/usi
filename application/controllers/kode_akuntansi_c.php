<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kode_akuntansi_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kode_akuntansi_m','model');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }
	}

	public function index()
	{
		$data = array(
				'title' 	 		=> 'Master Kode Akuntansi',
				'page'  	 		=> 'kode_akuntansi_v',
				'sub_menu' 	 		=> 'master data',
				'sub_menu1'	 		=> 'master kode akuntansi',
				'menu' 	   	 		=> 'master_data',
				'menu2'		 		=> 'kode_akuntansi',
				'lihat_data' 		=> $this->model->lihat_data_kode_akun(),
				'lihat_data_grup' 	=> $this->model->lihat_data_grup(),
				'url_simpan' 		=> base_url().'kode_akuntansi_c/simpan',
				'url_hapus'  		=> base_url().'kode_akuntansi_c/hapus',
				'url_ubah'	 		=> base_url().'kode_akuntansi_c/ubah_kode_akun',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$grup        = $this->input->post('grup');
		$kode_akun 	 = $this->input->post('kode_akun');
		$nama_akun 	 = $this->input->post('nama_akun');
		$tipe 	     = $this->input->post('tipe');

		$data = array(
	        'KODE_GRUP'      => addslashes($this->input->post('grup')),
			'KODE_AKUN' => addslashes($this->input->post('kode_akun')),
			'NAMA_AKUN' => addslashes($this->input->post('nama_akun')),
			'TIPE'      => addslashes($this->input->post('tipe'))
	    );

	    $this->db->insert('ak_kode_akuntansi',$data);

		$this->session->set_flashdata('sukses','1');
		redirect('kode_akuntansi_c');
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->db->where('ID', $id);
   		$this->db->delete('ak_kode_akuntansi'); 

		$this->session->set_flashdata('hapus','1');
		redirect('kode_akuntansi_c');
	}

	function data_kode_akun_id()
	{
		$id = $this->input->post('id');
		$data = $this->model->data_kode_akun_id($id);
		echo json_encode($data);
	}

	function ubah_kode_akun()
	{
		$id 				= $this->input->post('id_akun_modal');
		
		$data = array(
	        'KODE_GRUP' => addslashes($this->input->post('grup_modal')),
			'KODE_AKUN' => addslashes($this->input->post('kode_akun_modal')),
			'NAMA_AKUN' => addslashes($this->input->post('nama_akun_modal')),
			'TIPE'      => addslashes($this->input->post('tipe_modal'))
	    );

		$this->db->where('ID', $id);
    	$this->db->update('ak_kode_akuntansi', $data);

		$this->session->set_flashdata('sukses','1');
		redirect('kode_akuntansi_c');	
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