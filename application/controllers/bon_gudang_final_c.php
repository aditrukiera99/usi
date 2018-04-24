<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bon_gudang_final_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('bon_gudang_final_m','bon_gudang_final');
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
				'title' 	      => 'Bon Gudang Final',
				'page'  	      => 'bon_gudang_final_v',
				'sub_menu' 	      => 'Bon Gudang Final',
				'sub_menu1'	      => 'Bon Gudang Final',
				'menu' 	   	      => 'bon',
				'menu2'		      => 'bon',
				'lihat_data'      => $this->bon_gudang_final->lihat_data_bon_gudang_final(),
				'lihat_barang'    => $this->bon_gudang_final->lihat_data_barang(),
				'dt_dept'   	  => $this->bon_gudang_final->lihat_data_divisi(),
				'url_simpan' 	  => base_url().'bon_gudang_final_c/simpan',
				'url_hapus'  	  => base_url().'bon_gudang_final_c/hapus',
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

		$id_bon_gudang_final     = $this->input->post('id_bon_gudang_final');
		if ($id_bon_gudang_final == '') {

			$sess_user = $this->session->userdata('sign_in');
			$nama = $sess_user['nama_user'];
			$departemen = $sess_user['departemen'];

			$dept_row = $this->db->query("SELECT * FROM master_divisi WHERE id_divisi = '$departemen'")->row();
			
			
			$tahun_kas = date("Y",strtotime($this->input->post('tanggal')));
			
			
			$get_nomor	   = $this->master_model_m->get_nomor_dokumen('BON_GUDANG_FINAL');

			$no_bukti_real = $get_nomor."/BGF/".$dept_row->nama_divisi."/".$var."/".$tahun_kas;

			$tanggal 	  = $this->input->post('tanggal');
			$uraian 	  = $this->input->post('uraian');

			$this->master_model_m->update_nomor('BON_GUDANG_FINAL');
			$this->bon_gudang_final->simpan_data_barang($no_bukti_real,$tanggal,$uraian,$nama,$departemen);
			

			$id_bon_gudang_final_baru 		= $this->db->insert_id();
			$nama_produk 	    			= $this->input->post('nama_produk');
			$produk    						= $this->input->post('produk');
			$keterangan     				= $this->input->post('keterangan');
			$kuantitas      				= $this->input->post('kuantitas');
			$satuan 	    				= $this->input->post('satuan');
			$reff_no 		    			= $this->input->post('reff_no');
			$tgl_pemakaian 		    		= $this->input->post('tgl_pemakaian');
			$id_peminjaman_detail 		    = $this->input->post('id_peminjaman_detail');

			foreach ($nama_produk as $key => $val) {
					 $this->bon_gudang_final->simpan_data_barang_detail($id_bon_gudang_final_baru,$produk[$key],$val,$keterangan[$key],$kuantitas[$key],$satuan[$key],$reff_no[$key],$tgl_pemakaian[$key]);
			}

			foreach ($id_peminjaman_detail as $keyi => $vali) {
				$this->bon_gudang_final->update_selisih_detail($vali,$kuantitas[$keyi]);
			}
			$this->session->set_flashdata('sukses','1');
			redirect('bon_gudang_final_c');
		
		}else{

			$sess_user = $this->session->userdata('sign_in');
			$nama = $sess_user['nama_user'];
			$departemen = $sess_user['departemen'];

			$dept_row = $this->db->query("SELECT * FROM master_divisi WHERE id_divisi = '$departemen'")->row();
			
			
			$tahun_kas = date("Y",strtotime($this->input->post('tanggal')));
			
			$sql_buk = "SELECT NEXT_NOMOR FROM ak_nomor WHERE TIPE = 'BON_GUDANG_final_SEMENTARA'";

	        $row_buk = $this->db->query($sql_buk)->row();

			$no_buk = $row_buk->NEXT_NOMOR + 1;

			$no_bukti_real = $no_buk."/SP2/".$dept_row->nama_divisi."/".$var."/".$tahun_kas;
			$tanggal 	  = $this->input->post('tanggal');
			$uraian 	  = $this->input->post('uraian');

			$this->bon_gudang_final->save_next_nomor('bon_gudang_final_DUA');
			$this->bon_gudang_final->simpan_data_barang($no_bukti_real,$tanggal,$uraian,$nama,$departemen);
			

			$id_bon_gudang_final_baru = $this->db->insert_id();
			$nama_produk 	    = $this->input->post('nama_produk');
			$produk    			= $this->input->post('produk');
			$keterangan     	= $this->input->post('keterangan');
			$kuantitas      	= $this->input->post('kuantitas');
			$satuan 	    	= $this->input->post('satuan');
			$reff_no 		    = $this->input->post('reff_no');
			$id_peminjaman_detail 		    = $this->input->post('id_peminjaman_detail');

			foreach ($nama_produk as $key => $val) {
					 $this->bon_gudang_final->simpan_data_barang_detail($id_bon_gudang_final_baru,$produk[$key],$val,$keterangan[$key],$kuantitas[$key],$satuan[$key],$reff_no[$key]);
			}

			foreach ($id_peminjaman_detail as $keyi => $vali) {
				$this->bon_gudang_final->update_selisih_detail($vali,$kuantitas[$keyi]);
			}
			$this->session->set_flashdata('sukses','1');
			redirect('bon_gudang_final_c');
		}
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->bon_gudang_final->hapus_bon_gudang_final($id);
		$this->session->set_flashdata('hapus','1');
		redirect('bon_gudang_final_c');
	}

	function data_bon_gudang_final_id()
	{
		$id = $this->input->post('id');
		$data = $this->bon_gudang_final->data_bon_gudang_final_id($id);
		echo json_encode($data);
	}

	function data_bon_gudang_final_detail_id()
	{
		$id = $this->input->post('id');
		$data = $this->bon_gudang_final->data_bon_gudang_final_detail_id($id);
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
		$dt = $this->bon_gudang_final->get_produk_detail($id_barang);

		echo json_encode($dt);
	}

	function get_transaction_info(){
		$id = $this->input->post('id');
		$dt = $this->bon_gudang_final->get_transaction_info($id);

		echo json_encode($dt);
	}

	function get_transaction_info_bgs(){
		$id = $this->input->post('id');
		$dt = $this->bon_gudang_final->get_transaction_info_bgs($id);

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

		$dt = $this->bon_gudang_final->get_data_trx($id);
		$dt_det = $this->bon_gudang_final->get_data_trx_detail($id);


		$data =  array(
			'page' => "bon_gudang_final_c", 
			'dt' => $dt,
			'dt_det' => $dt_det,
		);
		
		$this->load->view('pdf/report_bon_pemakaian_barang_pdf', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */