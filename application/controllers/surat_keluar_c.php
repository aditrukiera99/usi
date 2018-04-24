<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Surat_keluar_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('surat_keluar_m','permintaan');
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
				'title' 	      => 'Surat Keluar',
				'page'  	      => 'surat_keluar_v',
				'sub_menu' 	      => 'pembelian',
				'sub_menu1'	      => 'permintaan barang',
				'menu' 	   	      => 'penjualan',
				'menu2'		      => 'permintaan',
				'lihat_data'      => $this->permintaan->lihat_data_permintaan(),
				'lihat_barang'    => $this->permintaan->lihat_data_barang(),
				'url_simpan' 	  => base_url().'surat_keluar_c/simpan',
				'url_hapus'  	  => base_url().'surat_keluar_c/hapus',
			);
		
		$this->load->view('home_v',$data);
	}

	function simpan()
	{
		$id_permintaan     = $this->input->post('id_permintaan');

		$bulan_kas = date("m",strtotime($this->input->post('tanggal')));

		if($bulan_kas == "01"){
	    $var = "I";
	   } else if($bulan_kas == "02"){
	    $var = "II";
	   } else if($bulan_kas == "03"){
	    $var = "III";
	   } else if($bulan_kas == "04"){
	    $var = "IV";
	   } else if($bulan_kas == "05"){
	    $var = "V";
	   } else if($bulan_kas == "06"){
	    $var = "VI";
	   } else if($bulan_kas == "07"){
	    $var = "VII";
	   } else if($bulan_kas == "08"){
	    $var = "VIII";
	   } else if($bulan_kas == "09"){
	    $var = "IX";
	   } else if($bulan_kas == "10"){
	    $var = "X";
	   } else if($bulan_kas == "11"){
	    $var = "XI";
	   } else if($bulan_kas == "12"){
	    $var = "XII";
	   }
		if ($id_permintaan == '') {


			$sess_user = $this->session->userdata('sign_in');
			$nama = $sess_user['nama_user'];
			$departemen = $sess_user['departemen'];

			$dept_row = $this->db->query("SELECT * FROM master_divisi WHERE id_divisi = '$departemen'")->row();
			
			
			$tahun_kas = date("Y",strtotime($this->input->post('tanggal')));
			
			$get_nomor	   = $this->master_model_m->get_nomor_dokumen('SURAT_BARANG_KELUAR');

			$no_bukti_real 		= $get_nomor."/SBK/".$dept_row->nama_divisi."/".$var."/".$tahun_kas;

			$no_spb 	  = $this->input->post('no_spb');
			$tanggal 	  = $this->input->post('tanggal');
			$uraian 	  = $this->input->post('uraian');

			$this->master_model_m->update_nomor('SURAT_BARANG_KELUAR');
			$this->permintaan->simpan_data_barang($no_bukti_real,$tanggal,$uraian,$departemen);

			$id_permintaan_baru = $this->db->insert_id();
			$id_produk 	    	= $this->input->post('produk');
			$nama_produk    	= $this->input->post('nama_produk');
			$keterangan     	= $this->input->post('keterangan');
			$kuantitas      	= $this->input->post('kuantitas');
			$satuan 	    	= $this->input->post('satuan');
			// $harga 		    	= $this->input->post('harga');
			// $jumlah 	    	= $this->input->post('jumlah');

			foreach ($nama_produk as $key => $val) {
					 $this->permintaan->simpan_data_barang_detail($id_permintaan_baru,$id_produk,$val,$keterangan[$key],$kuantitas[$key],$satuan[$key]);
			}
			$this->session->set_flashdata('sukses','1');
			redirect('surat_keluar_c');
		
		}else{

			$id 		  = $this->input->post('id_permintaan');
			$no_spb 	  = $this->input->post('no_spb');
			$tanggal 	  = $this->input->post('tanggal');
			$uraian 	  = $this->input->post('uraian');

			$this->permintaan->ubah_data_permintaan($id,$no_spb,$tanggal,$uraian);

			$nama_produk  		 = $this->input->post('nama_produk');
			$keterangan   		 = $this->input->post('keterangan');
			$kuantitas    		 = $this->input->post('kuantitas');
			$satuan 	  		 = $this->input->post('satuan');
			$harga 		  		 = $this->input->post('harga');
			$jumlah 	  		 = $this->input->post('jumlah');

			foreach ($nama_produk as $key => $val) {
				$this->permintaan->ubah_data_permintaan_detail($id,$val,$keterangan[$key],$kuantitas[$key],$satuan[$key],$harga[$key],$jumlah[$key]);
			}
			$this->session->set_flashdata('sukses','1');
			redirect('surat_keluar_c');
		}
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->permintaan->hapus_permintaan($id);
		$this->session->set_flashdata('hapus','1');
		redirect('surat_keluar_c');
	}

	function data_permintaan_id()
	{
		$id = $this->input->post('id');
		$data = $this->permintaan->data_permintaan_id($id);
		echo json_encode($data);
	}

	function data_permintaan_detail_id()
	{
		$id = $this->input->post('id');
		$data = $this->permintaan->data_permintaan_detail_id($id);
		echo json_encode($data);	
	}

	function get_produk_popup()
	{
		$where = "1=1";

		$keyword = $this->input->post('keyword');
		if($keyword != "" || $keyword != null){
			$where = $where." AND (kode_barang LIKE '%$keyword%' OR nama_barang LIKE '%$keyword%')";
		}

		$sql = "
		SELECT * FROM master_barang WHERE $where 
		ORDER BY id_barang DESC
		LIMIT 10
		";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_produk_detail(){
		$id_barang = $this->input->get('id_barang');
		$dt = $this->permintaan->get_produk_detail($id_barang);

		echo json_encode($dt);
	}

	function cetak($id=""){

		$dt = $this->permintaan->get_data_trx($id);
		$dt_det = $this->permintaan->get_data_trx_detail($id);


		$data =  array(
			'page' => "surat_keluar_c", 
			'dt' => $dt,
			'dt_det' => $dt_det,
		);
		
		$this->load->view('pdf/report_surat_surat_keluar_pdf', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */