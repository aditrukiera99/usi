<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_pekerjaan_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('order_pekerjaan_m','permintaan');
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
				'title' 	      => 'Permintaan Jasa',
				'page'  	      => 'order_pekerjaan_v',
				'sub_menu' 	      => 'Jasa',
				'sub_menu1'	      => 'Permintaan Jasa',
				'menu' 	   	      => 'Jasa',
				'menu2'		      => 'Permintaan Jasa',
				'lihat_data'      => $this->permintaan->lihat_data_permintaan(),
				'lihat_barang'    => $this->permintaan->lihat_data_barang(),
				'url_simpan' 	  => base_url().'order_pekerjaan_c/simpan',
				'url_hapus'  	  => base_url().'order_pekerjaan_c/hapus',
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

		$id_permintaan     = $this->input->post('id_permintaan');
		if ($id_permintaan == '') {

			$sess_user = $this->session->userdata('sign_in');
			$nama = $sess_user['nama_user'];
			$departemen = $sess_user['departemen'];

			$dept_row = $this->db->query("SELECT * FROM master_divisi WHERE id_divisi = '$departemen'")->row();
			
			
			$tahun_kas = date("Y",strtotime($this->input->post('tanggal')));
			
			$get_nomor	   = $this->master_model_m->get_nomor_dokumen('ORDER_PEKERJAAN');

			$no_bukti_real = $get_nomor."/OPEK/".$dept_row->nama_divisi."/".$var."/".$tahun_kas;

			$tanggal 	  	  = $this->input->post('tanggal');
			$uraian 	 	  = $this->input->post('uraian');
			$waktu 	  		  = $this->input->post('waktu');
			$tipe_waktu 	  = $this->input->post('tipe_waktu');
			$proyek_lambat 	  = $this->input->post('proyek_lambat');

			$this->master_model_m->update_nomor('ORDER_PEKERJAAN');
			$this->permintaan->simpan_data_barang($no_bukti_real,$tanggal,$uraian,$waktu,$tipe_waktu,$proyek_lambat,$departemen);

			$id_permintaan_baru = $this->db->insert_id();
			$nama 	    		= $this->input->post('nama');
			$keterangan    		= $this->input->post('keterangan');

			foreach ($nama as $key => $val) {
					 $this->permintaan->simpan_data_barang_detail($id_permintaan_baru,$val,$keterangan[$key],$departemen);
			}
			$this->session->set_flashdata('sukses','1');
			redirect('order_pekerjaan_c');
		
		}else{

			$sess_user = $this->session->userdata('sign_in');
			$nama = $sess_user['nama_user'];
			$departemen = $sess_user['departemen'];

			$dept_row = $this->db->query("SELECT * FROM master_divisi WHERE id_divisi = '$departemen'")->row();
			
			
			$tahun_kas = date("Y",strtotime($this->input->post('tanggal')));
			
			$sql_buk = "SELECT NEXT_NOMOR FROM ak_nomor WHERE TIPE = 'ORDER_PEKERJAAN'";

	        $row_buk = $this->db->query($sql_buk)->row();

			$no_buk = $row_buk->NEXT_NOMOR + 1;

			$no_bukti_real = $no_buk."/OPEK/".$dept_row->nama_divisi."/".$var."/".$tahun_kas;

			$tanggal 	  	  = $this->input->post('tanggal');
			$uraian 	 	  = $this->input->post('uraian');
			$waktu 	  		  = $this->input->post('waktu');
			$tipe_waktu 	  = $this->input->post('tipe_waktu');
			$proyek_lambat 	  = $this->input->post('proyek_lambat');

			$this->permintaan->save_next_nomor('ORDER_PEKERJAAN');
			$this->permintaan->simpan_data_barang($no_bukti_real,$tanggal,$uraian,$waktu,$tipe_waktu,$proyek_lambat,$departemen);

			$id_permintaan_baru = $this->db->insert_id();
			$nama 	    		= $this->input->post('nama');
			$keterangan    		= $this->input->post('keterangan');

			foreach ($nama as $key => $val) {
					 $this->permintaan->simpan_data_barang_detail($id_permintaan_baru,$val,$keterangan[$key],$departemen);
			}
			$this->session->set_flashdata('sukses','1');
			redirect('order_pekerjaan_c');
		}
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->permintaan->hapus_permintaan($id);
		$this->session->set_flashdata('hapus','1');
		redirect('order_pekerjaan_c');
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
			'page' => "order_pekerjaan_c", 
			'dt' => $dt,
			'dt_det' => $dt_det,
		);
		
		$this->load->view('pdf/report_order_pekerjaan_pdf', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */