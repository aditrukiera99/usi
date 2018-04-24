<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peminjaman_barang_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('peminjaman_barang_m','peminjaman');
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
				'title' 	      => 'Peminjaman Barang',
				'page'  	      => 'peminjaman_barang_v',
				'sub_menu' 	      => 'pembelian',
				'sub_menu1'	      => 'Peminjaman barang',
				'menu' 	   	      => 'penjualan',
				'menu2'		      => 'peminjaman',
				'lihat_data'      => $this->peminjaman->lihat_data_peminjaman(),
				'lihat_barang'    => $this->peminjaman->lihat_data_barang(),
				'url_simpan' 	  => base_url().'peminjaman_barang_c/simpan',
				'url_hapus'  	  => base_url().'peminjaman_barang_c/hapus',
			);
		
		$this->load->view('home_v',$data);
	}

	

	function simpan()
	{

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

		$id_peminjaman     = $this->input->post('id_peminjaman');
		if ($id_peminjaman == '') {

			$sess_user = $this->session->userdata('sign_in');
			$nama = $sess_user['nama_user'];
			$departemen = $sess_user['departemen'];

			
			$dept_row = $this->db->query("SELECT * FROM master_divisi WHERE id_divisi = '$departemen'")->row();

			$tahun_kas = date("Y",strtotime($this->input->post('tanggal')));
			
			$get_nomor	   = $this->master_model_m->get_nomor_dokumen('PEMINJAMAN_BARANG_SATU');

			$no_bukti_real = $get_nomor."/SP1/".$dept_row->nama_divisi."/".$var."/".$tahun_kas;
			$tanggal 	  = $this->input->post('tanggal');
			$uraian 	  = $this->input->post('uraian');

			$this->master_model_m->update_nomor('PEMINJAMAN_BARANG_SATU');
			$this->peminjaman->simpan_data_barang($no_bukti_real,$tanggal,$uraian,$nama,$departemen);
			

			$id_peminjaman_baru = $this->db->insert_id();
			$id_produk 	    	= $this->input->post('produk');
			$nama_produk    	= $this->input->post('nama_produk');
			$keterangan     	= $this->input->post('keterangan');
			$kuantitas      	= $this->input->post('kuantitas');
			$satuan 	    	= $this->input->post('satuan');
			// $harga 		    	= $this->input->post('harga');
			// $jumlah 	    	= $this->input->post('jumlah');

			foreach ($nama_produk as $key => $val) {
					 $this->peminjaman->simpan_data_barang_detail($id_peminjaman_baru,$id_produk[$key],$val,$keterangan[$key],$kuantitas[$key],$satuan[$key]);
			}
			$this->session->set_flashdata('sukses','1');
			redirect('peminjaman_barang_c');
		
		}else{

			$id 		  = $this->input->post('id_peminjaman');
			$no_spb 	  = $this->input->post('no_spb');
			$tanggal 	  = $this->input->post('tanggal');
			$uraian 	  = $this->input->post('uraian');

			$this->peminjaman->ubah_data_peminjaman($id,$no_spb,$tanggal,$uraian);

			$nama_produk  		 = $this->input->post('nama_produk');
			$keterangan   		 = $this->input->post('keterangan');
			$kuantitas    		 = $this->input->post('kuantitas');
			$satuan 	  		 = $this->input->post('satuan');
			$harga 		  		 = $this->input->post('harga');
			$jumlah 	  		 = $this->input->post('jumlah');

			foreach ($nama_produk as $key => $val) {
				$this->peminjaman->ubah_data_peminjaman_detail($id,$val,$keterangan[$key],$kuantitas[$key],$satuan[$key],$harga[$key],$jumlah[$key]);
			}
			$this->session->set_flashdata('sukses','1');
			redirect('peminjaman_barang_c');
		}
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->peminjaman->hapus_peminjaman($id);
		$this->session->set_flashdata('hapus','1');
		redirect('peminjaman_barang_c');
	}

	function data_peminjaman_id()
	{
		$id = $this->input->post('id');
		$data = $this->peminjaman->data_peminjaman_id($id);
		echo json_encode($data);
	}

	function data_peminjaman_detail_id()
	{
		$id = $this->input->post('id');
		$data = $this->peminjaman->data_peminjaman_detail_id($id);
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
		$dt = $this->peminjaman->get_produk_detail($id_barang);

		echo json_encode($dt);
	}

	function tgl_to_romawi($var){
	  if($var == "01"){
	    $var = "I";
	   } else if($var == "02"){
	    $var = "II";
	   } else if($var == "03"){
	    $var = "III";
	   } else if($var == "04"){
	    $var = "IV";
	   } else if($var == "05"){
	    $var = "V";
	   } else if($var == "06"){
	    $var = "VI";
	   } else if($var == "07"){
	    $var = "VII";
	   } else if($var == "08"){
	    $var = "VIII";
	   } else if($var == "09"){
	    $var = "IX";
	   } else if($var == "10"){
	    $var = "X";
	   } else if($var == "11"){
	    $var = "XI";
	   } else if($var == "12"){
	    $var = "XII";
	   }

	   return $var;
	}

	function cetak($id=""){

		$dt = $this->peminjaman->get_data_trx($id);
		$dt_det = $this->peminjaman->get_data_trx_detail($id);


		$data =  array(
			'page' => "peminjaman_barang_c", 
			'dt' => $dt,
			'dt_det' => $dt_det,
		);
		
		$this->load->view('pdf/report_peminjaman_tools_pdf', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */