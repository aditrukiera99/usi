<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lap_pembelian_jasa_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('divisi_m','divisi');
		$data = $this->session->userdata('sign_in');
        $nama = $data['id'];

        if($nama == "" || $nama == null){
        	redirect('login_c','refresh');
        }

        $this->load->helper('url');
		$this->load->library('fpdf/HTML2PDF');
	}

	public function index()
	{
		$data = array(
				'title' 	 		=> 'Laporan Pembelian jasa',
				'page'  	 		=> 'lap_pembelian_jasa_v',
				'sub_menu' 	 		=> 'Laporan',
				'sub_menu1'	 		=> 'Penerimaan jasa',
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

	function cetak($id=""){

		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$view = "pdf/lap_pembelian_jasa_pdf";
		

        $dt = $this->db->query("SELECT * FROM tb_pembelian_jasa WHERE tanggal LIKE '%-$bulan-$tahun%' ")->result();


		
		$data = array(
			'title' 		=> 'LAPORAN PERMINTAAN JASA ',
			'title2'		=> 'SEMUA BAGIAN',
			'dt'			=> $dt,
		);
		$this->load->view($view,$data);
	}

	function cetak_supplier($id=""){

		$view = "pdf/lap_daftar_supplier_pdf";
		

        $dt = $this->db->query("SELECT * FROM master_supplier ")->result();


		
		$data = array(
			'title' 		=> 'LAPORAN PERMINTAAN JASA ',
			'title2'		=> 'SEMUA BAGIAN',
			'dt'			=> $dt,
		);
		$this->load->view($view,$data);
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */