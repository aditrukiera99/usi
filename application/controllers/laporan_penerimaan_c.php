<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_penerimaan_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('laporan_penerimaan_m','laporan');
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
				'title' 	      => 'Laporan Penerimaan Barang',
				'page'  	      => 'laporan_penerimaan_v',
				'sub_menu' 	      => 'pembelian',
				'sub_menu1'	      => 'laporan penerimaan barang',
				'menu' 	   	      => 'penjualan',
				'menu2'		      => 'laporan_penerimaan',
				'lihat_data'      => $this->laporan->lihat_data_laporan(),
				'dt_dept'   	  => $this->laporan->lihat_data_divisi(),
				'url_simpan' 	  => base_url().'laporan_penerimaan_c/simpan',
				'url_hapus'  	  => base_url().'laporan_penerimaan_c/hapus',
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

		$id_laporan  = $this->input->post('id_laporan');
		if ($id_laporan == '') {
			$sess_user = $this->session->userdata('sign_in');
			$nama = $sess_user['nama_user'];
			$departemen = $sess_user['departemen'];

			$dept_row = $this->db->query("SELECT * FROM master_divisi WHERE id_divisi = '$departemen'")->row();
			
			
			$tahun_kas = date("Y",strtotime($this->input->post('tanggal')));
			

			$get_nomor	   = $this->master_model_m->get_nomor_dokumen('LAPORAN_PENERIMAAN_BARANG');
			
			$no_bukti_real = $get_nomor."/LPB/".$dept_row->nama_divisi."/".$var."/".$tahun_kas;

			
			$tanggal 	 = $this->input->post('tanggal');
			$no_po 		 = $this->input->post('no_po');
			$diterima 	 = $this->input->post('diterima');

			$this->master_model_m->update_nomor('LAPORAN_PENERIMAAN_BARANG');
			$this->laporan->simpan_data_laporan($no_bukti_real,$tanggal,$no_po,$diterima);

			$id_laporan_baru = $this->db->insert_id();
			$id_produk 		 = $this->input->post('id_produk');
			$nama_produk 	 = $this->input->post('nama_produk');
			$keterangan  	 = $this->input->post('keterangan');
			$kuantitas 	 	 = $this->input->post('kuantitas');
			$harga 		 	 = $this->input->post('harga_awal');
			$total 		 	 = $this->input->post('total');
			$no_opb 	 	 = $this->input->post('no_opb');

			foreach ($nama_produk as $key => $val) {
				$this->laporan->simpan_data_laporan_detail($id_laporan_baru,$id_produk[$key],$val,$keterangan[$key],$kuantitas[$key],$harga[$key],$total[$key],$no_opb[$key]);
			}
			$this->session->set_flashdata('sukses','1');
			redirect('laporan_penerimaan_c');
		
		}else{

			$id 		 = $this->input->post('id_laporan');
			$no_lpb 	 = $this->input->post('no_lpb');
			$tanggal 	 = $this->input->post('tanggal');
			$no_po 		 = $this->input->post('no_po');
			$diterima 	 = $this->input->post('diterima');

			$this->laporan->ubah_data_laporan($no_lpb,$tanggal,$no_po,$diterima);

			$id_laporan_baru = $this->db->insert_id();
			$id_produk 		 = $this->input->post('produk');
			$nama_produk 	 = $this->input->post('nama_produk');
			$keterangan  	 = $this->input->post('keterangan');
			$kuantitas 	 	 = $this->input->post('kuantitas');
			$harga 		 	 = $this->input->post('harga');
			$total 		 	 = $this->input->post('total');
			$no_opb 	 	 = $this->input->post('no_opb');

			foreach ($nama_produk as $key => $val) {
				$this->laporan->ubah_data_laporan_detail($id_laporan,$id_laporan_baru,$id_produk,$val,$keterangan[$key],$kuantitas[$key],$harga[$key],$total[$key],$no_opb[$key]);
			}
			$this->session->set_flashdata('sukses','1');
			redirect('laporan_penerimaan_c');
		}
		
	}

	function hapus()
	{
		$id = $this->input->post('id_hapus');
		$this->laporan->hapus_laporan($id);
		$this->session->set_flashdata('hapus','1');
		redirect('laporan_penerimaan_c');
	}

	function data_laporan_id()
	{
		$id = $this->input->post('id');
		$data = $this->laporan->data_laporan_id($id);
		echo json_encode($data);
	}

	function po_detail_produk()
	{
		$id = $this->input->post('id');

		$sql = "
		SELECT b.*, a.no_po FROM tb_purchase_order a
		JOIN tb_purchase_order_detail b ON a.id_purchase = b.id_induk
		WHERE a.id_purchase = $id
		";

		$dt = $this->db->query($sql)->result();
        echo json_encode($dt);
	}

	function get_po_popup()
	{
		$where = "1=1";

		$keyword = $this->input->post('keyword');
		if ($keyword != "" || $keyword != null) {
			$where = $where."AND (no_po LIKE '%$keyword%' OR supplier LIKE '%$keyword%')";
		}

		$sql = "SELECT * FROM tb_purchase_order WHERE $where ORDER BY id_purchase ASC LIMIT 10 ";

		$dt = $this->db->query($sql)->result();
		echo json_encode($dt);
	}

	function get_transaction_info(){
		$id = $this->input->post('id');
		$dt = $this->laporan->get_transaction_info($id);

		echo json_encode($dt);
	}

	function get_po_detail()
	{
		$id_purchase = $this->input->get('id_purchase');
		$dt = $this->laporan->get_po_detail($id_purchase);

		echo json_encode($dt);
	}

	function get_produk_popup()
	{
		$where = "1=1";

		$keyword = $this->input->post('keyword');
		if($keyword != "" || $keyword != null){
			$where = $where." AND (nama_barang LIKE '%$keyword%' OR harga_beli LIKE '%$keyword%')";
		}

		$sql = " SELECT * FROM master_barang WHERE $where ORDER BY id_barang DESC LIMIT 10";

		$dt = $this->db->query($sql)->result();

		echo json_encode($dt);
	}

	function get_produk_detail()
	{
		$id_barang = $this->input->get('id_barang');
		$dt = $this->laporan->get_produk_detail($id_barang);

		echo json_encode($dt);
	}

	function cetak($id=""){

		$dt = $this->laporan->get_data_trx($id);
		$dt_det = $this->laporan->get_data_trx_detail($id);


		$data =  array(
			'page' => "laporan_penerimaan_c", 
			'dt' => $dt,
			'dt_det' => $dt_det,
		);
		
		$this->load->view('pdf/report_laporan_penerimaan_barang_pdf', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */