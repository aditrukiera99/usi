<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembelian_jasa_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pembelian_jasa_m','pengembalian');
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
				'title' 	      => 'Pembelian Jasa',
				'page'  	      => 'pembelian_jasa_v',
				'sub_menu' 	      => 'Pembelian',
				'sub_menu1'	      => 'Pembelian Jasa',
				'menu' 	   	      => 'Pembelian',
				'menu2'		      => 'pengembalian',
				'lihat_data'      => $this->pengembalian->lihat_data_pengembalian(),
				'lihat_barang'    => $this->pengembalian->lihat_data_barang(),
				'dt_dept'   	  => $this->pengembalian->lihat_data_divisi(),
				'dt_supp'   	  => $this->pengembalian->lihat_data_supplier(),
				'url_simpan' 	  => base_url().'pembelian_jasa_c/simpan',
				'url_hapus'  	  => base_url().'pembelian_jasa_c/hapus',
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

		$id_pengembalian     = $this->input->post('id_pengembalian');
		if ($id_pengembalian == '') {

			$sess_user = $this->session->userdata('sign_in');
			$nama = $sess_user['nama_user'];
			$departemen = $sess_user['departemen'];

			$dept_row = $this->db->query("SELECT * FROM master_divisi WHERE id_divisi = '$departemen'")->row();
			
			
			$get_nomor	   = $this->master_model_m->get_nomor_dokumen('PEMBELIAN_JASA');


			$no_bukti_real 		= $get_nomor."/SPK/".$dept_row->nama_divisi."/".$var."/".$tahun_kas;
			$tanggal 	  		= $this->input->post('tanggal');
			$uraian 	 	 	= $this->input->post('uraian');
			$subtotal_text 	  	= $this->input->post('subtotal_text');
			$po_text 	  		= $this->input->post('po_text');
			$ppn_text 	  		= $this->input->post('ppn_text');
			$pph_text 	  		= $this->input->post('pph_text');
			$total_semua 	  	= $this->input->post('total_semua');
			$id_supplier 	  	= $this->input->post('id_supplier');
			$pot_po 	  		= $this->input->post('pot_po');
			$ppn 	  			= $this->input->post('ppn');
			$pph 	  			= $this->input->post('pph');
			$terms 				= $this->input->post('terms');
			$terms_dua 			= $this->input->post('terms_dua');

			if($terms == 'Tunai'){
				$dta_terms = 'Tunai';
			}else if($terms == 'Minggu'){
				$dta_terms = $terms_dua.' Minggu';
			}else if ($terms == 'Proses') {
				$dta_terms = 'Pembayaran akan dilakukan secara proses </br>'.$terms_dua;
			}

			$this->master_model_m->update_nomor('PEMBELIAN_JASA');
			$this->pengembalian->simpan_data_barang($no_bukti_real,$tanggal,$uraian,$nama,$departemen,$subtotal_text,$po_text,$ppn_text,$pph_text,$total_semua,$id_supplier,$pot_po,$ppn,$pph,$dta_terms);
			

			$id_pengembalian_baru = $this->db->insert_id();
			$nama    					= $this->input->post('nama');
			$keterangan    				= $this->input->post('keterangan');
			$harga     					= $this->input->post('harga');
			$disc      					= $this->input->post('disc');
			$total 	    				= $this->input->post('total');
			$no_opek 		   			= $this->input->post('no_opek');
			$id_peminjaman_detail 		= $this->input->post('id_peminjaman_detail');

			foreach ($nama as $key => $val) {
					 $this->pengembalian->simpan_data_barang_detail($id_pengembalian_baru,$val,$keterangan[$key],$harga[$key],$disc[$key],$total[$key],$no_opek[$key]);
			}

			// foreach ($id_peminjaman_detail as $keyi => $vali) {
			// 	$this->pengembalian->update_selisih_detail($vali,$kuantitas[$keyi]);
			// }
			$this->session->set_flashdata('sukses','1');
			redirect('pembelian_jasa_c');
		
		}else{

			$sess_user = $this->session->userdata('sign_in');
			$nama = $sess_user['nama_user'];
			$departemen = $sess_user['departemen'];

			$dept_row = $this->db->query("SELECT * FROM master_divisi WHERE id_divisi = '$departemen'")->row();
			
			
			$tahun_kas = date("Y",strtotime($this->input->post('tanggal')));
			
			$sql_buk = "SELECT NEXT_NOMOR FROM ak_nomor WHERE TIPE = 'PEMBELIAN_JASA'";

	        $row_buk = $this->db->query($sql_buk)->row();

			$no_buk = $row_buk->NEXT_NOMOR + 1;

			$no_bukti_real = $no_buk."/SPK/".$dept_row->nama_divisi."/".$var."/".$tahun_kas;
			$tanggal 	  = $this->input->post('tanggal');
			$uraian 	  = $this->input->post('uraian');
			$subtotal_text 	  = $this->input->post('subtotal_text');
			$po_text 	  = $this->input->post('po_text');
			$ppn_text 	  = $this->input->post('ppn_text');
			$pph_text 	  = $this->input->post('pph_text');
			$total_semua 	  = $this->input->post('total_semua');

			$this->pengembalian->save_next_nomor('PEMBELIAN_JASA');
			$this->pengembalian->simpan_data_barang($no_bukti_real,$tanggal,$uraian,$nama,$departemen,$subtotal_text,$po_text,$ppn_text,$pph_text,$total_semua);
			

			$id_pengembalian_baru = $this->db->insert_id();
			$nama    					= $this->input->post('nama');
			$keterangan    				= $this->input->post('keterangan');
			$harga     					= $this->input->post('harga');
			$disc      					= $this->input->post('disc');
			$total 	    				= $this->input->post('total');
			$no_opek 		   			= $this->input->post('no_opek');
			$id_peminjaman_detail 		= $this->input->post('id_peminjaman_detail');

			foreach ($nama as $key => $val) {
					 $this->pengembalian->simpan_data_barang_detail($id_pengembalian_baru,$val,$keterangan[$key],$harga[$key],$disc[$key],$total[$key],$no_opek[$key]);
			}

			// foreach ($id_peminjaman_detail as $keyi => $vali) {
			// 	$this->pengembalian->update_selisih_detail($vali,$kuantitas[$keyi]);
			// }
			$this->session->set_flashdata('sukses','1');
			redirect('pembelian_jasa_c');
		}
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->pengembalian->hapus_pengembalian($id);
		$this->session->set_flashdata('hapus','1');
		redirect('pembelian_jasa_c');
	}

	function data_pengembalian_id()
	{
		$id = $this->input->post('id');
		$data = $this->pengembalian->data_pengembalian_id($id);
		echo json_encode($data);
	}

	function data_pengembalian_detail_id()
	{
		$id = $this->input->post('id');
		$data = $this->pengembalian->data_pengembalian_detail_id($id);
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
		$dt = $this->pengembalian->get_produk_detail($id_barang);

		echo json_encode($dt);
	}

	function get_transaction_info(){
		$id = $this->input->post('id');
		$dt = $this->pengembalian->get_transaction_info($id);

		echo json_encode($dt);
	}

	function get_transaction_supplier(){
		$id = $this->input->post('id');
		$dt = $this->pengembalian->get_transaction_supplier($id);

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

		$dt = $this->pengembalian->get_data_trx($id);
		$dt_det = $this->pengembalian->get_data_trx_detail($id);


		$data =  array(
			'page' => "pembelian_jasa_c", 
			'dt' => $dt,
			'dt_det' => $dt_det,
		);
		
		$this->load->view('pdf/report_surat_perintah_kerja_pdf', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */