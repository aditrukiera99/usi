<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kartu_stok_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
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
				'title' 	 		=> 'Kartu Stok',
				'page'  	 		=> 'kartu_stok_v',
				'sub_menu' 	 		=> 'Gudang',
				'sub_menu1'	 		=> 'Kartu Stok',
				'menu' 	   	 		=> 'gudang',
				'menu2'		 		=> 'kartu_stok',
				'dt' 			    => $this->db->get('master_barang')->result(),
				'url_simpan' 		=> base_url().'kartu_stok_c/simpan',
				'url_hapus'  		=> base_url().'kartu_stok_c/hapus',
				'url_ubah'	 		=> base_url().'kartu_stok_c/ubah_divisi',
			);
		
		$this->load->view('home_v',$data);
	}

	function cetak($id=""){

		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$barang = $this->input->post('barang');
		$view = "pdf/lap_kartu_stok_pdf";
		

        $dt = $this->db->query("SELECT tb.no_spb , tb.tanggal , tbd.keterangan ,  tbd.nama_produk , tbd.kuantitas , tbd.satuan 
        	FROM tb_permintaan_barang tb , tb_permintaan_barang_detail tbd 
        	WHERE tb.id_permintaan = tbd.id_induk AND tanggal LIKE '%-$bulan-$tahun%' AND tbd.nama_produk LIKE '%$barang%'
        ")->result();


		
		$data = array(
			'title' 		=> 'LAPORAN KARTU STOK ',
			'title2'		=> 'SEMUA BAGIAN',
			'dt'			=> $dt,
		);
		$this->load->view($view,$data);
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */